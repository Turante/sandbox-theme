<?php
// Produces a list of pages in the header without whitespace -- er, I mean negative space.
function sandbox_globalnav() {
	echo "<div id=\"globalnav\"><ul id=\"menu\">";
	if ( !is_home() || is_paged() ) { ?><li class="page_item home_page_item"><a href="<?php bloginfo('home') ?>" title="<?php echo wp_specialchars(get_bloginfo('name'), 1) ?>"><?php _e('Home', 'blogtxt') ?></a></li><?php }
	$menu = wp_list_pages('title_li=&sort_column=post_title&echo=0');
	echo str_replace(array("\r", "\n", "\t"), '', $menu);
	echo "</ul></div>\n";
}

// Adds the language function for WP 2.1+ blogs. 
function sandbox_language() {
	if ( function_exists('language_attributes') ) {
		language_attributes();
	} else {
		echo 'xml:lang="en-us" lang="en-us"';
	}
}

// Template tag: echoes semantic classes in the <body> element
function sandbox_body_class( $print = true ) {
	global $wp_query, $current_user;

	$c = array('wordpress');

	sandbox_date_classes(time(), $c);

	is_home()       ? $c[] = 'home'       : null;
	is_archive()    ? $c[] = 'archive'    : null;
	is_date()       ? $c[] = 'date'       : null;
	is_search()     ? $c[] = 'search'     : null;
	is_paged()      ? $c[] = 'paged'      : null;
	is_attachment() ? $c[] = 'attachment' : null;
	is_404()        ? $c[] = 'four04'     : null; // CSS does not allow a digit as first character

	if ( is_single() ) {
		the_post();
		$c[] = 'single';
		if ( isset($wp_query->post->post_date) )
			sandbox_date_classes(mysql2date('U', $wp_query->post->post_date), $c, 's-');
		foreach ( (array) get_the_category() as $cat )
			$c[] = 's-category-' . $cat->category_nicename;
			$c[] = 's-author-' . get_the_author_login();
		rewind_posts();
	}

	else if ( is_author() ) {
		$author = $wp_query->get_queried_object();
		$c[] = 'author';
		$c[] = 'author-' . $author->user_nicename;
	}

	else if ( is_category() ) {
		$cat = $wp_query->get_queried_object();
		$c[] = 'category';
		$c[] = 'category-' . $cat->category_nicename;
	}

	else if ( is_page() ) {
		the_post();
		$c[] = 'page';
		$c[] = 'page-author-' . get_the_author_login();
		rewind_posts();
	}

	if ( $current_user->ID )
		$c[] = 'loggedin';

	$c = join(' ', apply_filters('body_class',  $c));

	return $print ? print($c) : $c;
}

// Template tag: echoes semantic classes in each post <div>
function sandbox_post_class( $print = true ) {
	global $post, $sandbox_post_alt;

	$c = array('hentry', "p$sandbox_post_alt", $post->post_type, $post->post_status);

	$c[] = 'author-' . get_the_author_login();

	foreach ( (array) get_the_category() as $cat )
		$c[] = 'category-' . $cat->category_nicename;

	sandbox_date_classes(mysql2date('U', $post->post_date), $c);

	if ( ++$sandbox_post_alt % 2 )
		$c[] = 'alt';

	$c = join(' ', apply_filters('post_class', $c));

	return $print ? print($c) : $c;
}
$sandbox_post_alt = 1;

// Template tag: echoes semantic classes for a comment <li>
function sandbox_comment_class( $print = true ) {
	global $comment, $post, $sandbox_comment_alt;

	$c = array($comment->comment_type, "c$sandbox_comment_alt");

	if ( $comment->user_id > 0 ) {
		$user = get_userdata($comment->user_id);

		$c[] = "byuser commentauthor-$user->user_login";

		if ( $comment->user_id === $post->post_author )
			$c[] = 'bypostauthor';
	}

	sandbox_date_classes(mysql2date('U', $comment->comment_date), $c, 'c-');
	if ( ++$sandbox_comment_alt % 2 )
		$c[] = 'alt';
		
	if ( is_trackback() ) {
		$c[] = 'trackback';
	}

	$c = join(' ', apply_filters('comment_class', $c));

	return $print ? print($c) : $c;
}

