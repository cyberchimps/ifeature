<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/*
	Functions
	Author: Tyler Cunningham
	Establishes the core theme functions.
	Copyright (C) 2011 CyberChimps
	Version 3.0
*/

/**
* Define global theme functions.
*/ 
	$themename = 'ifeature';
	$themenamefull = 'iFeature';
	$themeslug = 'if';
	$root = get_template_directory_uri(); 
	$slider_default = "$root/images/ifeaturefree.jpg";
	$pagedocs = 'http://cyberchimps.com/question/using-the-ifeature-free-3-page-options/';
	$sliderdocs = 'http://cyberchimps.com/question/using-the-ifeature-3-slider/';

/**
* Content width.
*/ 
if ( ! isset( $content_width ) ) $content_width = 608; //Set content width

/**
* Basic theme setup.
*/ 
function if_theme_setup() {
	
/**
* Initialize Synapse Core Framework and Pro Extension.
*/ 
	require_once ( get_template_directory() . '/core/core-init.php' );

/**
* Call additional files required by theme.
*/ 
	require_once ( get_template_directory() . '/includes/classy-options-init.php' ); // Theme options markup.
	require_once ( get_template_directory() . '/includes/options-functions.php' ); // Custom functions based on theme options.
	require_once ( get_template_directory() . '/includes/meta-box.php' ); // Meta options markup.
	require_once ( get_template_directory() . '/includes/theme-hooks.php' ); // Theme specific hooks.
	require_once ( get_template_directory() . '/includes/theme-actions.php' ); // Actions for theme specific hooks.
	require_once ( get_template_directory() . '/includes/presstrends.php' ); // Opt-in PressTrends option.
	
	add_theme_support(
		'post-formats',
		array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
	);

	add_theme_support( 'post-thumbnails' );
	add_theme_support('automatic-feed-links');
	add_editor_style();
	
	ifeature_meta_update();
	
}
add_action( 'after_setup_theme', 'if_theme_setup' );

/**
* Redirect user to theme options page after activation.
*/ 
if ( is_admin() && isset($_GET['activated'] ) && $pagenow =="themes.php" ) {
	wp_redirect( 'themes.php?page=ifeature' );
}

/**
* Add link to theme options in Admin bar.
*/ 
function if_admin_link() {
	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array( 'id' => 'iFeature', 'title' => 'iFeature Options', 'href' => admin_url('themes.php?page=ifeature')  ) ); 
}
add_action( 'admin_bar_menu', 'if_admin_link', 113 );

/**
* Custom markup for gallery posts in main blog index.
*/ 
function if_custom_gallery_post_format( $content ) {
	global $options, $themeslug, $post;
	$root = get_template_directory_uri(); 
	
	ob_start();?>
	
		<?php if ($options->get($themeslug.'_post_formats') == '1') : ?>
			<div class="postformats"><!--begin format icon-->
				<img src="<?php echo get_template_directory_uri(); ?>/images/formats/gallery.png" />
			</div><!--end format-icon-->
		<?php endif;?>
				<h2 class="posts_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					<!--Call @Core Meta hook-->
			<?php synapse_post_byline(); ?>
				<?php
				if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1' && !is_single() ) {
 		 			echo '<div class="featured-image">';
 		 			echo '<a href="' . get_permalink($post->ID) . '" >';
 		 				the_post_thumbnail();
  					echo '</a>';
  					echo '</div>';
				}
			?>	
				<div class="entry" <?php if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1' ) { echo 'style="min-height: 115px;" '; }?>>
				
				<?php if (!is_single()): ?>
				<?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>

				<figure class="gallery-thumb">
					<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
					<br /><br />
					This gallery contains <?php echo $total_images ; ?> images
					<?php endif;?>
				</figure><!-- .gallery-thumb -->
				<?php endif;?>
				
				<?php if (is_single()): ?>
					<?php the_content(); ?>
				<?php endif;?>
				</div><!--end entry-->

				<div style=clear:both;></div>
	<?php	
	$content = ob_get_clean();
	
	return $content;
}
add_filter('synapse_post_formats_gallery_content', 'if_custom_gallery_post_format' ); 
	
/**
* Set custom post excerpt link text based on theme option.
*/ 
function if_new_excerpt_more($more) {

	global $themename, $themeslug, $options, $post;
    
    	if ($options->get($themeslug.'_excerpt_link_text') == '') {
    		$linktext = 'Read More...';
   		}
    	else {
    		$linktext = $options->get($themeslug.'_excerpt_link_text');
   		}

	return '</p><p><a href="'. get_permalink($post->ID) . '">'.$linktext.'</a></p>';
}
add_filter('excerpt_more', 'if_new_excerpt_more');

/**
* Set custom post excerpt length based on theme option.
*/ 
function if_new_excerpt_length($length) {

	global $themename, $themeslug, $options;
	
		if ($options->get($themeslug.'_excerpt_length') == '') {
    		$length = '55';
    	}
    	else {
    		$length = $options->get($themeslug.'_excerpt_length');
    	}
    	
	return $length;
}
add_filter('excerpt_length', 'if_new_excerpt_length');

