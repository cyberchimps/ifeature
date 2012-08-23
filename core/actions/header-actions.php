<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Header actions used by the CyberChimps Synapse Core Framework
*
* Author: Tyler Cunningham
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Synapse
* @since 1.0
*/

/**
* Synapse header actions
*/
add_action( 'synapse_after_head_tag', 'synapse_font' );
add_action( 'synapse_head_tag', 'synapse_html_attributes' );
add_action( 'synapse_head_tag', 'synapse_meta_tags' );
add_action( 'synapse_head_tag', 'synapse_title_tag' );
add_action( 'synapse_head_tag', 'synapse_link_rel' );

add_action( 'synapse_header_sitename', 'synapse_header_sitename_content');
add_action( 'synapse_header_site_description', 'synapse_header_site_description_content' );
add_action( 'synapse_header_social_icons', 'synapse_header_social_icons_content' );

add_action( 'synapse_navigation', 'synapse_nav' );
add_action( 'synapse_404_content', 'synapse_404_content_handler' );

/**
* Establishes the theme font family.
*
* @since 1.0
*/
function synapse_font() {
	global $themeslug, $options; //Call global variables
	$family = apply_filters( 'synapse_default_font_family', 'Helvetica, serif' );
	
	if ($options->get($themeslug.'_font') == "" ) {
		$font = apply_filters( 'synapse_default_font', 'Arial' );
	}		
	else {
		$font = $options->get($themeslug.'_font'); 
	} ?>
	
	<body style="font-family:'<?php echo str_replace("+", " ", $font ); ?>', <?php echo $family; ?>" <?php body_class(); ?> > <?php
}

/**
* Establishes the theme HTML attributes
*
* @since 1.0
*/
function synapse_html_attributes() { ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class=""> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
<head profile="http://gmpg.org/xfn/11"> <?php 
}

/**
* Establishes the theme META tags (including SEO options)
*
* @since 1.0
*/
function synapse_meta_tags() {?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><?php  
	global $themeslug, $options, $post; //Call global variables
	if(!$post) return; // in case of 404 page or something
	$title = get_post_meta($post->ID, $themeslug.'_seo_title' , true);
	$pagedescription = get_post_meta($post->ID, $themeslug.'_seo_description' , true);
	$keywords = get_post_meta($post->ID, $themeslug.'_seo_keywords' , true);  ?>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="distribution" content="global" />

<meta name="language" content="<?php bloginfo( 'language' ); ?>" /> 
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width"/><?php

	if ($options->get($themeslug.'_home_title') != '' AND is_front_page()) { ?>
<meta name='title' content='<?php echo ($options->get($themeslug.'_home_title')) ;?>'/> <?php
	}
	if ($options->get($themeslug.'_home_description') != '' AND is_front_page()) { ?>
<meta name='description' content='<?php echo ($options->get($themeslug.'_home_description')) ;?>' /> <?php
	}
	if ($options->get($themeslug.'_home_keywords') != '' AND is_front_page()) { ?>
<meta name='keywords' content=' <?php echo ($options->get($themeslug.'_home_keywords')) ; ?>' /> <?php
	}
	
	if ($title != '' AND !is_front_page()) {
		echo "<meta name='title' content='$title' />";
	}
	if ($pagedescription != '' AND !is_front_page()) {
		echo "<meta name='description' content='$pagedescription'/>";
	}
	if ($keywords != '' AND !is_front_page()) {
		echo "<meta name='keywords' content='$keywords'/>";
	} 
}

/**
* Establishes the theme title tags.
*
* @since 1.0
*/
function synapse_title_tag() {
	echo '<title>'; 
	wp_title( ' - ' );
	echo '</title>';   
}

/**
* Sets the header link rel attributes
*
* @since 1.0
*/
function synapse_link_rel() {	
	
?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php }


/**
* Header left content (sitename or logo)
*
* @since 1.0
*/
function synapse_header_sitename_content() {
	global $themeslug, $options; //Call global variables
	$logo = $options->get($themeslug.'_logo'); //Calls the logo URL from the theme options
	if( $url = $options->get($themeslug.'_logo_url_toggle' ) == 1 )
	{
		$url = $options->get($themeslug.'_logo_url') != '' ? $options->get($themeslug.'_logo_url') : get_home_url();
	}
	else {
		$url = get_home_url();
	}

	if ($logo != '') { ?>
	<div id="logo">
		<a href="<?php echo $url; ?>/"><img src="<?php echo stripslashes($logo['url']); ?>" alt="logo"></a>
	</div> <?php
	}
						
	if ($logo == '' ) { ?>
		<h1 class="sitename"><a href="<?php echo $url; ?>/"><?php bloginfo('name'); ?> </a></h1>
		<?php
	}						 
}

