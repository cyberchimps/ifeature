<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/********************* BEGIN DEFINITION OF META BOXES ***********************/

add_action('init', 'initialize_the_meta_boxes');

function initialize_the_meta_boxes() {

	global  $themename, $themeslug, $themenamefull, $options; // call globals.
	
	// Call taxonomies for select options
	
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
			->single_image($themeslug.'_slider_image', 'Slider Image', '')
			->text($themeslug.'_slider_text', 'Slider Text', 'Enter your slider text here')
			->sliderhelp('', 'Need Help?', '')
		->end();
	
	$mb = new Chimps_Metabox('pages', $themenamefull.' Page Options', array('pages' => array('page')));
	$mb
		->tab("Page Options")
			->image_select($themeslug.'_page_sidebar', 'Select Page Layout', '',  array('options' => array(TEMPLATE_URL . '/images/options/right.png', TEMPLATE_URL . '/images/options/none.png')))
			->checkbox($themeslug.'_hide_page_title', 'Page Title', '', array('std' => 'on'))
			->section_order($themeslug.'_page_section_order', 'Page Elements', '', array('options' => array(
					'breadcrumbs' => 'Breadcrumbs',
					'page_section' => 'Page',
					'twitterbar_section' => 'Twitter Bar',	
					'product_element' => 'Product'		
					),
					'std' => 'breadcrumbs,page_section'
				))
			->pagehelp('', 'Need Help?', '')
		->tab("Twitter Options")
			->text($themeslug.'_twitter_handle', 'Twitter Handle', 'Enter your Twitter handle if using the Twitter bar')
			->checkbox($themeslug.'_twitter_reply', 'Show @ Replies', '')
		->tab("Product Options")
			->select($themeslug.'_product_text_align', 'Text Align', '', array('options' => array('Left', 'Right')) )
			->text($themeslug.'_product_title', 'Product Title', '', array('std' => 'Product'))
			->textarea($themeslug.'_product_text', 'Proudct Text', '', array('std' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. '))
			->select($themeslug.'_product_type', 'Media Type', '', array('options' => array('Image', 'Video')) )
			->single_image($themeslug.'_product_image', 'Product Image', '', array('std' =>  TEMPLATE_URL . '/images/product.jpg'))
			->textarea($themeslug.'_product_video', 'Video Embed', '')
			->checkbox($themeslug.'_product_link_toggle', 'Product Link', '', array('std' => 'on'))
			->text($themeslug.'_product_link_url', 'Link URL', '', array('std' => home_url()))
			->text($themeslug.'_product_link_text', 'Link Text', '', array('std' => 'Buy Now'))
		->tab("SEO Options")
			->text($themeslug.'_seo_title', 'SEO Title', '')
			->textarea($themeslug.'_seo_description', 'SEO Description', '')
			->textarea($themeslug.'_seo_keywords', 'SEO Keywords', '')
			->pagehelp('', 'Need help?', '')
		->end();

	foreach ($meta_boxes as $meta_box) {
		$my_box = new RW_Meta_Box_Taxonomy($meta_box);
	}

}
