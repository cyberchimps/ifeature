<?php 
/**
* Single post template used by the iFeature theme.
*
* Authors: Tyler Cunningham, Trent Lapinski.
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: license.txt.
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package iFeature
* @since 3.1
*/

/**
* Variable definition.
*/
global $options, $themeslug, $post;

/**
* Call the header.
*/
get_header(); 

?>

<div class="container_12">
<?php if (function_exists('chimps_breadcrumbs') && ($options->get($themeslug.'_disable_breadcrumbs') == "1")) { chimps_breadcrumbs(); }?>

		<div id="content" class="grid_8">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<div class="post_container">
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		
				<!--Begin @Core index loop hook-->
					<?php chimps_loop(); ?>
				<!--End @Core index loop hook-->	
			
				<!--Begin @Core link pages hook-->
					<?php chimps_link_pages(); ?>
				<!--End @Core link pages hook-->
			
				<!--Begin @Core post edit link hook-->
					<?php chimps_edit_link(); ?>
				<!--End @Core post edit link hook-->
			
				<!--Begin @Core FB like hook-->
					<?php ifeature_fb_like_plus_one(); ?>
				<!--End @Core FB like hook-->
			
				<!--Begin @Core post tags hook-->
					<?php chimps_post_tags(); ?>
				<!--End @Core post tags hook-->
				
				<!--Begin @Core post pagination hook-->
					<?php chimps_post_pagination(); ?>
				<!--End @Core post pagination hook-->				
								
				<!--Begin @Core post bar hook-->
					<?php ifeature_post_bar(); ?>
				<!--End @Core post bar hook-->
			
				</div><!--end post_class-->	
		</div><!--end post container--> 
	
			<?php endwhile; ?>
			
			<?php comments_template(); ?>
		
			<?php else : ?>

				<h2>Not Found</h2>

			<?php endif; ?>
		
		</div><!--end content-->

	<!--Begin @Core index after entry hook-->
	<?php chimps_after_entry(); ?>
	<!--End @Core index after entry hook-->



</div><!--end container_12-->

<div style="clear:both;"></div>

<?php get_footer(); ?>