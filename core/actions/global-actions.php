<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Global actions used by the CyberChimps Synapse Core Framework
*
* Author: Tyler Cunningham
* Copyright: &#169; 2011
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
* Synapse global actions
*/

add_action( 'synapse_loop', 'synapse_loop_content' );
add_action( 'synapse_post_byline', 'synapse_post_byline_content' );
add_action( 'synapse_edit_link', 'synapse_edit_link_content' );
add_action( 'synapse_post_tags', 'synapse_post_tags_content' );
add_action( 'synapse_post_bar', 'synapse_post_bar_content' );
add_action( 'synapse_fb_like_plus_one', 'synapse_fb_like_plus_one_content' );

/**
* Check for post format type, apply filter based on post format name for easy modification.
*
* @since 1.0
*/
function synapse_loop_content($content) { 

	global $options, $themeslug, $post; //call globals
	
	if (is_single()) {
		 $post_formats = $options->get($themeslug.'_single_post_formats');
		 $featured_images = $options->get($themeslug.'_single_show_featured_images');
		 $excerpts = $options->get($themeslug.'_single_show_excerpts');
	}
	elseif (is_archive()) {
		 $post_formats = $options->get($themeslug.'_archive_post_formats');
		 $featured_images = $options->get($themeslug.'_archive_show_featured_images');
		 $excerpts = $options->get($themeslug.'_archive_show_excerpts');
	}
	else {
		 $post_formats = $options->get($themeslug.'_post_formats');
		 $featured_images = $options->get($themeslug.'_show_featured_images');
		 $excerpts = $options->get($themeslug.'_show_excerpts');
	}
	
	if (get_post_format() == '') {
		$format = "default";
	}
	else {
		$format = get_post_format();
	} ?>
		
		<?php ob_start(); ?>
			
			<?php if ($post_formats != '0') : ?>
			<div class="postformats"><!--begin format icon-->
				<img src="<?php echo get_template_directory_uri(); ?>/images/formats/<?php echo $format ;?>.png" alt="formats" />
			</div><!--end format-icon-->
			<?php endif; ?>
				<h2 class="posts_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					<!--Call @Core Meta hook-->
			<?php synapse_post_byline(); ?>
				<?php
				if ( has_post_thumbnail() && $featured_images == '1') {
 		 			echo '<div class="featured-image">';
 		 			echo '<a href="' . get_permalink($post->ID) . '" >';
 		 				the_post_thumbnail();
  					echo '</a>';
  					echo '</div>';
				}
			?>	
				<div class="entry" <?php if ( has_post_thumbnail() && $featured_images == '1' ) { echo 'style="min-height: 115px;" '; }?>>
					<?php 
						if ($excerpts == '1' && !is_single() ) {
						the_excerpt();
						}
						else {
							the_content(__('Read more&#8230;', 'core'));
						}
					 ?>
				</div><!--end entry-->
				
				<div class='clear'>&nbsp;</div>
			<?php	
		
		$content = ob_get_clean();
		$content = apply_filters( 'synapse_post_formats_'.$format.'_content', $content );
	
		echo $content; 
}

/**
* Sets up the HTML for the postbar area.
*
* @since 3.1
*/
function synapse_post_bar_content() { 
	global $options, $themeslug; 
	
	if (is_single()) {
		$hidden = $options->get($themeslug.'_single_hide_byline'); 
	}
	elseif (is_archive()) {
		$hidden = $options->get($themeslug.'_archive_hide_byline'); 
	}
	else {
		$hidden = $options->get($themeslug.'_hide_byline'); 
	}?>
	
		<div id="postbar">
				<div class="six columns" id="share">
					<?php if (($hidden[$themeslug.'_hide_share']) != '0'):?>
					&nbsp;<a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/share/facebook.png" alt="Share on Facebook" height="16px" width="16px" /></a> 
					<a href="http://twitter.com/home?status=<?php the_permalink() ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/share/twitter.png" alt="Share on Twitter" height="16px" width="16px" /></a> 
					<a href="http://reddit.com/submit?url=<?php the_permalink() ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/share/reddit.png" alt="Share on Reddit" height="16px" width="16px" /></a> <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/share/linkedin.png" alt="Share on LinkedIn" height="16px" width="16px" /></a>	
					<?php endif;?>
				</div><!--end share-->
				<div class="six columns" id="comments">
					<?php if (($hidden[$themeslug.'_hide_comments']) != '0'):?>
					<?php comments_popup_link( __('No Comments', 'core' ), __('1 Comment', 'core' ), __('% Comments' , 'core' )); //need a filer here ?>&nbsp;&nbsp;<img src="<?php echo get_template_directory_uri(); ?>/images/Commentsgrey.png" alt="comments"/>&nbsp;
					<?php endif;?>
				</div><!--end comments-->
		</div><!--end postbar--> 
	<?php
}

