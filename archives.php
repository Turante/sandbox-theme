<?php
/*
Template Name: Archives Page
*/
?>
<?php get_header() ?>
	
	<div id="container">
		<div id="content" class="hfeed">

<?php the_post() ?>

			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				<h2 class="entry-title"><?php the_title() ?></h2>
				<div class="entry-content">
<?php the_content(); ?>

					<ul class="alignleft content-column">
						<li>
							<h3><?php _e('Archives by Category', 'sandbox') ?></h3>
							<ul>
								<?php wp_list_cats('sort_column=name&optioncount=1&feed=RSS') ?> 
							</ul>
						</li>
					</ul>
					
					<ul class="alignleft content-column">
						<li>
							<h3><?php _e('Archives by Month', 'sandbox') ?></h3>
							<ul>
								<?php wp_get_archives('type=monthly&show_post_count=1') ?>
							</ul>
						</li>
					</ul>
<?php edit_post_link(__('Edit this entry.', 'sandbox'),'<p class="entry-edit">','</p>') ?>

				</div>
			</div><!-- .post -->

<?php if ( get_post_custom_values('comments') ) comments_template() // Add a key/value of "comments" to enable comments on pages! ?>

		</div><!-- #content .hfeed -->
	</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>