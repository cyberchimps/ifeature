<?php
/**
* Page actions used by the CyberChimps Core Framework 
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
* Core page actions
*/

add_action('chimps_page_section', 'chimps_page_section_content' );

/**
* Sets up the page content. 
*
* @since 1.0
*/
function chimps_page_section_content() { 
	global $options, $themeslug, $post;
	
	$hidetitle = get_post_meta($post->ID, 'hide_page_title' , true);
	$sidebar = get_post_meta($post->ID, 'page_sidebar' , true);

	if ($sidebar == "1" ) {
		$content_grid = 'grid_12';
	}
	
	else {
		$content_grid = 'grid_8';
	}

?>
<div class="container_12">

	<?php if ($sidebar == "2"): ?>
		<div id="sidebar" class="grid_3">
			<?php get_sidebar('left'); ?>
		</div>
	<?php endif;?>
			
		<div id="content" class="<?php echo $content_grid; ?>">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<div class="post_container">
			
				<div class="post" id="post-<?php the_ID(); ?>">
				<?php if ($hidetitle == "on"): ?>
				

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
	
	<?php if ($sidebar == "0" OR $sidebar == ""): ?>
		<div id="sidebar" class="grid_4">
			<?php get_sidebar(); ?>
		</div>
	<?php endif;?>
	
</div><!--end container_12-->

<div class='clear'>&nbsp;</div> <?php
}