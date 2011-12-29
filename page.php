<?php 

/*
	Page
	Establishes the core iFeature page tempate.
	Version: 2.0
	Copyright (C) 2011 CyberChimps

*/

/* Header call. */

	get_header(); 
	
/* End header. */	

/* Define global variables. */

	global $options, $themeslug, $post; // call globals

	$page_section_order = get_post_meta($post->ID, 'page_section_order' , true);
	
/* End define global variables. */

?>

<div class="container_12">
<?php if (function_exists('chimps_breadcrumbs') && ($options->get($themeslug.'_disable_breadcrumbs') == "1")) { chimps_breadcrumbs(); }?>

<?php //calls the Page Elements
	foreach(explode(",", $page_section_order) as $key) {
		$fn = 'chimps_' . $key;
		if(function_exists($fn)) {
			call_user_func_array($fn, array());
		}
	}
?>
	
</div>

<div style="clear:both;"></div>
<?php get_footer(); ?>