/**
* Sets the post byline information (author, date, category). 
*
* @since 1.0
*/
function synapse_post_byline_content() {
	global $options, $themeslug; //call globals.  
	if (is_single()) {
		$hidden = $options->get($themeslug.'_single_hide_byline'); 
	}
	elseif (is_archive()) {
		$hidden = $options->get($themeslug.'_archive_hide_byline'); 
	}
	else {
		$hidden = $options->get($themeslug.'_hide_byline'); 
	}?>
	
	<div class="meta">
		<?php if (($hidden[$themeslug.'_hide_date']) != '0'):?> <?php printf( __( 'Published on', 'core' )); ?> <a href="<?php the_permalink() ?>"><?php echo get_the_date(); ?></a><?php endif;?>
		<?php if (($hidden[$themeslug.'_hide_author']) != '0'):?><?php printf( __( 'by', 'core' )); ?> <?php the_author_posts_link(); ?> <?php endif;?> 
		<?php if (($hidden[$themeslug.'_hide_categories']) != '0'):?><?php printf( __( 'in', 'core' )); ?> <?php the_category(', ') ?> <?php endif;?>
	</div> <?php
}

/**
* Sets up the WP edit link
*
* @since 1.0
*/
function synapse_edit_link_content() {
	edit_post_link('Edit', '<p>', '</p>');
}

/**
* Sets up the tag area
*
* @since 1.0
*/
function synapse_post_tags_content() {
	global $options, $themeslug; 
	if (is_single()) {
		$hidden = $options->get($themeslug.'_single_hide_byline'); 
	}
	elseif (is_archive()) {
		$hidden = $options->get($themeslug.'_archive_hide_byline'); 
	}
	else {
		$hidden = $options->get($themeslug.'_hide_byline'); 
	}?>

	<?php if (has_tag() AND ($hidden[$themeslug.'_hide_tags']) != '0'):?>
	<div class="tags">
			<?php the_tags( __('Tags: ', 'core' ), ', ', '<br />'); ?>
		
	</div><!--end tags--> 
	<?php endif;
}

/**
* Sets up the Facebook Like and Google Plus One area
*
* @since 3.1
*/
function synapse_fb_like_plus_one_content() {
	global $options, $themeslug; 
	
	if (is_single()) {
		 $fb = $options->get($themeslug.'_single_show_fb_like');
		 $gplus = $options->get($themeslug.'_single_show_gplus');
	}
	elseif (is_archive()) {
		 $fb = $options->get($themeslug.'_archive_show_fb_like');
		 $gplus = $options->get($themeslug.'_archive_show_gplus');
	}
	else {
		 $fb = $options->get($themeslug.'_show_fb_like');
		 $gplus = $options->get($themeslug.'_show_gplus');
	}?>

	<?php if ($gplus == "1"):?>
		<div class="gplusone">	
			<g:plusone size="standard" count="true" href="<?php the_permalink() ?>"></g:plusone>
		</div>
	<?php endif;?>
						
	<?php if ($fb == "1"):?>			
		<div id="fb">
			<iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink() ?>&layout=standard&show_faces=true&width=450&action=like&colorscheme=light" scrolling="no" frameborder="0"  allowTransparency="true" style="border:none; overflow:hidden; width:330px; height:28px"></iframe>
		</div>
	<?php endif;
}

/**
* End
*/

?>