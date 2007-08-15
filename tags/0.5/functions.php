<?php

function sandbox_get_option($name) {
	$defaults = array(
		'skin' => '2c-l',
		);

	$options = array_merge($defaults, (array) get_option('sandbox_options'));

	if ( isset($options[$name]) )
		return $options[$name];

	return false;
}

function sandbox_set_options($new_options) {
	$options = (array) get_option('sandbox_options');

	$options = array_merge($options, (array) $new_options);

	return update_option('sandbox_options', $options);
}

// Template tag: echoes a stylesheet link if one is selected
function sandbox_stylesheets() {
	$skin = sandbox_get_option('skin');

	if ( $skin != 'none' ) {
?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . "/skins/$skin.css" ?>" title="Sandbox" />
<?php
	}
}

// Template tag: echoes a link to skip navigation
function sandbox_skipnav() {
	if ( !sandbox_get_option('globalnav') )
		return;

	echo "		<p class='access'><a href='#content'>Skip navigation</a></p>\n";
}

// Template tag: echoes a page list for navigation menus
function sandbox_globalnav() {
	if ( !sandbox_get_option('globalnav') )
		return;

	echo '<div id="globalnav"><ul id="menu">';
	$menu = wp_list_pages( array('title_li'=>'', 'echo'=>false, 'sort_column'=>'menu_order') );
	echo str_replace(array("\r", "\n", "\t"), '', $menu); // Strip intratag whitespace
	echo "</ul></div>\n";
}

// Template tag: echoes semantic classes
function sandbox_body_class() {
	global $wp_query;

	$c = array('wordpress');

	sandbox_date_classes(time(), $c);

	is_home()       ? $c[] = 'home'       : null;
	is_page()       ? $c[] = 'page'       : null;
	is_archive()    ? $c[] = 'archive'    : null;
	is_date()       ? $c[] = 'date'       : null;
	is_search()     ? $c[] = 'search'     : null;
	is_paged()      ? $c[] = 'paged'      : null;
	is_attachment() ? $c[] = 'attachment' : null;
	is_404()        ? $c[] = 'four04'     : null; // CSS does not allow a digit as first character

	if ( is_author() ) {
		global $wp_query;
		$author = $wp_query->get_queried_object();
		$c[] = 'author';
		$c[] = 'author-' . $author->user_nicename;
	}

	if ( is_category() ) {
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		$c[] = 'category';
		$c[] = 'category-' . $cat->category_nicename;
	}

	if ( is_single() ) {
		$c[] = 'single';
		if ( isset($wp_query->post->post_date) )
			sandbox_date_classes(mysql2date('U', $wp_query->post->post_date), $c, 's-');
	}

	echo join(' ', apply_filters('body_class',  $c));
}

// Template tag: echoes semantic classes for a post
function sandbox_post_class() {
	global $post, $sandbox_post_alt;

	$c = array('hentry', $post->post_type, $post->post_status);
	$c[] = 'author-' . get_the_author_login();

	foreach ( (array) get_the_category() as $cat )
		$c[] = 'category-' . $cat->category_nicename;

	sandbox_date_classes(mysql2date('U', $post->post_date), $c);

	if ( ++$sandbox_post_alt % 2 )
		$c[] = 'alt';

	echo join(' ', apply_filters('post_class', $c));
}
$sandbox_post_alt = 1;

// Template tag: echoes semantic classes for a comment
function sandbox_comment_class() {
	global $comment, $post, $sandbox_comment_alt;

	$c = array($comment->comment_type);

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

	echo join(' ', apply_filters('comment_class', $c));
}

// Adds four time-based classes to an array
function sandbox_date_classes($t, &$c, $p = '') {
	$t = $t + (get_settings('gmt_offset') * 3600);
	$c[] = $p . 'y' . gmdate('Y', $t); // Year
	$c[] = $p . 'm' . gmdate('m', $t); // Month
	$c[] = $p . 'd' . gmdate('d', $t); // Day
	$c[] = $p . 'h' . gmdate('h', $t); // Hour
}

function widget_sandbox_search($args) {
	extract($args);
	if ( empty($title) )
		$title = __('Search', 'sandbox');
?>
		<?php echo $before_widget ?>

			<?php echo $before_title ?><label for="s"><?php echo $title ?></label><?php echo $after_title ?>
			<form id="searchform" method="get" action="<?php bloginfo('home') ?>">
				<input id="s" name="s" type="text" value="<?php echo wp_specialchars($s, 1); ?>" size="7" tabindex="1" />
				<input id="searchsubmit" name="searchsubmit" type="submit" value="<?php _e('Search &raquo;', 'sandbox') ?>" tabindex="2" />
			</form> 
		<?php echo $after_widget ?>

<?php
}

