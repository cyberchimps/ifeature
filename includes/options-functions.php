<?php
/**
* Functions related to the iFeature Theme Options.
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

/* Widget Title Background*/

function widget_title_background() {
	global $options, $themeslug;
		
	if ($options->get($themeslug.'_widget_title_background') == '0' ) {
		echo '<style type="text/css">';
		echo ".widget-title {background: none; border-bottom: none;}";
		echo '</style>';
	}

}
add_action( 'wp_head', 'widget_title_background' );

/* Icon margin*/

function icon_margin() {
	global $options, $themeslug;
	$margin = $options->get($themeslug.'_icon_margin');
	
	if ($options->get($themeslug.'_icon_margin') != '10px' ) {
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

/* Plus 1 Allignment */

function plusone_alignment() {

	global $themename, $themeslug, $options;
	
	if ($options->get($themeslug.'_show_fb_like') == "1" AND $options->get($themeslug.'_show_gplus') == "1" OR $options->get($themeslug.'_single_show_fb_like') == "1" AND $options->get($themeslug.'_single_show_gplus') == "1" ) {

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
		echo ".meta a {color: $link;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'add_link_color');

/* Link Hover Color */

function add_link_hover_color() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_link_hover_color') != '') {
		$link = $options->get($themeslug.'_link_hover_color'); 
	

		echo '<style type="text/css">';
		echo "a:hover {color: $link;}";
		echo ".meta a:hover {color: $link;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'add_link_hover_color');

/* Menu Color */

function add_menu_color() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_custom_menu_color') != '' && $options->get($themeslug.'_custom_menu_color_toggle') != '0') {
		$color = $options->get($themeslug.'_custom_menu_color'); 
	

		echo '<style type="text/css">';
		echo "#imenu {background: $color;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'add_menu_color');

/* Menu Link Color */

function add_menulink_color() {

	global $themename, $themeslug, $options;

	if (!$options->get($themeslug.'_menulink_color')) {
		$sitelink = '#FFFFFF';
	}
	
	elseif ($options->get($themeslug.'_custom_menu_color_toggle') == '1'){ 
		$sitelink = $options->get($themeslug.'_menulink_color'); 
	}	
		
		echo '<style type="text/css">';
		echo "#nav ul li a {color: $sitelink;}";
		echo '</style>';
}
add_action( 'wp_head', 'add_menulink_color');

/* Menu Dropdown Color */

function add_menu_dropdown_color() {

	global $themename, $themeslug, $options;

	if (!$options->get($themeslug.'_custom_dropdown_color')) {
		$dropdown = '#555';
	}
	
	elseif ($options->get($themeslug.'_custom_menu_color_toggle') == '1'){ 
		$dropdown = $options->get($themeslug.'_custom_dropdown_color'); 
	}	
		
		echo '<style type="text/css">';
		echo "#nav li ul a {background: $dropdown;}";
		echo '</style>';
}
add_action( 'wp_head', 'add_menu_dropdown_color');

/* Menu Hover Color */

function add_menu_hover_color() {

	global $themename, $themeslug, $options;

	if (!$options->get($themeslug.'_menu_hover_color')) {
		$hover = '#444';
	}
	
	elseif ($options->get($themeslug.'_custom_menu_color_toggle') == '1'){ 
		$hover = $options->get($themeslug.'_menu_hover_color'); 
	}	
		
		echo '<style type="text/css">';
		echo "#nav ul li a:hover {background: $hover;}";
		echo '</style>';
}
add_action( 'wp_head', 'add_menu_hover_color');

/* Corners */

function menu_rounded_corners() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_menu_corners') == '0') {
		echo '<style type="text/css">';
		echo "#imenu {-webkit-border-radius: 0px;border-radius: 0px;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'menu_rounded_corners');

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

	if ($options->get($themeslug.'_footer_color') != "" ) {
	
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

/* Custom CSS */

function custom_css() {

	global $themename, $themeslug, $options;
	
	$custom =$options->get($themeslug.'_css_options');
	echo '<style type="text/css">' . "\n";
	echo  $custom  . "\n";
	echo '</style>' . "\n";
}

function custom_css_filter($_content) {
	$_return = preg_replace ( '/@import.+;( |)|((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/))/i', '', $_content );
	$_return = htmlspecialchars ( strip_tags($_return), ENT_NOQUOTES, 'UTF-8' );
	return $_return;
}
		
add_action ( 'wp_head', 'custom_css' );

?>