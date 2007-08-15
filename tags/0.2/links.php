<?php
/*
Template Name: Links Page
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

<?php $link_cats = $wpdb->get_results("SELECT cat_id, cat_name FROM $wpdb->linkcategories"); foreach ($link_cats as $link_cat) { ?>
					<h3 id="page-linkcat-<?php echo $link_cat->cat_id; ?>" class="linkcat"><?php echo $link_cat->cat_name; ?></h3>
					<ul>
						<?php get_links($link_cat->cat_id, '<li>', '</li>', ' &mdash; ', 'name'); ?>
					</ul>
<?php } ?>

					<?php edit_post_link('Edit this entry.','<p class="edit-link">','</p>'); ?>
					<!-- <?php trackback_rdf(); ?> -->
				</div><!-- END POST-ENTRY -->
			</div><!-- END POST -->

<?php endwhile; endif; ?>

		</div><!-- END CONTENT -->
	</div><!-- END CONTAINER  -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>