function widget_sandbox_links() {
	if ( function_exists('wp_list_bookmarks') ) {
		wp_list_bookmarks(array('title_before'=>'<h3>', 'title_after'=>'</h3>', 'show_images'=>true));
	} else {
		// Condensed from 2.0.3 get_links_list()
		global $wpdb;

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

function sandbox_skin_info($skin) {
	$info = array(
		'skin_name' => $skin,
		'skin_uri' => '',
		'description' => '',
		'version' => '1.0',
		'author' => __('Anonymous', 'sandbox'),
		'author_uri' => '',
		'global_navigation' => 'Y',
		);

	if ( !file_exists(ABSPATH."wp-content/themes/sandbox/skins/$skin.css") )
		return array();

	$css = (array) file(ABSPATH."wp-content/themes/sandbox/skins/$skin.css");

	foreach ( $css as $line ) {
		if ( strstr($line, '*/') )
			return $info;

		if ( !strstr($line, ':') )
			continue;

		list ( $k, $v ) = explode(':', $line, 2);

		$k = str_replace(' ', '_', strtolower(trim($k)));

		if ( array_key_exists($k, $info) )
			$info[$k] = stripslashes(wp_filter_kses(trim($v)));
	}
}

function sandbox_admin_skins() {
	$skins = array();
	if ( isset ( $_GET['message'] ) ) {
		switch ( $_GET['message'] ) {
			case 'updated' :
				echo "\n<div id='message' class='updated fade'><p>".__('Options saved successfully.', 'sandbox')."</p></div>\n";
				break;
		}
	}
	$current_skin = sandbox_get_option('skin');
	$_skins = glob(ABSPATH.'wp-content/themes/sandbox/skins/*.css');
	foreach ( $_skins as $k => $v ) {
		$info = array();
		preg_match('/\/([^\/]+).css$/i', $v, $matches);
		if ( !empty($matches[1]) ) {
			$skins[$matches[1]] = sandbox_skin_info($matches[1]);
		}
	}
?>
<script type="text/javascript">
function showme(o) { document.getElementById('show').src = o.src; }
</script>
<div class="wrap">
<h2><?php _e('Current Skin', 'sandbox') ?></h2>
<div id="currenttheme">
<?php if ( file_exists(get_template_directory() . "/skins/$current_skin.png") ) : ?>
<img src="<?php echo get_template_directory_uri() . "/skins/$current_skin.png"; ?>" alt="<?php _e('Current skin preview', 'sandbox'); ?>" />
<?php endif; ?>
<?php
	if ( is_array($skins[$current_skin]) )
		extract($skins[$current_skin]);
	if ( !empty($skin_uri) )
		$skin_name = "<a href=\"$skin_uri\">$skin_name</a>";
	if ( !empty($author_uri) )
		$author =  "<a href=\"$author_uri\">$author</a>";
?>
<h3><?php printf(__('%1$s %2$s by %3$s'), $skin_name, $version, $author) ; ?></h3>
<p><?php echo $description; ?></p>
</div>

<h2><?php _e('Available Skins', 'sandbox') ?></h2>

<?php
	foreach ( $skins as $skin => $info ) :
	if ( $skin == $current_skin || !is_array($info) )
		continue;
	extract($info);
	$activate_link = "themes.php?page=skins&amp;action=activate&amp;skin=$skin";
	if ( function_exists('wp_nonce_url') )
		$activate_link = wp_nonce_url($activate_link, 'switch-skin_' . $skin);
?>
<div class="available-theme">
<h3><a href="<?php echo $activate_link; ?>"><?php echo "$skin_name $version"; ?></a></h3>

<a href="<?php echo $activate_link; ?>" class="screenshot">
<?php if ( file_exists(get_template_directory() . "/skins/$skin.png" ) ) : ?>
<img src="<?php echo get_template_directory_uri() . "/skins/$skin.png"; ?>" alt="" />
<?php endif; ?>
</a>

<p><?php echo $description; ?></p>
</div>
<?php endforeach; ?>

<h2><?php _e('Sandbox Info', 'sandbox'); ?></h2>
<p><?php printf(__('Check the <a href="%1$s">documentation</a> for help installing new skins and information on the rich semantic markup that makes the Sandbox unique.', 'sandbox'), get_template_directory_uri() . '/readme.html'); ?></p>
</div>
<?php
}

function sandbox_init() {
	load_theme_textdomain('sandbox');

	if ( $GLOBALS['pagenow'] == 'themes.php'
			&& isset($_GET['page']) && $_GET['page'] == 'skins'
			&& isset($_GET['action']) && $_GET['action'] == 'activate'
			&& current_user_can('switch_themes') ) {
		check_admin_referer('switch-skin_' . $_GET['skin']);
		$info = sandbox_skin_info($_GET['skin']);
		sandbox_set_options(array(
			'skin' => wp_filter_kses($_GET['skin']),
			'globalnav' => bool_from_yn($info['global_navigation'])
			));
		wp_redirect('themes.php?page=skins&message=updated');
	}
}

function sandbox_admin_menu() {
	add_theme_page(__('Sandbox Skins', 'sandbox'), __('Sandbox Skins', 'sandbox'), 'switch_themes', 'skins', 'sandbox_admin_skins');
}

function sandbox_widgets_init() {
	if ( !function_exists('register_sidebars') )
		return;

	$p = array(
		'before_title' => "<h3 class='widgettitle'>",
		'after_title' => "</h3>\n",
	);

	register_sidebars(2, $p);

	register_sidebar_widget(__('Search', 'sandbox'), 'widget_sandbox_search', null, 'search');
	unregister_widget_control('search');
	register_sidebar_widget(__('Links', 'sandbox'), 'widget_sandbox_links', null, 'links');
	unregister_widget_control('links');
}

add_action('init', 'sandbox_init', 1);
add_action('init', 'sandbox_widgets_init');
add_action('admin_menu', 'sandbox_admin_menu');

?>