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
* 404
*/
function chimps_before_404() {
	do_action('chimps_before_404');
}

function chimps_404() {
	do_action('chimps_404');
}

function chimps_after_404() {
	do_action('chimps_after_404');
}

/** 
* Archive
*/
function chimps_before_archive() {
	do_action('chimps_before_archive');
}

function chimps_archive() {
	do_action('chimps_archive');
}

function chimps_archive_title() {
	do_action('chimps_archive_title');
}

function chimps_after_archive() {
	do_action('chimps_after_archive');
}

/** 
* Comments
*/
function chimps_before_comments() {
	do_action('chimps_before_comments');
}

function chimps_comments() {
	do_action('chimps_comments');
}

function chimps_after_comments() {
	do_action('chimps_after_comments');
}

/** 
* Content 
*/
function chimps_before_content() {
	do_action('chimps_before_content');
}

function chimps_after_content() {
	do_action('chimps_after_content');
}


/** 
* Entry 
*/
function chimps_index_before_entry() {
	do_action('chimps_index_before_entry');
}

function chimps_index_after_entry() {
	do_action('chimps_index_after_entry');
}

function chimps_meta() {
	do_action('chimps_meta');
}

function chimps_index_entry() {
	do_action('chimps_index_entry');
}

function chimps_index_loop() {
	do_action('chimps_index_loop');
}

function chimps_index_before_loop() {
	do_action('chimps_index_before_loop');
}

function chimps_index_after_loop() {
	do_action('chimps_index_after_loop');
}

/** 
* Footer 
*/
function chimps_before_footer() {
	do_action('chimps_before_footer_content');
}

function chimps_footer() {
	do_action('chimps_footer');
}

function chimps_afterfooter() { 
	do_action('chimps_afterfooter');
}

function chimps_after_footer() {
	do_action('chimps_after_footer_content');
}

/** 
* Global 
*/
function chimps_post_bar() {
	do_action('chimps_post_bar');
}

function chimps_post_byline() {
	do_action('chimps_post_byline');
}

function chimps_post_tags() {
	do_action('chimps_post_tags');
}

function chimps_link_pages() {
	do_action('chimps_link_pages');
}

function chimps_edit_link() {
	do_action('chimps_edit_link');
}

function chimps_fb_like_plus_one() { //this will be renamed I promise
	do_action('chimps_fb_like_plus_one');
}

/** 
* Header 
*/
function chimps_after_head_tag() {
	do_action('chimps_after_head_tag');
}

function chimps_before_header() {
	do_action('chimps_before_header');
}

function chimps_head_tag() {
	do_action('chimps_head_tag');
}

function chimps_after_header() {
	do_action('chimps_after_header');
}

function chimps_header_sitename() {
	do_action('chimps_header_sitename');
}

function chimps_header_site_description() {
	do_action('chimps_header_site_description');
}

function chimps_header_contact_area() {
	do_action('chimps_header_contact_area');
}

function chimps_header_social_icons() {
	do_action('chimps_header_social_icons');
}

function chimps_navigation() {
	do_action('chimps_navigation');
}

/** 
* Pagination 
*/
function chimps_pagination() { 
	do_action('chimps_pagination');
}

function chimps_links_pages() { 
	do_action('chimps_links_pages');
}

function chimps_post_pagination() { 
	do_action('chimps_post_pagination');
}

/** 
* Page
*/
function chimps_page_section() {
	do_action('chimps_page_section');
}

/** 
* Search
*/
function chimps_before_search() {
	do_action('chimps_before_search');
}

function chimps_search() {
	do_action('chimps_search');
}

function chimps_after_search() {
	do_action('chimps_after_search');
}

/** 
* Slider
*/
function chimps_blog_slider_lite() {
	do_action('chimps_blog_slider_lite');
}

/** 
* Twitterbar
*/
function chimps_twitterbar_section() {
	do_action('chimps_twitterbar_section');
}

/**
* End
*/

?>