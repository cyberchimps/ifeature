<?php 

/*
	Single
	
	Establishes the single post template of iFeature. 
	
	Copyright (C) 2011 CyberChimps
*/


	global $options, $themeslug, $post; // call globals

/* End variable definition. */	


get_header(); ?>

<div class="container">
	<div class="row">
		<?php if (function_exists('synapse_breadcrumbs') && ($options->get($themeslug.'_disable_breadcrumbs') == "1")) { synapse_breadcrumbs(); }?>
	</div>
	<div class="row">
	
	<!--Begin @Core post area-->
		<?php synapse_index(); ?>
	<!--End @Core post area-->

	</div>
</div><!--end container-->

<?php get_footer(); ?>