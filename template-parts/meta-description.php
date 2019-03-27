<?php if ( is_front_page() ) :?>
	<meta name="description" content="<?php bloginfo('description'); ?>" />
<?php elseif ( is_category() ) :?>
	<meta name="description" content="<?php echo category_description(); ?>" />
<?php elseif ( is_single() ) :?>
	<?php if ( has_excerpt() ) :?>
	<meta name="description" content="<?php echo get_the_excerpt(); ?>" />
	<?php else : ?>
	<?php endif; ?>
<?php else : ?>
<?php endif; ?>
