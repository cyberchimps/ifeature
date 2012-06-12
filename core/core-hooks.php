<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Hook wrappers used by the CyberChimps Synapse Core Framework
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
* @package Synapse
* @since 1.0
*/

/**
* Facebook like and plus one. 
*
* @since 1.0
*/
function synapse_sidebar_init() {
	do_action ('synapse_sidebar_init');
}

/**
* Placed before the 404 message content (404.php).
*
* @since 1.0
*/
function synapse_before_404() {
	do_action('synapse_before_404');
}

/**
* 404 page template message content (404.php).
*
* @since 1.0
*/
function synapse_404() {
	do_action('synapse_404');
}

/**
* Placed after the 404 message content (404.php).
*
* @since 1.0
*/
function synapse_after_404() {
	do_action('synapse_after_404');
}

/**
* Placed before the archive template content (archive.php). 
*
* @since 1.0
*/
function synapse_before_archive() {
	do_action('synapse_before_archive');
}

/**
* Conditionals for various archive page title types (archive.php).
*
* @since 1.0
*/
function synapse_archive_title() {
	do_action('synapse_archive_title');
}

/**
* Archive template loop content (archive.php).
*
* @since 1.0
*/
function synapse_archive() {
	do_action('synapse_archive');
}

/**
* Placed after the archive template content (archive.php). 
*
* @since 1.0
*/
function synapse_after_archive() {
	do_action('synapse_after_archive');
}

/**
* Placed after the comment section content (comments.php). 
*
* @since 1.0
*/
function synapse_before_comments() {
	do_action('synapse_before_comments');
}

/**
* Creates the comment section (comments.php). 
*
* @since 1.0
*/
function synapse_comments() {
	do_action('synapse_comments');
}

/**
* Placed after the comment section (comments.php). 
*
* @since 1.0
*/
function synapse_after_comments() {
	do_action('synapse_after_comments');
}

/**
* For use before main page content. 
*
* @since 1.0
*/
function synapse_before_page_content() {
	do_action('synapse_before_page_content');
}

/**
* For use after main page content. 
*
* @since 1.0
*/
function synapse_after_page_content() {
	do_action('synapse_after_page_content');
}

/**
* Placed after post entry (sets up sidebar). 
*
* @since 1.0
*/
function synapse_after_entry() {
	do_action('synapse_after_entry');
}

/**
* For use before the loop. 
*
* @since 1.0
*/
function synapse_before_loop() {
	do_action('synapse_before_loop');
}

/**
* The loop. 
*
* @since 1.0
*/
function synapse_loop() {
	do_action('synapse_loop');
}

/**
* The loop (single.php). 
*
* @since 1.0
*/
function synapse_single_loop() {
	do_action('synapse_single_loop');
}

/**
* For use after the loop. 
*
* @since 1.0
*/
function synapse_after_loop() {
	do_action('synapse_after_loop');
}

/**
* For use before the footer content. 
*
* @since 1.0
*/
function synapse_before_footer() {
	do_action('synapse_before_footer_content');
}

/**
* Footer content. 
*
* @since 1.0
*/
function synapse_footer() {
	do_action('synapse_footer');
}

/**
* For use after the footer content. 
*
* @since 1.0
*/
function synapse_after_footer() {
	do_action('synapse_after_footer_content');
}

/**
* Contains the secondary footer elements. 
*
* @since 1.0
*/
function synapse_secondary_footer() { 
	do_action('synapse_secondary_footer');
}

/**
* Post byline content (single.php). 
*
* @since 1.0
*/
function synapse_single_post_byline() {
	do_action('synapse_single_post_byline');
}

/**
* Post byline content (archive.php). 
*
* @since 1.0
*/
function synapse_archive_post_byline() {
	do_action('synapse_archive_post_byline');
}


/**
* Calls post tags (single.php). 
*
* @since 1.0
*/
function synapse_single_post_tags() {
	do_action('synapse_single_post_tags');
}

/**
* Post byline content. 
*
* @since 1.0
*/
function synapse_post_byline() {
	do_action('synapse_post_byline');
}

/**
* Calls post tags. 
*
* @since 1.0
*/
function synapse_post_tags() {
	do_action('synapse_post_tags');
}

