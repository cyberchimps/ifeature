<?php
/**
* Pagination actions used by the CyberChimps Synapse Core Framework
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
* Synapse pagination actions
*/
add_action('synapse_pagination', 'synapse_previous_posts');
add_action('synapse_pagination', 'synapse_newer_posts');
add_action('synapse_link_pages', 'synapse_link_pages_content');
add_action('synapse_post_pagination', 'synapse_post_pagination_content');

/**
* Sets up the previous post link and applies a filter to the link text.
*
* @since 1.0
*/
function synapse_previous_posts() {
	$previous_text = apply_filters('synapse_previous_posts_text', '&laquo; Older Entries' ); 
	
	echo "<div class='pagnext-posts'>";
	next_posts_link( __( $previous_text, 'core' ));
	echo "</div>";
}

/**
* Sets up the next post link and applies a filter to the link text. 
*
* @since 1.0
*/
function synapse_newer_posts() {
	$newer_text = apply_filters('synapse_newer_posts_text', 'Newer Entries &raquo;' );
	
	echo "<div class='pagprev-posts'>";
	previous_posts_link( __( $newer_text, 'core' ));
	echo "</div>";
}

/**
* Sets up the WP link pages
*
* @since 1.0
*/
function synapse_link_pages_content() {
	 wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number'));
}

/**
* Post pagination links 
*
* @since 1.0
*/
function synapse_post_pagination_content() {
	global $options, $themeslug?>
	
	<?php if ($options->get($themeslug.'_post_pagination') != "0"):?>
	<div class="prev-posts-single"><?php previous_post_link(); ?></div> <div class="next-posts-single"><?php next_post_link(); ?></div>
	<?php endif; 
}

/**
* End
*/

?>