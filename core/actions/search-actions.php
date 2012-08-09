<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Search actions used by the CyberChimps Synapse Core Framework
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
* Synapse search actions
*/
add_action( 'synapse_search', 'synapse_search_content' );

/**
* Search results output
*
* @since 1.0
*/
function synapse_search_content() { 
	global $options, $themeslug;
	$results = apply_filters( 'synapse_search_results_message', 'Search Results For: %s' ); 
	$noresults = apply_filters( 'synapse_no_search_results_message', 'No posts found.' ); ?>
	
	<div id="content_left">
		<div class="content_padding">

		<?php if (have_posts()) : ?>

				<?php while (have_posts()) : the_post(); ?>
		
		<div class="post_container">

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				<?php get_template_part('meta', 'search' ); ?>

				<div class="entry">

					<?php 
						if ($options->get($themeslug.'_search_show_excerpts') == '1') {
							the_excerpt();
						}
						else {
							the_content();
						}
					 ?>

				</div>

			</div>

		</div><!--end post_container-->
		<?php endwhile; ?>

		<?php synapse_pagination(); ?>

	<?php else : ?>

		<h2><?php printf( $noresults ) ; ?></h2>

	<?php endif; ?>
		</div><!--end content_padding-->
	</div><!--end content_left--><?php
}

/**
* End
*/

?>