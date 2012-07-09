<?php 

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/*
	Page
	Establishes the iFeature Pro page tempate.
	Version: 3.0
	Copyright (C) 2011 CyberChimps

*/

/* Header call. */

	get_header(); 
	
/* End header. */	

/* Define global variables. */
	global $options, $post, $themeslug;
	$page_section_order = get_post_meta($post->ID, $themeslug.'_page_section_order' , true);
	if(!$page_section_order) {
		$page_section_order = 'breadcrumbs,page_section';
	}
	
/* End define global variables. */?>

<div class="container">
	
	<div class="row"> 
	
	<!--Begin @Core before page content hook-->
		<?php synapse_before_page_content(); ?>
	<!--End @Core before page content hook-->

		<?php
			foreach(explode(",", $page_section_order) as $key) {
				$fn = 'synapse_' . $key;
				if(function_exists($fn)) {
					call_user_func_array($fn, array());
				}
			}
		?>	
		
	<!--Begin @Core after page content hook-->
		<?php synapse_after_page_content(); ?>
	<!--End @Core after page content hook-->
	
	</div><!--end row-->
</div><!--end container-->

<?php get_footer(); ?>