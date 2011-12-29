<?php 
/**
* 404 page template used by the iFeature theme.
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

/* Header call. */

	get_header(); 
	
/* End header. */

?>

<div class="container_12">

	<div id="content" class="grid_12">
		<div class="content_padding">
		
			<!-- Begin @Core before_404 hook content-->
      			<?php chimps_before_404(); ?>
      		<!-- Begin @Core before_404 hook content-->
		
      		<!-- Begin @Core 404 hook content-->
      			<?php chimps_404(); ?>
      		<!-- Begin @Core 404 hook content-->
      		
      		<!-- Begin @Core after_404 hook content-->
      			<?php chimps_after_404(); ?>
      		<!-- Begin @Core after_404 hook content-->
      		
		</div><!--end content_padding-->
	</div><!--end content_left-->

</div><!--end content_wrap-->
<div class='clear'>&nbsp;</div>

<?php get_footer(); ?>