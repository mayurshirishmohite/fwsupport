<?php
/*
 *  Author: Mikle Inc
 *  URL: https://feed.mikle.com/ 
 */

/*
 *
 * Remove unnecessary elements automatically added on header
 *
 */
     remove_action('wp_head', 'feed_links_extra', 3);
     remove_action('wp_head', 'rsd_link');
     remove_action('wp_head', 'wlwmanifest_link');
     remove_action('wp_head', 'wp_generator');
     remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
     remove_action('wp_head', 'print_emoji_detection_script', 7);
     remove_action('admin_print_scripts', 'print_emoji_detection_script');
     remove_action('wp_print_styles', 'print_emoji_styles' );
     remove_action('admin_print_styles', 'print_emoji_styles');
     remove_action('wp_head', 'rest_output_link_wp_head');
     remove_action('wp_head', 'wp_oembed_add_discovery_links');
     remove_action('wp_head', 'wp_oembed_add_host_js');
     remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
     remove_action('wp_head', 'rel_canonical');
     remove_action('wp_head','wp_resource_hints',2);
     wp_deregister_style( 'wp-block-library' ); 
     wp_register_style( 'wp-block-library', null, [], 1 );
     wp_deregister_style( 'wp-block-library-theme' ); 
     wp_register_style( 'wp-block-library-theme', null, [], 1 );

// Remove WP JQuery and Migrate scripts and replace with custom CDN
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

/*
 *
 * Stop auto redirection from 404 to the correct URL
 * https://qiita.com/tkykmw/items/7b822f7c1a22f888382a
 * https://core.trac.wordpress.org/ticket/16557#comment:2
 *
 */
add_filter('redirect_canonical', 'remove_redirect_guess_404_permalink', 10, 2);
function remove_redirect_guess_404_permalink($redirect_url, $requested_url) {
  if(is_404()) {
    return false;
  }
  return $redirect_url;
}

/*
 *
 * Pagination added to category.php, saerch.php and tag.php
 * https://fellowtuts.com/bootstrap/wordpress-pagination-bootstrap-4-style/
 
 * Custom Function for Pagination to rewrite base URL 
 * Added by : FW
 */
 
function get_pagenum_link_custom( $pagenum = 1, $escape = true ) {
    global $wp_rewrite;
 
    $pagenum = (int) $pagenum;
 
    $request = remove_query_arg( 'paged' );
 
    $home_root = parse_url( home_url() );
    $home_root = ( isset( $home_root['path'] ) ) ? $home_root['path'] : '';
    $home_root = preg_quote( $home_root, '|' );
 
    $request = preg_replace( '|^' . $home_root . '|i', '', $request );
    $request = preg_replace( '|^/+|', '', $request );
 
    if ( ! $wp_rewrite->using_permalinks() || is_admin() ) {
        $base = 'https://feed.mikle.com/support/';
 
        if ( $pagenum > 1 ) {
            $result = add_query_arg( 'paged', $pagenum, $base . $request );
        } else {
            $result = $base . $request;
        }
    } else {
        $qs_regex = '|\?.*?$|';
        preg_match( $qs_regex, $request, $qs_match );
 
        if ( ! empty( $qs_match[0] ) ) {
            $query_string = $qs_match[0];
            $request      = preg_replace( $qs_regex, '', $request );
        } else {
            $query_string = '';
        }
 
        $request = preg_replace( "|$wp_rewrite->pagination_base/\d+/?$|", '', $request );
        $request = preg_replace( '|^' . preg_quote( $wp_rewrite->index, '|' ) . '|i', '', $request );
        $request = ltrim( $request, '/' );
 
        $base = 'https://feed.mikle.com/support/';
 
        if ( $wp_rewrite->using_index_permalinks() && ( $pagenum > 1 || '' != $request ) ) {
            $base .= $wp_rewrite->index . '/';
        }
 
        if ( $pagenum > 1 ) {
            $request = ( ( ! empty( $request ) ) ? trailingslashit( $request ) : $request ) . user_trailingslashit( $wp_rewrite->pagination_base . '/' . $pagenum, 'paged' );
        }
 
        $result = $base . $request . $query_string;
    }
 
    /**
     * Filters the page number link for the current request.
     *
     * @since 2.5.0
     *
     * @param string $result The page number link.
     */
    $result = apply_filters( 'get_pagenum_link', $result );
 
    if ( $escape ) {
        return esc_url( $result );
    } else {
        return esc_url_raw( $result );
    }
}
function fellowtuts_wpbs_pagination($pages = '', $range = 2) 
{  
	$showitems = ($range * 2) + 1;  
	global $paged;
	if(empty($paged)) $paged = 1;
	if($pages == '')
	{
		global $wp_query; 
		$pages = $wp_query->max_num_pages;
	
		if(!$pages)
			$pages = 1;		 
	}   
	
	if(1 != $pages)
	{
		echo '<nav aria-label="Page navigation" role="navigation">';
		echo '<span class="sr-only">Page navigation</span>';
		echo '<ul class="pagination justify-content-center ft-wpbs">';
		echo '<li class="page-item disabled hidden-md-down d-none d-lg-block"><span class="page-link">'.$paged.' / '.$pages.'</span></li>';

		if($paged > 2 && $paged > $range+1 && $showitems < $pages) 
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link_custom(1).'" aria-label="First Page">&laquo;<span class="hidden-sm-down d-none d-md-block"> First</span></a></li>';

		if($paged > 1 && $showitems < $pages) 
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link_custom($paged - 1).'" aria-label="Previous Page">&lsaquo;<span class="hidden-sm-down d-none d-md-block"> Previous</span></a></li>';

		for ($i=1; $i <= $pages; $i++)
		{
		    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				echo ($paged == $i)? '<li class="page-item active"><span class="page-link"><span class="sr-only">Current Page </span>'.$i.'</span></li>' : '<li class="page-item"><a class="page-link" href="'.get_pagenum_link_custom($i).'"><span class="sr-only">Page </span>'.$i.'</a></li>';
		}
		
		if ($paged < $pages && $showitems < $pages) 
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link_custom($paged + 1).'" aria-label="Next Page"><span class="hidden-sm-down d-none d-md-block">Next </span>&rsaquo;</a></li>';  

	 	if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link_custom($pages).'" aria-label="Last Page"><span class="hidden-sm-down d-none d-md-block">Last </span>&raquo;</a></li>';

	 	echo '</ul>';
        echo '</nav>';
        //echo '<div class="pagination-info mb-5 text-center">[ <span class="text-muted">Page</span> '.$paged.' <span class="text-muted">of</span> '.$pages.' ]</div>';	 	
	}
}