function synapse_header_site_description_content() {
	global $themeslug, $options; ?>
	
	<div id="description">
		<h1 class="description"><?php bloginfo('description'); ?>&nbsp;</h1>
	</div> <?php
}


/**
* Social icons
*
* @since 1.0
*/
function synapse_header_social_icons_content() { 
	global $options, $themeslug; //call globals
	
	$facebook		= $options->get($themeslug.'_facebook');
	$hidefacebook   = $options->get($themeslug.'_hide_facebook_icon');
	$twitter		= $options->get($themeslug.'_twitter');;
	$hidetwitter    = $options->get($themeslug.'_hide_twitter_icon');;
	$gplus		    = $options->get($themeslug.'_gplus');
	$hidegplus      = $options->get($themeslug.'_hide_gplus_icon');
	$flickr		    = $options->get($themeslug.'_flickr');
	$hideflickr     = $options->get($themeslug.'_hide_flickr');
	$pinterest		= $options->get($themeslug.'_pinterest');
	$hidepinterest	= $options->get($themeslug.'_hide_pinterest');
	$linkedin		= $options->get($themeslug.'_linkedin');
	$hidelinkedin   = $options->get($themeslug.'_hide_linkedin');
	$youtube		= $options->get($themeslug.'_youtube');
	$hideyoutube    = $options->get($themeslug.'_hide_youtube');
	$googlemaps		= $options->get($themeslug.'_googlemaps');
	$hidegooglemaps = $options->get($themeslug.'_hide_googlemaps');
	$email			= $options->get($themeslug.'_email');
	$hideemail      = $options->get($themeslug.'_hide_email');
	$rss			= $options->get($themeslug.'_rsslink');
	$hiderss   		= $options->get($themeslug.'_hide_rss_icon');
	
	if ($options->get($themeslug.'_icon_style') == '') {
		$folder = 'default';
	}
	
	else {
		$folder = $options->get($themeslug.'_icon_style');
	} ?>

	<div id="social">

		<div class="icons">

		<?php if ($hidefacebook == '1' AND $facebook != '' OR $hidefacebook == '' AND $facebook != '' ):?>
			<a href="<?php echo $facebook ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/facebook.png" alt="Facebook" /></a>
		<?php endif;?>
		<?php if ($hidefacebook == '1' AND $facebook == '' OR $hidefacebook == '' AND $facebook == '' ):?>
			<a href="http://facebook.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/facebook.png" alt="Facebook" /></a>
		<?php endif;?>
		<?php if ($hidetwitter == '1' AND $twitter != '' OR $hidetwitter == '' AND $twitter != '' ):?>
			<a href="<?php echo $twitter ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/twitter.png" alt="Twitter" /></a>
		<?php endif;?>
		<?php if ($hidetwitter == '1' AND $twitter == '' OR $hidetwitter == '' AND $twitter == '' ):?>
			<a href="http://twitter.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/twitter.png" alt="Twitter" /></a>
		<?php endif;?>
		<?php if ($hidegplus == '1' AND $gplus != ''  OR $hidegplus == '' AND $gplus != '' ):?>
			<a href="<?php echo $gplus ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/gplus.png" alt="Gplus" /></a>
		<?php endif;?>
		<?php if ($hidegplus == '1' AND $gplus == '' OR $hidegplus == '' AND $gplus == '' ):?>
			<a href="https://plus.google.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/gplus.png" alt="Gplus" /></a>
		<?php endif;?>
		<?php if ($hideflickr == '1' AND $flickr != '' ):?>
			<a href="<?php echo $flickr ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/flickr.png" alt="Flickr" /></a>
		<?php endif;?>
		<?php if ($hideflickr == '1' AND $flickr == '' ):?>
			<a href="https://flickr.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/flickr.png" alt="Flickr" /></a>
		<?php endif;?>
		<?php if ($hidepinterest == '1' AND $pinterest != '' ):?>
			<a href="<?php echo $pinterest ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/pinterest.png" alt="Pinterest" /></a>
		<?php endif;?>
		<?php if ($hidepinterest == '1' AND $pinterest == '' ):?>
			<a href="https://pinterest.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/pinterest.png" alt="Pinterest" /></a>
		<?php endif;?>
		<?php if ($hidelinkedin == '1' AND $linkedin != '' ):?>
			<a href="<?php echo $linkedin ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/linkedin.png" alt="LinkedIn" /></a>
		<?php endif;?>
		<?php if ($hidelinkedin == '1' AND $linkedin == '' ):?>
			<a href="http://linkedin.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/linkedin.png" alt="LinkedIn" /></a>
		<?php endif;?>
		<?php if ($hideyoutube == '1' AND $youtube != '' ):?>
			<a href="<?php echo $youtube ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/youtube.png" alt="YouTube" /></a>
		<?php endif;?>
		<?php if ($hideyoutube == '1' AND $youtube == '' ):?>
			<a href="http://youtube.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/youtube.png" alt="YouTube" /></a>
		<?php endif;?>
		<?php if ($hidegooglemaps == '1' AND $googlemaps != ''):?>
			<a href="<?php echo $googlemaps ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/googlemaps.png" alt="Google Maps" /></a>
		<?php endif;?>
		<?php if ($hidegooglemaps == '1' AND $googlemaps == ''):?>
			<a href="http://google.com/maps" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/googlemaps.png" alt="Google Maps" /></a>
		<?php endif;?>
		<?php if ($hideemail == '1' AND $email != ''):?>
			<a href="mailto:<?php echo $email ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/email.png" alt="E-mail" /></a>
		<?php endif;?>
		<?php if ($hideemail == '1' AND $email == ''):?>
			<a href="mailto:no@way.com" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/email.png" alt="E-mail" /></a>
		<?php endif;?>
		<?php if ($hiderss == '1' and $rss != '' OR $hiderss == '' and $rss != '' ):?>
			<a href="<?php echo $rss ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/rss.png" alt="RSS" /></a>
		<?php endif;?>
		<?php if ($hiderss == '1' and $rss == '' OR $hiderss == '' and $rss == '' ):?>
			<a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/rss.png" alt="RSS" /></a>
		<?php endif;?>
	
		</div><!--end icons--> 
		
	</div><!--end social--> <?php
}

