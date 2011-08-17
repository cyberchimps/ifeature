<?php

/*
	Functions
	
	Establishes the core iFeature functions.
	
	Copyright (C) 2011 CyberChimps
*/

$options = get_option('ifeature');

/* Begin custom excerpt functions. */	

function ifeature_new_excerpt_more($more) {

	global $options;
    
    	if ($options['if_excerpt_link_text'] == '') {
    		$linktext = '(Read More...)';
   		}
    
    	else {
    		$linktext = $options['if_excerpt_link_text'];
   		}
    
    global $post;
	return '<a href="'. get_permalink($post->ID) . '"> <br /><br /> '.$linktext.'</a>';
}
add_filter('excerpt_more', 'ifeature_new_excerpt_more');

function ifeature_new_excerpt_length($length) {

	global $options;
	
		if ($options['if_excerpt_length'] == '') {
    		$length = '55';
    	}
    
    	else {
    		$length = $options['if_excerpt_length'];
    	}

	return $length;
}
add_filter('excerpt_length', 'ifeature_new_excerpt_length');

/* End excerpt functions. */

/* Add auto-feed links support. */	
	add_theme_support('automatic-feed-links');
	
/* Add post-thumb support. */

	global $options;
	
	if($options['if_featured_image_height'] == "") {
			$featureheight = '100';
	}		
	
	else {
		$featureheight = $options['if_featured_image_height']; 
		
	}
	
		if ($options['if_featured_image_width'] == "") {
			$featurewidth = '100';
	}		
	
	else {
		$featurewidth = $options['if_featured_image_width']; 
	}
	add_theme_support( 'post-thumbnails' ); 
	set_post_thumbnail_size( $featureheight, $featurewidth, true );

// This theme allows users to set a custom background
add_custom_background();
	
// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();


/**
* Attach CSS3PIE behavior to elements
* Add elements here that need PIE applied
*/   
function ifeature_render_ie_pie() { ?>
<style type="text/css" media="screen">
#header li a, .postmetadata, .post_container, .wp-caption, .sidebar-widget-style, .sidebar-widget-title {
  behavior: url('<?php echo get_template_directory_uri(); ?>/library/pie/PIE.htc');
}
</style>
<?php
}

add_action('wp_head', 'ifeature_render_ie_pie', 8);

// + 1 Button 

function ifeature_plusone(){
	
	$path =  get_template_directory_uri() ."/library/js/";

	$script = "
		
		<script type=\"text/javascript\" src=\"".$path."/plusone.js\"></script>
		";
	
	echo $script;
}
add_action('wp_head', 'ifeature_plusone');

	
// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"), false);
	   wp_enqueue_script('jquery');
	}

// Nivo Slider 

function ifeature_add_nivoslider(){
	 
	$path =  get_template_directory_uri() ."/library/ns/";

	$script = "
		
		<script type=\"text/javascript\" src=\"".$path."/jquery.nivo.slider.js\"></script>
		";
	
	echo $script;
}
add_action('wp_head', 'ifeature_add_nivoslider');


	// Register superfish scripts
	
function ifeature_add_scripts() {
 
    if (!is_admin()) { // Add the scripts, but not to the wp-admin section.
    // Adjust the below path to where scripts dir is, if you must.
    $scriptdir = get_template_directory_uri() ."/library/sf/";
 
    // Register the Superfish javascript files
    wp_register_script( 'superfish', $scriptdir.'sf.js', false, '1.4.8');
    wp_register_script( 'sf-menu', $scriptdir.'sf-menu.js');
    // Now the superfish CSS
   
    //load the scripts and style.
	wp_enqueue_style('superfish-css');
    wp_enqueue_script('superfish');
    wp_enqueue_script('sf-menu');
    } // end the !is_admin function
} //end add_our_scripts function
 
//Add our function to the wp_head. You can also use wp_print_scripts.
add_action( 'wp_head', 'ifeature_add_scripts',0);
	
	// Register menu names
	
	function ifeature_register_menus() {
	register_nav_menus(
	array( 'header-menu' =>  'Header Menu' , 'footer-menu' =>  'Footer Menu' )
  );
}
	add_action( 'init', 'ifeature_register_menus' );
	
	// Menu fallback
	
	function ifeature_menu_fallback() {
	global $post; ?>
	
	<ul id="menu-nav" class="sf-menu">
	<?php wp_list_pages( 'title_li=&sort_column=menu_order&depth=3'); ?>
	</ul><?php
}

	//Register Widgetized Sidebar and Footer
    
    
    register_sidebar(array(
    	'name' => 'Sidebar Widgets',
    	'id'   => 'sidebar-widgets',
    	'description'   => 'These are widgets for the sidebar.',
    	'before_widget' => '<div id="%1$s" class="sidebar-widget-style">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="sidebar-widget-title">',
    	'after_title'   => '</h2>'
    ));
	
	register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<div class="footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-widget-title">',
		'after_title' => '</h3>',
	));
	
if ( ! isset( $content_width ) ) $content_width = 640;
  
	//iFeature theme options file
	
require_once ( get_template_directory() . '/library/options/options.php' );
require_once ( get_template_directory() . '/library/options/options-themes.php' );
require_once ( get_template_directory() . '/library/options/meta-box.php' );
?>