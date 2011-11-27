<?php 

/*
	Search
	
	Establishes the iFeature search functionality. 
	
	Copyright (C) 2011 CyberChimps
*/

get_header(); 

?>

<div class="container_12">

	<div id="content" class="grid_8">
	<!-- Begin @Core before_search hook -->
		<?php chimps_before_search(); ?>
	<!-- End @Core before_search hook -->
	
	<!-- Begin @Core search hook -->
		<?php chimps_search(); ?>
	<!-- End @Core search hook -->
	
	<!-- Begin @Core after_search hook -->
		<?php chimps_after_search(); ?>
	<!-- End @Core after_search hook -->
		
	</div>
	
	<div id="sidebar" class="grid_4">
				<?php get_sidebar(); ?>
		</div>
	

</div><!--end content_wrap-->
<div class="clear"></div>

<?php get_footer(); ?>
