<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Custom actions used by the iFeature Pro WordPress Theme
*
* Author: Tyler Cunningham
* Copyright: © 2011
* {@link http://cyberchimpscom/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package iFeature Pro
* @since 3.0
*/

/**
* iFeature Actions
*/
add_action( 'ifeature_header_contact_area', 'ifeature_header_contact_area_content' );

add_action( 'ifeature_header_content', 'ifeature_header_standard_content');
add_action( 'ifeature_sitename_contact', 'ifeature_sitename_contact_content');
add_action( 'ifeature_description_icons', 'ifeature_description_icons_content');
add_action( 'ifeature_logo_description', 'ifeature_logo_description_content');


remove_action( 'synapse_head_tag', 'synapse_link_rel' );
add_action( 'synapse_head_tag', 'ifeature_link_rel' );

remove_action( 'synapse_box_section', 'synapse_box_section_content' );
add_action( 'synapse_box_section', 'ifeature_box_section_content' );

remove_action( 'synapse_sidebar_init', 'synapse_sidebar_init_content' );
add_action( 'synapse_sidebar_init', 'custom_sidebar_init_content' );

remove_action( 'synapse_before_content_sidebar', 'synapse_before_content_sidebar_markup' );

remove_action( 'synapse_after_content_sidebar', 'synapse_after_content_sidebar_markup' );
add_action( 'synapse_after_content_sidebar', 'custom_after_content_sidebar_markup' );

/**
* Set sidebar and grid variables.
*
* @since 1.0
*/
function custom_sidebar_init_content() {

	global $options, $themeslug, $post, $sidebar, $content_grid;

	if (is_page()) {
	$sidebar = get_post_meta($post->ID, $themeslug.'_page_sidebar' , true);
	}
	
	if ($sidebar == "1") {
		$content_grid = 'twelve columns';
	}
	else {
		$content_grid = 'eight columns';
	}
}

/**
* After entry sidebar
*
* @since 1.0
*/
function custom_after_content_sidebar_markup() {
	global $options, $themeslug, $post, $sidebar; // call globals ?>
	
	<?php if ($sidebar == '0' OR $sidebar == '' ): ?>
	<div id="sidebar" class="four columns">
		<?php get_sidebar(); ?>
	</div>
	<?php endif;?>
	<?php 
}


/**
* Sets up the header contact area
*
* @since 1.0
*/
function ifeature_header_contact_area_content() { 
	global $themeslug, $options; 
	$contactdefault = apply_filters( 'synapse_header_contact_default_text', 'Enter Contact Information Here' ); 
			
		echo "<div id='header_contact'>";
		echo stripslashes ($options->get($themeslug.'_header_contact')); 
		echo "</div>";
}

/**
* Sets the header link rel attributes
*
* @since 3.0.2
*/
function ifeature_link_rel() {
	global $themeslug, $options; //Call global variables
	$favicon = $options->get($themeslug.'_favicon'); //Calls the favicon URL from the theme options 
  
	if( $options->get( $themeslug.'_favicon_toggle' )	== true ): ?>
	<link rel="shortcut icon" href="<?php echo stripslashes($favicon['url']); ?>" type="image/x-icon" />
<?php endif; ?>

<?php if( $options->get($themeslug.'_apple_touch_toggle') == true && is_array( $options->get($themeslug.'_apple_touch') ) ): ?>
<!--  For apple touch icon -->
<?php $apple_icon = $options->get($themeslug.'_apple_touch'); ?>
<link rel="apple-touch-icon" href="<?php echo $apple_icon['url']; ?>"/>
<?php endif; ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php
}

/**
* Sitename/Contact
*
* @since 3.0
*/
function ifeature_sitename_contact_content() {
?>
	<div class="container">
		<div class="row">
		
			<div class="seven columns">
				
				<!-- Begin @Core header sitename hook -->
					<?php synapse_header_sitename(); ?> 
				<!-- End @Core header sitename hook -->
			
				
			</div>	
			
			<div class="five columns">
			
			<!-- Begin @Core header contact area hook -->
			<?php ifeature_header_contact_area(); ?>
		<!-- End @Core header contact area hook -->
						
			</div>	
		</div><!--end row-->
	</div>
	
<?php
}

/**
* Logo/Description
*
* @since 3.0
*/
function ifeature_logo_description_content() {
?>
	<div class="container">
		<div class="row">
		
			<div class="seven columns">
				
			<!-- Begin @Core header sitename hook -->
					<?php synapse_header_sitename(); ?> 
			<!-- End @Core header sitename hook -->
			
				
			</div>	
			
			<div class="five columns" style="text-align: right;">
			
			<!-- Begin @Core header description hook -->
				<?php synapse_header_site_description(); ?> 
			<!-- End @Core header description hook -->
						
			</div>	
		</div><!--end row-->
	</div>	

<?php
}

/**
* Description/Icons
*
* @since 3.0
*/
function ifeature_description_icons_content() {
?>
	<div class="container">
		<div class="row">
		
			<div class="five columns">
				
			<!-- Begin @Core header description hook -->
				<?php synapse_header_site_description(); ?> 
			<!-- End @Core header description hook -->
			
				
			</div>	
			
			<div class="seven columns">
			
			<!-- Begin @Core header social icon hook -->
				<?php synapse_header_social_icons(); ?> 
			<!-- End @Core header contact social icon hook -->	
						
			</div>	
		</div><!--end row-->
	</div>	

<?php
}

/**
* Header content standard
*
* @since 3.0
*/
function ifeature_header_standard_content() {
?>
	<div class="container">
		<div class="row">
		
			<div class="seven columns">
				
				<!-- Begin @Core header sitename hook -->
					<?php synapse_header_sitename(); ?> 
				<!-- End @Core header sitename hook -->
			
				
			</div>	
			
			<div id ="register" class="five columns">
				
			<!-- Begin @Core header social icon hook -->
				<?php synapse_header_social_icons(); ?> 
			<!-- End @Core header contact social icon hook -->	
				
			</div>	
		</div><!--end row-->
	</div>

<?php
}

?>