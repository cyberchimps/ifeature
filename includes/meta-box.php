<?php
/**
 * Create meta box for editing pages in WordPress
 *
 * Compatible with custom post types since WordPress 3.0
 * Support input types: text, textarea, checkbox, checkbox list, radio box, select, wysiwyg, file, image, date, time, color
 *
 * @author: Rilwis
 * @url: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 * @usage: please read document at project homepage and meta-box-usage.php file
 * @version: 3.0.1
 */
 

/********************* BEGIN DEFINITION OF META BOXES ***********************/

add_action('init', 'initialize_the_meta_boxes');

function initialize_the_meta_boxes() {

	global  $themename, $themeslug, $themenamefull, $options; // call globals.
	
	// Call taxonomies for select options
	
	$carouselterms = get_terms('carousel_categories', 'hide_empty=0');
	$carouseloptions = array();

		foreach($carouselterms as $term) {
			$carouseloptions[$term->slug] = $term->name;
		}

	$terms = get_terms('slide_categories', 'hide_empty=0');
	$slideroptions = array();

		foreach($terms as $term) {
			$slideroptions[$term->slug] = $term->name;
		}

	$terms2 = get_terms('category', 'hide_empty=0');
	$blogoptions = array();
	$blogoptions['all'] = "All";

		foreach($terms2 as $term) {
			$blogoptions[$term->slug] = $term->name;
		}
	
	// End taxonomy call
	
	$meta_boxes = array();

	$mb = new Chimps_Metabox('post_slide_options', $themenamefull.' Slider Options', array('pages' => array('post')));
	$mb
		->tab("Slider Options")
			->single_image('slider_image', 'Slider Image', '')
			->text('slider_text', 'Slider Text', 'Enter your slider text here')
			->checkbox('slider_hidetitle', 'Title Bar', '', array('std' => 'on'))
			->single_image('slider_custom_thumb', 'Custom Thumbnail', 'Use the image uploader to upload a custom navigation thumbnail')
			->sliderhelp('', 'Need Help?', '')
		->end();
		
	$mb = new Chimps_Metabox('Carousel', 'Featured Post Carousel', array('pages' => array($themeslug.'_featured_posts')));
	$mb
		->tab("Featured Post Carousel Options")
			->text('post_title', 'Featured Post Title', '')
			->single_image('post_image', 'Featured Post Image', '')
			->text('post_url', 'Featured Post URL', '')
			->reorder('reorder_id', 'Reorder Name', 'Reorder Desc' )
		->end();

	$mb = new Chimps_Metabox('slides', 'Custom Feature Slides', array('pages' => array($themeslug.'_custom_slides')));
	$mb
		->tab("Custom Slide Options")
			->text('slider_caption', 'Custom Slide Caption', '')
			->text('slider_url', 'Custom Slide Link', '')
			->single_image('slider_image', 'Custom Slide Image', '')
			->checkbox('slider_hidetitle', 'Slide Title Bar', '', array('std' => 'on'))
			->single_image('slider_custom_thumb', 'Custom Thumbnail', '')
			->sliderhelp('', 'Need Help?', '')
			->reorder('reorder_id', 'Reorder Name', 'Reorder Desc' )
		->end();

	$mb = new Chimps_Metabox('pages', $themenamefull.' Page Options', array('pages' => array('page')));
	$mb
		->tab("Page Options")
			->image_select('page_sidebar', 'Select Page Layout', '',  array('options' => array(TEMPLATE_URL . '/images/options/right.png', TEMPLATE_URL . '/images/options/tworight.png', TEMPLATE_URL . '/images/options/rightleft.png', TEMPLATE_URL . '/images/options/none.png', TEMPLATE_URL . '/images/options/left.png')))
			->checkbox('hide_page_title', 'Page Title', '', array('std' => 'on'))
			->section_order('page_section_order', 'Page Elements', '', array('options' => array(
					'page_slider' => 'iFeature Slider',
					'callout_section' => 'Callout',
					'twitterbar_section' => 'Twitter Bar',
					'page_section' => 'Page',
					'box_section' => 'Boxes',
					'carousel_section' => 'Carousel',			
					),
					'std' => 'page_section'
				))

			->pagehelp('', 'Need Help?', '')
		->tab($themenamefull." Slider Options")
			->select('page_slider_size', 'Select Slider Size', '', array('options' => array('Full-Width', 'Half-Width')) )
			->select('page_slider_type', 'Select Slider Type', '', array('options' => array('Custom Slides', 'Blog Posts')) )
			->select('slider_category', 'Custom Slide Category', '', array('options' => $slideroptions) )
			->select('slider_blog_category', 'Blog Post Category', '', array('options' => $blogoptions, 'all') )
			->text('slider_blog_posts_number', 'Number of Featured Blog Posts', '', array('std' => '5'))
			->text('slider_height', 'Slider Height', '', array('std' => '330'))
			->text('slider_delay', 'Slider Delay Time (MS)', '', array('std' => '3500'))
			->select('page_slider_animation', 'Slider Animation Type', '', array('options' => array('Horizontal-Push (default)', 'Fade', 'Horizontal-Slide', 'Vertical-Slide')) )
			->select('page_slider_navigation_style', 'Slider Navigation Style', '', array('options' => array('Dots (default)', 'Thumbnails', 'None')) )
			->select('page_slider_caption_style', 'Slider Caption Style', '', array('options' => array('None (default)', 'Bottom', 'Left', 'Right')) )
			->checkbox('hide_arrows', 'Navigation Arrows', '', array('std' => 'on'))
			->checkbox('enable_wordthumb', 'WordThumb Image Resizing', '', array('std' => 'off'))
			->sliderhelp('', 'Need Help?', '')
		->tab("Callout Options")
			->text('callout_title', 'Callout Title', '')
			->textarea('callout_text', 'Callout Text', '')
			->checkbox('disable_callout_button', 'Callout Button', '', array('std' => 'on'))
			->text('callout_button_text', 'Callout Button Text', '')
			->text('callout_url', 'Callout Button URL', '')
			->checkbox('extra_callout_options', 'Custom Callout Options', '', array('std' => 'off'))
			->single_image('callout_image', 'Custom Button Image', '')
			->color('custom_callout_color', 'Custom Background Color', '')
			->color('custom_callout_title_color', 'Custom Title Color', '')
			->color('custom_callout_text_color', 'Custom Text Color', '')
			->color('custom_callout_button_color', 'Custom Button Color', '')
			->color('custom_callout_button_text_color', 'Custom Button Text Color', '')
			->pagehelp('', 'Need help?', '')
		->tab("Carousel Options")
			->select('carousel_category', 'Carousel Category', '', array('options' => $carouseloptions) )
			->text('carousel_speed', 'Carousel Animation Speed (ms)', '', array('std' => '750'))
		->tab("Twitter Options")
			->text('twitter_handle', 'Twitter Handle', 'Enter your Twitter handle if using the Twitter bar - Requires <a href="http://wordpress.org/extend/plugins/twitter-for-wordpress/" target="_blank">Twitter for WordPress Plugin')
		->tab("SEO Options")
			->text('seo_title', 'SEO Title', '')
			->textarea('seo_description', 'SEO Description', '')
			->textarea('seo_keywords', 'SEO Keywords', '')
			->pagehelp('', 'Need help?', '')
		->end();

	foreach ($meta_boxes as $meta_box) {
		$my_box = new RW_Meta_Box_Taxonomy($meta_box);
	}

}
