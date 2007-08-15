<?php get_header(); ?>
	
	<div id="container">
		<div id="content">

<?php if (have_posts()) : ?>

<?php $post = $posts[0]; // HACK FROM KUBRICK ?>
<?php /* IF CATEGORY ARCHIVE */ if ( is_category() ) { ?>				
			<h2 class="page-title">Category Archives: <?php echo single_cat_title(); ?></h2>
			<dl id="<?php $this_cat = get_category($cat); echo $this_cat->category_nicename; ?>-metadata" class="archive-metadata">
				<dt>About <?php echo single_cat_title(); ?></dt>
				<dd><?php echo category_description(); ?></dd>
			</dl>
<?php /* IF DAILY ARCHIVE */ } elseif ( is_day() ) { ?>
			<h2 class="page-title">Daily Archives: <?php the_time('F jS Y'); ?></h2>
<?php /* IF MONTHLY ARCHIVE */ } elseif ( is_month() ) { ?>
			<h2 class="page-title">Monthly Archives: <?php the_time('F Y'); ?></h2>
<?php /* IF YEARLY ARCHIVE */ } elseif ( is_year() ) { ?>
			<h2 class="page-title">Yearly Archives: <?php the_time('Y'); ?></h2>
<?php /* IF AUTHOR ARCHIVE */ } elseif ( is_author() ) { ?>
<?php // HACK TO SHOW THE AUTHOR'S DISPLAY NAME
if(isset($_GET['author_name'])) : $curauth = get_userdatabylogin($_GET['author_name']);
else : $curauth = get_userdata($_GET['author']); endif;
?>
			<h2 class="page-title">Author Archives: <?php echo $curauth->display_name; ?></h2>
			<dl id="<?php echo $curauth->user_nicename; ?>-metadata" class="archive-metadata">
				<dt>About <a href="<?php echo $curauth->user_url; ?>" title="<?php echo $curauth->display_name; ?> at <?php echo $curauth->user_url; ?>"><?php echo $curauth->display_name; ?></a></dt>
				<dd></a></dd>
				<dd><?php echo $curauth->user_description; ?></dd>
			</dl>
<?php /* IF ANOTHER PAGE OF ARCHIVES */ } elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) { ?>
			<h2 class="page-title">Blog Archives</h2>
<?php } ?>

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
				<div class="nav-next"><?php next_posts_link('&laquo; Older posts') ?></div>
				<div class="nav-previous"><?php previous_posts_link('Newer posts &raquo;') ?></div>
			</div><!-- END NAVIGATION -->
	
<?php else : ?>

			<div id="post-404" class="post">
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