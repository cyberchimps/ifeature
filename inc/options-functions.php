<?php
/* 
	Options	Functions
	Author: Tyler Cuningham
	Establishes the theme options functions.
	Copyright (C) 2011 CyberChimps
	Version 2.0
	
*/

/* Icon margin*/

function icon_margin() {
	global $options, $themeslug;
	$margin = $options->get($themeslug.'_icon_margin');
	
	if ($options->get($themeslug.'_icon_margin') != '18px' ) {
		echo '<style type="text/css">';
		echo ".icons {margin-top: $margin;}";
		echo '</style>';
	}

}
add_action( 'wp_head', 'icon_margin' );

/* Adjust postbar width for full width and 2 sidebar configs*/

function postbar_option() {
	global $options, $themeslug;
	
	if ($options->get($themeslug.'_blog_sidebar') == 'two-right' OR $options->get($themeslug.'_blog_sidebar') == 'right-left') {
		echo '<style type="text/css">';
		echo ".postbar {width: 95.4%;}";
		echo '</style>';
	}
	
	if ($options->get($themeslug.'_blog_sidebar') == 'none') {
		echo '<style type="text/css">';
		echo ".postbar {width: 97.8%;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'postbar_option');

/* Backgound Option*/

function background_option() {

	global $options, $themeslug;
	$root = get_template_directory_uri();
	$customsource = $options->get($themeslug.'_background_upload');
	$custom = stripslashes($customsource['url']);
	$repeat = $options->get($themeslug.'_bg_image_repeat');
	$position = $options->get($themeslug.'_bg_image_position');
	$attachment = $options->get($themeslug.'_bg_image_attachment');
	$color = $options->get($themeslug.'_background_color');
	
	if ($options->get($themeslug.'_background_image') == "" OR $options->get($themeslug.'_background_image') == "default" && $options->get($themeslug.'_custom_background') != "1")  {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$root/images/backgrounds/noise.jpg'); background-repeat: repeat; background-position: top left; background-attachment: fixed;}";
		echo '</style>';
	}
	
	if ($options->get($themeslug.'_background_image') == "dark" && $options->get($themeslug.'_custom_background') != "1")  {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$root/images/backgrounds/dark.png'); background-repeat: repeat; background-position: top left; background-attachment: fixed;}";
		echo '</style>';
	}
	
	if ($options->get($themeslug.'_background_image') == "wood" && $options->get($themeslug.'_custom_background') != "1")  {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$root/images/backgrounds/wood.png'); background-repeat: repeat; background-position: top left; background-attachment: fixed;}";
		echo '</style>';
	}
	
	if ($options->get($themeslug.'_background_image')  == "blue" && $options->get($themeslug.'_custom_background') != "1")  {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$root/images/backgrounds/blue.jpg'); background-repeat: repeat-x; background-position: top center; background-attachment: fixed;}";
		echo '</style>';
	}
	
	if ($options->get($themeslug.'_background_image') == "metal" && $options->get($themeslug.'_custom_background') != "1")   {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$root/images/backgrounds/metal.jpg'); background-color: #000; background-repeat: repeat-x; background-position: top center; background-attachment: fixed;}";
		echo '</style>';
	}
	
	if ($options->get($themeslug.'_background_image') == "space" && $options->get($themeslug.'_custom_background') != "1")  {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$root/images/backgrounds/space.jpg'); background-color: #000; background-repeat: repeat-x; background-position: top center; background-attachment: fixed;}";
		echo '</style>';
	}
	
	if ($options->get($themeslug.'_custom_background') == "1") {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$custom'); background-color: $color; background-repeat: $repeat; background-position: $position; background-attachment: $attachment;}";
		echo '</style>';
	
	}
	
}
add_action( 'wp_head', 'background_option');

/* Disable breadcrumbs*/
 
function disable_breadcrumbs() {

	global $options, $themeslug;
	$root = get_template_directory_uri();
	
	if ($options->get($themeslug.'_disable_breadcrumbs') == "1") {
		
		echo '<style type="text/css">';
		echo "#crumbs {display: none;}";
		echo '</style>';

	}
}
add_action( 'wp_head', 'disable_breadcrumbs');

/* Plus 1 Allignment */

function plusone_alignment() {

	global $themename, $themeslug, $options;
	
	if ($options->get($themeslug.'_show_fb_like') == "1" AND $options->get($themeslug.'_show_gplus') == "1" ) {

		echo '<style type="text/css">';
		echo ".gplusone {float: right; margin-right: -38px;}";
		echo '</style>';
		
	}
	
}
add_action( 'wp_head', 'plusone_alignment');


/* Featured Image Alignment */

function featured_image_alignment() {

	global $themename, $themeslug, $options;
	
	if ($options->get($themeslug.'_featured_image_align') == "key3" ) {

		echo '<style type="text/css">';
		echo ".featured-image {float: right;}";
		echo '</style>';
		
	}
	
	elseif ($options->get($themeslug.'_featured_image_align') == "key2" ) {

		echo '<style type="text/css">';
		echo ".featured-image {text-align: center;}";
		echo '</style>';
		
	}
	
	else {

		echo '<style type="text/css">';
		echo ".featured-image {float: left;}";
		echo '</style>';
		
	}

	
}
add_action( 'wp_head', 'featured_image_alignment');

/* Post Meta Data width */

function post_meta_data_width() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_blog_sidebar') == "two-right" OR $options->get($themeslug.'_blog_sidebar') == "right-left") {

		echo '<style type="text/css">';
		echo ".postmetadata {width: 480px;}";
		echo '</style>';
		
	}
	
}
add_action( 'wp_head', 'post_meta_data_width');