/**
* Navigation
*
* @since 1.0
*/
function synapse_nav() {
	global $options, $themeslug; //call globals 
	$url = $options->get($themeslug.'_logo_url') != '' ? $options->get($themeslug.'_logo_url') : get_home_url();
	
	if ($options->get($themeslug.'_hide_home_icon') == "0" && $options->get($themeslug.'_hide_search') == "0" OR $options->get($themeslug.'_hide_home_icon') == "1" && $options->get($themeslug.'_hide_search') == "0" ) {
		$grid = 'twelve columns';
	}
	
	else {
		$grid = 'nine columns';
	}
	
	?>
	
	<div class="container">
		<div class="row">

			<div class="twelve columns" id="imenu">

			<div id="nav" class="<?php echo $grid; ?>">
			<?php if ($options->get($themeslug.'_hide_home_icon') != "0"):?><div id="home"><a href="<?php echo $url; ?>"><img src="<?php echo get_template_directory_uri() ;?>/images/home.png" alt="home" /></a></div><?php endif;?>
			<?php if ($options->get($themeslug.'_hide_home_icon') == "0"):?>
			<div id="nohome"></div>
			<?php endif;?>
		    <?php wp_nav_menu( array(
		    'theme_location' => 'header-menu', // Setting up the location for the main-menu, Main Navigation.
		    'fallback_cb' => 'menu_fallback', //if wp_nav_menu is unavailable, WordPress displays wp_page_menu function, which displays the pages of your blog.
		    'items_wrap'      => '<ul id="nav_menu">%3$s</ul>',
			    )
			);
	    	?>
   			</div>
   			<?php if ($options->get($themeslug.'_hide_search') != "0"):?>
			<div class="three columns hide-on-phones">
				<?php get_search_form(); ?>
			</div>
			<?php endif;?>
		</div>
	</div>
</div>
<?php if ( $options->get($themeslug.'_hide_mobile_search') != "0" && $options->get($themeslug."_responsive_design") != "0" ):?>
<div class="show-on-phones">
	<div class="container">
		<div class="row">
			<div class="push-one-phone phone-two columns">
					<?php get_search_form(); ?>
      </div>
    </div>
   </div>
  </div>
<?php endif;?>
 <?php
}

/**
* End
*/

?>