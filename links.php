<?php
/*
Template Name: Links Page
*/
?>
<?php get_header() ?>
	
	<div id="container">
		<div id="content" class="hfeed">

<?php if (have_posts()) : while (have_posts()) : the_post() ?>

			<div id="post-<?php the_ID(); ?>" class="<?php sandbox_post_class() ?>">
				<h2 class="entry-title"><?php the_title() ?></h2>
				<div class="entry-content">
					<?php the_content() ?>
					<ul id="linkcats">
<?php if ( function_exists('wp_list_bookmarks') ) wp_list_bookmarks(); else { ?>
<?php
$link_cats = $wpdb->get_results("SELECT cat_id, cat_name FROM $wpdb->linkcategories");
foreach ($link_cats as $link_cat) {
?>
						<li id="linkcat-<?php echo $link_cat->cat_id; ?>">
							<h3><?php echo $link_cat->cat_name; ?></h3>
							<ul>
								<?php wp_get_links($link_cat->cat_id); ?>
							</ul>
						</li>
<?php } ?>
<?php } ?>
					</ul>
					<?php edit_post_link(__('Edit this entry.', 'sandbox'),'<p class="edit-link">','</p>') ?>
				</div>
			</div>

<?php endwhile; endif; ?>

		</div><!-- #content .hfeed -->
	</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>