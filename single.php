<?php get_header(); ?>
<?php get_template_part('breadcrumbs'); ?>

<!-- Main Content -->

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<main class="content-wrapper">
	<div class="container">
		<div class="col-lg-8">
			<article class="post">
				<h1><?php the_title(); //article title ?></h1>

				<ul class="meta">
					<li><span>Created :</span> <?php the_time('M, j, Y'); ?></li>
					<li><span>Last Updated:</span> <?php the_modified_time('M, j, Y'); ?></li>
				</ul>

				<?php the_content(); //contents ?>

			</article>
		<?php endwhile; else: ?>
			<p>No article to display</p>
		<?php endif; ?>

		</div>

		<div class="col-lg-4">
				   <?php get_sidebar(); ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>