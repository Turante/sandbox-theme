<?php get_header(); ?>
	
	<div id="container">
		<div id="content">

<?php if (have_posts()) : ?>

			<h2 class="page-title">Search Results: &#8220;<?php echo wp_specialchars($s); ?>&#8221;</h2>

<?php while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="post <?php post_category_class(); ?>">
				<h3 class="post-title"><a href="<?php the_permalink() ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				<p class="post-date"><?php the_time('F jS Y') ?></p>
				<div class="post-entry">
					<?php the_excerpt(); ?>
				</div><!-- END POST-ENTRY -->
				<p class="post-footer">By <?php the_author(); ?> | Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?> <?php comments_popup_link('Comments (0)', 'Comments (1)', 'Comments (%)'); ?></p>
			</div><!-- END POST -->
	
<?php endwhile; ?>

			<div class="navigation">
				<div class="nav-next"><?php next_posts_link('&laquo; Older matches') ?></div>
				<div class="nav-previous"><?php previous_posts_link('Newer matches &raquo;') ?></div>
			</div><!-- END NAVIGATION -->

<?php else : ?>

			<div id="post-404" class="post">
				<h3 class="post-title">Nothing Found</h3>
				<div class="post-entry">
					<p>There aren't any matches for your query &#8220;<?php echo wp_specialchars($s); ?>&#8221;. Please try a different search.</p>
					<form id="searchform-404" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<p>
							<label for="s-404">Search:</label>
							<input id="s-404" name="s" type="text" value="<?php echo wp_specialchars($s, 1); ?>" size="30" />
							<input id="searchsubmit-404" name="searchsubmit" type="submit" value="Find" />
						</p>
					</form>
				</div><!-- END POST-ENTRY  -->
			</div><!-- END POST -->

<?php endif; ?>
		
		</div><!-- END CONTENT -->
	</div><!-- END CONTAINER  -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>