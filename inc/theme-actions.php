<?php
/**
* Custom actions used by the iFeature Pro WordPress Theme
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
* @package iFeature
* @since 3.0
*/

/**
* iFeature Actions
*/
add_action( 'ifeature_post_bar', 'ifeature_post_bar_content' );
add_action( 'ifeature_fb_like_plus_one', 'ifeature_fb_like_plus_one_content' );
add_action( 'ifeature_header_contact_area', 'ifeature_header_contact_area_content' );

remove_action( 'chimps_head_tag', 'chimps_link_rel' );
add_action( 'chimps_head_tag', 'ifeature_link_rel' );

remove_action( 'chimps_navigation', 'chimps_nav' );
add_action( 'chimps_navigation', 'ifeature_nav' );

remove_action( 'chimps_archive', 'chimps_archive_loop' );
add_action( 'chimps_archive', 'ifeature_archive_loop' );

/**
* iFeatre archive page loop. 
*
* @since 1.0
*/
function ifeature_archive_loop() { 
?>
	<div class="post_container">
			
		<div <?php post_class() ?>>
				
			<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				
				<!--Begin @Core post tags hook-->
					<?php chimps_post_byline(); ?>
				<!--Begin @Core post tags hook-->
						
					<div class="entry">
						<?php the_excerpt(); ?>
					</div>
				
				<!--Begin @Core post tags hook-->
					<?php chimps_post_tags(); ?>
				<!--End @Core post tags hook-->	
				
				<!--Begin @iFeature post bar hook-->
					<?php ifeature_post_bar(); ?>
				<!--End @iFeature post bar hook-->					
							
		</div><!--end post-->
				
	</div><!--end post_container-->
			
<?php }

/**
* iFeature Navigation
*
* @since 1.0
*/
function ifeature_nav() {
	global $options, $themeslug; //call globals 
	
	if ($options->get($themeslug.'_hide_home_icon') == "0" && $options->get($themeslug.'_hide_search') == "0" OR $options->get($themeslug.'_hide_home_icon') == "1" && $options->get($themeslug.'_hide_search') == "0" ) {
		$grid = 'grid_12';
	}
	
	else {
		$grid = 'grid_9';
	}
	
	?>
	
	<div class="container_12">

	<div class="grid_12" id="imenu">

		<div id="nav" class="<?php echo $grid; ?>">
			<?php if ($options->get($themeslug.'_hide_home_icon') != "0"):?><div id="home"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() ;?>/images/home.png" alt="home" /></a></div><?php endif;?>
		    <?php wp_nav_menu( array(
		    'theme_location' => 'header-menu', // Setting up the location for the main-menu, Main Navigation.
		    'fallback_cb' => 'menu_fallback', //if wp_nav_menu is unavailable, WordPress displays wp_page_menu function, which displays the pages of your blog.
		    )
		);
    	?>
   		</div>
   		<?php if ($options->get($themeslug.'_hide_search') != "0"):?>
		<div class="grid_2">
			<?php get_search_form(); ?>
		</div>
		<?php endif;?>
	</div>
	
</div>
 <?php
}

/**
* Sets up the header contact area
*
* @since 1.0
*/
function ifeature_header_contact_area_content() { 
	global $themeslug, $options; 
	$contactdefault = apply_filters( 'chimps_header_contact_default_text', 'Enter Contact Information Here' ); 
	
	if ($options->get($themeslug.'_header_contact') == '' ) {
		echo "<div id='header_contact'>";
			printf( __( $contactdefault, 'core' )); 
		echo "</div>";
	}
	if ($options->get($themeslug.'_header_contact') != 'hide' ) {
		echo "<div id='header_contact1'>";
		echo stripslashes ($options->get($themeslug.'_header_contact')); 
		echo "</div>";
	}	
	if ($options->get($themeslug.'_header_contact') == 'hide' ) {
		echo "<div style ='height: 10%;'>&nbsp;</div> ";
	}
}

/**
* Sets the header link rel attributes
*
* @since 3.0.2
*/
function ifeature_link_rel() {
	global $themeslug, $options; //Call global variables
	$favicon = $options->get($themeslug.'_favicon'); //Calls the favicon URL from the theme options 
	
	if ($options->get($themeslug.'_font') == "" AND $options->get($themeslug.'_custom_font') == "") {
		$font = apply_filters( 'chimps_default_font', 'Arial' );
	}		
	elseif ($options->get($themeslug.'_custom_font') != "" && $options->get($themeslug.'_font') == 'custom') {
		$font = $options->get($themeslug.'_custom_font');	
	}	
	else {
		$font = $options->get($themeslug.'_font'); 
	} 
	if ($options->get($themeslug.'_color_scheme') == '') {
		$color = 'blue';
	}
	else {
		$color = $options->get($themeslug.'_color_scheme');
	}?>
	
<link rel="shortcut icon" href="<?php echo stripslashes($favicon['url']); ?>" type="image/x-icon" />
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/core/css/960/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/core/css/960/text.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/core/css/grid.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/shortcode.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/style.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/color/<?php echo $color; ?>.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/elements.css" type="text/css" />

<?php if (is_child_theme()) :  //add support for child themes?>
	<link rel="stylesheet" href="<?php echo bloginfo('stylesheet_directory') ; ?>/style.css" type="text/css" />
<?php endif; ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link href='http://fonts.googleapis.com/css?family=<?php echo $font ; ?>' rel='stylesheet' type='text/css' /> <?php
}

