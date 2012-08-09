<?php
/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* 404 actions used by the CyberChimps Synapse Core Framework
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
* Synapse 404 actions
*/
add_action( 'synapse_404', 'synapse_404_content' );

/**
* Sets up the 404 content message
*
* @since 1.0 
*/
function synapse_404_content() {
	global $options, $themeslug; // call globals
	
	if ($options->get($themeslug.'_custom_404') != '') {
		$message_text = $options->get($themeslug.'_custom_404');
	}
	else {
		$message_text = apply_filters( 'synapse_404_message', 'Error 404' );
	} ?>
	<div class="error"><?php printf( $message_text ); ?><br />	</div> 
	<?php
}

/**
* End
*/

?>