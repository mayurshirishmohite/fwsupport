<!-- Breadcrumbs -->
<?php 
	$cat = get_the_category();
	$cat = $cat[0];
?>
<div class="breadcrumbs">
	<div class="container">
		<ol>
			<li><span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="/"><span itemprop="name">Home</span></a><meta itemprop="position" content="1" /></span></li>
			<li><span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="/support/"><span itemprop="name">Support</span></a><meta itemprop="position" content="2" /></span></li>			
			<li <?php if ( is_category() ) :?> class="active"<?php endif; ?>><span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><?php if ( !is_category() ) :?><a itemprop="item" href="/support/category/<?php echo $cat->category_nicename; ?>/"><?php endif; ?><span itemprop="name">
<?php echo get_cat_name($cat->term_id); ?></span><?php if ( !is_category() ) :?></a><?php endif; ?><meta itemprop="position" content="3" /></span></li>
			<?php if ( is_single() ) :?><li class="active"><span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title(); ?></span><meta itemprop="position" content="4" /></span></li><?php endif; ?>
			<?php if (is_search()) {?><li><?php 
			echo "Searched results for: ";
			echo the_search_query(); ?></li><?php }; ?>
		</ol>
	</div>
</div>