/**
* Calls post tags (archive.php). 
*
* @since 1.0
*/
function synapse_archive_post_tags() {
	do_action('synapse_archive_post_tags');
}

/**
* Post pagination. 
*
* @since 1.0
*/
function synapse_link_pages() {
	do_action('synapse_link_pages');
}

/**
* Creates admin edit link for pages and posts. 
*
* @since 1.0
*/
function synapse_edit_link() {
	do_action('synapse_edit_link');
}

/**
* Contains HTML, title, rel and meta elements. 
*
* @since 1.0
*/
function synapse_head_tag() {
	do_action('synapse_head_tag');
}

/**
* Placed after closing HEAD tag, contains font function. 
*
* @since 1.0
*/
function synapse_after_head_tag() {
	do_action('synapse_after_head_tag');
}

/**
* For adding content before the main header content. 
*
* @since 1.0
*/
function synapse_before_header() {
	do_action('synapse_before_header');
}

/**
* For adding content after the main header content. 
*
* @since 1.0
*/
function synapse_after_header() {
	do_action('synapse_after_header');
}

/**
* Sitename/logo content. 
*
* @since 1.0
*/
function synapse_header_sitename() {
	do_action('synapse_header_sitename');
}

/**
* Site description. 
*
* @since 1.0
*/
function synapse_header_site_description() {
	do_action('synapse_header_site_description');
}

/**
* Header social icon section. 
*
* @since 1.0
*/
function synapse_header_social_icons() {
	do_action('synapse_header_social_icons');
}

/**
* Site menu. 
*
* @since 1.0
*/
function synapse_navigation() {
	do_action('synapse_navigation');
}

/**
* Index pagination. 
*
* @since 1.0
*/
function synapse_pagination() { 
	do_action('synapse_pagination');
}

/**
* Post page pagination. 
*
* @since 1.0
*/
function synapse_links_pages() { 
	do_action('synapse_links_pages');
}

/**
* Next/Prev post links for single.php. 
*
* @since 1.0
*/
function synapse_post_pagination() { 
	do_action('synapse_post_pagination');
}

/**
* Sets up the page section for page.php. 
*
* @since 1.0
*/
function synapse_page_section() {
	do_action('synapse_page_section');
}

/**
* Placed before the search result content. 
*
* @since 1.0
*/
function synapse_before_search() {
	do_action('synapse_before_search');
}

/**
* Sets up the search result content. 
*
* @since 1.0
*/
function synapse_search() {
	do_action('synapse_search');
}

/**
* Placed after the search result content. 
*
* @since 1.0
*/
function synapse_after_search() {
	do_action('synapse_after_search');
}

/**
* Generates the lite version of the iFeature slider. 
*
* @since 1.0
*/
function synapse_blog_slider_lite() {
	do_action('synapse_blog_slider_lite');
}

/**
* Generates the Twitter Bar page element. 
*
* @since 1.0
*/
function synapse_twitterbar_section() {
	do_action ('synapse_twitterbar_section');
}

/**
* Generates the before content sidebar. 
*
* @since 1.0
*/
function synapse_before_content_sidebar() {
	do_action ('synapse_before_content_sidebar');
}

/**
* Generates the after content sidebar. 
*
* @since 1.0
*/
function synapse_after_content_sidebar() {
	do_action ('synapse_after_content_sidebar');
}

/**
* Index content. 
*
* @since 1.0
*/
function synapse_index() {
	do_action ('synapse_index');
}

/**
* Postbar. 
*
* @since 1.0
*/
function synapse_post_bar() {
	do_action ('synapse_post_bar');
}

/**
* Facebook like and plus one. 
*
* @since 1.0
*/
function synapse_fb_like_plus_one() {
	do_action ('synapse_fb_like_plus_one');
}

/**
* Blog content slider. 
*
* @since 1.0
*/
function synapse_blog_content_slider() {
	do_action ('synapse_blog_content_slider');
}

/**
* Page content slider. 
*
* @since 1.0
*/
function synapse_page_content_slider() {
	do_action ('synapse_page_content_slider');
}

/**
* Page content slider. 
*
* @since 1.0
*/
function synapse_product_element() {
	do_action ('synapse_product_element');
}

/**
* End
*/

?>