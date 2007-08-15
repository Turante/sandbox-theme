<?php get_header(); ?>
	
	<div id="container">
		<div id="content" class="hfeed">

<?php if (have_posts()) : ?>

			<h2 class="page-title"><?php _e('Category Archives:', 'sandbox') ?> <?php echo single_cat_title(); ?></h2>
			<dl id="<?php $this_cat = get_category($cat); echo $this_cat->category_nicename; ?>-metadata" class="archive-metadata">
				<dt><?php printf(__('About %s', 'sandbox'), single_cat_title('', false)) ?></dt>
				<dd><?php echo category_description(); ?></dd>
			</dl>

<?php while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="<?php sandbox_post_class(); ?>">
				<h3 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), get_the_title()) ?>" rel="bookmark"><?php the_title() ?></a></h3>
				<abbr class="published" title="<?php the_time('Y-m-d'); echo 'T'; the_time('H:i:sO'); ?>"><?php unset($previousday); printf(__('%1$s &#8211; %2$s', 'sandbox'), the_date('', '', '', false),get_the_time()) ?></abbr>
				<div class="entry-content">
<?php the_excerpt('<span class="more-link">'.__('Read More &raquo;', 'sandbox').'</span>') ?>

				</div>
				<div class="entry-meta">
					<span class="entry-author author vcard"><?php printf(__('By %s', 'sandbox'), '<a class="url fn" href="'.get_author_link(false, $authordata->ID, $authordata->user_nicename).'" title="View all posts by ' . $authordata->display_name . '">'.get_the_author().'</a>') ?></span> |
					<span class="entry-category"><?php printf(__('Posted in %s', 'sandbox'), get_the_category_list(', ')) ?></span> |
<?php edit_post_link(__('Edit', 'sandbox'), "\t\t\t\t\t<span class='post-editlink'>", "</span> |\n"); ?>
					<span class="entry-commentlink"><?php comments_popup_link(__('Comments (0)', 'sandbox'), __('Comments (1)', 'sandbox'), __('Comments (%)', 'sandbox')) ?></span>
				</div>
			</div><!-- post -->

<?php endwhile; ?>

			<div class="navigation">
				<div class="nav-previous"><?php next_posts_link(__('&laquo; Older posts', 'sandbox')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts &raquo;', 'sandbox')) ?></div>
			</div>
	
<?php else : ?>

			<div id="post-0" class="post">
				<h2 class="entry-title"><?php _e('Not Found', 'sandbox') ?></h2>
				<div class="entry-content">
					<p><?php _e('Apologies, but we were unable to find what you were looking for. Perhaps the search box will help.', 'sandbox') ?></p>
				</div>
			</div>
			<form id="searchform" method="get" action="<?php bloginfo('home') ?>">
				<div>
					<input id="s" name="s" type="text" value="<?php echo wp_specialchars($s, 1); ?>" tabindex="1" size="10" />
					<input id="searchsubmit" name="searchsubmit" type="submit" value="<?php _e('Search &raquo;') ?>" tabindex="2" />
				</div>
			</form>

<?php endif; ?>
		
		</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>