// Adds four time- and date-based classes to an array
// with all times relative to GMT (sometimes called UTC)
function sandbox_date_classes($t, &$c, $p = '') {
	$t = $t + (get_settings('gmt_offset') * 3600);
	$c[] = $p . 'y' . gmdate('Y', $t); // Year
	$c[] = $p . 'm' . gmdate('m', $t); // Month
	$c[] = $p . 'd' . gmdate('d', $t); // Day
	$c[] = $p . 'h' . gmdate('h', $t); // Hour
}

// Returns a list of the post's categories, minus the queried one
function sandbox_cats_meow($glue) {
	$current_cat = single_cat_title('', false);
	$separator = "\n";
	$cats = explode($separator, get_the_category_list($separator));

	foreach ( $cats as $i => $str ) {
		if ( strstr($str, ">$current_cat<") ) {
			unset($cats[$i]);
			break;
		}
	}

	if ( empty($cats) )
		return false;

	return trim(join($glue, $cats));
}

// Sandbox widgets: Replaces the default search widget with one 
// that matches what is in the Sandbox sidebar by default
function widget_sandbox_search($args) {
	extract($args);
	if ( empty($title) )
		$title = __('Search', 'sandbox');
?>
		<?php echo $before_widget ?>

			<?php echo $before_title ?><label for="s"><?php echo $title ?></label><?php echo $after_title ?>
			<form id="searchform" method="get" action="<?php bloginfo('home') ?>">
				<div>
					<input id="s" name="s" type="text" value="<?php echo wp_specialchars(stripslashes($_GET['s']), true) ?>" size="10" />
					<input id="searchsubmit" name="searchsubmit" type="submit" value="<?php _e('Find &raquo;', 'sandbox') ?>" />
				</div>
			</form>
		<?php echo $after_widget ?>

<?php
}

// Sandbox widgets: Replaces the default meta widget with one
// that matches what is in the Sandbox sidebar by default
function widget_sandbox_meta($args) {
	extract($args);
	if ( empty($title) )
		$title = __('Meta', 'sandbox');
?>
		<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
			<ul>
				<?php wp_register() ?>
				<li><?php wp_loginout() ?></li>
				<?php wp_meta() ?>
			</ul>
		<?php echo $after_widget; ?>
<?php
}

// Sandbox widgets: Adds the Sandbox's home link as a widget, which
// appears when NOT on the home page OR on a page of the home page
function widget_sandbox_homelink($args) {
	extract($args);
	$options = get_option('widget_sandbox_homelink');
	$title = empty($options['title']) ? __('&laquo; Home') : $options['title'];
?>
<?php if ( !is_home() || is_paged() ) { ?>
		<?php echo $before_widget; ?>
			<?php echo $before_title ?><a href="<?php bloginfo('home') ?>" title="<?php echo wp_specialchars(get_bloginfo('name'), 1) ?>"><?php echo $title ?></a><?php echo $after_title ?>
		<?php echo $after_widget; ?>
<?php } ?>
<?php
}

// Sandbox widgets: Adds the option to set the text for the home link widget
function widget_sandbox_homelink_control() {
	$options = $newoptions = get_option('widget_sandbox_homelink');
	if ( $_POST["homelink-submit"] ) {
		$newoptions['title'] = strip_tags(stripslashes($_POST["homelink-title"]));
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_sandbox_homelink', $options);
	}
	$title = htmlspecialchars($options['title'], ENT_QUOTES);
?>
		<p style="text-align:left;"><?php _e('Adds a link to the home page on every page <em>except</em> the home.', 'sandbox'); ?></p>
		<p><label for="homelink-title"><?php _e('Link Text:'); ?> <input style="width: 175px;" id="homelink-title" name="homelink-title" type="text" value="<?php echo $title; ?>" /></label></p>
		<input type="hidden" id="homelink-submit" name="homelink-submit" value="1" />
<?php
}

// Sandbox widgets: Adds a widget with the Sandbox RSS links
// as they appear in the default Sandbox sidebar, which are good
function widget_sandbox_rsslinks($args) {
	extract($args);
	$options = get_option('widget_sandbox_rsslinks');
	$title = empty($options['title']) ? __('RSS Links') : $options['title'];
?>
		<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
			<ul>
				<li><a href="<?php bloginfo('rss2_url') ?>" title="<?php echo wp_specialchars(get_bloginfo('name'), 1) ?> RSS 2.0 Feed" rel="alternate" type="application/rss+xml"><?php _e('All posts', 'sandbox') ?></a></li>
				<li><a href="<?php bloginfo('comments_rss2_url') ?>" title="<?php echo wp_specialchars(bloginfo('name'), 1) ?> Comments RSS 2.0 Feed" rel="alternate" type="application/rss+xml"><?php _e('All comments', 'sandbox') ?></a></li>
			</ul>
		<?php echo $after_widget; ?>
<?php
}

