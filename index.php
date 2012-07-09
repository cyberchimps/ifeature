<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

 /*
	Index
	
	Creates the iFeature default index page.
	
	Copyright (C) 2011 CyberChimps
*/

	global $options, $themeslug, $post; // call globals
	
	$reorder = $options->get($themeslug.'_blog_section_order');
	$slidersize = $options->get($themeslug.'_slider_size');
			
/* Set slider hook based on page option */

	if (preg_match("/synapse_blog_slider/", $reorder )) {
		add_action ( 'synapse_blog_content_slider', 'synapse_blog_slider_lite');
	}
		
/* End set slider hook*/

?>

<?php get_header(); ?>

<div class="container">
		<?php
			foreach(explode(",", $options->get($themeslug.'_blog_section_order')) as $fn) {
				if(function_exists($fn)) {
					call_user_func_array($fn, array());
				}
			}
		?>
</div><!--end container-->

<?php get_footer(); ?>