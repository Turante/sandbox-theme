<?php

function sandbox_stylesheets() {
	$options = get_option('sandbox_options');
	$style = empty($options['style']) ? '2c-r' : $options['style'];
	if ( $style != 'none' ) {
?>
	<?php /* <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" title="Sandbox" /> */ ?>
	<?php /* <style type="text/css">@import url(<?php echo get_template_directory_uri() . "/styles/$style.css" ?>);</style> */ ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . "/styles/$style.css" ?>" title="Sandbox" />
<?php
	}
}

function sandbox_skipnav() {
	$options = get_option('sandbox_options');
	if ( empty($options['globalnav']) )
		return;
	echo "		<p class='access'><a href='#content'>Skip navigation</a></p>\n";
}

function sandbox_globalnav() {
	$options = get_option('sandbox_options');
	if ( empty($options['globalnav']) )
		return;
	if ( function_exists('wp_list_pages') ) {
		echo '		<div id="menu" class="globalnav"><ul class="nav">';
		$menu = wp_list_pages( array('title_li'=>'', 'echo'=>false, 'sort_column'=>'menu_order') );
		echo str_replace(array("\r", "\n", "\t"), '', $menu);
		echo "</ul><div class='clearer'></div></div>\n";
	} else {
		// OTHER NAV CODE, WAIT, WHAT 'OTHER' NAV CODE? ;-)
	}
}

