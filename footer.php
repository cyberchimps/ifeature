<?php
/**
* Footer template used by the iFeature theme.
*
* Authors: Tyler Cunningham, Trent Lapinski.
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package iFeature
* @since 3.1
*/

global $options, $themeslug;

?>

</div><!--end container 12 main wrap-->	

<div id="footer">
     <div class="container_12">
     
    <!-- Begin @Core before footer hook content-->
		<?php chimps_before_footer(); ?>
	<!-- End @Core before footer hook content-->
    	
	<!-- Begin @Core footer hook content-->
		<?php chimps_footer(); ?>
	<!-- End @Core footer hook content-->
	
	<!-- Begin @Core after footer hook content-->
		<?php chimps_after_footer(); ?>
	<!-- End @Core after footer hook content-->
			   
	</div><!--end footer_wrap-->
</div><!--end footer-->
	
	<div id="afterfooter">
		<div id="afterfooterwrap">
		
		<!-- Begin @Core secondary footer hook content-->
			<?php chimps_secondary_footer(); ?>
		<!-- End @Core secondary footer hook content-->
				
		</div>  <!--end afterfooterwrap-->	
	</div> <!--end afterfooter-->	
	
	<?php wp_footer(); ?>	
</body>

</html>
