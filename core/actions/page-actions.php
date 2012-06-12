<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Page actions used by the CyberChimps Synapse Core Framework
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
* Synapse page actions
*/

add_action('synapse_page_section', 'synapse_page_section_content' );

/**
* Sets up the page content. 
*
* @since 1.0
*/
function synapse_page_section_content() { 
	global $options, $themeslug, $post, $sidebar, $content_grid;
	
	synapse_sidebar_init();
	
	$hidetitle = get_post_meta($post->ID, $themeslug.'_hide_page_title' , true);


?>
<div class="row">
	<!--Begin @Core before content sidebar hook-->
		<?php synapse_before_content_sidebar(); ?>
	<!--End @Core before content sidebar hook-->
			
		<div id="content" class="<?php echo $content_grid; ?>">
		
		<?php synapse_page_content_slider(); ?>
		
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<div class="post_container">
			
				<div class="post" id="post-<?php the_ID(); ?>">
				<?php if ($hidetitle == "on" OR $hidetitle == ""): ?>
				

					<h2 class="posts_title"><?php the_title(); ?></h2>
						<?php endif;?>

					<div class="entry">

						<?php the_content(); ?>
						
					</div><!--end entry-->
					
					<div style=clear:both;></div>
					<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>


				<?php edit_post_link('Edit', '<p>', '</p>'); ?>

				</div><!--end post-->
		
			<?php comments_template(); ?>

			<?php endwhile; endif; ?>
			</div><!--end post_container-->
				
	</div><!--end content_left-->
	
	<!--Begin @Core after content sidebar hook-->
		<?php synapse_after_content_sidebar(); ?>
	<!--End @Core after content sidebar hook-->
</div>
<?php
}

/**
* End
*/

?>