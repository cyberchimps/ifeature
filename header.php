<?php 

/*
	Header
	Authors: Tyler Cunningham, Trent Lapinski
	Creates the theme header. 
	Copyright (C) 2011 CyberChimps
	Version 2.0
*/

/* Call globals. */	

	global $themename, $themeslug, $options;
	
	ifeature_header_content_init();

/* End globals. */
	
?>
<!-- Begin @Core head_tag hook content-->
	<?php chimps_head_tag(); ?>
<!-- End @Core head_tag hook content-->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> <!-- wp_enqueue_script( 'comment-reply' );-->
<?php wp_head(); ?> <!-- wp_head();-->
	
</head> <!-- closing head tag-->

<!-- Begin @Core after_head_tag hook content-->
	<?php chimps_after_head_tag(); ?>
<!-- End @Core after_head_tag hook content-->
	
<!-- Begin @Core before_header hook  content-->
	<?php chimps_before_header(); ?> 
<!-- End @Core before_header hook content -->
			
	<header id="head">
		
	<?php if ($options->get($themeslug.'_disable_header') != "1"):?>
	
		<!-- Begin @iFeature header content hook-->
			<?php ifeature_header_content(); ?> 
		<!-- End @iFeature header content hook -->	
				
	<?php endif;?>

		<!-- Begin @Core navigation contact area hook -->
			<?php chimps_navigation(); ?> 
		<!-- End @Core navigation contact area hook -->
				<div class='clear'>&nbsp;</div>
			</header>
<script type="text/javascript">$("ul").parent("li").addClass("parent");</script>				
<!-- Begin @Core after_header hook -->
	<?php chimps_after_header(); ?> 
<!-- End @Core after_header hook -->