<?php
/**
* Hook wrappers used by the CyberChimps Core Framework
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
* @package Core
* @since 1.0
*/

/**
* Placed before the 404 message content (404.php).
*
* @since 1.0
*/
function chimps_before_404() {
	do_action('chimps_before_404');
}

/**
* 404 page template message content (404.php).
*
* @since 1.0
*/
function chimps_404() {
	do_action('chimps_404');
}

/**
* Placed after the 404 message content (404.php).
*
* @since 1.0
*/
function chimps_after_404() {
	do_action('chimps_after_404');
}

/**
* Placed before the archive template content (archive.php). 
*
* @since 1.0
*/
function chimps_before_archive() {
	do_action('chimps_before_archive');
}

/**
* Conditionals for various archive page title types (archive.php).
*
* @since 1.0
*/
function chimps_archive_title() {
	do_action('chimps_archive_title');
}

/**
* Archive template loop content (archive.php).
*
* @since 1.0
*/
function chimps_archive() {
	do_action('chimps_archive');
}

/**
* Placed after the archive template content (archive.php). 
*
* @since 1.0
*/
function chimps_after_archive() {
	do_action('chimps_after_archive');
}

/**
* Placed after the comment section content (comments.php). 
*
* @since 1.0
*/
function chimps_before_comments() {
	do_action('chimps_before_comments');
}

/**
* Creates the comment section (comments.php). 
*
* @since 1.0
*/
function chimps_comments() {
	do_action('chimps_comments');
}

/**
* Placed after the comment section (comments.php). 
*
* @since 1.0
*/
function chimps_after_comments() {
	do_action('chimps_after_comments');
}

/**
* For use before main page content. 
*
* @since 1.0
*/
function chimps_before_page_content() {
	do_action('chimps_before_page_content');
}

/**
* For use after main page content. 
*
* @since 1.0
*/
function chimps_after_page_content() {
	do_action('chimps_after_page_content');
}

/**
* Placed after post entry (sets up sidebar). 
*
* @since 1.0
*/
function chimps_after_entry() {
	do_action('chimps_after_entry');
}

/**
* For use before the loop. 
*
* @since 1.0
*/
function chimps_before_loop() {
	do_action('chimps_before_loop');
}

/**
* The loop. 
*
* @since 1.0
*/
function chimps_loop() {
	do_action('chimps_loop');
}

/**
* For use after the loop. 
*
* @since 1.0
*/
function chimps_after_loop() {
	do_action('chimps_after_loop');
}

/**
* For use before the footer content. 
*
* @since 1.0
*/
function chimps_before_footer() {
	do_action('chimps_before_footer_content');
}

/**
* Footer content. 
*
* @since 1.0
*/
function chimps_footer() {
	do_action('chimps_footer');
}

/**
* For use after the footer content. 
*
* @since 1.0
*/
function chimps_after_footer() {
	do_action('chimps_after_footer_content');
}

/**
* Contains the secondary footer elements. 
*
* @since 1.0
*/
function chimps_secondary_footer() { 
	do_action('chimps_secondary_footer');
}

/**
* Post byline content. 
*
* @since 1.0
*/
function chimps_post_byline() {
	do_action('chimps_post_byline');
}

/**
* Calls post tags. 
*
* @since 1.0
*/
function chimps_post_tags() {
	do_action('chimps_post_tags');
}

/**
* Post pagination. 
*
* @since 1.0
*/
function chimps_link_pages() {
	do_action('chimps_link_pages');
}

/**
* Creates admin edit link for pages and posts. 
*
* @since 1.0
*/
function chimps_edit_link() {
	do_action('chimps_edit_link');
}

/**
* Contains HTML, title, rel and meta elements. 
*
* @since 1.0
*/
function chimps_head_tag() {
	do_action('chimps_head_tag');
}

/**
* Placed after closing HEAD tag, contains font function. 
*
* @since 1.0
*/
function chimps_after_head_tag() {
	do_action('chimps_after_head_tag');
}

/**
* For adding content before the main header content. 
*
* @since 1.0
*/
function chimps_before_header() {
	do_action('chimps_before_header');
}

/**
* For adding content after the main header content. 
*
* @since 1.0
*/
function chimps_after_header() {
	do_action('chimps_after_header');
}

/**
* Sitename/logo content. 
*
* @since 1.0
*/
function chimps_header_sitename() {
	do_action('chimps_header_sitename');
}

/**
* Site description. 
*
* @since 1.0
*/
function chimps_header_site_description() {
	do_action('chimps_header_site_description');
}

/**
* Header social icon section. 
*
* @since 1.0
*/
function chimps_header_social_icons() {
	do_action('chimps_header_social_icons');
}

/**
* Site menu. 
*
* @since 1.0
*/
function chimps_navigation() {
	do_action('chimps_navigation');
}

/**
* Index pagination. 
*
* @since 1.0
*/
function chimps_pagination() { 
	do_action('chimps_pagination');
}

/**
* Post page pagination. 
*
* @since 1.0
*/
function chimps_links_pages() { 
	do_action('chimps_links_pages');
}

/**
* Next/Prev post links for single.php. 
*
* @since 1.0
*/
function chimps_post_pagination() { 
	do_action('chimps_post_pagination');
}

/**
* Sets up the page section for page.php. 
*
* @since 1.0
*/
function chimps_page_section() {
	do_action('chimps_page_section');
}

/**
* Placed before the search result content. 
*
* @since 1.0
*/
function chimps_before_search() {
	do_action('chimps_before_search');
}

/**
* Sets up the search result content. 
*
* @since 1.0
*/
function chimps_search() {
	do_action('chimps_search');
}

/**
* Placed after the search result content. 
*
* @since 1.0
*/
function chimps_after_search() {
	do_action('chimps_after_search');
}

/**
* Generates the lite version of the iFeature slider. 
*
* @since 1.0
*/
function chimps_blog_slider_lite() {
	do_action('chimps_blog_slider_lite');
}

/**
* Generates the Twitter Bar page element. 
*
* @since 1.0
*/
function chimps_twitterbar_section() {
	do_action ('chimps_twitterbar_section');
}

/**
* End
*/

?>