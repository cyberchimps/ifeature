<?php

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
		->info("<h1>iFeature 3</h1>
		<h2>A Different Kind of WordPress Theme</h2>
<strong>Intuitive New Theme Options. New Design. Post Formats.</strong>

<p>iFeature 3 is one of the most advanced personal content management WordPress Themes in the world and now offers intuitive theme options which make using iFeature even more personal and fun than ever before.</p>

<p>To get started simply work your way through the menus to the left, select your options, add your content, and always remember to hit save after making any changes.</p>

<p>If you want even more amazing new features <a href='http://cyberchimps.com/ifeaturepro/' target='_blank'>upgrade to iFeature Pro 3</a> which includes Drag & Drop Page Elements, the iFeature Pro Slider with full-width custom slides, 8 beautiful preselected color schemes, more custom color pickers, amazing new background images, a featured posts section, callout section, more widgetized boxes, expanded typography including TypeKit support, and many more powerful new features please visit <a href='http://cyberchimps.com/ifeaturepro/' target='_blank'>CyberChimps.com</a> to learn more!</p>

<div id='upgrade2'><strong><a href='http://cyberchimps.com/ifeaturepro/' target='_blank' class='upgrade'>Upgrade to iFeature Pro 3</a></strong></div>

<p>We tried to make iFeature 3 as easy to use as possible, but if you still need help please read the <a href='http://cyberchimps.com/ifeature-free/docs/' target='_blank'>documentation</a>, and visit our <a href='http://cyberchimps.com/forum/' target='_blank'>support forum</a>.</p>

<p>Thank you for using iFeature 3, a <a href='http://cyberchimps.com' target='_blank'>CyberChimps WordPress Theme</a>.</p>")
		->section("Design")
		->open_outersection()
			->select($themeslug."_color_scheme", "Select a Color Scheme", array( 'options' => array("grey" => "Grey (default)", "green" => "Green"), 'default' => 'grey'))
		->close_outersection()
		->subsection("Typopgraphy")
			->select($themeslug."_font", "Choose a Font", array( 'options' => array("Arial" => "Arial (default)", "Courier New" => "Courier New", "Georgia" => "Georgia", "Helvetica" => "Helvetica", "Lucida Grande" => "Lucida Grande", "Tahoma" => "Tahoma", "Times New Roman" => "Times New Roman", "Verdana" => "Verdana", "Maven+Pro" => "Maven Pro", "Ubuntu" => "Ubuntu")))
		->subsection_end()
		->subsection("Background")
			->images($themeslug."_background_image", "Select a background", array( 'options' => array(  'dark' => TEMPLATE_URL . '/images/backgrounds/thumbs/dark.png', 'wood' => TEMPLATE_URL . '/images/backgrounds/thumbs/wood.png', 'default' => TEMPLATE_URL . '/images/backgrounds/thumbs/noise.png'), 'default' => 'default'))
			->checkbox($themeslug."_custom_background", "Toggle to use a custom background")
			->upload($themeslug."_background_upload", "Background Image")
			->radio($themeslug."_bg_image_position", "Select the Image Position", array( 'options' => array("top left" => "Left", "top center" => "Center", "top right" => "Right")))
			->radio($themeslug."_bg_image_repeat", "Select the Image Repeat", array( 'options' => array("repeat" => "Tile", "repeat-x" => "Tile Horizontally", "repeat-y" => "Tile Vertically", "no-repeat" => "No Tile")))
			->radio($themeslug."_bg_image_attachment", "Select the Image Attachment", array( 'options' => array("scroll" => "Scroll", "fixed" => "Fixed")))
			->color($themeslug."_background_color", "Select a Background Color")
		->subsection_end()
		->subsection("Custom Colors")
			->color($themeslug."_sitetitle_color", "Site Title Color")
			->color($themeslug."_tagline_color", "Site Description Color")
		->subsection_end()
	->section("Header")
		->subsection("Header Options")
			->upload($themeslug."_logo", "Custom Logo")
			->checkbox($themeslug."_enable_header_contact", "Header Contact Area")
			->textarea($themeslug."_header_contact", "Enter Your Information")
			->checkbox($themeslug."_show_description", "Show Site Description")
			->text($themeslug."_icon_margin", "Social Icon Margin Top", array('default' => '10px'))
			->upload($themeslug."_favicon", "Custom Favicon")
			->checkbox($themeslug."_disable_breadcrumbs", "Breadcrumbs" , array('default' => true))
		->subsection_end()
		->subsection("iMenu Options")
			->select($themeslug."_menu_font", "Choose a Menu Font", array( 'options' => array("Arial" => "Arial (default)", "Courier New" => "Courier New", "Georgia" => "Georgia", "Helvetica" => "Helvetica", "Lucida Grande" => "Lucida Grande", "Tahoma" => "Tahoma", "Times New Roman" => "Times New Roman", "Verdana" => "Verdana", "Maven+Pro" => "Maven Pro", "Ubuntu" => "Ubuntu")))
			->checkbox($themeslug."_hide_home_icon", "Home Icon", array('default' => true))
			->checkbox($themeslug."_hide_search", "Searchbar", array('default' => true))
		
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
		->subsection("Blog Options")
			->checkbox($themeslug."_post_formats", "Post Format Icons",  array('default' => true))
			->checkbox($themeslug."_show_excerpts", "Post Excerpts")
			->text($themeslug."_excerpt_link_text", "Excerpt Link Text", array('default' => '(More)…'))
			->text($themeslug."_excerpt_length", "Excerpt Character Length", array('default' => '55'))
			->checkbox($themeslug."_show_featured_images", "Enable Featured Images")
			->select($themeslug."_featured_image_align", "Featured Image Alignment", array( 'options' => array("key1" => "Left", "key2" => "Center", "key3" => "Right")))
			->text($themeslug."_featured_image_height", "Featured Image Height", array('default' => '100'))
			->text($themeslug."_featured_image_width", "Featured Image Width", array('default' => '100'))
			->multicheck($themeslug."_hide_byline", "Post Byline Elements", array( 'options' => array($themeslug."_hide_author" => "Author" , $themeslug."_hide_categories" => "Categories", $themeslug."_hide_date" => "Date", $themeslug."_hide_comments" => "Comments", $themeslug."_hide_share" => "Share", $themeslug."_hide_tags" => "Tags"), 'default' => array( $themeslug."_hide_tags" => true, $themeslug."_hide_share" => true, $themeslug."_hide_author" => true, $themeslug."_hide_date" => true, $themeslug."_hide_comments" => true, $themeslug."_hide_categories" => true ) ) )
			->checkbox($themeslug."_show_fb_like", "Show Facebook Like Button")
			->checkbox($themeslug."_show_gplus", "Show Google Plus One Button")
			->checkbox($themeslug."_post_pagination", "Post Pagination Links",  array('default' => true))
		->subsection_end()->subsection("Blog Slider")
			->checkbox($themeslug."_hide_slider_blog", "Index iFeature Slider" , array('default' => true))
			->select($themeslug.'_slider_category', 'Select the post category', array( 'options' => $blogoptions ))
			->text($themeslug."_slider_posts_number", "Number of Featured Blog Posts")
			->text($themeslug."_slider_delay", "Slider Delay")
			->checkbox($themeslug."hide_slider_navigation", "Slider Navigation" , array('default' => true))
		->subsection_end()->subsection("SEO")
			->textarea($themeslug."_home_description", "Home Description")
			->textarea($themeslug."_home_keywords", "Home Keywords")
			->text($themeslug."_home_title", "Optional Home Title")
		->subsection_end()
	
	->section("Footer")
		->open_outersection()
			->text($themeslug."_footer_text", "Footer Copyright Text")
		->close_outersection()
	
;
}