function sandbox_body_class() {
	global $wp_query;

	$c = array('wordpress');

	sandbox_date_classes(time(), $c);

	is_home()     ? $c[] = 'home'     : null;
	is_page()     ? $c[] = 'page'     : null;
	is_archive()  ? $c[] = 'archive'  : null;
	is_date()     ? $c[] = 'date'     : null;
	is_search()   ? $c[] = 'search'   : null;
	is_paged()    ? $c[] = 'paged'    : null;
	is_attachment()    ? $c[] = 'attachment'    : null;
	is_404()      ? $c[] = 'four04'   : null; // CSS does not allow a digit as first character

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

function sandbox_post_class() {
	global $post, $sandbox_post_alt;

	$c = array($post->post_type, $post->post_status);
	$c[] = 'author-' . get_the_author_login();

	foreach ( (array) get_the_category() as $cat )
		$c[] = 'category-' . $cat->category_nicename;

	sandbox_date_classes(mysql2date('U', $post->post_date), $c);

	if ( ++$sandbox_post_alt % 2 )
		$c[] = 'alt';

	echo 'hentry post';

	echo join(' ', apply_filters('post_class', $c));
}
$sandbox_post_alt = 1;

function sandbox_comment_class() {
	global $comment, $post, $sandbox_comment_alt;

	$c = array($comment->comment_type);

	if ( $comment->user_id > 0 ) {
		$user = get_userdata($comment->user_id);

		$c[] = "byuser commentauthor-$user->user_login";
	}

	if ( $comment->user_id > 0 && $comment->user_id === $post->post_author )
		$c[] = 'bypostauthor';

	sandbox_date_classes(mysql2date('U', $comment->comment_date), $c, 'c-');
	if ( ++$sandbox_comment_alt % 2 )
		$c[] = 'alt';
		
	if ( is_trackback() ) {
		$c[] = 'trackback';
	}

	echo join(' ', apply_filters('comment_class', $c));
}

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
register_sidebar_widget(__('Search', 'sandbox'), 'widget_sandbox_search');

function widget_sandbox_links() {
	if ( function_exists('wp_list_bookmarks') ) {
		wp_list_bookmarks(array('title_before'=>'<h3>', 'title_after'=>'</h3>'));
	} else { 
		// I don't like WP 2.0x links.
	}
}
register_sidebar_widget(__('Links', 'sandbox'), 'widget_sandbox_links');

function widget_links_control() {
	$options = $newoptions = get_option('widget_links');
	if ( $_POST["links-submit"] ) {
		$newoptions['title'] = strip_tags(stripslashes($_POST["links-title"]));
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_links', $options);
	}
	$title = htmlspecialchars($options['title'], ENT_QUOTES);
?>
			<p><label for="links-title"><?php _e('Title:'); ?> <input style="width: 250px;" id="links-title" name="links-title" type="text" value="<?php echo $title; ?>" /></label></p>
			<input type="hidden" id="links-submit" name="links-submit" value="1" />
<?php
}

function sandbox_init() {
	load_theme_textdomain('sandbox');

	$p = $s = array(
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => "</h3>\n",
	);

	$p['name'] = __('Primary Sidebar', 'sandbox');
	$s['name'] = __('Secondary Sidebar', 'sandbox');
	
	if ( function_exists('register_sidebar') ) {
		register_sidebar($p);
		register_sidebar($s);
	}

	if ( function_exists('register_sidebar_widget') )
		register_sidebar_widget(__('Search'), 'widget_sandbox_search');
}
add_action('init', 'sandbox_init');

function sandbox_admin_menu() {
	add_theme_page(__('Sandbox Options', 'sandbox'), __('Sandbox Options', 'sandbox'), 'edit_themes', basename(__FILE__), 'sandbox_options_page');
}
add_action('admin_menu', 'sandbox_admin_menu');

function sandbox_options_page() {
	$styles = array();
	$defaults = array('style' => '2c-r');
	$options = array_merge($defaults, (array) get_option('sandbox_options'));
	if ( $GLOBALS['pagenow'] == 'themes.php' && $_GET['page'] == basename(__FILE__) && isset($_POST['sandbox_submit']) ) {
		$options['style'] = wp_filter_kses($_POST['style']);
		$options['globalnav'] = empty($_POST['globalnav']) ? false : true;
		if ( update_option('sandbox_options', $options) )
			echo "\n<div id='message' class='updated fade'><p>".__('Options saved successfully.', 'sandbox')."</p></div>\n";
	}
	$_styles = glob(ABSPATH.'wp-content/themes/sandbox/styles/*.css');
	foreach ( $_styles as $k => $v ) {
		$info = array();
		preg_match('/\/([^\/]+).css$/i', $v, $matches);
		if ( !empty($matches[1]) )
			$style = file($v);
			$info['desc'] = stripslashes(wp_filter_kses(trim($style[0], "\r\n\t/* ")));
			$png = str_replace('.css', '.png', $v);
			if ( file_exists($png) ) {
				$png_url = get_template_directory_uri() . '/styles/' . $matches[1] . '.png';
				$info['img'] = "<img src='$png_url' alt='' style='width:40px;height:32px;' onmouseover='showme(this)' />";
			} else {
				$info['img'] = false;
			}
			$styles[$matches[1]] = $info;
	}
?>
<script type="text/javascript">
function showme(o) { document.getElementById('show').src = o.src; }
</script>
<div class="wrap">
	<h2><?php _e('Choose a Style', 'sandbox') ?></h2>
	<p><?php _e('Below are styles available for the Miniamlist Sandbox, as installed in the <code>/styles/</code> folder', 'sandbox') ?></p>
	<form action="" method="post">
		<table cellspacing="8">
<?php $i = 0; foreach ( $styles as $style => $info ) : extract($info); ?>
			<tr style="height:35px;">
				<td><input name="style" id="style-<?php echo $style ?>" type="radio" value="<?php echo $style ?>" <?php checked($options['style'], $style) ?> /></td>
				<td><?php if ($img) : ?><label for="style-<?php echo $style ?>"><?php echo $img ?></label><?php endif ?></td>
				<td><label for="style-<?php echo $style ?>"><?php _e($desc, 'sandbox') ?></label></td>
<?php if ( ++$i == 1 ) : ?>
				<td width="300px" rowspan="<?php echo count($styles) + 1; ?>"><img alt="Mouseover thumbnails for a larger preview" src="" id="show" width="250px" height="200px" align="right" style="border:1px inset #999;padding:10px;" /></td>
<?php endif ?>

			</tr>
<?php endforeach; ?>
			<tr>
				<td><input name="style" id="style-none" type="radio" value="none" <?php checked($options['style'], 'none') ?> /></td>
				<td></td>
				<td><label for="style-none"><?php _e('No stylesheet', 'sandbox') ?></label></td>
			</tr>
			<tr>
				<td colspan="4"><h3><?php _e('Extra Options', 'sandbox') ?></h3></td>
			</tr>
			<tr>
				<td colspan="4"><label for="globalnav"><input type="checkbox" id="globalnav" name="globalnav" <?php checked($options['globalnav'], true) ?> /> <?php _e('Add a navigation menu (page list) between the header and content.', 'sandbox') ?></label></td>
			</tr>
			<tr>
				<td colspan="4"><p class="submit"><input type="submit" name="sandbox_submit" id="sandbox_submit" value="<?php _e("Save Options &raquo;", 'sandbox') ?>" /></p></td>
			</tr>
		</table>
	</form>
</div>
<?php
}

?>