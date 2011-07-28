<?php
/*
	Section: Icons
	Authors: Trent Lapinski, Tyler Cunningham 
	Description: Creates header icons.
	Version: 2.0	
*/
	$options = get_option('ifeature') ;  
	$facebook		= $options['if_facebook'];
	$hidefacebook   = $options['if_hide_facebook'];
	$twitter		= $options['if_twitter'] ;
	$hidetwitter   = $options['if_hide_twitter'];
	$gplus		= $options['if_gplus'] ;
	$hidegplus   = $options['if_hide_gplus'];
	$linkedin		= $options['if_linkedin'] ;
	$hidelinkedin   = $options['if_hide_linkedin'];
	$youtube		= $options['if_youtube'];
	$hideyoutube   = $options['if_hide_youtube'];
	$googlemaps		= $options['if_googlemaps'];
	$hidegooglemaps   = $options['if_hide_googlemaps'];
	$email			= $options['if_email'];
	$hideemail   = $options['if_hide_email'];
	$rss			= $options['if_rsslink'] ;
	$hiderss   = $options['if_hide_rss'];

?>

<div class="icons">

	<?php if ($hidefacebook != '1' AND $facebook != '' ):?>
		<a href="<?php echo $facebook ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/facebook.png" alt="Facebook" /></a>
		<?php endif;?>
	<?php if ($hidefacebook != '1' AND $facebook == '' ):?>
		<a href="http://facebook.com"><img src="<?php echo get_template_directory_uri(); ?>/images/social/facebook.png" alt="Facebook" /></a>
	<?php endif;?>
	<?php if ($hidetwitter != '1' AND $twitter != '' ):?>
		<a href="<?php echo $twitter ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/twitter.png" alt="Twitter" /></a>
	<?php endif;?>
	<?php if ($hidetwitter != '1' AND $twitter == '' ):?>
		<a href="http://twitter.com"><img src="<?php echo get_template_directory_uri(); ?>/images/social/twitter.png" alt="Twitter" /></a>
	<?php endif;?>
		<?php if ($hidegplus != '1' AND $gplus != '' ):?>
		<a href="<?php echo $gplus ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/gplus.png" alt="Gplus" /></a>
	<?php endif;?>
	<?php if ($hidegplus != '1' AND $gplus == '' ):?>
		<a href="https://plus.google.com"><img src="<?php echo get_template_directory_uri(); ?>/images/social/gplus.png" alt="Gplus" /></a>
	<?php endif;?>
	<?php if ($hidelinkedin != '1' AND $linkedin != '' ):?>
		<a href="<?php echo $linkedin ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/linkedin.png" alt="LinkedIn" /></a>
	<?php endif;?>
		<?php if ($hidelinkedin != '1' AND $linkedin == '' ):?>
		<a href="http://linkedin.com" ><img src="<?php echo get_template_directory_uri(); ?>/images/social/linkedin.png" alt="LinkedIn" /></a>
	<?php endif;?>
	<?php if ($hideyoutube != '1' AND $youtube != '' ):?>
		<a href="<?php echo $youtube ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/youtube.png" alt="YouTube" /></a>
	<?php endif;?>
	<?php if ($hideyoutube != '1' AND $youtube == '' ):?>
		<a href="http://youtube.com"><img src="<?php echo get_template_directory_uri(); ?>/images/social/youtube.png" alt="YouTube" /></a>
	<?php endif;?>
	<?php if ($hidegooglemaps != '1' AND $googlemaps != ''):?>
		<a href="<?php echo $googlemaps ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/googlemaps.png" alt="Google Maps" /></a>
	<?php endif;?>
	<?php if ($hidegooglemaps != '1' AND $googlemaps == ''):?>
		<a href="http://google.com/maps"><img src="<?php echo get_template_directory_uri(); ?>/images/social/googlemaps.png" alt="Google Maps" /></a>
	<?php endif;?>
	<?php if ($hideemail != '1' AND $email != ''):?>
		<a href="mailto:<?php echo $email ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/email.png" alt="E-mail" /></a>
	<?php endif;?>
		<?php if ($hideemail != '1' AND $email == ''):?>
		<a href="mailto:no@way.com"><img src="<?php echo get_template_directory_uri(); ?>/images/social/email.png" alt="E-mail" /></a>
	<?php endif;?>
	<?php if ($hiderss != '1' and $rss != '' ):?>
		<a href="<?php echo $rss ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/rss.png" alt="RSS" /></a>
	<?php endif;?>
	<?php if ($hiderss != '1' and $rss == ''  ):?>
		<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/rss.png" alt="RSS" /></a>
	<?php endif;?>
	
</div>