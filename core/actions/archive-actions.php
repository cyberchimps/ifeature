<?php
/**
* Archive actions used by the CyberChimps Core Framework 
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
* Core archive actions
*/
add_action( 'chimps_archive_title', 'chimps_archive_page_title' );
add_action( 'chimps_archive', 'chimps_archive_loop' );

/**
* Output archive page title based on archive type. 
*
* @since 1.0
*/
function chimps_archive_page_title() { 
	global $post; ?>
	

 	

			<?php if (is_category()) { ?>
				<h2><?php printf( __( 'Archive for the &#8216;', 'core' )); ?><?php single_cat_title(); ?><?php printf( __( '&#8217; Category:', 'core' )); ?></h2><br />

			<?php } elseif( is_tag() ) { ?>
				<h2><?php printf( __( 'Posts Tagged &#8216;', 'core' )); ?><?php single_tag_title(); ?><?php printf( __( '&#8217;:', 'core' )); ?></h2><br />

			<?php } elseif (is_day()) { ?>
				<h2><?php printf( __( 'Archive for', 'core' )); ?> <?php the_time('F jS, Y'); ?>:</h2><br />

			<?php } elseif (is_month()) { ?>
				<h2><?php printf( __( 'Archive for', 'core' )); ?> <?php the_time('F, Y'); ?>:</h2><br />

			<?php } elseif (is_year()) { ?>
				<h2 class="pagetitle"><?php printf( __( 'Archive for:', 'core' )); ?> <?php the_time('Y'); ?>:</h2><br />

			<?php } elseif (is_author()) { ?>
				<h2 class="pagetitle"><?php printf( __( 'Author Archive:', 'core' )); ?></h2><br />

			<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h2 class="pagetitle"><?php printf( __('Blog Archives:', 'core' )); ?></h2><br />
	
			<?php } 
}

/**
* Archive page loop. 
*
* @since 1.0
*/
function chimps_archive_loop()
{ ?>
			<div class="post_container">
			
				<div <?php post_class() ?>>
				
						<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					
						<?php chimps_post_byline(); ?>

						<div class="entry">
							<?php the_excerpt(); ?>
						</div>
				
				<!--Begin @Core post tags hook-->
					<?php chimps_post_tags(); ?>
				<!--End @Core post tags hook-->
			
				<!--Begin @Core post bar hook-->
					<?php chimps_post_bar(); ?>
				<!--End @Core post bar hook-->							
							
				</div><!--end post-->
				
			</div><!--end post_container-->
			
<?php }


/**
* End
*/

?>