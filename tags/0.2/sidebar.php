		<div id="primary" class="sidebar">
			<ul>
		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Primary Sidebar') ) : // BEGIN PRIMARY SIDEBAR WIDGETS ?>
		<?php /* IF THIS IS THE FRONTPAGE */ if ( !is_home() || is_paged() ) { ?>
				<li class="home-link">
					<h2><a href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>">&laquo; Home</a></h2>
				</li>
		<?php } ?>
				<?php wp_list_pages('title_li=<h2>Pages</h2>' ); ?>
				<li class="category-links">
					<h2>Categories</h2>
					<ul>
						<?php wp_list_cats('sort_column=name&hierarchical=1'); ?>
					</ul>
				</li>
				<li class="archive-links">
					<h2>Archives</h2>
					<ul>
						<?php wp_get_archives('type=monthly'); ?>
					</ul>
				</li>
		<?php endif; /* END PRIMARY SIDEBAR WIDGETS  */ ?>
			</ul>
		</div><!-- END PRIMARY / SIDEBAR -->

		<div id="secondary" class="sidebar">
			<ul>
		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Secondary Sidebar') ) : // BEGIN  SECONDARY SIDEBAR WIDGETS ?>
				<li class="blog-search">
					<h2><label for="s">Search</label></h2>
					<?php include (TEMPLATEPATH . '/searchform.php'); ?>
				</li>
				<?php get_links_list(); ?>
				<li class="feed-links">
					<h2>RSS Feeds</h2>
					<ul>
						<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php bloginfo('name'); ?> RSS 2.0 Feed" rel="alternate" type="application/rss+xml">All posts</a></li>
						<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php bloginfo('name'); ?> Comments RSS 2.0 Feed" rel="alternate" type="application/rss+xml">All comments</a></li>
					</ul>
				</li>
		<?php if ( is_home() ) { ?>
				<li class="meta-links">
					<h2>Meta</h2>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</li>
		<?php } ?>
		<?php endif; /* END SECONDARY SIDEBAR WIDGETS  */ ?>
			</ul>
		</div><!-- END SECONDARY / SIDEBAR -->