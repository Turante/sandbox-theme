<?php
$themename = "Minimalist Sandbox";
$shortname = "sandbox";
$themeversion = "0.2.7";
$themeuri = "http://www.plaintxt.org/themes/minimalist-sandbox/";
$themeauthor = "Scott Allan Wallick";
$authoruri = "http://scottwallick.com/";
$options = array(

/* ITEMS APPEARING IN THE CURRENT THEME OPTIONS MENU */
	array( 
		"id" => $shortname."_layout",
		"name" => "Layout",
		"type" => "radio",
		"std" => "three-column_side-both.css",
		"options" => array(
			"three-column_side-both.css",
			"three-column_side-left.css",
			"three-column_side-right.css",
			"two-column_side-left.css",
			"two-column_side-right.css",
			"one-column.css"
		)
	),
    array(
		"id" => $shortname."_body_font_size",
		"name" => "Base Font Size",
		"std" => "75%",
		"type" => "text"
	),
    array(
		"id" => $shortname."_body_font_family",
		"name" => "Base Font Family",
		"std" => "Verdana, Geneva, sans serif",
		"type" => "select",
		"options" => array(
			"Arial, Helvetica, sans-serif",
			"'Courier New', Courier, monospace",
			"Georgia, Times, serif",
			"'Lucida Console', Monaco, monospace",
			"'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
			"Tahoma, Geneva, sans-serif",
			"'Times New Roman', Times, serif",
			"'Trebuchet MS', Helvetica, sans-serif",
			"Verdana, Geneva, sans serif"
		)	
	),
    array(
		"id" => $shortname."_heading_font_family",
		"name" => "Heading Font Family",
		"std" => "Verdana, Geneva, sans serif",
		"type" => "select",
		"options" => array(
			"Arial, Helvetica, sans-serif",
			"'Courier New', Courier, monospace",
			"Georgia, Times, serif",
			"'Lucida Console', Monaco, monospace",
			"'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
			"Tahoma, Geneva, sans-serif",
			"'Times New Roman', Times, serif",
			"'Trebuchet MS', Helvetica, sans-serif",
			"Verdana, Geneva, sans serif"
		)
	),
    array(
		"id" => $shortname."_body_background",
		"name" => "Body Background Color",
		"std" => "#fff",
		"type" => "text"
	),
    array(
		"id" => $shortname."_body_color",
		"name" => "Body Text Color",
		"std" => "#000",
		"type" => "text"
	)
);

/* CREATES THE OPTIONS TAB WITHIN THE PRESENTATION MENU */
function mytheme_add_admin() {

    global $themename, $shortname, $options;

	if ( $_GET['page'] == basename(__FILE__) ) {

		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
			}
			foreach ($options as $value) {
				if ( isset( $_REQUEST[ $value['id'] ] ) ) {
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
				} else {
					delete_option( $value['id'] );
				} 
			}
			header("Location: themes.php?page=functions.php&saved=true");
			die;
        }
		
		else if ( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				delete_option( $value['id'] );
			}
			header("Location: themes.php?page=functions.php&reset=true");
			die;
		}
		add_action('admin_head', 'mytheme_admin_head');
    }
	add_theme_page($themename." Options", "Current Theme Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin_head() /* PUTS STUFF IN THE head OF THE ADMIN THEME OPTIONS PAGE */ {
?>
<style type="text/css" media="all">
/*<![CDATA[*/
table.optiontable label.radio-item { margin-left: 0.2em; }
/*]]>*/
</style>
<?php
}