/**
* Custom featured image size based on theme options.
*/ 
function if_init_featured_image() {	
	if ( function_exists( 'add_theme_support' ) ) {
	
	global $themename, $themeslug, $options;
	
	if ($options->get($themeslug.'_featured_image_height') == '') {
		$featureheight = '100';
	}		
	else {
		$featureheight = $options->get($themeslug.'_featured_image_height'); 
	}
	if ($options->get($themeslug.'_featured_image_width') == "") {
			$featurewidth = '100';
	}		
	else {
		$featurewidth = $options->get($themeslug.'_featured_image_width'); 
	} 
	set_post_thumbnail_size( $featurewidth, $featureheight, true );
	}	
}
add_action( 'init', 'if_init_featured_image', 11);	

/**
* Attach CSS3PIE behavior to elements
*/   
function if_render_ie_pie() { ?>
	
	<style type="text/css" media="screen">
		#wrapper input, textarea, #twitterbar, input[type=submit], input[type=reset], #imenu, .searchform, .post_container, .postformats, .postbar, .post-edit-link, .widget-container, .widget-title, .footer-widget-title, .comments_container, ol.commentlist li.even, ol.commentlist li.odd, .slider_nav, ul.metabox-tabs li, .tab-content, .list_item, .section-info, #of_container #header, .menu ul li a, .submit input, #of_container textarea, #of_container input, #of_container select, #of_container .screenshot img, #of_container .of_admin_bar, #of_container .subsection > h3, .subsection, #of_container #content .outersection .section
  		
  	{
  		behavior: url('<?php echo get_stylesheet_directory_uri(); ?>/core/library/pie/PIE.htc');
	}
	</style>
<?php
}

add_action('wp_head', 'if_render_ie_pie', 8);

/**
* Add Google Analytics based on theme option.
*/ 
function if_google_analytics() {
	global $themename, $themeslug, $options;
	
	echo stripslashes ($options->get($themeslug.'_ga_code'));

}
add_action('wp_head', 'if_google_analytics');
	
/**
* Register custom menus for header, footer.
*/ 
function if_register_menus() {
	register_nav_menus(
	array( 'header-menu' => __( 'Header Menu', 'core' ), 'footer-menu' => __( 'Footer Menu', 'core' ))
  );
}
add_action( 'init', 'if_register_menus' );
	
/**
* Menu fallback if custom menu not used.
*/ 
function menu_fallback() {
	global $post; ?>
	
	<ul id="nav_menu">
		<?php wp_list_pages( 'title_li=&sort_column=menu_order&depth=3'); ?>
	</ul><?php
}
/**
* Register widgets.
*/ 
function if_widgets_init() {
    register_sidebar(array(
    	'name' => 'Sidebar Widgets',
    	'id'   => 'sidebar-widgets',
    	'description'   => 'These are widgets for the sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
    ));
    	register_sidebar(array(
		'name' => 'Footer',
		'id' => 'footer-widgets',
		'description' => 'These are the footer widgets',
		'before_widget' => '<div class="three columns footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-widget-title">',
		'after_title' => '</h3>',
	));
}
add_action ('widgets_init', 'if_widgets_init');

function ifeature_meta_update() {
	global $theme_version;
	
	// Get last used theme version
	$prev_theme_version = (get_option('if_theme_version')) ? get_option('if_theme_version') : 0;
	
	if ( $prev_theme_version < '4.5.3') {

		// Update post meta_key values
		$prev_post_meta_keys = array(
			'slider_image' => 'if_slider_image',
			'slider_text' => 'if_slider_text',
		);
		
		foreach ($prev_post_meta_keys as $prev_key => $updated_key) {
			ifeature_update_meta_key('post', $updated_key, $prev_key);
		}
		
		// Update page meta_key values
		$prev_page_meta_keys = array(
			'page_sidebar' => 'if_page_sidebar',
			'hide_page_title' => 'if_hide_page_title',
			'page_section_order' => 'if_page_section_order',
			'twitter_handle' => 'if_twitter_handle',
			'twitter_reply' => 'if_twitter_reply',
			'product_text_align' => 'if_product_text_align',
			'product_title' => 'if_product_title',
			'product_text' => 'if_product_text',
			'product_type' => 'if_product_type',
			'product_image' => 'if_product_image',
			'product_video' => 'if_product_video',
			'product_link_toggle' => 'if_product_link_toggle',
			'product_link_url' => 'if_product_link_url',
			'product_link_text' => 'if_product_link_text',
			'seo_title' => 'if_seo_title',
			'seo_description' => 'sif_eo_description',
			'seo_keywords' => 'if_seo_keywords'
		);
		
		foreach ($prev_page_meta_keys as $prev_key => $updated_key) {
			ifeature_update_meta_key('post', $updated_key, $prev_key);
		}
	}
	
	if ( $prev_theme_version < $theme_version) {
		// Set new theme version
		update_option('if_theme_version', $theme_version);
	}
}

function ifeature_update_meta_key($meta_type, $meta_key, $prev_meta_key) {
	if ( !$meta_type || !$meta_key || !$prev_meta_key)
		return false;

	if ( ! $table = _get_meta_table($meta_type) )
		return false;

	global $wpdb;

	$column = esc_sql($meta_type . '_id');

	$prev_meta_key = stripslashes($prev_meta_key);
	$meta_key = stripslashes($meta_key);
	
	$wpdb->update( $table, array( 'meta_key' => $meta_key), array( 'meta_key' => $prev_meta_key ) );
}

/**
* End
*/
?>