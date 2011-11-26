<?php
/**
* Pagination actions used by the CyberChimps Core Framework
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
* Core pagination actions
*/
add_action('chimps_pagination', 'chimps_previous_posts');
add_action('chimps_pagination', 'chimps_newer_posts');
add_action('chimps_links_pages', 'chimps_wp_link_pages');
add_action('chimps_post_pagination', 'chimps_post_pagination_content');

/**
* Sets up the previous post link and applies a filter to the link text.
*
* @since 1.0
*/
function chimps_previous_posts() {
	$previous_text = apply_filters('chimps_previous_posts_text', '&laquo; Older Entries' ); 
	
	echo "<div class='pagnext-posts'>";
	next_posts_link( __( $previous_text, 'core' ));
	echo "</div>";
}

/**
* Sets up the next post link and applies a filter to the link text. 
*
* @since 1.0
*/
function chimps_newer_posts() {
	$newer_text = apply_filters('chimps_newer_posts_text', 'Newer Entries &raquo;' );
	
	echo "<div class='pagprev-posts'>";
	previous_posts_link( __( $newer_text, 'core' ));
	echo "</div>";
}

/**
* Uses wp_link_pages to display post pagination. 
*
* @since 1.0
*/
function chimps_wp_link_pages() {
	wp_link_pages(array(
		'before' => 'Pages: ', // should we add a filter/translation wrapper here?
		'next_or_number' => 'number') // same here?
	);
}

/**
* Uses wp_link_pages to display post pagination. 
*
* @since 1.0
*/
function chimps_post_pagination_content() {
	global $options, $themeslug; ?>
<?php if ($options->get($themeslug.'_post_pagination') == "1"): ?>

				<div style="text-align:left;padding:5px; margin-top: -10px; margin-bottom: 5px; margin-left: -5px;"><?php previous_post_link(); ?></div> <div style="float:right;padding:5px; margin-top:-35px;"><?php next_post_link(); ?></div>
					<?php endif; 
	
}

/**
* End
*/

?>