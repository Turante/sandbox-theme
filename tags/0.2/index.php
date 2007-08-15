<?php get_header(); ?>
	
	<div id="container">
		<div id="content">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="post<?php post_category_class(); ?>">
				<h2 class="post-title"><a href="<?php the_permalink() ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<p class="post-date"><?php the_time('F jS Y') ?></p>
				<div class="post-entry">
					<?php the_content('<span class="more-link">Continue Reading &raquo;</span>'); ?>
					<?php link_pages('<p class="page-link">Pages: ', '</p>', 'number'); ?>
					<!-- <?php trackback_rdf(); ?> -->
				</div><!-- END POST-ENTRY -->
				<p class="post-footer">By <?php the_author(); ?> | Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?> <?php comments_popup_link('Comments (0)', 'Comments (1)', 'Comments (%)'); ?></p>
			</div><!-- END POST -->

<?php comments_template(); ?>

<?php endwhile; ?>

			<div class="navigation">
				<div class="nav-next"><?php next_posts_link('&laquo; Older posts') ?></div>
				<div class="nav-previous"><?php previous_posts_link('Newer posts &raquo;') ?></div>
			</div><!-- END NAVIGATION -->

<?php else : ?>

			<div id="post-error" class="post">
				<h2 class="post-title">Not Found</h2>
				<div class="post-entry">
					<p>Apologies. But something you were looking for just can't be found. Please have a look around or try searching for what you're looking for.</p>
				</div><!-- END POST-ENTRY  -->
			</div><!-- END POST -->

<?php endif; ?>

		</div><!-- END CONTENT -->
	</div><!-- END CONTAINER  -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>