<?php
/**
* Custom hooks used by the iFeature Pro WordPress Theme
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
* @package iFeature Pro
* @since 3.0
*/


/**
* Hook for header content area
*
* @since 3.0
*/
function ifeature_header_content() {
	do_action('ifeature_header_content');
}

/**
* Hook for the post bar
*
* @since 3.1
*/
function ifeature_post_bar() {
	do_action('ifeature_post_bar');
}

/**
* Hook for the Facebook and Plus One buttons
*
* @since 3.1
*/
function ifeature_fb_like_plus_one() { //this will be renamed I promise
	do_action('ifeature_fb_like_plus_one');
}

/**
* Hook for the Header Contact Area
*
* @since 3.1
*/
function ifeature_header_contact_area() {
	do_action('ifeature_header_contact_area');
}