/**
* Sets up the Facebook Like and Google Plus One area
*
* @since 3.1
*/
function ifeature_fb_like_plus_one_content() {
	global $options, $themeslug; ?>

	<?php if ($options->get($themeslug.'_show_gplus') == "1"):?>
		<div class="gplusone">	
			<g:plusone size="standard" count="true"></g:plusone>
		</div>
	<?php endif;?>
						
	<?php if ($options->get($themeslug.'_show_fb_like') == "1"):?>			
		<div id="fb">
			<iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink() ?>&layout=standard&show_faces=true&width=450&action=like&colorscheme=light" scrolling="no" frameborder="0"  allowTransparency="true" style="border:none; overflow:hidden; width:330px; height:28px"></iframe>
		</div>
	<?php endif;
}


/**
* Sets up the HTML for the post share section
*
* @since 3.1
*/
function ifeature_post_bar_content() { 
	global $options, $themeslug; 
	$hidden = $options->get($themeslug.'_hide_byline'); ?>
	
	
		<div class="postbar" class="grid_8">
		<?php if (($hidden[$themeslug.'_hide_share']) != '0'):?>
			<div class="share">
		<a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/share/facebook.png" alt="Share on Facebook" height="16px" width="16px" /></a> 
		<a href="http://twitter.com/home?status=<?php the_permalink() ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/share/twitter.png" alt="Share on Twitter" height="16px" width="16px" /></a> 
		<a href="http://reddit.com/submit?url=<?php the_permalink() ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/share/reddit.png" alt="Share on Reddit" height="16px" width="16px" /></a> <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/share/linkedin.png" alt="Share on LinkedIn" height="16px" width="16px" /></a>	
		</div><!--end share-->
	<?php endif;?>		
		<?php if (($hidden[$themeslug.'_hide_comments']) != '0'):?>
		<div class="comments">
			<img src="<?php echo get_template_directory_uri(); ?>/images/Commentsgrey.png" height="21px" width="21px" alt="comments"/>&nbsp;
				<?php comments_popup_link( __('No Comments &#187;', 'core' ), __('1 Comment &#187;', 'core' ), __('% Comments &#187;' , 'core' )); //need a filer here ?>
		</div><!--end comments-->
		<?php endif;?>	
	</div><!--end postmetadata--> <?php
}



/**
* Header content standard
*
* @since 3.0
*/
function ifeature_header_standard_content() {
?>
	<div class="container_12">
		
			<div class="grid_6">
				
				<!-- Begin @Core header sitename hook -->
					<?php chimps_header_sitename(); ?> 
				<!-- End @Core header sitename hook -->
			
				
			</div>	
			
			<div class="grid_6">
			
			
				<!-- Begin @Core header social icon hook -->
					<?php chimps_header_social_icons(); ?> 
				<!-- End @Core header contact social icon hook -->
				
			</div>	
		
	</div><!--end container 12-->
		
	<div class='clear'>&nbsp;</div>

<?php
}

/**
* Header content extra
*
* @since 3.0
*/
function ifeature_header_extra_content() {
global $options, $themeslug;?>
	
	<div class="container_12">
		
		<div class="grid_6">
				
			<!-- Begin @Core header sitename hook -->
				<?php chimps_header_sitename(); ?> 
			<!-- End @Core header sitename hook -->
				
		</div>	
			
				<div id="header_contact" class="grid_6">
				&nbsp;
			<?php if ($options->get($themeslug.'_enable_header_contact') == '1'	): ?>

		<!-- Begin @Core header contact area hook -->
			<?php ifeature_header_contact_area(); ?>
		<!-- End @Core header contact area hook -->
					<?php endif ; ?>
		</div>	
		
	</div>
		
	<div class='clear'>&nbsp;</div>
		
	<div class="container_12" id="head2">
				
		<div class="grid_6">
		&nbsp;
			<?php if ($options->get($themeslug.'_show_description') == '1'	): ?>
			<!-- Begin @Core header description hook -->
				<?php chimps_header_site_description(); ?> 
			<!-- End @Core header description hook -->
			<?php endif; ?>
		</div>
			
		<div class="grid_6">
			
			<!-- Begin @Core header social icon hook -->
				<?php chimps_header_social_icons(); ?> 
			<!-- End @Core header contact social icon hook -->	
				
		</div>
			
	</div>
		
	<div class='clear'>&nbsp;</div>

<?php
}

/**
* Define header contact based on theme options
*
* @since 3.0
*/
function ifeature_header_content_init() {
	global $options, $themeslug;
	
	if ($options->get($themeslug.'_enable_header_contact') != '1' && $options->get($themeslug.'_show_description') != '1') {
	
			add_action( 'ifeature_header_content', 'ifeature_header_standard_content');
	}
	
	if ($options->get($themeslug.'_enable_header_contact') == '1' OR $options->get($themeslug.'_show_description') == '1') {
	
			add_action( 'ifeature_header_content', 'ifeature_header_extra_content');
	}
}