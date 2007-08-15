<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<title><?php wp_title(''); ?> <?php if ( !( is_404() ) && ( is_single() ) or ( is_page() ) or ( is_archive() ) ) { ?> &middot; <?php } ?> <?php bloginfo('name'); ?></title>
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /><!-- LEAVE FOR STATS -->
<meta name="description" content="<?php bloginfo('description'); ?>" />
<link rel="stylesheet" title="Minimalist Sandbox" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
<link rel="start" href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 2.0 Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Comments RSS 2.0 Feed" href="<?php bloginfo('comments_rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head(); ?>
<style type="text/css" media="all">
/*<![CDATA[*/
@import url('<?php bloginfo('template_directory'); ?>/layouts/<?php newmin_layout(); ?>');
<?php /* CSS FOR THEME OPTIONS */
	newmin_bodyfontsize();
	newmin_bodyfontfamily();
	newmin_headerfontfamily();
?>
/*]]>*/
</style>
</head>
<body>

<div id="wrapper">

	<div id="header">
		<h1 id="blog-title"><a href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
		<p id="blog-description"><?php bloginfo('description'); ?></p>
	</div><!-- END HEADER -->