function mytheme_admin() {

	global $themename, $themeuri, $shortname, $themeauthor, $themeversion, $authoruri, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
?>

<div id="<?php echo $shortname; ?>-options" class="wrap">

	<h2><?php echo $themename; ?> Options</h2>

	<p>You can change certain aspects of this theme from within this menu. The actual theme files are not altered by these settings. <strong>You must click on <i>Save Changes</i> to store any changes</strong>. You can also reset any changes by clicking on <i>Reset</i>.</p>
	
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

		<table class="optiontable">

<?php foreach ($options as $value) { 
    
if ($value['type'] == "text") { ?>
        
<tr valign="top"> 
    <th scope="row"><?php echo $value['name']; ?>:</th>
    <td>
        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
    </td>
</tr>

<?php } elseif ($value['type'] == "select") { ?>

    <tr valign="top"> 
        <th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?>:</label></th>
        <td>
            <select id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $option) { ?>
                <option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>

<?php
	} elseif ( $value['type'] == "radio" ) {
?>
			<tr valign="top"> 
				<th scope="row"><?php echo $value['name']; ?>:</th>
				<td>
<?php foreach ($value['options'] as $option) { ?>
					<input id="<?php echo $option; ?>" name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo $option; ?>" <?php if ( get_settings( $value['id'] ) == $option) { echo 'checked="checked"'; } elseif ($option == $value['std']) { echo 'checked="checked"'; } ?> /><label class="radio-item" for="<?php echo $option; ?>"><?php echo $option; ?></label><br/>
<?php } ?>
				</td>
			</tr>
<?php
	}
}
?>
		</table>
		<p class="submit">
			<input name="save" type="submit" value="Save Changes" />    
			<input name="action" type="hidden" value="save" />
		</p>
	</form>
	
	<h3>Restore Default Settings</h3>

	<p>You may discard any changes to all these options by clicking on <i>Reset</i>. <strong>All changes to these options will be lost</strong> and cannot be restored. This theme will continue to be the current theme until another is selected. The default settings will be loaded after a reset.</p>

	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<p class="submit">
			<input name="reset" type="submit" value="Reset" />
			<input name="action" type="hidden" value="reset" />
		</p>
	</form>
	
	<h4>About <?php echo $themename; ?></h4>
	
	<p>The <a href="<?php echo $themeuri; ?>" title="<?php echo $themename; ?>"><?php echo $themename; ?></a> theme version <?php echo $themeversion; ?> is currently installed. It was designed by <a href="<?php echo $authoruri; ?>" title="<?php echo $themeauthor; ?>"><?php echo $themeauthor; ?></a>.</p>
	
</div><!-- END WRAP / <?php echo $shortname; ?> -->

<?php
}
function mytheme_wp_head() { 

/* MAGICALLY PLACES THINGS IN THE head OF THE BLOG */ ?>

<?php }

add_action('wp_head', 'mytheme_wp_head');
add_action('admin_menu', 'mytheme_add_admin'); 

/*** FUNCTION TO ADD SEMANTIC CLASSES TO THE body TAG ***/
function body_class() {
	if ( is_home() ) {
		print 'home ';
	}
	if ( is_single() ) {
		print 'single ';
	}
	if ( is_page() ) {
		print 'page ';
	}
	if ( is_archive() ) {
		print 'archive ';
	}
	if ( is_category() ) {
		print 'category ';
	}
	if ( is_date() ) {
		print 'date ';
	}
	if ( is_author() ) {
		print 'author ';
	}
	if ( is_search() ) {
		print 'search ';
	}
	if ( is_paged() ) {
		print 'paged ';
	}
	if ( is_404() ) {
		print '404 ';
	}
}
/*** FUNCTION TO ADD SEMANTIC (CATEGORY) CLASSES TO INDIVIDUAL POSTS ***/
function post_category_class() {
	foreach ( ( get_the_category() ) as $cat ) { 
		echo $cat->category_nicename . ' '; 
	}
}

/*** CALLS FOR WIDGETS v0.1 ***/
if ( function_exists('register_sidebar') ) {
	register_sidebar(
		array(
			'name' => 'Primary Sidebar',
		)
	);
	register_sidebar( 
		array(
			'name' => 'Secondary Sidebar',
		)
	);
}

function widget_mytheme_search() {
?>
<li class="blog-search">
	<h2><label for="s">Search</label></h2>
	<form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div>
			<input id="s" name="s" type="text" value="<?php echo wp_specialchars($s, 1); ?>" size="5" tabindex="1" />
			<input id="searchsubmit" name="searchsubmit" type="submit" value="Find" tabindex="2" />
		</div>
	</form> 
</li>
<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Search'), 'widget_mytheme_search');
?>