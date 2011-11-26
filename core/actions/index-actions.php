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

add_action( 'chimps_index_after_entry', 'chimps_index_after_entry_sidebar' );

add_action( 'chimps_index_before_entry', 'chimps_index_before_entry_slider' );
add_action( 'chimps_index_before_entry', 'chimps_index_before_entry_sidebar' );

add_action( 'chimps_index_loop', 'chimps_index_loop_content' );

add_action( 'chimps_index_entry', 'chimps_index_content_slider' );


/**
* Index content slider
*
* @since 1.0
*/
function chimps_index_content_slider() { 
		global $options, $themeslug; ?>
		
		<?php if ($options->get($themeslug.'_hide_slider_blog') != '1' && $options->get($themeslug.'_slider_size') != "key2"): ?>
		
			<?php chimps_blog_slider(); ?>
		
	<?php endif;

}

/**
* Index content before entry slider
*
* @since 1.0
*/
function chimps_index_before_entry_slider() { 
		global $options, $themeslug; ?>
		
		<?php if ($options->get($themeslug.'_hide_slider_blog') != '1' && $options->get($themeslug.'_slider_size') == "key2"): ?>
	
			<?php chimps_blog_slider(); ?>
		
	<?php endif;

}

/**
* Before entry sidebar
*
* @since 1.0
*/
function chimps_index_after_entry_sidebar() {
	global $options, $themeslug, $post; // call globals
	
	$blogsidebar = $options->get($themeslug.'_blog_sidebar');
	$sidebar = get_post_meta($post->ID, 'page_sidebar' , true);?>
	
	
	
	<?php if ($sidebar == "0" OR $blogsidebar == 'right' OR $blogsidebar == '' ): ?>
	<div id="sidebar" class="grid_4">
		<?php get_sidebar(); ?>
	</div>
	<?php endif;?>
	
	<?php if ($sidebar == "3" OR $blogsidebar == 'two-right' ): ?>
	<div id="sidebar" class="grid_3">
		<?php get_sidebar('left'); ?>
	</div>
	<?php endif;?> 
	
	<?php if ($sidebar == "2" OR $sidebar == "3" OR $blogsidebar == 'two-right' OR $blogsidebar == 'right-left' ): ?>
	<div id="sidebar" class="grid_3">
		<?php get_sidebar('right'); ?>
	</div>
	<?php endif;?> <?php 
}

/**
* Before entry sidebar
*
* @since 1.0
*/
function chimps_index_before_entry_sidebar() { 
	global $options, $themeslug, $post; // call globals
	
	$blogsidebar = $options->get($themeslug.'_blog_sidebar');
	$sidebar = get_post_meta($post->ID, 'page_sidebar' , true);?>
				
	<?php if ($sidebar == "3" OR $blogsidebar == 'right-left' ): ?>
	<div id="sidebar" class="grid_3">
		<?php get_sidebar('left'); ?>
	</div>
	<?php endif;
	
	}


/**
* Check for post format type, apply filter based on post format name for easy modification.
*
* @since 1.0
*/
function chimps_index_loop_content($content) { 

	global $options, $themeslug, $post; //call globals
	
		
	if (get_post_format() == '') {
		$format = "default";
	}
	else {
		$format = get_post_format();
	} ?>
	
		
		<?php ob_start(); ?>
			
			<?php if ($options->get($themeslug.'_post_formats') == '1') : ?>
			<div class="postformats"><!--begin format icon-->
				<img src="<?php echo get_template_directory_uri(); ?>/images/formats/<?php echo $format ;?>.png" alt="formats" />
			</div><!--end format-icon-->
			<?php endif; ?>
				<h2 class="posts_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					<!--Call @Core Meta hook-->
			<?php chimps_post_byline(); ?>
				<?php
				if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1' && !is_single() ) {
 		 			echo '<div class="featured-image">';
 		 			echo '<a href="' . get_permalink($post->ID) . '" >';
 		 				the_post_thumbnail();
  					echo '</a>';
  					echo '</div>';
				}
			?>	
				<div class="entry" <?php if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1' ) { echo 'style="min-height: 115px;" '; }?>>
					<?php 
						if ($options->get($themeslug.'_show_excerpts') == '1' && !is_single()) {
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