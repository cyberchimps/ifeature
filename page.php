<?php 
/**
* Page template used by the iFeature theme.
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
	global $options, $themeslug, $post; // call globals
	$page_section_order = get_post_meta($post->ID, 'page_section_order' , true);

/**
* Call the header.
*/
	get_header(); 
	
?>

<div class="container_12">
<?php if (function_exists('chimps_breadcrumbs') && ($options->get($themeslug.'_disable_breadcrumbs') == "1")) { chimps_breadcrumbs(); }?>

	<!--Begin @Core before page content hook-->
		<?php chimps_before_page_content(); ?>
	<!--End @Core before page content hook-->

<?php //calls the Page Elements
	foreach(explode(",", $page_section_order) as $key) {
		$fn = 'chimps_' . $key;
		if(function_exists($fn)) {
			call_user_func_array($fn, array());
		}
	}
?>

	<!--Begin @Core after page content hook-->
		<?php chimps_after_page_content(); ?>
	<!--End @Core after page content hook-->
	
</div>

<div style="clear:both;"></div>
<?php get_footer(); ?>
