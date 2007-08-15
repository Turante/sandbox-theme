<div id="col1" class="sidebar">
	<ul>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('"Blue" Sidebar') ) : // BEGIN WIDGETS ?>
<?php /* IF THIS IS THE FRONTPAGE */ if ( !is_home() || is_paged() ) { ?>
		<li id="home-link">
			<h2><a href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>">&laquo; Home</a></h2>
		</li>
<?php } ?>
		<?php wp_list_pages('title_li=<h2>Pages</h2>' ); ?>
		<li id="category-links">
			<h2>Categories</h2>
			<ul>
				<?php wp_list_cats('sort_column=name&hierarchical=1'); ?>
			</ul>
		</li>
		<li id="archive-links">
			<h2>Archives</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		</li>
<?php endif; /* END FOR WIDGETS  */ ?>
	</ul>
</div><!-- END COL1 / SIDEBAR -->

<div id="col2" class="sidebar">
	<ul>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('"Orange" Sidebar') ) : // BEGIN WIDGETS ?>
		<li id="search">
			<h2><label for="s">Search</label></h2>
			<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		</li>
		<?php get_links_list(); ?>
		<li id="feed-link">
			<h2>RSS Feeds</h2>
			<ul>
				<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php bloginfo('name'); ?> RSS 2.0 Feed" rel="alternate" type="application/rss+xml">All posts</a></li>
				<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php bloginfo('name'); ?> Comments RSS 2.0 Feed" rel="alternate" type="application/rss+xml">All comments</a></li>
			</ul>
		</li>
		<li id="meta-links">
			<h2>Meta</h2>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</li>
<?php endif; /* END FOR WIDGETS  */ ?>
	</ul>
</div><!-- END COL2 / SIDEBAR -->