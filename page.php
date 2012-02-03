<?php 

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
	$size = get_post_meta($post->ID, 'page_slider_size' , true);
	$page_section_order = get_post_meta($post->ID, 'page_section_order' , true);
	if(!$page_section_order) {
		$page_section_order = 'page_section';
	}
	
/* End define global variables. */

/* Set slider hook based on page option */

if (preg_match("/page_slider/", $page_section_order ) && $size == "1" ) {
	remove_action ('synapse_page_slider', 'synapse_slider_content' );
	add_action ('synapse_page_content_slider', 'synapse_slider_content' );
}
/* End set slider hook*/
?>

<div class="container">
	<div class="row">
		<?php if (function_exists('synapse_breadcrumbs') && ($options->get($themeslug.'_disable_breadcrumbs') == "1")) { synapse_breadcrumbs(); }?>
	</div>
	<div class="row"> 
		<?php
			foreach(explode(",", $page_section_order) as $key) {
				$fn = 'synapse_' . $key;
				if(function_exists($fn)) {
					call_user_func_array($fn, array());
				}
			}
		?>	
	</div><!--end row-->
</div><!--end container-->
<?php get_footer(); ?>