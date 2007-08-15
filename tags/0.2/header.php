<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<?php // ADDS FUNCTIONALITY TO OPTIONS FROM THE functions.php FILE
global $options;
foreach ( $options as $value ) {
	if ( get_settings( $value['id'] ) === FALSE ) {
		$$value['id'] = $value['std'];
	} else {
	$$value['id'] = get_settings( $value['id'] );
	}
} ?>
<title><?php wp_title(''); ?> <?php if ( !(is_404() ) && ( is_single() ) or ( is_page() ) or ( is_archive() ) ) { ?> &middot; <?php } ?> <?php bloginfo('name'); ?> <?php if ( is_home() ) { ?> &middot; <?php bloginfo('description'); ?><?php } ?> </title>
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /><!-- LEAVE FOR STATS -->
<meta name="description" content="<?php bloginfo('description'); ?>" />
<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php bloginfo('name'); ?> Comments RSS" />
<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php bloginfo('name'); ?> RSS" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="search" href="<?php echo get_settings('home'); ?>/#s" title="<?php bloginfo('name'); ?>" />
<link rel="start" href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" title="Minimalist Sandbox" media="all" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head(); ?>
<!-- STYLING BELOW INSERTED VIA MINIMALIST SANDBOX THEME OPTIONS MENU -->
<style type="text/css" media="all">
/*<![CDATA[*/
@import url('<?php bloginfo('template_directory'); ?>/layouts/<?php echo $sandbox_layout; ?>');
body {
	background: <?php echo $sandbox_body_background; ?>;
	color: <?php echo $sandbox_body_color; ?>;
	font: <?php echo $sandbox_body_font_size; ?>/150% <?php echo $sandbox_body_font_family; ?>;
}
h1, h2, h3, h4, h5, h6 { font-family: <?php echo $sandbox_heading_font_family; ?>; }
/*]]>*/
</style>
</head>

<body class="<?php body_class(); ?>">

<div id="wrapper">

	<div id="header">
		<h1 id="blog-title"><a href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
		<p id="blog-description"><?php bloginfo('description'); ?></p>
	</div><!-- END HEADER -->