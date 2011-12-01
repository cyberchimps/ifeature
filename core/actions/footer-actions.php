<?php
/**
* Footer actions used by the CyberChimps Core Framework 
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
* Core footer actions
*/
add_action ( 'chimps_footer', 'chimps_footer_widgets' );
add_action ( 'chimps_footer', 'chimps_analytics' );

add_action ( 'chimps_afterfooter', 'chimps_afterfooter_copyright' );
add_action ( 'chimps_afterfooter', 'chimps_afterfooter_menu' );
add_action ( 'chimps_afterfooter', 'chimps_afterfooter_credit' );


/**
* Set the footer widgetized area.
*
* @since 1.0
*/
function chimps_footer_widgets() { 

   	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer") ) { ?>
		
		<div class="grid_3 footer-widgets">
			<h3 class="footer-widget-title"><?php printf( __( 'Recent Posts', 'core' )); ?></h3>
			<ul>
				<?php wp_get_archives('type=postbypost&limit=4'); ?>
			</ul>
		</div>
		
		<div class="grid_3 footer-widgets">
			<h3 class="footer-widget-title"><?php printf( __( 'Archives', 'core' )); ?></h3>
			<ul>
				<?php wp_get_archives('type=monthly&limit=16'); ?>
			</ul>
		</div>

		<div class="grid_3 footer-widgets">
			<h3 class="footer-widget-title"><?php printf( __( 'Links', 'core' )); ?></h3>
			<ul>
				<?php wp_list_bookmarks('categorize=0&title_li='); ?>
			</ul>
		</div>

		<div class="grid_3 footer-widgets">
			<h3 class="footer-widget-title"><?php printf( __( 'WordPress', 'core' )); ?></h3>
			<ul>
    		<?php wp_register(); ?>
    		<li><?php wp_loginout(); ?></li>
    		<li><a href="<?php echo esc_url( __('http://wordpress.org/', 'core' )); ?>" target="_blank" title="<?php esc_attr_e('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'core'); ?>"> <?php printf( __('WordPress', 'core' )); ?></a></li>
    		<?php wp_meta(); ?>
    		</ul>
		</div>
		
			<?php }
			
			echo "<div class='clear'></div> ";

}

/**
* Inserts the Google Analytics script from the theme options.
*
* @since 1.0
*/
function chimps_analytics() {
	global $options, $themeslug; //call globals
	
	echo stripslashes ($options->get($themeslug.'_ga_code'));
}

/**
* Adds the afterfooter copyright area. 
*
* @since 1.0
*/
function chimps_afterfooter_copyright() {
	global $options, $themeslug; //call globals
		
	if ($options->get($themeslug.'_footer_text') == "") {
		$copyright =  get_bloginfo('name');
	}
	else {
		$copyright = $options->get($themeslug.'_footer_text');
	}
	
	echo "<div id='afterfootercopyright'>";
		echo "&copy; $copyright";
	echo "</div>";
	

}

/**
* Adds the afterfooter menu.
*
* @since 1.0
*/
function chimps_afterfooter_menu() {
	echo "<div id='afterfootermenu'>";
	wp_nav_menu( array(
		'theme_location' => 'footer-menu', 
	)); 
	echo "</div>";
}

/**
* Adds the CyberChimps credit.
*
* @since 1.0
*/
function chimps_afterfooter_credit() { 
	global $options, $themeslug; //call globals
	
	if ($options->get($themeslug.'_hide_link') != "1") {?>
		
		<div class="credit">
			<a href="http://cyberchimps.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/achimps.png" alt="credit" /></a>
		</div> 
	
	<?php }
}

/**
* End
*/

?>