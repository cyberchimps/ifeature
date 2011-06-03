<?php
/*
	Section: Icons
	Authors: Trent Lapinski, Tyler Cunningham 
	Description: Creates header icons.
	Version: 1.0.3	
*/
	$options = get_option('ifeature') ;  
	$facebook		= $options['if_facebook'];
	$twitter		= $options['if_twitter'] ;
	$linkedin		= $options['if_linkedin'] ;
	$youtube		= $options['if_youtube'];
	$googlemaps		= $options['if_googlemaps'];
	$email			= $options['if_email'];
	$rss			= $options['if_rsslink'] ;

?>

<div class="icons">

	<?php if ($facebook != 'hide' AND $facebook != '' ):?>
		<a href="<?php echo $facebook ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/facebook.png" alt="Facebook" /></a>
		<?php endif;?>
	<?php if ($facebook != 'hide' AND $facebook == '' ):?>
		<a href="http://facebook.com"><img src="<?php echo get_template_directory_uri(); ?>/images/social/facebook.png" alt="Facebook" /></a>
	<?php endif;?>
	<?php if ($twitter != 'hide' AND $twitter != '' ):?>
		<a href="<?php echo $twitter ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/twitter.png" alt="Twitter" /></a>
	<?php endif;?>
	<?php if ($twitter != 'hide' AND $twitter == '' ):?>
		<a href="http://twitter.com"><img src="<?php echo get_template_directory_uri(); ?>/images/social/twitter.png" alt="Twitter" /></a>
	<?php endif;?>
	<?php if ($linkedin != 'hide' AND $linkedin != '' ):?>
		<a href="<?php echo $linkedin ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/linkedin.png" alt="LinkedIn" /></a>
	<?php endif;?>
		<?php if ($linkedin != 'hide' AND $linkedin == '' ):?>
		<a href="http://linkedin.com" ><img src="<?php echo get_template_directory_uri(); ?>/images/social/linkedin.png" alt="LinkedIn" /></a>
	<?php endif;?>
	<?php if ($youtube != 'hide' AND $youtube != '' ):?>
		<a href="<?php echo $youtube ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/youtube.png" alt="YouTube" /></a>
	<?php endif;?>
	<?php if ($youtube != 'hide' AND $youtube == '' ):?>
		<a href="http://youtube.com"><img src="<?php echo get_template_directory_uri(); ?>/images/social/youtube.png" alt="YouTube" /></a>
	<?php endif;?>
	<?php if ($googlemaps != 'hide' AND $googlemaps != ''):?>
		<a href="<?php echo $googlemaps ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/googlemaps.png" alt="Google Maps" /></a>
	<?php endif;?>
	<?php if ($googlemaps != 'hide' AND $googlemaps == ''):?>
		<a href="http://google.com/maps"><img src="<?php echo get_template_directory_uri(); ?>/images/social/googlemaps.png" alt="Google Maps" /></a>
	<?php endif;?>
	<?php if ($email != 'hide' AND $email != ''):?>
		<a href="mailto:<?php echo $email ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/email.png" alt="E-mail" /></a>
	<?php endif;?>
		<?php if ($email != 'hide' AND $email == ''):?>
		<a href="mailto:no@way.com"><img src="<?php echo get_template_directory_uri(); ?>/images/social/email.png" alt="E-mail" /></a>
	<?php endif;?>
	<?php if ($rss != 'hide' and $rss != '' ):?>
		<a href="<?php echo $rss ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/rss.png" alt="RSS" /></a>
	<?php endif;?>
	<?php if ($rss == '' ):?>
		<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/rss.png" alt="RSS" /></a>
	<?php endif;?>
	
</div>