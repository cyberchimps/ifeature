<?php 

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/*
	Single
	
	Establishes the single post template of iFeature. 
	
	Copyright (C) 2011 CyberChimps
*/


	global $options, $themeslug, $post; // call globals

/* End variable definition. */	


get_header(); ?>

<div class="container">
	<?php if ($options->get($themeslug.'_single_breadcrumbs') == "1") { synapse_breadcrumbs();}?>
	<div class="row">
	
	<!--Begin @Core post area-->
		<?php synapse_index(); ?>
	<!--End @Core post area-->

	</div>
</div><!--end container-->

<?php get_footer(); ?>