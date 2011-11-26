<?php 

/*
	Single
	
	Establishes the single post template of iFeature. 
	
	Copyright (C) 2011 CyberChimps
*/



/* End variable definition. */	


get_header(); ?>

<div class="container_12">
<?php if (function_exists('chimps_breadcrumbs')) chimps_breadcrumbs(); ?>

	
		<div id="content" class="grid_8">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<div class="post_container">
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		
				<!--Begin @Core index loop hook-->
					<?php chimps_index_loop(); ?>
				<!--End @Core index loop hook-->	
			
				<!--Begin @Core link pages hook-->
					<?php chimps_link_pages(); ?>
				<!--End @Core link pages hook-->
			
				<!--Begin @Core post edit link hook-->
					<?php chimps_edit_link(); ?>
				<!--End @Core post edit link hook-->
			
				<!--Begin @Core FB like hook-->
					<?php chimps_fb_like_plus_one(); ?>
				<!--End @Core FB like hook-->
			
				<!--Begin @Core post tags hook-->
					<?php chimps_post_tags(); ?>
				<!--End @Core post tags hook-->
				
				<!--Begin @Core post pagination hook-->
					<?php chimps_post_pagination(); ?>
				<!--End @Core post pagination hook-->				
								
				<!--Begin @Core post bar hook-->
					<?php chimps_post_bar(); ?>
				<!--End @Core post bar hook-->
			
				</div><!--end post_class-->	
		</div><!--end post container--> 
	
			<?php endwhile; ?>
			
			<?php comments_template(); ?>
		
			<?php else : ?>

				<h2>Not Found</h2>

			<?php endif; ?>
		
		</div><!--end content-->

	<!--Begin @Core index after entry hook-->
	<?php chimps_index_after_entry(); ?>
	<!--End @Core index after entry hook-->



</div><!--end container_12-->

<div style="clear:both;"></div>

<?php get_footer(); ?>