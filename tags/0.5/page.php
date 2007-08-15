<?php get_header(); ?>

	<div id="container">
		<div id="content" class="hfeed">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="<?php sandbox_post_class() ?>">
				<h2 class="entry-title"><?php the_title(); ?></h2>
				<div class="entry-content">
<?php the_content(); ?>

<?php link_pages('<p class="page-link">'.__('Pages: ', 'sandbox'), '</p>', 'number'); ?>

<?php edit_post_link(__('Edit this entry.', 'sandbox'),'<p class="edit-link">','</p>'); ?>

				</div>
			</div>

<?php endwhile; endif; ?>

		</div><!-- #content .hfeed -->
	</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>