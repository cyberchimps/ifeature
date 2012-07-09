<?php 

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/*
	Search
	
	Establishes the iFeature search functionality. 
	
	Copyright (C) 2011 CyberChimps
*/

global $options, $themeslug, $post, $sidebar, $content_grid; // call globals
	
synapse_sidebar_init();
get_header(); 

?>

<div class="container">
	<div class="row">
		<!--Begin @synapse before content sidebar hook-->
			<?php synapse_before_content_sidebar(); ?>
		<!--End @synapse before content sidebar hook-->
		<div id="content" class="<?php echo $content_grid; ?>">
			<!-- Begin @synapse before_search hook -->
				<?php synapse_before_search(); ?>
			<!-- End @synapse before_search hook -->
	
			<!-- Begin @synapse search hook -->
				<?php synapse_search(); ?>
			<!-- End @synapse search hook -->
	
			<!-- Begin @synapse after_search hook -->
				<?php synapse_after_search(); ?>
			<!-- End @synapse after_search hook -->		
		</div>	
		<!--Begin @synapse after content sidebar hook-->
			<?php synapse_after_content_sidebar(); ?>
		<!--End @synapse after content sidebar hook-->
	</div><!--end row-->
</div><!--end container-->

<?php get_footer(); ?>