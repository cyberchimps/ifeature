<?php
/**
* Global actions used by the CyberChimps Core Framework 
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
* Core global actions
*/
add_action( 'chimps_post_byline', 'chimps_post_byline_content' );
add_action( 'chimps_edit_link', 'chimps_edit_link_content' );
add_action( 'chimps_post_tags', 'chimps_post_tags_content' );

/**
* Sets the post byline information (author, date, category). 
*
* @since 1.0
*/
function chimps_post_byline_content() {
	global $options, $themeslug; //call globals.  
	$hidden = $options->get($themeslug.'_hide_byline');?>
	
	<div class="meta">
		<?php if (($hidden[$themeslug.'_hide_date']) != '0'):?> <?php printf( __( 'Published on', 'core' )); ?> <a href="<?php the_permalink() ?>"><?php the_time('F jS, Y') ?></a><?php endif;?>
		<?php if (($hidden[$themeslug.'_hide_author']) != '0'):?><?php printf( __( 'by', 'core' )); ?> <?php the_author_posts_link(); ?> <?php endif;?> 
		<?php if (($hidden[$themeslug.'_hide_categories']) != '0'):?><?php printf( __( 'in', 'core' )); ?> <?php the_category(', ') ?> <?php endif;?>
	</div> <?php
}

/**
* Sets up the WP edit link
*
* @since 1.0
*/
function chimps_edit_link_content() {
	edit_post_link('Edit', '<p>', '</p>');
}

/**
* Sets up the tag area
*
* @since 1.0
*/
function chimps_post_tags_content() {
	global $options, $themeslug; 
	$hidden = $options->get($themeslug.'_hide_byline'); ?>

	<?php if (has_tag() AND ($hidden[$themeslug.'_hide_tags']) != '0'):?>
	<div class="tags">
			<?php the_tags('Tags: ', ', ', '<br />'); ?>
		
	</div><!--end tags--> 
	<?php endif;
}

/**
* End
*/

?>