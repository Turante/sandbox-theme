<?php
/*
File Name: Wordpress Theme Toolkit
Version: 1.0
Author: Ozh
Author URI: http://planetOzh.com/
*/
/************************************************************************************
 * THEME USERS : Don't touch anything !! Or don't ask the theme author for support (:-0
 ************************************************************************************/
include(dirname(__FILE__).'/themetoolkit.php');

/************************************************************************************
 * FUNCTION ARRAY
 ************************************************************************************/
themetoolkit(
	'newmin', 
	array(
	'separ1' => 'CHOOSE A LAYOUT {separator}',
	'layout' => 'Layout {radio|3colleftright|3 columns: sidebar on left &amp; right<br/><img src="' . get_bloginfo('template_directory') . '/layouts/3colleftright.png" alt="3 columns: sidebar on left &amp; right" style="margin: 5px 0 10px 18px;" />|3colleft|3 columns: 2 sidebars on the left<br/><img src="' . get_bloginfo('template_directory') . '/layouts/3colleft.png" alt="3 columns: 2 sidebars on the left" style="margin: 5px 0 10px 18px;" />|3colright|3 columns: 2 sidebars on the right<br/><img src="' . get_bloginfo('template_directory') . '/layouts/3colright.png" alt="3 columns: 2 sidebars on the right" style="margin: 5px 0 10px 18px;" />|2colleft|2 columns: sidebar on the left<br/><img src="' . get_bloginfo('template_directory') . '/layouts/2colleft.png" alt="2 columns: sidebar on the left" style="margin: 5px 0 10px 18px;" />|2colright|2 columns: sidebar on the right<br/><img src="' . get_bloginfo('template_directory') . '/layouts/2colright.png" alt="2 columns: sidebar on the right" style="margin: 5px 0 10px 18px;" />|1colflu|1 column fluid: two sidebars stacked below<br/><img src="' . get_bloginfo('template_directory') . '/layouts/1colflu.png" alt="1 column fluid: two sidebars stacked below" style="margin: 5px 0 10px 18px;" />} ## All layouts have fixed width sidebars and fluid width content, except the single column layout, where sidebars are 50% of the content. Based on the markup and CSS at <a href="http://blog.html.it/layoutgala/" title="Layout Gala" target="_blank">Layout Gala</a>.',
	'separ2' => 'SELECT TYPOGRAPHY {separator}',
	'bodyfontsize' => 'Base Font Size ## The base font size globally affects all font sizes throughout your blog. This can be in any unit (e.g., px, pt, em), but I suggest using a percentage (%). Default is 80%.<br/><em>Format: <strong>Xy</strong> where X = a number and y = its units.</em>',
	'bodyfontfamily' => 'Base Font Family {radio|arial, helvetica, sans-serif|<span style="font-family:arial, helvetica, sans-serif !important;font-weight:bold;">Arial</span> (Helvetica, sans serif)|"courier new", courier, monospace|<span style="font-family:courier new, courier, monospace !important;font-weight:bold;">Courier New</span> (Courier, monospace)|georgia, times, serif|<span style="font-family:georgia, times, serif !important;font-weight:bold;">Georgia</span> (Times, serif)|"lucida console", monaco, monospace|<span style="font-family:lucida console, monaco, monospace !important;font-weight:bold;">Lucida Console</span> (Monaco, monospace)|"lucida sans unicode", lucida grande, sans-serif|<span style="font-family:lucida sans unicode, lucida grande !important;font-weight:bold;">Lucida Sans Unicode</span> (Lucida Grande, sans serif)|tahoma, geneva, sans-serif|<span style="font-family:tahoma, geneva, sans-serif !important;font-weight:bold;">Tahoma</span> (Geneva, sans serif)|"times new roman", times, serif|<span style="font-family:times new roman, times, serif !important;font-weight:bold;">Times New Roman</span> (Times, serif)|"trebuchet ms", helvetica, sans-serif|<span style="font-family:trebuchet ms, helvetica, sans-serif !important;font-weight:bold;">Trebuchet MS</span> (Helvetica, sans serif)|verdana, geneva, sans-serif|<span style="font-family:verdana, geneva, sans-serif !important;font-weight:bold;">Verdana</span> (Geneva, sans serif)} ## The base font family sets the font the body text throughout the blog. A fall-back font and the font family are in parentheses. Default is Verdana.',
	'headerfontfamily' => 'Header Font Family {radio|arial, helvetica, sans-serif|<span style="font-family:arial, helvetica, sans-serif !important;font-weight:bold;">Arial</span> (Helvetica, sans serif)|"courier new", courier, monospace|<span style="font-family:courier new, courier, monospace !important;font-weight:bold;">Courier New</span> (Courier, monospace)|georgia, times, serif|<span style="font-family:georgia, times, serif !important;font-weight:bold;">Georgia</span> (Times, serif)|"lucida console", monaco, monospace|<span style="font-family:lucida console, monaco, monospace !important;font-weight:bold;">Lucida Console</span> (Monaco, monospace)|"lucida sans unicode", lucida grande, sans-serif|<span style="font-family:lucida sans unicode, lucida grande !important;font-weight:bold;">Lucida Sans Unicode</span> (Lucida Grande, sans serif)|tahoma, geneva, sans-serif|<span style="font-family:tahoma, geneva, sans-serif !important;font-weight:bold;">Tahoma</span> (Geneva, sans serif)|"times new roman", times, serif|<span style="font-family:times new roman, times, serif !important;font-weight:bold;">Times New Roman</span> (Times, serif)|"trebuchet ms", helvetica, sans-serif|<span style="font-family:trebuchet ms, helvetica, sans-serif !important;font-weight:bold;">Trebuchet MS</span> (Helvetica, sans serif)|verdana, geneva, sans-serif|<span style="font-family:verdana, geneva, sans-serif !important;font-weight:bold;">Verdana</span> (Geneva, sans serif)} ## Sets the font family for headings (<code>h1</code>, <code>h2</code>, etc). A fall-back font and the font family are in parentheses. Default is Verdana.',
	),
	__FILE__
);

