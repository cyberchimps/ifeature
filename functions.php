<?php

/*
	Functions
	
	Establishes the core iFeature functions.
	
	Copyright (C) 2011 CyberChimps
*/

$options = get_option('ifeature');

/* Begin custom excerpt functions. */	

/* Localization */
	    
	load_theme_textdomain( 'ifeature', TEMPLATEPATH . '/languages' );

	    $locale = get_locale();
	    $locale_file = TEMPLATEPATH . "/languages/$locale.php";
	    if ( is_readable( $locale_file ) )
		    require_once( $locale_file );

/* Begin breadcrumb function. */	

function ifeature_breadcrumbs() {
 
  $delimiter = '&raquo;';
  $home = 'Home'; // text for the 'Home' link
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div id="crumbs">';
 
    global $post;
    $homeLink = home_url();
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . 'Archive for category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __( 'Page', 'ifeature') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} // end ifeature_breadcrumbs()


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

// Load jQuery
 	
if ( !is_admin() ) {
    wp_enqueue_script('jquery');
}

// + 1 Button 

function ifeature_plusone(){
	
	$path =  get_template_directory_uri() ."/library/js/";

	$script = "
		
		<script type=\"text/javascript\" src=\"".$path."plusone.js\"></script>
		";
	
	echo $script;
}
add_action('wp_head', 'ifeature_plusone');

	

// Nivo Slider 

function ifeature_add_nivoslider(){
	 
	$path =  get_template_directory_uri() ."/library/ns/";

	$script = "
		
		<script type=\"text/javascript\" src=\"".$path."jquery.nivo.slider.js\"></script>
		";
	
	echo $script;
}
add_action('wp_head', 'ifeature_add_nivoslider');


// Call Superfish
if ( !is_admin() ) 
{
	function ifeature_superfish()
 	{  
   
    	// Adjust the below path to where scripts dir is, if you must.
    	$scriptdir = get_template_directory_uri() ."/library/sf/";
 
    	// Register the Superfish javascript file
    	wp_register_script( 'superfish', $scriptdir.'sf.js', false, '1.4.8');
    	wp_register_script( 'sf-menu', $scriptdir.'sf-menu.js');
   
   		 //load the scripts.
    	wp_enqueue_script('superfish');
    	wp_enqueue_script('sf-menu');
    	
  	}
add_action('wp_enqueue_scripts', 'ifeature_superfish');
}
	
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

function ifeature_widgets_init() {    
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
		'id'   => 'footer-widgets',
		'description'   => 'These are widgets for the footer.',
		'before_widget' => '<div class="footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-widget-title">',
		'after_title' => '</h3>',
	));
}
add_action( 'widgets_init', 'ifeature_widgets_init' );
	
if ( ! isset( $content_width ) ) $content_width = 640;

//Add link to theme settings in Admin bar

function ifeature_admin_link() {

	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array( 'id' => 'iFeature', 'title' => 'iFeature Settings', 'href' => admin_url('themes.php?page=theme_options')  ) ); 
  
}
add_action( 'admin_bar_menu', 'ifeature_admin_link', 113 );
	
//iFeature theme options file
	
require_once ( get_template_directory() . '/library/options/options.php' );
require_once ( get_template_directory() . '/library/options/options-themes.php' );
require_once ( get_template_directory() . '/library/options/meta-box.php' );
?>