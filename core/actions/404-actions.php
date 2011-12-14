<?php
/**
* 404 actions used by the CyberChimps Core Framework
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
* Core 404 actions
*/
add_action( 'chimps_404', 'chimps_404_content' );

/**
* Sets up the 404 content message
*
* @since 1.0 
*/
function chimps_404_content() {
	$message_text = apply_filters( 'chimps_404_message', 'Error 404' ); ?>
	<div class="error"><?php printf( __( $message_text, 'core' )); ?><br /></div> <?php
}

/**
* End
*/

?>