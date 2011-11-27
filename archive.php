<?php 

/*
	Archive
	Creates the iFeature archive pages.
	Copyright (C) 2011 CyberChimps
	Version 2.0
*/

/* Header call. */

	get_header(); 
	
/* End header. */

?>

<div class="container_12">

<?php if (function_exists('chimps_breadcrumbs')) chimps_breadcrumbs(); ?>

	<div id="main">
	
		<div id="content" class="grid_8">
		
		
		
		<!--Begin @Core before_archive hook-->
			<?php chimps_before_archive(); ?>
		<!--End @Core before_archive hook-->
		
		<?php if (have_posts()) : ?>
		
			<!--Begin @Core archive hook-->
			<?php chimps_archive_title(); ?>
			<!--End @Core archive hook-->
		
		<?php while (have_posts()) : the_post(); ?>
		
			<!--Begin @Core archive hook-->
				<?php chimps_archive(); ?>
			<!--End @Core archive hook-->
		
		 <?php endwhile; ?>
	 
	 <?php else : ?>

		<h2>Nothing found</h2>

	<?php endif; ?>

		<!--Begin @Core pagination hook-->
			<?php chimps_pagination(); ?>
		<!--End @Core pagination hook-->
		
		<!--Begin @Core after_archive hook-->
			<?php chimps_after_archive(); ?>
		<!--End @Core after_archive hook-->
	
		</div><!--end content_padding-->
		


		<div id="sidebar" class="grid_4">
				<?php get_sidebar(); ?>
		</div>
	
</div><!--end content_wrap-->

	</div><!--end content_left-->

<div class='clear'>&nbsp;</div>

<?php get_footer(); ?>