/* Site Title Color */

function add_sitetitle_color() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_sitetitle_color') == "") {
		$sitetitle = '#717171';
	}
	
	else {
		$sitetitle = $options->get($themeslug.'_sitetitle_color'); 
	}		
	
		echo '<style type="text/css">';
		echo ".sitename a {color: $sitetitle;}";
		echo '</style>';
		
}
add_action( 'wp_head', 'add_sitetitle_color');

/* Link Color */

function add_link_color() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_link_color') != '') {
		$link = $options->get($themeslug.'_link_color'); 
	

		echo '<style type="text/css">';
		echo "a {color: $link;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'add_link_color');


/* Menu Link Color */

function add_menulink_color() {

	global $themename, $themeslug, $options;

	if (!$options->get($themeslug.'_menulink_color')) {
		$sitelink = '#FFFFFF';
	}
	
	else{ 
		$sitelink = $options->get($themeslug.'_menulink_color'); 
	}	
		
		echo '<style type="text/css">';
		echo "#nav ul li a {color: $sitelink;}";
		echo '</style>';
}
add_action( 'wp_head', 'add_menulink_color');

/* Tagline Color */

function add_tagline_color() {

	global $themename, $themeslug, $options;

	if (!$options->get($themeslug.'_tagline_color')) {
		$tagline = '#000';
	}
	
	else { 
		$tagline = $options->get($themeslug.'_tagline_color'); 
	}		
		
		echo '<style type="text/css">';
		echo "#description {color: $tagline;}";
		echo '</style>';

}
add_action( 'wp_head', 'add_tagline_color');

/* Post Title Color */

function add_posttitle_color() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_posttitle_color') != '') {
		$posttitle = $options->get($themeslug.'_posttitle_color'); 
			
		echo '<style type="text/css">';
		echo ".posts_title a {color: $posttitle;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'add_posttitle_color');

/* Footer Color */

function add_footer_color() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_footer_color') != "#222222" ) {
	
		$footercolor = $options->get($themeslug.'_footer_color'); 
	
	
		echo '<style type="text/css">';
		echo "#footer {background: $footercolor;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'add_footer_color');

/* Menu Font */
 
function add_menu_font() {
		
	global $themename, $themeslug, $options;	
		
	if ($options->get($themeslug.'_menu_font') == "") {
		$font = 'Arial';
	}		
		
	elseif ($options->get($themeslug.'_menu_font') == 'custom' && $options->get($themeslug.'_custom_menu_font') != "") {
		$font = $options->get($themeslug.'_custom_menu_font');	
	}
	
	else {
		$font = $options->get($themeslug.'_menu_font'); 
	}
	
		$fontstrip =  ereg_replace("[^A-Za-z0-9]", " ", $font );
	
		echo "<link href='http://fonts.googleapis.com/css?family=$font' rel='stylesheet' type='text/css' />";
		echo '<style type="text/css">';
		echo "#nav ul li a {font-family: $fontstrip;}";
		echo '</style>';
}
add_action( 'wp_head', 'add_menu_font'); 

/* Widget title background */
 
/*function widget_title_bg() {

	global $themename, $themeslug, $options;
	$root = get_template_directory_uri();
	
	if (v($options, $themeslug.'_widget_title_bg') == "1") {
		
		echo '<style type="text/css">';
		echo ".box-widget-title {background: url($root/images/wtitlebg.png) no-repeat center top; margin: -6px -5px 5px -5px;}";
		echo ".sidebar-widget-title {background: url($root/images/wtitlebg.png) no-repeat center top; margin: -6px -5px 5px -5px;}";
		echo '</style>';

	}
}
add_action( 'wp_head', 'widget_title_bg'); */


/* Custom CSS */

function custom_css() {

	global $themename, $themeslug, $options;
	
	$custom =$options->get($themeslug.'_css_options');
	echo '<style type="text/css">' . "\n";
	echo custom_css_filter ( $custom ) . "\n";
	echo '</style>' . "\n";
}

function custom_css_filter($_content) {
	$_return = preg_replace ( '/@import.+;( |)|((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/))/i', '', $_content );
	$_return = htmlspecialchars ( strip_tags($_return), ENT_NOQUOTES, 'UTF-8' );
	return $_return;
}
		
add_action ( 'wp_head', 'custom_css' );

?>