// Sandbox widgets: Adds the option to set the text for the RSS link widget
function widget_sandbox_rsslinks_control() {
	$options = $newoptions = get_option('widget_sandbox_rsslinks');
	if ( $_POST["rsslinks-submit"] ) {
		$newoptions['title'] = strip_tags(stripslashes($_POST["rsslinks-title"]));
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_sandbox_rsslinks', $options);
	}
	$title = htmlspecialchars($options['title'], ENT_QUOTES);
?>
			<p><label for="rsslinks-title"><?php _e('Title:'); ?> <input style="width: 250px;" id="rsslinks-title" name="rsslinks-title" type="text" value="<?php echo $title; ?>" /></label></p>
			<input type="hidden" id="rsslinks-submit" name="rsslinks-submit" value="1" />
<?php
}

// Template tag & Sandbox widget: Creates a string to produce
// links in either WP 2.1 or then WP 2.0 style, relative to install
function widget_sandbox_links() {
	if ( function_exists('wp_list_bookmarks') ) {
		wp_list_bookmarks(array('title_before'=>'<h3>', 'title_after'=>'</h3>', 'show_images'=>true));
	} else {
		// Queries db for links, gets stuff to display 
		global $wpdb;

		// Results are for 2.0-style links
		$cats = $wpdb->get_results("
			SELECT DISTINCT link_category, cat_name, show_images, 
				show_description, show_rating, show_updated, sort_order, 
				sort_desc, list_limit
			FROM `$wpdb->links` 
			LEFT JOIN `$wpdb->linkcategories` ON (link_category = cat_id)
			WHERE link_visible =  'Y'
				AND list_limit <> 0
			ORDER BY cat_name ASC", ARRAY_A);
	
		if ($cats) {
			foreach ($cats as $cat) {
				$orderby = $cat['sort_order'];
				$orderby = (bool_from_yn($cat['sort_desc'])?'_':'') . $orderby;

				// Display the category name
				echo '	<li id="linkcat-' . $cat['link_category'] . '"><h3>' . $cat['cat_name'] . "</h3>\n\t<ul>\n";
				// Call get_links() with all the appropriate params
				get_links($cat['link_category'],
					'<li>',"</li>","\n",
					bool_from_yn($cat['show_images']),
					$orderby,
					bool_from_yn($cat['show_description']),
					bool_from_yn($cat['show_rating']),
					$cat['list_limit'],
					bool_from_yn($cat['show_updated']));
	
				// Close the last category
				echo "\n\t</ul>\n</li>\n";
			}
		}
	}
}

// Sandbox widgets: initializes Widgets for the Sandbox
function sandbox_widgets_init() {
	if ( !function_exists('register_sidebars') )
		return;

	// Overrides the Widgets default and uses <h3>'s for sidebar headings
	$p = array(
		'before_title' => "<h3 class='widgettitle'>",
		'after_title' => "</h3>\n",
	);

	// How many? Two?! That's it?
	register_sidebars(2, $p);

	// Registers the widgets specific to the Sandbox, as set earlier
	register_sidebar_widget(__('Search', 'sandbox'), 'widget_sandbox_search', null, 'search');
	unregister_widget_control('search');
	register_sidebar_widget(__('Meta', 'sandbox'), 'widget_sandbox_meta', null, 'meta');
	unregister_widget_control('meta');
	register_sidebar_widget(__('Links', 'sandbox'), 'widget_sandbox_links', null, 'links');
	unregister_widget_control('links');
	register_sidebar_widget(array('Home Link', 'widgets'), 'widget_sandbox_homelink');
	register_widget_control(array('Home Link', 'widgets'), 'widget_sandbox_homelink_control', 300, 125);
	register_sidebar_widget(array('RSS Links', 'widgets'), 'widget_sandbox_rsslinks');
	register_widget_control(array('RSS Links', 'widgets'), 'widget_sandbox_rsslinks_control', 300, 90);
}

// Runs our code at the end to check that everything needed has loaded
add_action('init', 'sandbox_widgets_init');

// Adds filters for greater compliance
add_filter('archive_meta', 'wptexturize');
add_filter('archive_meta', 'convert_smilies');
add_filter('archive_meta', 'convert_chars');
add_filter('archive_meta', 'wpautop');
?>