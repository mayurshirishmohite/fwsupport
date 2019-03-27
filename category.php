<?php get_header(); ?>
<?php get_template_part('breadcrumbs'); ?>


<!-- Main Content -->

<main class="content-wrapper">
	<div class="container">
		<div class="col-lg-8">
			<article class="post">
				<h1><?php single_cat_title(); ?></h1>
					<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<h3><a href="https://feed.mikle.com/support/<?php echo esc_attr( $post->post_name ); ?>/"><?php the_title(); ?></a></h3>
					<p><?php the_excerpt(); ?></p>
					<?php endwhile; else: ?>
					<h3>No article to display</h3>
					<?php endif; ?>
					<?php get_template_part('template-parts/snippet-pagination'); ?>
			</article>
		</div>
		<div class="col-lg-4">
				   <?php get_sidebar(); ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>