/*
 *
 * Add custom field to WordPress Admin Writing Post Advanced Panel
 * https://codex.wordpress.org/Writing_Posts
 * 
 */
add_action('admin_menu', 'add_custom_fields');
add_action('save_post', 'save_custom_fields');

function add_custom_fields() {
	add_meta_box( 'my_sectionid', 'Customfield', 'my_custom_fields', 'post');
}

/* Display custom field */
function my_custom_fields() {
	global $post;
	$esdescription = get_post_meta($post->ID,'esdescription',true);
	$easysteps = get_post_meta($post->ID,'easysteps',true);

	echo '<p>Description<br />';
	echo '<input type="text" name="esdescription" value="'.esc_html($esdescription).'" size="100%" /></p>';
	echo '<p>Easy Steps<br />';
	echo '<textarea name="easysteps" style="width:100%;height:200px" />'.esc_html($easysteps).'</textarea></p>';
}

/* Store the value of custom field */
function save_custom_fields( $post_id ) {
	if(!empty($_POST['esdescription']))
		update_post_meta($post_id, 'esdescription', $_POST['esdescription'] );
		else delete_post_meta($post_id, 'esdescription');
 
	if(!empty($_POST['easysteps']))
		update_post_meta($post_id, 'easysteps', $_POST['easysteps'] );
		else delete_post_meta($post_id, 'easysteps');
}

/*
 *
 * Short code list
 *
 */
function show_easysteps() {
  ob_start();
  get_template_part('easysteps'); // display the content of easysteps.php
  return ob_get_clean();
}
add_shortcode('easysteps', 'show_easysteps');

// This replaces the srcset tags with the feed.mikle.com from  http://34.192.136.101  (alias):
// This is also where I could change all image URLs over to be secure links (HTTPS)
function change_cdn_srcset($sources) {
	foreach ( $sources as $source ) {
		$sources[ $source['value'] ][ 'url' ] = str_replace('http://34.192.136.101', 'https://feed.mikle.com', $sources[ $source['value'] ][ 'url' ]);
		// you MAY use external domains as well
		// $sources[ $source['value'] ][ 'url' ] = str_replace('http://www.example.com', 'https://static.examplecdnprovider.com', $sources[ $source['value'] ][ 'url' ]);
	}
	return $sources;
}
add_filter( 'wp_calculate_image_srcset', 'change_cdn_srcset');
function change_cdn_srcsethttps($sources) {
	foreach ( $sources as $source ) {
		$sources[ $source['value'] ][ 'url' ] = str_replace('https://34.192.136.101', 'https://feed.mikle.com', $sources[ $source['value'] ][ 'url' ]);
		// you MAY use external domains as well
		// $sources[ $source['value'] ][ 'url' ] = str_replace('http://www.example.com', 'https://static.examplecdnprovider.com', $sources[ $source['value'] ][ 'url' ]);
	}
	return $sources;
}
add_filter( 'wp_calculate_image_srcset', 'change_cdn_srcsethttps');
?>