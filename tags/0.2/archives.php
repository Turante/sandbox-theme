<?php
/*
Template Name: Archives Page
*/
?>
<?php get_header(); ?>
	
	<div id="container">
		<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="post <?php echo $post->post_name; ?>">
				<h2 class="post-title"><?php the_title(); ?></h2>
				<div class="post-entry">
					<?php the_content(); ?>
					<div id="archives-by-category" class="content-column" style="float:left;width:48%;">
					<h3>Archives by Category</h3>
						<ul>
							<?php wp_list_cats('sorr_column=name&optioncount=1&feed=RSS'); ?> 
						</ul>
					</div>
					<div id="archives-by-category" class="content-column" style="float:right;width:48%;">
					<h3>Archives by Month</h3>
						<ul>
							<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
						</ul>
					</div>
					<?php edit_post_link('Edit this entry.','<p class="edit-link" style="clear:both;">','</p>'); ?>
					<!-- <?php trackback_rdf(); ?> -->
				</div><!-- END POST-ENTRY -->
			</div><!-- END POST -->

<?php endwhile; endif; ?>

		</div><!-- END CONTENT -->
	</div><!-- END CONTAINER  -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>