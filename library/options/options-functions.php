<?php
/* 
	Options	Functions
	Author: Tyler Cuningham
	Establishes the theme options functions.
	Copyright (C) 2011 CyberChimps
	Version 2.0
	
*/

/* Disable breadcrumbs*/
 
function ifeature_disable_breadcrumbs() {

	global $options;
	$root = get_template_directory_uri();
	
	if ($options['if_disable_breadcrumbs'] == "1") {
		
		echo '<style type="text/css">';
		echo "#crumbs {display: none;}";
		echo '</style>';

	}
}
add_action( 'wp_head', 'ifeature_disable_breadcrumbs');


/* Widget title background */
 
function ifeature_widget_title_bg() {

	global $options;
	$root = get_template_directory_uri();
	
	if ($options['if_widget_title_bg'] == "1") {
		
		echo '<style type="text/css">';
		echo ".box-widget-title {background: url($root/images/wtitlebg.png) no-repeat center top; margin: -6px -5px 5px -5px;}";
		echo ".sidebar-widget-title {background: url($root/images/wtitlebg.png) no-repeat center top; margin: -6px -5px 5px -5px;}";
		echo '</style>';

	}
}
add_action( 'wp_head', 'ifeature_widget_title_bg');



/* Plus 1 Allignment */

function ifeature_plusone_alignment() {

	global $options;
	
	if ($options['if_show_fb_like'] == "1" AND $options['if_show_gplus'] == "1" ) {

		echo '<style type="text/css">';
		echo ".gplusone {float: right; margin-right: -38px;}";
		echo '</style>';
		
	}
	
}
add_action( 'wp_head', 'ifeature_plusone_alignment');


/* Featured Image Alignment */

function ifeature_featured_image_alignment() {

	global $options;
	
	if ($options['if_featured_images'] == "right" ) {

		echo '<style type="text/css">';
		echo ".featured-image {float: right;}";
		echo '</style>';
		
	}
	
	elseif ($options['if_featured_images'] == "center" ) {

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
add_action( 'wp_head', 'ifeature_featured_image_alignment');


/* Link Color */

function ifeature_add_link_color() {

	global $options;

	if ($options['if_link_color'] == "") 
		$link = '717171';
	

	else 
		$link = $options['if_link_color']; 
					
	
		echo '<style type="text/css">';
		echo "a {color: #$link;}";
		echo '</style>';
		
}
add_action( 'wp_head', 'ifeature_add_link_color');
