<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Initializes the iFeature Theme Options
*
* Author: Tyler Cunningham
* Copyright: &#169; 2011
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

require( get_template_directory() . '/core/classy-options/classy-options-framework/classy-options-framework.php');

add_action('init', 'chimps_init_options');

function chimps_init_options() {

global $options, $themeslug, $themename, $themenamefull;
$options = new ClassyOptions($themename, $themenamefull." Options");

$terms2 = get_terms('category', 'hide_empty=0');

	$blogoptions = array();
                                    
	$blogoptions['all'] = "All";

    	foreach($terms2 as $term) {

        	$blogoptions[$term->slug] = $term->name;

        }


$options
		->section("Welcome")
		->info("<h1>iFeature 4</h1>
		
<p><strong>A Responsive Drag & Drop Free WordPress Theme</strong></p>

<div id='upgrade2'><strong><a href='http://cyberchimps.com/ifeaturepro/' target='_blank' class='upgrade'>Upgrade to iFeature Pro 4</a></strong></div>

<p>If you want even more amazing new features <a href='http://cyberchimps.com/ifeaturepro/' target='_blank'>upgrade to iFeature Pro 4</a> which includes dozens of more feautres such as more Drag & Drop Header, Blog and Page Elements, the Responsive iFeature Pro Slider with full-width custom slides, 8 beautiful preselected color schemes, custom color pickers, amazing background images, a responsive featured posts section, callout section, more widgetized boxes, expanded typography including TypeKit support, and many more powerful new features. Please visit <a href='http://cyberchimps.com/ifeaturepro/' target='_blank'>CyberChimps.com</a> to learn more!</p>

<p>iFeature 4 includes a Responsive Apple-like design (which magically adjusts to mobile devices such as the iPhone and iPad), Responsive iFeature Slider, New Drag & Drop Header Elements, Page and Blog Elements, intuitive Theme Options, and is built with HTML5 and CSS3.</p>

<p>To get started simply work your way through the menus to the left, select your options, add your content, and always remember to hit save after making any changes.</p>

<p>We tried to make iFeature 4 as easy to use as possible, but if you still need help please read the <a href='http://cyberchimps.com/ifeature-free/docs/' target='_blank'>documentation</a>, and visit our <a href='http://cyberchimps.com/forum/' target='_blank'>support forum</a>.</p>

<p>Thank you for using iFeature 4.</p>

<h4>A Different Kind of WordPress Theme</h4>

<p><a href='http://cyberchimps.com' target='_blank'>A CyberChimps WordPress Theme</a></p>")
		->section("Design")
		->open_outersection()
			->checkbox($themeslug."_responsive_design", "Responsive Design", array('default' => true))
			->checkbox($themeslug."_responsive_video", "Responsive Videos")
			->select($themeslug."_color_scheme", "Select a Skin Color", array( 'options' => array("grey" => "Grey (default)", "green" => "Green"), 'default' => 'grey'))
		->close_outersection()
		->subsection("Typography")
			->select($themeslug."_font", "Choose a Font", array( 'options' => array("Arial" => "Arial (default)", "Courier New" => "Courier New", "Georgia" => "Georgia", "Helvetica" => "Helvetica", "Lucida Grande" => "Lucida Grande", "Tahoma" => "Tahoma", "Times New Roman" => "Times New Roman", "Verdana" => "Verdana", "Maven+Pro" => "Maven Pro", "Ubuntu" => "Ubuntu")))
		->subsection_end()
		->subsection("Background")
			->images($themeslug."_background_image", "Select a background", array( 'options' => array(  'dark' => TEMPLATE_URL . '/images/backgrounds/thumbs/dark.png', 'wood' => TEMPLATE_URL . '/images/backgrounds/thumbs/wood.png', 'default' => TEMPLATE_URL . '/images/backgrounds/thumbs/noise.png'), 'default' => 'default'))
			->checkbox($themeslug."_custom_background", "Toggle to use a custom background")
			->color($themeslug."_background_color", "Custom Background Color")
			->upload($themeslug."_background_upload", "Background Image")
			->radio($themeslug."_bg_image_position", "Image Position", array( 'options' => array("top left" => "Left", "top center" => "Center", "top right" => "Right")))
			->radio($themeslug."_bg_image_repeat", "Image Repeat", array( 'options' => array("repeat" => "Tile", "repeat-x" => "Tile Horizontally", "repeat-y" => "Tile Vertically", "no-repeat" => "No Tile")))
			->radio($themeslug."_bg_image_attachment", "Image Attachment", array( 'options' => array("scroll" => "Scroll", "fixed" => "Fixed")))
		->subsection_end()
		->subsection("Custom Colors")
			->color($themeslug."_sitetitle_color", "Site Title Color")
			->color($themeslug."_tagline_color", "Site Description Color")
			->color($themeslug."_link_color", "Link Color")
		->subsection_end()
	->section("Header")
		->open_outersection()
			->section_order("header_section_order", "Drag & Drop Header Elements", array('options' => array("ifeature_header_content" => "Logo + Icons", "ifeature_sitename_contact" => "Logo + Contact", "ifeature_description_icons" => "Description + Icons", "ifeature_logo_Description" => "Logo + Description", "synapse_navigation" => "iMenu"), 'default' => 'ifeature_header_content,synapse_navigation'))
			->upload($themeslug."_banner", "Banner Image")
			->textarea($themeslug."_header_contact", "Contact Information")
		->close_outersection()
		->subsection("Header Options")
			->upload($themeslug."_logo", "Custom Logo")
			->checkbox($themeslug."_favicon_toggle", "Favicon" , array('default' => false))
			->upload($themeslug."_favicon", "Custom Favicon", array('default' => array('url' => TEMPLATE_URL . '/images/favicon.ico')))
			->checkbox($themeslug."_apple_touch_toggle", "Apple Touch Icon" , array('default' => false))
			->upload($themeslug."_apple_touch", "Apple Touch Icon", array('default' => array('url' => TEMPLATE_URL . '/images/apple-icon.png')))
		->subsection_end()
		->subsection("iMenu Options")
			->select($themeslug."_menu_font", "Choose a Menu Font", array( 'options' => array("Arial" => "Arial (default)", "Courier New" => "Courier New", "Georgia" => "Georgia", "Helvetica" => "Helvetica", "Lucida Grande" => "Lucida Grande", "Tahoma" => "Tahoma", "Times New Roman" => "Times New Roman", "Verdana" => "Verdana", "Maven+Pro" => "Maven Pro", "Ubuntu" => "Ubuntu")))
			->checkbox($themeslug."_hide_home_icon", "Home Icon", array('default' => true))
			->checkbox($themeslug."_hide_search", "Searchbar", array('default' => true))
			->checkbox($themeslug."_hide_mobile_search", "Mobile Searchbar", array('default' => true))
		
		->subsection_end()
		->subsection("Social")
			->images($themeslug."_icon_style", "Icon set", array( 'options' => array( 'legacy' => TEMPLATE_URL . '/images/social/thumbs/icons-classic.png', 'default' =>
TEMPLATE_URL . '/images/social/thumbs/icons-default.png' ), 'default' => 'default' ) )
			->text($themeslug."_twitter", "Twitter Icon URL", array('default' => 'http://twitter.com'))
			->checkbox($themeslug."_hide_twitter_icon", "Hide Twitter Icon", array('default' => true))
			->text($themeslug."_facebook", "Facebook Icon URL", array('default' => 'http://facebook.com'))
			->checkbox($themeslug."_hide_facebook_icon", "Hide Facebook Icon" , array('default' => true))
			->text($themeslug."_gplus", "Google + Icon URL", array('default' => 'http://plus.google.com'))
			->checkbox($themeslug."_hide_gplus_icon", "Hide Google + Icon" , array('default' => true))
			->text($themeslug."_flickr", "Flickr Icon URL", array('default' => 'http://flikr.com'))
			->checkbox($themeslug."_hide_flickr", "Hide Flickr Icon")
			->text($themeslug."_pinterest", "Pinterest Icon URL", array('default' => 'http://pinterest.com'))
			->checkbox($themeslug."_hide_pinterest", "Hide Pinterest Icon")
			->text($themeslug."_linkedin", "LinkedIn Icon URL", array('default' => 'http://linkedin.com'))
			->checkbox($themeslug."_hide_linkedin", "Hide LinkedIn Icon")
			->text($themeslug."_youtube", "YouTube Icon URL", array('default' => 'http://youtube.com'))
			->checkbox($themeslug."_hide_youtube", "Hide YouTube Icon")
			->text($themeslug."_googlemaps", "Google Maps Icon URL", array('default' => 'http://maps.google.com'))
			->checkbox($themeslug."_hide_googlemaps", "Hide Google maps Icon")
			->text($themeslug."_email", "Email Address")
			->checkbox($themeslug."_hide_email", "Hide Email Icon")
			->text($themeslug."_rsslink", "RSS Icon URL")
			->checkbox($themeslug."_hide_rss_icon", "Hide RSS Icon" , array('default' => true))
		->subsection_end()
		->subsection("Tracking")
			->textarea($themeslug."_ga_code", "Google Analytics Code")
		->subsection_end()
	->section("Blog")
		->open_outersection()
			->section_order($themeslug."_blog_section_order", "Drag & Drop Blog Elements", array('options' => array("synapse_index" => "Post Page", "synapse_blog_slider" => "iFeature Slider", "synapse_twitterbar_section" => "Twitter Bar", "synapse_product_element" => "Product"), "default" => 'synapse_blog_slider,synapse_index'))
		->close_outersection()
		->subsection("Blog Options")
			->checkbox($themeslug."_post_formats", "Post Format Icons",  array('default' => true))
			->checkbox($themeslug."_show_excerpts", "Post Excerpts")
			->text($themeslug."_excerpt_link_text", "Excerpt Link Text", array('default' => 'Read More&#8230;'))
			->text($themeslug."_excerpt_length", "Excerpt Character Length", array('default' => '55'))
			->checkbox($themeslug."_show_featured_images", "Enable Featured Images")
			->select($themeslug."_featured_image_align", "Featured Image Alignment", array( 'options' => array("key1" => "Left", "key2" => "Center", "key3" => "Right", "key4" => "None")))
			->text($themeslug."_featured_image_height", "Featured Image Height", array('default' => '100'))
			->text($themeslug."_featured_image_width", "Featured Image Width", array('default' => '100'))
			->multicheck($themeslug."_hide_byline", "Post Byline Elements", array( 'options' => array($themeslug."_hide_author" => "Author" , $themeslug."_hide_categories" => "Categories", $themeslug."_hide_date" => "Date", $themeslug."_hide_comments" => "Comments", $themeslug."_hide_share" => "Share", $themeslug."_hide_tags" => "Tags"), 'default' => array( $themeslug."_hide_tags" => true, $themeslug."_hide_share" => true, $themeslug."_hide_author" => true, $themeslug."_hide_date" => true, $themeslug."_hide_comments" => true, $themeslug."_hide_categories" => true ) ) )
			->checkbox($themeslug."_show_fb_like", "Show Facebook Like Button")
			->checkbox($themeslug."_show_gplus", "Show Google Plus One Button")
		->subsection_end()
		->subsection("Blog Slider")
			->select($themeslug.'_slider_category', 'Post Category', array( 'options' => $blogoptions ))
			->text($themeslug."_slider_posts_number", "Number of Featured Blog Posts")
			->text($themeslug."_slider_delay", "Slider Delay")
			->checkbox($themeslug."hide_slider_navigation", "Slider Navigation" , array('default' => true))
		->subsection_end()
		->subsection("Twtterbar Options")
			->text($themeslug."_blog_twitter", "Enter your Twitter handle")
			->checkbox($themeslug."_blog_twitter_reply", "Show @ Replies")
		->subsection_end()
		->subsection("Product Options")
			->select($themeslug."_blog_product_text_align", "Product Layout", array( 'options' => array("key1" => "Text Left - Image Right", "key2" => "Text Right - Image Left")))
			->text($themeslug."_blog_product_title", "Product Title", array('default' =>'Product'))
			->textarea($themeslug."_blog_product_text", "Product Text", array('default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. '))
			->select($themeslug."_blog_product_type", "Media Type", array( 'options' => array("key1" => "Image", "key2" => "Video")))
			->upload($themeslug."_blog_product_image", "Product Image", array('default' => array('url' => TEMPLATE_URL . '/images/product.jpg')))
			->textarea($themeslug."_blog_product_video", "Video Embed")
			->checkbox($themeslug."_blog_product_link_toggle", "Product Link", array('default' => true))
			->text($themeslug."_blog_product_link_url", "Link", array('default' => home_url()))
			->text($themeslug."_blog_product_link_text", "Text", array('default' => 'Buy Now'))
		->subsection_end()
		->subsection("SEO")
			->textarea($themeslug."_home_description", "Home Description")
			->textarea($themeslug."_home_keywords", "Home Keywords")
			->text($themeslug."_home_title", "Optional Home Title")
		->subsection_end()
		->section("Templates")
		->subsection("Single Post")
			->checkbox($themeslug."_single_breadcrumbs", "Breadcrumbs", array('default' => true))
			->checkbox($themeslug."_single_show_featured_images", "Featured Images")
			->checkbox($themeslug."_single_post_formats", "Post Format Icons",  array('default' => true))
			->multicheck($themeslug."_single_hide_byline", "Post Byline Elements", array( 'options' => array($themeslug."_hide_author" => "Author" , $themeslug."_hide_categories" => "Categories", $themeslug."_hide_date" => "Date", $themeslug."_hide_comments" => "Comments", $themeslug."_hide_share" => "Share", $themeslug."_hide_tags" => "Tags"), 'default' => array( $themeslug."_hide_tags" => true, $themeslug."_hide_share" => true, $themeslug."_hide_author" => true, $themeslug."_hide_date" => true, $themeslug."_hide_comments" => true, $themeslug."_hide_categories" => true ) ) )
			->checkbox($themeslug."_single_show_fb_like", "Facebook Like Button")
			->checkbox($themeslug."_single_show_gplus", "Google Plus One Button")
			->checkbox($themeslug."_post_pagination", "Post Pagination Links",  array('default' => true))
		->subsection_end()	
		->subsection("Archive")
			->checkbox($themeslug."_archive_breadcrumbs", "Breadcrumbs", array('default' => true))
			->checkbox($themeslug."_archive_show_excerpts", "Post Excerpts", array('default' => true))
			->checkbox($themeslug."_archive_show_featured_images", "Featured Images")
			->checkbox($themeslug."_archive_post_formats", "Post Format Icons",  array('default' => true))
			->multicheck($themeslug."_archive_hide_byline", "Post Byline Elements", array( 'options' => array($themeslug."_hide_author" => "Author" , $themeslug."_hide_categories" => "Categories", $themeslug."_hide_date" => "Date", $themeslug."_hide_comments" => "Comments", $themeslug."_hide_share" => "Share", $themeslug."_hide_tags" => "Tags"), 'default' => array( $themeslug."_hide_tags" => true, $themeslug."_hide_share" => true, $themeslug."_hide_author" => true, $themeslug."_hide_date" => true, $themeslug."_hide_comments" => true, $themeslug."_hide_categories" => true ) ) )
			->checkbox($themeslug."_archive_show_fb_like", "Facebook Like Button")
			->checkbox($themeslug."_archive_show_gplus", "Google Plus One Button")
			->subsection_end()
		->subsection("Search")
			->checkbox($themeslug."_search_show_excerpts", "Post Excerpts", array('default' => true))
		->subsection_end()
		->subsection("404")
			->textarea($themeslug."_custom_404", "Custom 404 Content")
		->subsection_end()
	->section("Footer")
		->open_outersection()
			->text($themeslug."_footer_text", "Footer Copyright Text")
		->close_outersection()
	
;
}