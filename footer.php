<?php

/*
	
	Footer
	
	Establishes the widgetized footer and static post-footer section of iFeature. 
	
	Copyright (C) 2011 CyberChimps
	
*/
$options = get_option('ifeature') ;  
?>
	</div><!--end main-->
</div><!--end page_wrap-->			
	
		
<div id="footer">
    <div id="footer_wrap">
    	
    	<?php if (dynamic_sidebar("Footer")) : else : ?>
		
<div class="footer-widgets">
			<div class="footer-widget-title"><?php printf( __( 'Recent Posts', 'ifeature' )); ?></div>
			<ul>
				<?php wp_get_archives('type=postbypost&limit=4'); ?>
			</ul>
		</div>
		
		<div class="footer-widgets">
			<div class="footer-widget-title"><?php printf( __( 'Archives', 'ifeature' )); ?></div>
			<ul>
				<?php wp_get_archives('type=monthly&limit=16'); ?>
			</ul>
		</div>

		<div class="footer-widgets">
			<div class="footer-widget-title"><?php printf( __( 'Links', 'ifeature' )); ?></div>
			<ul>
				<?php wp_list_bookmarks('categorize=0&title_li='); ?>
			</ul>
		</div>

		<div class="footer-widgets">
			<div class="footer-widget-title"><?php printf( __( 'WordPress', 'ifeature' )); ?></div>
			<ul>
    		<?php wp_register(); ?>
    		<li><?php wp_loginout(); ?></li>
    		<li><a href="<?php echo esc_url( __('http://wordpress.org/', 'ifeature' )); ?>" target="_blank" title="<?php esc_attr_e('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'ifeature'); ?>"> <?php printf( __('WordPress', 'ifeature' )); ?></a></li>
    		<?php wp_meta(); ?>
    		</ul>
		</div>

			<?php endif; ?>
		<div class="clear"></div>

		<!--Inserts Google Analytics Code-->
		<?php  $analytics = $options['if_ga_code']; ?>
		<?php echo stripslashes($analytics); ?>
		
	</div><!--end footer_wrap-->
</div><!--end footer-->
	
	<div id="afterfooter">
		<div id="afterfooterwrap">
			<!--Inserts Copyright Text-->
			<?php  $copyright = $options['if_footer_text']; ?>
				<?php if ($copyright == ''): ?> 
					<div id="afterfootercopyright">
						&copy; <?php echo bloginfo ( 'name' );  ?>
					</div>
				<?php endif;?>
				<?php if ($copyright != ''):?> 
					<div id="afterfootercopyright">
						&copy; <?php echo $copyright; ?>
					</div>
				<?php endif;?>
			<!--Inserts Afterfooter Menu-->
			<div id="afterfootermenu">
				<?php wp_nav_menu( array(
	   			'theme_location' => 'footer-menu', // Setting up the location for the main-menu, Main Navigation.
	    	)); ?>

			</div>
					<div id="credit">
						<?php get_template_part('credit', 'footer' ); ?>
					</div>
			
		</div>  <!--end afterfooterwrap-->	
	</div> <!--end afterfooter-->	
<?php wp_footer(); ?>	
</body>

</html>
