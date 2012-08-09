<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;


/**
* Pagination actions used by the CyberChimps Synapse Core Framework
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
* Synapse pagination actions
*/
add_action('synapse_pagination', 'synapse_pagination_content');
add_action('synapse_link_pages', 'synapse_link_pages_content');
add_action('synapse_post_pagination', 'synapse_post_pagination_content');

/**
* Sets up the post index pagination.
*
* @since 1.0
*/
function synapse_pagination_content($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo '<div class="pagination"><span>'.__( 'Page', 'core' ).' '.$paged.' '.__( 'of', 'core' ).' '.$pages.'</span>';
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<a href="'.get_pagenum_link(1).'">'.__( '&laquo; First', 'core' ).'</a>';
         if($paged > 1 && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged - 1).'">'.__( '&lsaquo; Previous', 'core' ).'</a>';
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged + 1).'"">'.__( 'Next &rsaquo;', 'core').'</a>';
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<a href="'.get_pagenum_link($pages).'">'.__( 'Last &raquo;', 'core' ).'</a>';
         echo "</div>\n";
     }
}

/**
* Sets up the previous post link and applies a filter to the link text.
*
* @since 1.0
*/
function synapse_previous_posts() {
	$previous_text = apply_filters('synapse_previous_posts_text', '&laquo; Older Entries' ); 
	
	echo "<div class='pagnext-posts'>";
	next_posts_link( $previous_text );
	echo "</div>";
}

/**
* Sets up the next post link and applies a filter to the link text. 
*
* @since 1.0
*/
function synapse_newer_posts() {
	$newer_text = apply_filters('synapse_newer_posts_text', 'Newer Entries &raquo;' );
	
	echo "<div class='pagprev-posts'>";
	previous_posts_link( $newer_text );
	echo "</div>";
}

/**
* Sets up the WP link pages
*
* @since 1.0
*/
function synapse_link_pages_content() {
	 wp_link_pages(array('before' =>  __('Pages:', 'core' ) , 'next_or_number' => 'number'));
}

/**
* Post pagination links 
*
* @since 1.0
*/
function synapse_post_pagination_content() {
	global $options, $themeslug?>
	
	<?php if ($options->get($themeslug.'_post_pagination') != "0"):?>
	<div class="prev-posts-single"><?php previous_post_link(); ?></div> <div class="next-posts-single"><?php next_post_link(); ?></div>
	<?php endif; 
}

/**
* End
*/

?>