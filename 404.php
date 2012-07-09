<?php 

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/*
	404
	Creates the iFeature 404 page.
	Copyright (C) 2011 CyberChimps
*/

	global $options, $themeslug, $post, $sidebar, $content_grid; // call globals

/* Header call. */

	synapse_sidebar_init();
	get_header(); 
	
/* End header. */

?>

	
<div class="container">
	<div class="row">
	<!--Begin @synapse before content sidebar hook-->
		<?php synapse_before_content_sidebar(); ?>
	<!--End @synapse before content sidebar hook-->
	<div id="content" class="<?php echo $content_grid; ?>">
		<div class="content_padding">
		
			<!-- Begin @synapse before_404 hook content-->
      			<?php synapse_before_404(); ?>
      		<!-- Begin @synapse before_404 hook content-->
		
      		<!-- Begin @synapse 404 hook content-->
      			<?php synapse_404(); ?>
      		<!-- Begin @synapse 404 hook content-->
      		
      		<!-- Begin @synapse after_404 hook content-->
      			<?php synapse_after_404(); ?>
      		<!-- Begin @synapse after_404 hook content-->
      		
		</div><!--end content_padding-->
	</div><!--end content_left-->
	
	<!--Begin @synapse after content sidebar hook-->
		<?php synapse_after_content_sidebar(); ?>
	<!--End @synapse after content sidebar hook-->
	
</div><!--end content_wrap-->
	</div><!--end row-->
</div><!--end container-->

<?php get_footer(); ?>