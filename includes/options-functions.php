<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Functions related to iFeature Theme Options.
*
* Author: Tyler Cunningham
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package iFeature
* @since 3.1
*/

/**
* Establishes the theme background. 
*
* @since 3.0
*/
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

/**
* Google Plus One button alignment. 
*
* @since 3.0
*/
function if_plusone_alignment() {

	global $themename, $themeslug, $options;
	
	if ($options->get($themeslug.'_show_fb_like') == "1" AND $options->get($themeslug.'_show_gplus') == "1" OR $options->get($themeslug.'_single_show_fb_like') == "1" AND $options->get($themeslug.'_single_show_gplus') == "1" OR $options->get($themeslug.'_archive_show_fb_like') == "1" AND $options->get($themeslug.'_archive_show_gplus') == "1") {

		echo '<style type="text/css">';
		echo ".gplusone {float: right; margin-right: -38px;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'if_plusone_alignment');

/**
* Featured image alignment. 
*
* @since 3.0
*/
function if_featured_image_alignment() {

	global $themename, $themeslug, $options;
	
	if ($options->get($themeslug.'_featured_image_align') == "key4" ) {

		echo '<style type="text/css">';
		echo ".featured-image {float: none;}";
		echo '</style>';
	}
	if ($options->get($themeslug.'_featured_image_align') == "key3" ) {

		echo '<style type="text/css">';
		echo ".featured-image {float: right;}";
		echo '</style>';
	}
	if ($options->get($themeslug.'_featured_image_align') == "key2" ) {

		echo '<style type="text/css">';
		echo ".featured-image {text-align: center;}";
		echo '</style>';	
	}
	if  ($options->get($themeslug.'_featured_image_align') == "key1" )  {

		echo '<style type="text/css">';
		echo ".featured-image {float: left;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'if_featured_image_alignment');

/**
* Change site title color. 
*
* @since 3.0
*/
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

/**
* Change site tagline color. 
*
* @since 3.0
*/
function if_add_tagline_color() {

	global $themename, $themeslug, $options;

	if (!$options->get($themeslug.'_tagline_color')) {
		$tagline = '#000';
	}
	else { 
		$tagline = $options->get($themeslug.'_tagline_color'); 
	}		
		
		echo '<style type="text/css">';
		echo ".description {color: $tagline;}";
		echo '</style>';
}
add_action( 'wp_head', 'if_add_tagline_color');

/* Link Color */

function if_add_link_color() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_link_color') != '') {
		$link = $options->get($themeslug.'_link_color'); 
	

		echo '<style type="text/css">';
		echo "a {color: $link;}";
		echo ".meta a {color: $link;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'if_add_link_color');



/**
* Set custom menu font. 
*
* @since 3.0
*/
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
	
		$fontstrip =  str_replace("+", " ", $font );
	
		echo "<link href='//fonts.googleapis.com/css?family=$font' rel='stylesheet' type='text/css' />";
		echo '<style type="text/css">';
		echo "#nav ul li a {font-family: $fontstrip;}";
		echo '</style>';
}
add_action( 'wp_head', 'if_add_menu_font'); 

?>