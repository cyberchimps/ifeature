<?php 

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/*
	Archive
	Creates the iFeature archive pages.
	Copyright (C) 2011 CyberChimps
	Version 2.0
*/

	global $options, $themeslug, $post, $content_grid; // call globals
	
/* Header call. */

	synapse_sidebar_init();
	get_header(); 
	
/* End header. */

?>

<div class="container">
	<?php if ($options->get($themeslug.'_archive_breadcrumbs') == "1") { synapse_breadcrumbs();}?>
	<div class="row">
	<!--Begin @synapse before content sidebar hook-->
		<?php synapse_before_content_sidebar(); ?>
	<!--End @synapse before content sidebar hook-->
	
	<div id="content" class="<?php echo $content_grid; ?>">
	<?php if (have_posts()) : ?>
	
		<!--Begin @synapse before_archive hook-->
			<?php synapse_before_archive(); ?>
		<!--End @synapse before_archive hook-->
		
		<?php while (have_posts()) : the_post(); ?>
		
		<div class="post_container">
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		
			<!--Begin @synapse archive hook-->
				<?php synapse_loop(); ?>
			<!--End @synapse archive hook-->
			
			<!--Begin @Core post tags hook-->
				<?php synapse_post_tags(); ?>
			<!--End @Core post tags hook-->
			
			</div><!--end post_class-->	
		</div><!--end post container--> 
		<!--Begin @iFeature post bar hook-->
				<?php synapse_post_bar(); ?>
			<!--End @iFeature post bar hook-->

		 <?php endwhile; ?>
	 
	 <?php else : ?>
	 
			<h2>Nothing found</h2>

	
	<?php endif; ?>

		<!--Begin @synapse pagination hook-->
			<?php synapse_pagination(); ?>
		<!--End @synapse pagination hook-->
		
		<!--Begin @synapse after_archive hook-->
			<?php synapse_after_archive(); ?>
		<!--End @synapse after_archive hook-->
	
		</div><!--end content_padding-->

	<!--Begin @synapse after content sidebar hook-->
		<?php synapse_after_content_sidebar(); ?>
	<!--End @synapse after content sidebar hook-->
	
		</div><!--end content-->
	</div><!--end row-->
</div><!--end container-->

<?php get_footer(); ?>