<?php
/* 
	Options	Functions
	Author: Tyler Cuningham
	Establishes the theme options functions.
	Copyright (C) 2011 CyberChimps
	Version 2.0
	
*/

/* Icon margin*/

function if_icon_margin() {
	global $options, $themeslug;
	$margin = $options->get($themeslug.'_icon_margin');
	
	if ($options->get($themeslug.'_icon_margin') != '10px' ) {
		echo '<style type="text/css">';
		echo ".icons {margin-top: $margin;}";
		echo '</style>';
	}

}
add_action( 'wp_head', 'if_icon_margin' );

/* Backgound Option*/

function if_background_option() {

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
		
	if ($options->get($themeslug.'_custom_background') == "1") {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$custom'); background-color: $color; background-repeat: $repeat; background-position: $position; background-attachment: $attachment;}";
		echo '</style>';
	
	}
	
}
add_action( 'wp_head', 'if_background_option');

/* Disable breadcrumbs*/
 
function if_disable_breadcrumbs() {

	global $options, $themeslug;
	$root = get_template_directory_uri();
	
	if ($options->get($themeslug.'_disable_breadcrumbs') != "1") {
		
		echo '<style type="text/css">';
		echo "#crumbs {display: none;}";
		echo '</style>';

	}
}
add_action( 'wp_head', 'if_disable_breadcrumbs');

/* Plus 1 Allignment */

function if_plusone_alignment() {

	global $themename, $themeslug, $options;
	
	if ($options->get($themeslug.'_show_fb_like') == "1" AND $options->get($themeslug.'_show_gplus') == "1" ) {

		echo '<style type="text/css">';
		echo ".gplusone {float: right; margin-right: -38px;}";
		echo '</style>';
		
	}
	
}
add_action( 'wp_head', 'if_plusone_alignment');


/* Featured Image Alignment */

function if_featured_image_alignment() {

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
add_action( 'wp_head', 'if_featured_image_alignment');

/* Site Title Color */

function if_add_sitetitle_color() {

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
add_action( 'wp_head', 'if_add_sitetitle_color');

/* Tagline Color */

function if_add_tagline_color() {

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
add_action( 'wp_head', 'if_add_tagline_color');


/* Menu Font */
 
function if_add_menu_font() {
		
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
add_action( 'wp_head', 'if_add_menu_font'); 

?>