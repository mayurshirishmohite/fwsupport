<?php get_header(); ?>

<!-- Main Content -->

<main class="content-wrapper">
	<div class="container">
		<div class="col-lg-8">
			<article class="post">
				<h1>Tag: <?php single_tag_title(); ?></h1>
					<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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