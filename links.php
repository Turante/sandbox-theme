<?php
/*
Template Name: Links Page
*/
?>
<?php get_header() ?>
	
	<div id="container">
		<div id="content" class="hfeed">

<?php the_post() ?>

			<div id="post-<?php the_ID(); ?>" class="<?php sandbox_post_class() ?>">
				<h2 class="entry-title"><?php the_title() ?></h2>
				<div class="entry-content">
<?php the_content() ?>

					<ul id="linkcats">
<?php if ( function_exists('wp_list_bookmarks') ) : wp_list_bookmarks(); else : ?>
<?php
$link_cats = $wpdb->get_results("SELECT cat_id, cat_name FROM $wpdb->linkcategories");
foreach ($link_cats as $link_cat) :
?>
						<li id="linkcat-<?php echo $link_cat->cat_id; ?>">
							<h3><?php echo $link_cat->cat_name; ?></h3>
							<ul>
								<?php wp_get_links($link_cat->cat_id); ?>
							</ul>
						</li>
<?php endforeach ?>
<?php endif ?>
					</ul>
<?php edit_post_link(__('Edit this entry.', 'sandbox'),'<p class="edit-link">','</p>') ?>

				</div>
			</div><!-- .post -->

<?php /* Add a custom field with key "comments" (value is ignored) to turn on comments for a page! */ ?>
<?php if ( get_post_custom_values('comments') ) comments_template() ?>

		</div><!-- #content .hfeed -->
	</div><!-- #container -->

<?php get_sidebar() ?>
<?php get_footer() ?>