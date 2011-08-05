<?php 

/*
	404
	
	Creates the iFeature 404 page.
	
	Copyright (C) 2011 CyberChimps
*/

get_header(); 
?>

<div id="content_wrap">
	<div id="content_left">
		<div class="content_padding">

	<div class="error">Error 404<br />
	<center><img src="<?php echo get_template_directory_uri() ;?>/images/confusedchimp.png" height="400" width="400" /></center>
	
	</div>
				
		</div><!--end content_padding-->
		
	</div><!--end content_left-->

	<div id="sidebar_right"><?php get_sidebar(); ?></div>
</div><!--end content_wrap-->

<div style=clear:both;></div>
<?php get_footer(); ?>