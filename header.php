<?php 
/**
* Header template used by the iFeature theme.
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
	global $themename, $themeslug, $options;
	
/**
* Initialize the header content.
*/ 
	ifeature_header_content_init(); 
	
?>
<!-- Begin @Core head_tag hook content-->
	<?php chimps_head_tag(); ?>
<!-- End @Core head_tag hook content-->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> <!-- wp_enqueue_script( 'comment-reply' );-->
<?php wp_head(); ?> <!-- wp_head();-->
	
</head> <!-- closing head tag-->

<!-- Begin @Core after_head_tag hook content-->
	<?php chimps_after_head_tag(); ?>
<!-- End @Core after_head_tag hook content-->
	
<!-- Begin @Core before_header hook  content-->
	<?php chimps_before_header(); ?> 
<!-- End @Core before_header hook content -->
			
	<header>
	
		<!-- Begin @iFeature header content hook-->
			<?php ifeature_header_content(); ?> 
		<!-- End @iFeature header content hook -->	

		<!-- Begin @Core navigation contact area hook -->
			<?php chimps_navigation(); ?> 
		<!-- End @Core navigation contact area hook -->
				<div class='clear'>&nbsp;</div>
			</header>

<div class="container_12"><!--main wrap-->				
<!-- Begin @Core after_header hook -->
	<?php chimps_after_header(); ?> 
<!-- End @Core after_header hook -->