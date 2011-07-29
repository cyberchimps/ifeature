<?php
/* 
	Options	Functions
	Author: Tyler Cuningham
	Establishes the theme options functions.
	Copyright (C) 2011 CyberChimps
	Version 2.0
	
*/

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


/* Custom CSS */

function ifeature_custom_css() {

	global $options;
	
	$custom = $options['if_css_options'];
	echo '<style type="text/css">' . "\n";
	echo ifeature_custom_css_filter ( $custom ) . "\n";
	echo '</style>' . "\n";
}

function ifeature_custom_css_filter($_content) {
	$_return = preg_replace ( '/@import.+;( |)|((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/))/i', '', $_content );
	$_return = htmlspecialchars ( strip_tags($_return), ENT_NOQUOTES, 'UTF-8' );
	return $_return;
}
		
add_action ( 'wp_head', 'ifeature_custom_css' );

?>