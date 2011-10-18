<?php
/*
Template Name: Default Index
Copyright (C) 2011 CyberChimps

*/
$options = get_option('ifeature') ;  
?>

<?php get_header(); ?>

<div id="content_wrap">
		
	<div id="content_left">
	
		<!--Insert Feature Slider-->
	
<?php $hideslider = $options['if_hide_slider'] ?>
		<?php if ($hideslider != '1' ):?>
		
			<?php get_template_part('slider', 'index' ); ?>
		<?php endif;?>
	
		<div class="content_padding">
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<!--Call the Loop-->
			<?php get_template_part('loop', 'index' ); ?>
				
		<?php endwhile; ?>

		<?php get_template_part('pagination', 'index'); ?>

		<?php else : ?>

			<h2><?php printf( __( 'Not Found', 'ifeature' )); ?></h2>

		<?php endif; ?>
		</div> <!--end content_padding-->
	</div> <!--end content_left-->

	<?php get_sidebar(); ?>
	
</div><!--end content_wrap-->
<div class="clear"></div>

<?php get_footer(); ?>