<?php
/**
* Index actions used by the CyberChimps Core Framework 
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
* Core Index actions
*/

add_action( 'chimps_loop', 'chimps_loop_content' );

add_action( 'chimps_after_entry', 'chimps_after_entry_sidebar' );

/**
* After entry sidebar
*
* @since 1.0
*/
function chimps_after_entry_sidebar() {
	global $options, $themeslug, $post; // call globals
	
	$blogsidebar = $options->get($themeslug.'_blog_sidebar');
	$sidebar = get_post_meta($post->ID, 'page_sidebar' , true);?>
	
	
	<?php if ($sidebar == "0" OR $blogsidebar == 'right' OR $blogsidebar == '' ): ?>
	<div id="sidebar" class="grid_4">
		<?php get_sidebar(); ?>
	</div>
	<?php endif;?>
 <?php 
}

/**
* Check for post format type, apply filter based on post format name for easy modification.
*
* @since 1.0
*/
function chimps_loop_content($content) { 

	global $options, $themeslug, $post; //call globals
	
	if (get_post_format() == '') {
		$format = "default";
	}
	else {
		$format = get_post_format();
	} ?>
		
		<?php ob_start(); ?>
			
			<?php if ($options->get($themeslug.'_post_formats') != '0') : ?>
			<div class="postformats"><!--begin format icon-->
				<img src="<?php echo get_template_directory_uri(); ?>/images/formats/<?php echo $format ;?>.png" alt="formats" />
			</div><!--end format-icon-->
			<?php endif; ?>
				<h2 class="posts_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					<!--Call @Core Meta hook-->
			<?php chimps_post_byline(); ?>
				<?php
				if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1'  && !is_single()) {
 		 			echo '<div class="featured-image">';
 		 			echo '<a href="' . get_permalink($post->ID) . '" >';
 		 				the_post_thumbnail();
  					echo '</a>';
  					echo '</div>';
				}
			?>	
				<div class="entry" <?php if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1' && !is_single()  ) { echo 'style="min-height: 115px;" '; }?>>
					<?php 
						if ($options->get($themeslug.'_show_excerpts') == '1' && !is_single() ) {
						the_excerpt();
						}
						else {
							the_content();
						}
					 ?>
				</div><!--end entry-->
				
				<div class='clear'>&nbsp;</div>
			<?php	
		
		$content = ob_get_clean();
		$content = apply_filters( 'chimps_post_formats_'.$format.'_content', $content );
	
		echo $content; 
}

/**
* End
*/

?>