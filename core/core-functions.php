<?php
/**
* CyberChimps Core Framework functions
*
* Authors: Tyler Cunningham, Ben Allfree
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
* Establishes 'core' as the textdomain, sets $locale and file path
*
* @since 1.0
*/
function chimps_text_domain() {
	load_theme_textdomain( 'core', TEMPLATEPATH . '/core/languages' );

	    $locale = get_locale();
	    $locale_file = TEMPLATEPATH . "/core/languages/$locale.php";
	    if ( is_readable( $locale_file ) )
		    require_once( $locale_file );
		
		return;    
}

	add_theme_support(
		'post-formats',
		array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
	);

/**
* End
*/
		    
?>