/************************************************************************************
 * FUNCTION CALLS
 ************************************************************************************/
function newmin_layout() {
	global $newmin;
	if ($newmin->option['layout'] == '3colleftright') {
		print '3colleftright.css';
	}
	if ($newmin->option['layout'] == '3colleft') {
		print '3colleft.css';
	}
	if ($newmin->option['layout'] == '3colright') {
		print '3colright.css';
	}
	if  ($newmin->option['layout'] == '2colleft') {
		print '2colleft.css';
	}
	if  ($newmin->option['layout'] == '2colright') {
		print '2colright.css';
	}
	if  ($newmin->option['layout'] == '1colflu') {
		print '1colflu.css';
	}
}
function newmin_bodyfontsize() {
	global $newmin;
	if ( $newmin->option['bodyfontsize'] ) {
		print 'body { font: ';
		print $newmin->option['bodyfontsize'];
		print "/150% ";
	}
}
function newmin_bodyfontfamily() {
	global $newmin;
	if ( $newmin->option['bodyfontfamily'] ) {
		print $newmin->option['bodyfontfamily'];
		print "; }\n";
	}
}
function newmin_headerfontfamily() {
	global $newmin;
	if ( $newmin->option['headerfontfamily'] ) {
		print 'h1, h2, h3, h4, h5, h6 { font-family: ';
		print $newmin->option['headerfontfamily'];
		print "; }\n";
	}
}

/************************************************************************************
 * FUNCTION DEFAULTS
 ************************************************************************************/
if ( !$newmin->is_installed() ) {

	$set_defaults['layout'] = '3colleftright';
	$set_defaults['bodyfontsize'] = '75%';
	$set_defaults['bodyfontfamily'] = 'verdana, geneva, sans-serif';
	$set_defaults['headerfontfamily'] = 'verdana, geneva, sans-serif';
	$result = $newmin->store_options($set_defaults) ;
}

/************************************************************************************
 * CALL FOR WIDGETS PLUGIN, V.1
 ************************************************************************************/
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => '"Blue" Sidebar',
	));
	register_sidebar(array(
		'name' => '"Orange" Sidebar',
	));
}

function widget_newmin_search() {
?>
<li id="search">
	<h2><label for="s">Search</label></h2>
	<form id="searchform" method="get" action="<?php bloginfo('home'); ?>/">
		<div>
			<input id="s" name="s" type="text" value="<?php echo wp_specialchars($s, 1); ?>" tabindex="1" size="5" />
			<input id="searchsubmit" name="searchsubmit" type="submit" value="Find" tabindex="2" />
		</div>
	</form> 
</li>
<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Search'), 'widget_plaintxtblog_search');
?>