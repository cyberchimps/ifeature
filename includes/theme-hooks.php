<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

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
* Hook for the Header Contact Area
*
* @since 3.0.5
*/
function ifeature_header_contact_area() {
	do_action('ifeature_header_contact_area');
}

function ifeature_sitename_register() {
	do_action('ifeature_sitename_register');
}

function ifeature_sitename_contact() {
	do_action('ifeature_sitename_contact');
}

function ifeature_description_icons() {
	do_action('ifeature_description_icons');
}

function ifeature_logo_menu() {
	do_action('ifeature_logo_menu');
}

function ifeature_logo_description() {
	do_action('ifeature_logo_description');
}

function ifeature_banner() {
	do_action('ifeature_banner');
}