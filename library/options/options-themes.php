<?php
/* 
	Options	Themes
	Author: Tyler Cunningham
	Establishes the CyberChimps Themes page.
	Copyright (C) 2011 CyberChimps
	Version 2.0
	
*/


// Add scripts and stylesheet

function ifeature_enqueue_store_styles() {
 
 	global $themename, $themeslug, $options;
 	wp_register_style($themeslug.'storecss', get_template_directory_uri(). '/library/options/theme-options.css');

      
    wp_enqueue_style($themeslug.'storecss');  
}

// Add page to the menu
function cyberchimps_store_add_menu() {
	$page = add_theme_page('CyberChimps Store Page', 'CyberChimps Themes', 'administrator', 'themes', 'cyberchimps_store_page_init');
	
	
  add_action('admin_print_styles-' . $page, 'ifeature_enqueue_store_styles');  

}

add_action('admin_menu', 'cyberchimps_store_add_menu');

// Create the page
function cyberchimps_store_page_init() {
	$root = get_template_directory_uri(); 
?>

<div style="text-align: left;margin: 10px 0 10px 10px;padding: 0px;border:0;width: 860px;">
	<div style="margin: 0 0 15px 0;">
		<a href="http://cyberchimps.com" target="_blank"><img src="<?php echo $root ;?>/images/themes/cyberchimps.png" /></a>
		<br />
		<font size="4"><b>Professional WordPress Themes</b></font>
		<br /><br />
		<div class="menu">
		<ul>
			<li><a href="http://cyberchimps.com/support" target="_blank">Support</a></li>
			<li><a href="http://cyberchimps.com/ifeature-free/docs/" target="_blank">Documentation</a></li>
			<li><a href="http://cyberchimps.com/forum/" target="_blank">Forum</a></li>
			<li><a href="http://twitter.com/#!/cyberchimps" target="_blank">Twitter</a></li>
			<li><a href="http://cyberchimps.com/store/" target="_blank">CyberChimps Store</a></li>
		</ul>
	</div>
	<div style="clear: both;"></div>

	</div>
	<div id="container">
		<div style="float: left;width: 300px;margin-right: 10px;">
		
		<ul>
		<li style="margin-top: 10px;">
		<a href="http://cyberchimps.com/businesspro/" target="_blank"><img src="<?php echo $root ;?>/images/themes/bizpro.png" /></a></li>
		<li style="margin-top: 30px;">
		<a href="http://cyberchimps.com/ifeaturepro/" target="_blank"><img src="<?php echo $root ;?>/images/themes/ifeaturepro2thumb.png" /></a></li>
		<li style="margin-top: 30px;">
		<a href="http://cyberchimps.com/neuropro/" target="_blank"><img src="<?php echo $root ;?>/images/themes/neuropro.png" /></a></li>
		</ul>
		
		</div>
		
		<div style="margin: 0;float: left;width: 550px;height: 1% /* Holly hack for Peekaboo Bug */">
		
		<ul>
		
		<li style="margin-top: 18px;">
		<font size="3"><a href="http://cyberchimps.com/businesspro/" target="_blank"><b>Business Pro</b></a></font>
		<br /><br />
		Business Pro is a Professional WordPress Theme. Business Pro gives your company the tools to turn WordPress into a modern feature rich Content Management System (CMS).
		<br /><br /> Business Pro offers intuitive options enabling any business to use WordPress as their content management system. Business Pro offers designers and developers Custom CSS, Import / Export options, and support for CSS3, and HTML5. Even if you are not a designer, Business Pro is built to be business friendly.
		<br /><br />
		<a href="http://cyberchimps.com/businesspro" target="_blank"><img src="<?php echo $root ;?>/images/themes/buybizpro.png" height="40" width="120" /></a>
		</li>
		
		<li style="margin-top: 48px;">
		<font size="3"><a href="http://cyberchimps.com/ifeaturepro/" target="_blank"><b>iFeature Pro</b></a></font>
		<br /><br />
		iFeature Pro turns WordPress into a beautifully designed feature rich Content Management System (CMS).

We thought differently when developing iFeature Pro, and took CyberChimps years of experience developing websites for clients and built user friendly settings for the most requested features from the ground up.
<br /><br />
iFeature Pro is an advanced WordPress theme released under the GNU GPL v2. iFeature Pro works great in Chrome, Safari, FireFox, and Internet Explorer 7, 8, and 9 (we do not support Internet Explorer 6). <br /><br />
		<a href="http://cyberchimps.com/ifeaturepro/" target="_blank"><img src="<?php echo $root ;?>/images/themes/buyifeaturepro.png" height="40" width="120" /></a>
		</li>
		
		<li style="margin-top: 48px;">
		<font size="3"><a href="http://cyberchimps.com/neuropro/" target="_blank"><b>Neuro Pro</b></a></font>
		<br /><br />
		Neuro Pro gives you the tools to turn WordPress into a modern feature rich Content Management System (CMS).

We built Neuro Pro on the same solid foundation as iFeature Pro, and added new powerful design options. Neuro Pro features intuitive design options allowing anyone the ability to easily customize the look and feel of WordPress. We also included several popular color scheme to choose from, as well as beautiful modern background images. Neuro Pro also offers designers and developers Custom CSS, Import / Export options, and support for CSS3 and HTML5.
<br /><br />
Neuro Pro is a next generation WordPress theme released under the GNU GPL v2. Neuro Pro works great in Chrome, Safari, FireFox, and Internet Explorer 7, 8, and 9 (we do not support Internet Explorer 6).
		<br /> <br />
		<a href="http://cyberchimps.com/neuropro/" target="_blank"><img src="<?php echo $root ;?>/images/themes/buyneuropro.png" height="40" width="120" /></a>
		</li>
		<br /><br />
		</div>
	</div>
</div>

<?php
}
