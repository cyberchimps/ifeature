<?php

/*
	Functions
	Author: Tyler Cunningham
	Establishes the core theme functions.
	Copyright (C) 2011 CyberChimps
	Version 3.0
*/


/* Define global variables. */	

	$themename = 'ifeature';
	$themenamefull = 'iFeature';
	$themeslug = 'if';
	$root = get_template_directory_uri(); 
	
	
//Redirect after activation
if ( is_admin() && isset($_GET['activated'] ) && $pagenow ==	"themes.php" )
	wp_redirect( 'themes.php?page=ifeature' );
	
//Gallery options 

function custom_gallery_post_format( $content ) {
global $options, $themeslug, $post;
$root = get_template_directory_uri(); 
ob_start();
?>
		<?php if ($options->get($themeslug.'_post_formats') == '1') : ?>
			<div class="postformats"><!--begin format icon-->
				<img src="<?php echo get_template_directory_uri(); ?>/images/formats/gallery.png" />
			</div><!--end format-icon-->
		<?php endif;?>
				<h2 class="posts_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					<!--Call @Core Meta hook-->
			<?php chimps_post_byline(); ?>
				<?php
				if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1' ) {
 		 			echo '<div class="featured-image">';
 		 			echo '<a href="' . get_permalink($post->ID) . '" >';
 		 				the_post_thumbnail();
  					echo '</a>';
  					echo '</div>';
				}
			?>	
				<div class="entry" <?php if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1' ) { echo 'style="min-height: 115px;" '; }?>>
		<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
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
				</div><!--end entry-->

				
				<div style=clear:both;></div>
	<?php	
	$content = ob_get_clean();
	
	return $content;
}

add_filter('chimps_post_formats_gallery_content', 'custom_gallery_post_format' ); 
	
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php echo get_avatar( $comment, 48 ); ?>

         <?php printf(__('<cite class="fn">%s</cite> <span class="says"></span>'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>

      <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>

      <?php comment_text() ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
<?php
}
	
/* Localization */
	    
	load_theme_textdomain( 'core', TEMPLATEPATH . '/languages' );

	    $locale = get_locale();
	    $locale_file = TEMPLATEPATH . "/languages/$locale.php";
	    if ( is_readable( $locale_file ) )
		    require_once( $locale_file );

/* End global variables. */	

/* Begin custom excerpt functions. */	

function new_excerpt_more($more) {

	global $themename, $themeslug, $options;
    
    	if ($options->get($themeslug.'_excerpt_link_text') == '') {
    		$linktext = '(Read More...)';
   		}
    
    	else {
    		$linktext = $options->get($themeslug.'_excerpt_link_text');
   		}
    
    global $post;
	return '<a href="'. get_permalink($post->ID) . '"> <br /><br /> '.$linktext.'</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function new_excerpt_length($length) {

	global $themename, $themeslug, $options;
	
		if ($options->get($themeslug.'_excerpt_length') == '') {
    		$length = '55';
    	}
    
    	else {
    		$length = $options->get($themeslug.'_excerpt_length');
    	}

	return $length;
}
add_filter('excerpt_length', 'new_excerpt_length');

/* End excerpt functions. */

/* Add auto-feed links support. */	
add_theme_support('automatic-feed-links');
	
/* Add post-thumb support. */

function init_featured_image() {	
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
	 
	set_post_thumbnail_size( $featureheight, $featurewidth, true );
}	
}
add_action( 'init', 'init_featured_image', 11);	

// Featured image support.
add_theme_support( 'post-thumbnails' );

// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();

/**
* Attach CSS3PIE behavior to elements
* Add elements here that need PIE applied
*/   
function render_ie_pie() { ?>
	
	<style type="text/css" media="screen">
		#header li a, .postmetadata, .post_container, #navbackground, .wp-caption, .sidebar-widget-style, .sidebar-widget-title, .boxes, .box1, .box2, .box3, .box-widget-title, #calloutwrap, .calloutbutton, #twitterbar 
  		
  			{
  				behavior: url('<?php bloginfo('stylesheet_directory'); ?>/library/pie/PIE.htc');
			}
	</style>
<?php
}

add_action('wp_head', 'render_ie_pie', 8);
	
// Nivo Slider 

function nivoslider(){
	 
	$path =  get_template_directory_uri() ."/core/library/ns";

	$script = "
		
		<script type=\"text/javascript\" src=\"".$path."/jquery.nivo.slider.js\"></script>
		";
	
	echo $script;
}
add_action('wp_head', 'nivoslider');

// + 1 Button 

function plusone(){
	
	$path =  get_template_directory_uri() ."/core/library/js";

	$script = "
		
		<script type=\"text/javascript\" src=\"".$path."/plusone.js\"></script>
		";
	
	echo $script;
}
add_action('wp_head', 'plusone');


// Register jQuery
	
// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"), false);
	   wp_enqueue_script('jquery');
	}
	
	// Register menu names
	
	function register_menus() {
	register_nav_menus(
	array( 'header-menu' => __( 'Header Menu' ), 'footer-menu' => __( 'Footer Menu' ))
  );
}
	add_action( 'init', 'register_menus' );
	
	// Menu fallback
	
	function menu_fallback() {
	global $post; ?>
	
	<ul id="menu-nav" class="sf-menu">
		<?php wp_list_pages( 'title_li=&sort_column=menu_order&depth=3'); ?>
	</ul><?php
}

function ifp_widgets_init() {
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
		'before_widget' => '<div class="footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-widget-title">',
		'after_title' => '</h3>',
	));
}
add_action ('widgets_init', 'ifp_widgets_init');

//Add link to theme settings in Admin bar

function admin_link() {

	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array( 'id' => 'iFeature', 'title' => 'iFeature Pro Options', 'href' => admin_url('themes.php?page=ifeature')  ) ); 
  
}
add_action( 'admin_bar_menu', 'admin_link', 113 );

//Set content width

if ( ! isset( $content_width ) ) $content_width = 608;

//hooks

require_once ( get_template_directory() . '/core/core-init.php' );

do_action('chimps_init');

// Call additional template files
require_once ( get_template_directory() . '/inc/classy-options-init.php' );
require_once ( get_template_directory() . '/inc/options-functions.php' );
require_once ( get_template_directory() . '/inc/meta-box.php' );	
require_once ( get_template_directory() . '/inc/update.php' ); // Include automatic updater
require_once ( get_template_directory() . '/inc/theme-hooks.php' ); // Include automatic updater
require_once ( get_template_directory() . '/inc/theme-actions.php' ); // Include automatic updater

?>