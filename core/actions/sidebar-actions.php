<?php
/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Sidebar actions used by the CyberChimps Synapse Core Framework
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
* Synapse sidebar actions
*/
add_action( 'synapse_sidebar_init', 'synapse_sidebar_init_content' );
add_action( 'synapse_before_content_sidebar', 'synapse_before_content_sidebar_markup' );
add_action( 'synapse_after_content_sidebar', 'synapse_after_content_sidebar_markup' );


/**
* Set sidebar and grid variables.
*
* @since 1.0
*/
function synapse_sidebar_init_content() {

	global $options, $themeslug, $post, $sidebar, $content_grid;
	
	if (is_single()) {
	$sidebar = $options->get($themeslug.'_single_sidebar');
	}
	elseif (is_archive()) {
	$sidebar = $options->get($themeslug.'_archive_sidebar');
	}
	elseif (is_404()) {
	$sidebar = $options->get($themeslug.'_404_sidebar');
	}
	elseif (is_search()) {
	$sidebar = $options->get($themeslug.'_search_sidebar');
	}
	elseif (is_page()) {
	$sidebar = get_post_meta($post->ID, $themeslug.'_page_sidebar' , true);
	}
	else {
	$sidebar = $options->get($themeslug.'_blog_sidebar');
	}
	
	if ($sidebar == 'two-right' OR $sidebar == 'right-left' OR $sidebar == "1" OR $sidebar == "2") {
		$content_grid = 'six columns';
	}
	elseif ($sidebar == 'none' OR $sidebar == "3") {
		$content_grid = 'twelve columns';
	}
	else {
		$content_grid = 'eight columns';
	}
}

/**
* Before entry sidebar
*
* @since 1.0
*/
function synapse_before_content_sidebar_markup() { 
	global $options, $themeslug, $post, $sidebar; // call globals ?>
				
	<?php if ($sidebar == 'right-left' OR $sidebar == "2"): ?>
	<div id="sidebar" class="three columns">
		<?php get_sidebar('left'); ?>
	</div>
	<?php endif; ?>
	
	<?php if ($sidebar == 'left' OR $sidebar == "4"): ?>
	<div id="sidebar" class="four columns">
		<?php get_sidebar(); ?>
	</div>
	<?php endif;
}

/**
* After entry sidebar
*
* @since 1.0
*/
function synapse_after_content_sidebar_markup() {
	global $options, $themeslug, $post, $sidebar; // call globals ?>
	
	<?php if ($sidebar == 'right' OR $sidebar == '0' OR $sidebar == '' ): ?>
	<div id="sidebar" class="four columns">
		<?php get_sidebar(); ?>
	</div>
	<?php endif;?>
	
	<?php if ($sidebar == 'two-right' OR  $sidebar == '1' ): ?>
	<div id="sidebar" class="three columns">
		<?php get_sidebar('left'); ?>
	</div>
	<?php endif;?> 
	
	<?php if ($sidebar == 'two-right' OR $sidebar == 'right-left' OR $sidebar == '1' OR $sidebar == '2'): ?>
	<div id="sidebar" class="three columns">
		<?php get_sidebar('right'); ?>
	</div>
	<?php endif;?> <?php 
}

/**
* End
*/

?>