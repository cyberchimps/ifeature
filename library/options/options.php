<?php   

/* 
Portions of code referenced from Theme4Press http://theme4press.com/
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html  
*/

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' ); 


$options = get_option('ifeature');

/**
 * Init plugin options to white list our options
 */  
function theme_options_init() {
	
	register_setting( 'if_options', 'ifeature', 'theme_options_validate' );
	wp_register_script('ifjquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"), false, '1.4.4');
  wp_register_script('ifjqueryui', get_template_directory_uri(). '/library/js/jquery-ui.js');
  wp_register_script('ifjquerycookie', get_template_directory_uri(). '/library/js/jquery-cookie.js');
  wp_register_script('ifcookie', get_template_directory_uri(). '/library/js/cookie.js');
  wp_register_style('ifcss', get_template_directory_uri(). '/library/options/theme-options.css');
  wp_register_script('ifcolor', get_template_directory_uri(). '/library/js/jscolor/jscolor.js');
}


$themename = "iFeature";
$template_url = get_template_directory_uri();


/**
 * Load up the menu page
 */
 
function theme_options_add_page() {
global $themename, $shortname, $options;
  $page = add_theme_page($themename." Settings", "".$themename." Settings", 'edit_theme_options', 'theme_options', 'theme_options_do_page');  

  add_action('admin_print_scripts-' . $page, 'if_scripts');
  add_action('admin_print_styles-' . $page, 'if_styles');  
 
}

/* Include options functions */

	require_once ( get_template_directory() . '/library/options/options-functions.php' );

/* End options functions */


$select_font = array(
	'0' => array('value' =>'Lucida Grande','label' => 'Lucida Grande (default)'),'1' => array('value' =>'Allan','label' => 'Allan'),'2' => array('value' =>'Arial','label' => 'Arial'),'3' => array('value' =>'Cantarell','label' => 'Cantarell'),'4' => array('value' =>'Courier New','label' => 'Courier New'),'5' => array('value' =>'Georgia','label' => 'Georgia'),'6' => array('value' =>'Tahoma','label' => 'Tahoma'),'7' => array('value' =>'Times New Roman','label' => 'Times New Roman'),'8' => array('value' =>'Ubuntu','label' => 'Ubuntu'),

);

$select_featured_images = array(
'0' => array('value' => 'left','label' => 'Left (default)' ),'1' => array('value' => 'center','label' => 'Center'), '2' => array('value' => 'right','label' => 'Right'),

);

$shortname = "if";

$optionlist = array (

array( "id" => $shortname,
	"type" => "open-tab"),

array( "type" => "open"),
array( "type" => "close"),

array( "type" => "close-tab"),

// General

array( "id" => $shortname."-tab1",
	"type" => "open-tab"),

array( "type" => "open"),

array( "name" => "Help",  
    "desc" => "",  
    "id" => $shortname."_general_faq",  
    "type" => "general_faq",  
    "std" => ""),

array( "name" => "Logo URL",  
    "desc" => "Use the image uploader or enter your own URL into the input field to use an image as your logo. To display the site title as text, leave blank.",  
    "id" => $shortname."_logo",  
    "type" => "upload",  
    "std" => ""),  
 
    
array( "name" => "Header Contact Area",  
    "desc" => "Enter contact info such as phone number for the top right corner of the header. It can be HTML (to hide enter the word: hide).",  
    "id" => $shortname."_header_contact",  
    "type" => "textarea",
    "std" => ""),
    
array( "name" => "Custom Favicon",  
    "desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",  
    "id" => $shortname."_favicon",  
    "type" => "upload2",  
    "std" => ""), 
    
array( "name" => "Footer Copyright",  
    "desc" => "Enter Copyright text used on the right side of the footer. It can be HTML",  
    "id" => $shortname."_footer_text",  
    "type" => "textarea",  
    "std" => ""),

array( "name" => "Google Analytics Code",  
    "desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically be added to the footer.",  
    "id" => $shortname."_ga_code",  
    "type" => "textarea2",  
    "std" => ""),  

array( "type" => "close"),

array( "type" => "close-tab"),



// Design

array( "id" => $shortname."-tab2",
	"type" => "open-tab"),
 
array( "type" => "open"),

array( "name" => "Help",  
    "desc" => "",  
    "id" => $shortname."_general_faq",  
    "type" => "design_faq",  
    "std" => ""),

array( "name" => "Choose a font:",  
    "desc" => "(Default is Cantarell)",  
    "id" => $shortname."_font",  
    "type" => "select1",  
    "std" => ""),
    
array( "name" => "Link Color",  
    "desc" => "Use the color picker to select the site link color",  
    "id" => $shortname."_link_color",  
      "type" => "color2",  
    "std" => "false"),
    
array( "name" => "Enable Widget Title Background",  
    "desc" => "Check this box to enable the classic widget title backgrounds.",  
    "id" => $shortname."_widget_title_bg",  
      "type" => "checkbox",  
    "std" => "false"),

array( "name" => "Want more options?",  
    "desc" => "",  
    "id" => $shortname."_designl_ad",  
    "type" => "design_ad",  
    "std" => ""),

array( "type" => "close"),

array( "type" => "close-tab"),


// Blog

array( "id" => $shortname."-tab3",
	"type" => "open-tab"),
 
array( "type" => "open"),

array( "name" => "Help",  
    "desc" => "",  
    "id" => $shortname."_blog_faq",  
    "type" => "blog_faq",  
    "std" => ""),

array( "name" => "Post Excerpts",  
    "desc" => "Use the following options to control excerpts.",  
    "id" => $shortname."_excerpts",  
      "type" => "excerpts",  
    "std" => "false"),

array( "name" => "Featured Images",  
    "desc" => "Use the following options to control featured image alignment and size.",  
    "id" => $shortname."_featured_images",  
      "type" => "featured",  
    "std" => "false"),

array( "name" => "Hide Post Elements",  
    "desc" => "Use the following checkboxes to hide various post elements.",  
    "id" => $shortname."_hide_post_elements",  
    "type" => "post",  
    "std" => "false"),

array(  "name" => "Show Facebook Like Button",
	"desc" => "Check this box to show the Facebook Like Button on blog posts",
	"id" => $shortname."_show_fb_like",
	"type" => "checkbox",
	"std" => "false"),  
	
array(  "name" => "Show Google +1 button",
	"desc" => "Check this box to show the Google +1 Button on blog posts",
	"id" => $shortname."_show_gplus",
	"type" => "checkbox",
	"std" => "false"),   

array( "name" => "Home Description",  
    "desc" => "Enter the META description of your homepage here.",  
    "id" => $shortname."_home_description",  
    "type" => "textarea",  
    "std" => ""),
    
array( "name" => "Home Keywords",  
    "desc" => "Enter the META keywords of your homepage here (separated by commas).",  
    "id" => $shortname."_home_keywords",  
    "type" => "textarea",  
    "std" => ""),
    
array( "name" => "Optional Home Title",  
    "desc" => "Enter an alternative title of your homepage here (default is site tagline).",  
    "id" => "if_home_title",  
    "type" => "text",  
    "std" => ""),


array( "type" => "close"),
array( "type" => "close-tab"),

// iFeature Slider

array( "id" => $shortname."-tab4",
	"type" => "open-tab"),

array( "type" => "open"),

array( "name" => "Help",  
    "desc" => "",  
    "id" => $shortname."_slider_faq",  
    "type" => "slider_faq",  
    "std" => ""),

array( "name" => "Hide iFeature Slider",  
    "desc" => "Check this box to hide the Feature Slider on the homepage.",  
    "id" => $shortname."_hide_slider",  
    "type" => "checkbox",  
    "std" => "false"),
    
array( "name" => "Show Posts From Blog Category:",  
    "desc" => "(Default is all)",  
    "id" => $shortname."_slider_category",  
    "type" => "select6",  
    "std" => ""),

array( "name" => "Number of Featured Posts:",  
    "desc" => "(Default is 5)",  
    "id" => $shortname."_slider_posts_number",  
    "type" => "text",  
    "std" => ""),  

array( "name" => "Slider Delay Time (in milliseconds):",  
    "desc" => "(Default is 3500)",  
    "id" => $shortname."_slider_delay",  
    "type" => "text",  
    "std" => ""),
    
array( "name" => "Hide the Navigation:",  
    "desc" => "Check to disable the slider navigation",  
    "id" => $shortname."_slider_navigation",    
   	"type" => "checkbox",
        "std" => "false"),  

  

array( "type" => "close"),   

array( "type" => "close-tab"),

// Social

array( "id" => $shortname."-tab5",
	"type" => "open-tab"),
 
array( "type" => "open"),

array( "name" => "Help",  
    "desc" => "",  
    "id" => $shortname."_social_faq",  
    "type" => "social_faq",  
    "std" => ""),

array( "name" => "Facebook URL",  
    "desc" => "Enter your Facebook page URL for the Facebook social icon.",  
    "id" => $shortname."_facebook",  
    "type" => "facebook",  
    "std" => "http://facebook.com"),

array( "name" => "Twitter URL",  
    "desc" => "Enter your Twitter URL for Twitter social icon.",  
    "id" => $shortname."_twitter",  
    "type" => "twitter",  
    "std" => "http://twitter.com"),
    
array( "name" => "Google Plus URL",  
    "desc" => "Enter your Google Plus url (we recommend using the http://gplus.to/ shortener).",  
    "id" => $shortname."_gplus",  
    "type" => "gplus",  
    "std" => "https://plus.google.com"),
    
array( "name" => "LinkedIn URL",  
    "desc" => "Enter your LinkedIn URL for the LinkedIn social icon.",  
    "id" => $shortname."_linkedin",  
    "type" => "linkedin",  
    "std" => "http://linkedin.com"),  
    
array( "name" => "YouTube URL",  
    "desc" => "Enter your YouTube URL for the YouTube social icon.",  
    "id" => $shortname."_youtube",  
    "type" => "youtube",  
    "std" => "http://youtube.com"),  
    
array( "name" => "Google Maps URL",  
    "desc" => "Enter your Google Maps URL for the Google Maps social icon.",  
    "id" => $shortname."_googlemaps",  
    "type" => "googlemaps",  
    "std" => "http://google.com/maps"),  

array( "name" => "Email",  
    "desc" => "Enter your contact email address for email social icon.",  
    "id" => $shortname."_email",  
    "type" => "email",  
    "std" => "no@way.com"),
    
array( "name" => "Custom RSS Link",  
    "desc" => "Enter Feedburner URL, or leave blank for default RSS feed.",  
    "id" => $shortname."_rsslink",  
    "type" => "rss",  
    "std" => ""),   

array( "type" => "close"),
array( "type" => "close-tab"),


);  

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $themename, $shortname, $optionlist, $select_featured_images,  $select_font;
  

	if ( ! isset( $_REQUEST['updated'] ) ) {
		$_REQUEST['updated'] = false; 
} 
  if( isset( $_REQUEST['reset'] )) { 
            global $wpdb;
            $query = "DELETE FROM $wpdb->options WHERE option_name LIKE 'ifeature'";
            $wpdb->query($query); 
            die;
            
     } 
   
?>

	<div class="wrap">
  
<br />
<img src="<?php echo get_template_directory_uri() ;?>/images/options/ifeature.png" />
<br /><br />
<a href="http://cyberchimps.com/ifeaturepro/" target="_blank"><img src="<?php echo get_template_directory_uri() ;?>/images/options/upgrade.png" /></a>
<br /><br />

		<?php if ( false !== $_REQUEST['updated'] ) { ?>
		<?php echo '<div id="message" class="updated fade" style="float:left;"><p><strong>'.$name.' settings saved</strong></p></div>'; ?>
    
    <?php } if( isset( $_REQUEST['reset'] )) { echo '<div id="message" class="updated fade"><p><strong>'.$name.' settings reset</strong></p></div>'; } ?>  
				


  <form method="post" action="options.php" enctype="multipart/form-data">
  
    <p class="submit" style="clear:left;float: right;">
				<input type="submit" class="button-primary" value="Save Settings" />   
	</p>
	
	<div class="menu">
	<ul>
		<li><a href="http://cyberchimps.com/support" target="_blank">Support</a></li>
		<li><a href="http://cyberchimps.com/ifeature-free/docs/">Documentation</a></li>
		<li><a href="http://cyberchimps.com/forum/" target="_blank">Forum</a></li>
		<li><a href="http://twitter.com/#!/cyberchimps" target="_blank">Twitter</a></li>
		<li><a href="http://www.facebook.com/CyberChimps" target="_blank">Facebook</a></li>
		<li><a href="http://cyberchimps.com/store/" target="_blank">CyberChimps Store</a></li>
		
	</ul>
	</div>

      
    <div id="tabs" style="clear:both;">   
    <ul class="tabNavigation">
        <li><a href="#if-tab1"><span>General</span></a></li>
        <li><a href="#if-tab2"><span>Design</span></a></li>
        <li><a href="#if-tab3"><span>Blog</span></a></li>
        <li><a href="#if-tab4"><span>iFeature Slider</span></a></li>
        <li><a href="#if-tab5"><span>Social</span></a></li>        
      
    
    </ul>
    
    <div class="tabContainer">
		
			<?php settings_fields( 'if_options' ); ?>
			<?php $options = get_option( 'ifeature' ); ?>

			<table class="form-table">   

      <?php foreach ($optionlist as $value) {  
switch ( $value['type'] ) {
 
case "open":
?>

<table width="100%" border="0" style="padding:10px;">

 
<?php break;
 
case "close":
?>


</table><br />
 
<?php break;


case "open-tab":
?>

<div id="<?php echo $value['id']; ?>">

 
<?php break;
 
case "close-tab":
?>

</div>
 
<?php break; 

case 'general_faq':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%">Read the <a href="http://cyberchimps.com/question/general-settings-tab/" target="_blank">General Options Tab FAQ</a></td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;

case 'design_faq':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%">Read the <a href="http://cyberchimps.com/question/design-settings-tab/" target="_blank">Design Options Tab FAQ</a></td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;

case 'social_faq':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%">Read the <a href="http://cyberchimps.com/question/social-settings-tab/" target="_blank">Social Options Tab FAQ</a></td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;

case 'blog_faq':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%">Read the <a href="http://cyberchimps.com/question/blog-settings-tab/" target="_blank">Blog Options Tab FAQ</a></td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;

case 'slider_faq':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%">Read the <a href="http://cyberchimps.com/question/ifeature-slider-settings-tab/" target="_blank">Slider Options Tab FAQ</a></td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;


case 'design_ad':  
?>  
  
<tr>

    <td width="1%" rowspan="2" valign="middle">  </td>
    <td width="99%"></a>
</td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" ><a href="http://cyberchimps.com/ifeaturepro/" target="_blank"><img src="<?php echo get_template_directory_uri() ;?>/images/options/upgradedesign.jpg" height="275" width="550" /></td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;


case 'color2':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%">
    
<?php

	if (isset($options['if_link_color']) == "") {
		$picker = '717171';
	}
			
	else {
		$picker = $options['if_link_color']; 
	}
?>

<input type="text" class="color{required:false}" id="ifeature[if_link_color]" name="ifeature[if_link_color]"  value="<?php echo $picker ;?>" style="width: 300px;" maxlength="6">   

<br /><br />
    
    </td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break; 


case 'select6':
?>
<tr>
<td width="15%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></td>
<td width="85%"><select style="width:300px;" name="<?php echo 'ifeature['.$value['id'].']'; ?>">

<?php
								$selected = $options[$value['id']];
								$p = '';
								$r = '';
								
								$terms2 = get_terms('category', 'hide_empty=0');

									$blogoptions = array();
									
									$blogoptions['all'] = "All";

										foreach($terms2 as $term) {

										$blogoptions[$term->slug] = $term->name;

									}
									

								foreach ( $blogoptions as $option ) {
									$label = $option['label'];
									if ( $selected == $option ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option ) . "'>$option</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option ) . "'>$option</option>";      
								}
								echo $p . $r;   
							?>    


</select>

</td>
</tr> 
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;


case 'excerpts':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%">
    <br />
    <input type="checkbox" id="ifeature[if_show_excerpts]" name="ifeature[if_show_excerpts]" value="1" <?php checked( '1', $options['if_show_excerpts'] ); ?>> - Show Excerpts
<br /><br />

	<?php
		if (isset($options['if_excerpt_link_text']) == "")
			$textlink = '(Read More...)';
			
		else
			$textlink = $options['if_excerpt_link_text']; 
	?>
	
   <input type="text" id="ifeature[if_excerpt_link_text]" name="ifeature[if_excerpt_link_text]" value="<?php echo $textlink ;?>"> - Excerpt Link Text
<br /><br />

	<?php
		if (isset($options['if_excerpt_length']) == "")
			$length = '55';
			
		else
			$length = $options['if_excerpt_length']; 
	?>

     <input type="text" id="ifeature[if_excerpt_length]" name="ifeature[if_excerpt_length]" value="<?php echo $length ;?>" > - Excerpt Character Length
<br /><br />

</td>
  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;


case 'post':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%">
    <br />
    <input type="checkbox" id="ifeature[if_hide_author]" name="ifeature[if_hide_author]" value="1" <?php checked( '1', $options['if_hide_author'] ); ?>> - Author
<br /><br />

   <input type="checkbox" id="ifeature[if_hide_categories]" name="ifeature[if_hide_categories]" value="1" <?php checked( '1', $options['if_hide_categories'] ); ?>> - Categories
<br /><br />

   <input type="checkbox" id="ifeature[if_hide_date]" name="ifeature[if_hide_date]" value="1" <?php checked( '1', $options['if_hide_date'] ); ?>> - Date
<br /><br />

   <input type="checkbox" id="ifeature[if_hide_comments]" name="ifeature[if_hide_comments]" value="1" <?php checked( '1', $options['if_hide_comments'] ); ?>> - Comments
<br /><br />

   <input type="checkbox" id="ifeature[if_hide_share]" name="ifeature[if_hide_share]" value="1" <?php checked( '1', $options['if_hide_share'] ); ?>> - Sharing
<br /><br />

   <input type="checkbox" id="ifeature[if_hide_tags]" name="ifeature[if_hide_tags]" value="1" <?php checked( '1', $options['if_hide_tags'] ); ?>> - Tags
<br /><br />

</td>
  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'featured':
?>
<tr>
<td width="15%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></td>
<td width="85%"><select style="width:300px;" name="<?php echo 'ifeature['.$value['id'].']'; ?>">

<?php
								$selected = $options[$value['id']];
								$p = '';
								$r = '';

								foreach ( $select_featured_images as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";      
								}
								echo $p . $r;   
							?>    

</select><br /></br>

Define a custom Featured Image size below (default is 100 by 100):

<br /><br />

<?php

	if (isset($options['if_featured_image_height']) == "") {
			$featureheight = '100';
	}		
	
	else {
		$featureheight = $options['if_featured_image_height']; 
	}
	
		if (isset($options['if_featured_image_width']) == "") {
			$featurewidth = '100';
	}		
	
	else {
		$featurewidth = $options['if_featured_image_width']; 
	}
	
?>

<input type="text" id="ifeature[if_featured_image_height]" name="ifeature[if_featured_image_height]"  value="<?php echo $featureheight ;?>" style="width: 300px;"> - Height

<br /><br />

<input type="text" id="ifeature[if_featured_image_width]" name="ifeature[if_featured_image_width]"  value="<?php echo $featurewidth ;?>" style="width: 300px;"> - Width

</td>
</tr> 
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;


case 'upload':
?>   


<tr>

<td width="15%" rowspan="2" valign="middle"><strong>Custom Logo</strong>


 
<tr>
<td width="85%">


    <?php settings_fields('if_options'); ?>
    <?php do_settings_sections('if'); 
    
   $file = $options['file'];
    
    if ($file != ''){
    
    echo "Logo preview:<br /><br /><img src='{$file['url']}'><br /><br />";}
    echo "<input type='text' name='if_filename_text' size='72' value='{$file['url']}'/>";
    echo "<br />" ;
    echo "<br />" ;
    echo "<input type='file' name='if_filename' size='30' />";?>

    
    <br />
    <small>Upload a logo image to use</small>


<?php
	$options = get_option('ifeature');
	$value = isset($options['file']) ? $options['file'] : '';
?>

</td>
</tr>


        
        <tr>
<td><small></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php break; 

case 'upload2':
?>   


<tr>

<td width="15%" rowspan="2" valign="middle"><strong>Custom Favicon</strong>


 
<tr>
<td width="85%">
<br />

    <?php settings_fields('if_options'); ?>
    <?php do_settings_sections('if'); 
    
    $file2 = $options['file2'];
    
    if ($file2 != ''){
    
    echo "Favicon preview:<br /><br /><img src='{$file2['url']}'><br /><br />";}
    echo "<input type='text' name='if_favfilename_text' size='72' value='{$file2['url']}'/>";
    echo "<br />" ;
    echo "<br />" ;
    echo "<input type='file' name='if_favfilename' size='30' />";?>

    
    <br />
    <small>Upload a favicon image to use</small>


<?php
	$options = get_option('ifeature');
	$value = isset($options['file2']) ? $options['file2'] : '';
?>

</td>
</tr>


        
        <tr>
<td><small></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php break; 
 
case 'facebook':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><input style="width:300px;" name="<?php echo 'ifeature['.$value['id'].']'; ?>" id="<?php echo 'if['.$value['id'].']'; ?>" type="<?php echo $value['type']; ?>" value="<?php if (  $options[$value['id']]  != "") { echo esc_attr($options[$value['id']]) ; } else { echo esc_attr($value['std']) ; } ?>" />
    
    <br /><br />
    <input type="checkbox" id="ifeature[if_hide_facebook]" name="ifeature[if_hide_facebook]" value="1" <?php checked( '1', $options['if_hide_facebook'] ); ?>> - Check this box to hide the Facebook icon. 
    
    </td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;


case 'twitter':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><input style="width:300px;" name="<?php echo 'ifeature['.$value['id'].']'; ?>" id="<?php echo 'if['.$value['id'].']'; ?>" type="<?php echo $value['type']; ?>" value="<?php if (  $options[$value['id']]  != "") { echo esc_attr($options[$value['id']]) ; } else { echo esc_attr($value['std']) ; } ?>" />
    
    <br /><br />
    <input type="checkbox" id="ifeature[if_hide_twitter]" name="ifeature[if_hide_twitter]" value="1" <?php checked( '1', $options['if_hide_twitter'] ); ?>> - Check this box to hide the Twitter icon. 
    
    </td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;

case 'gplus':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><input style="width:300px;" name="<?php echo 'ifeature['.$value['id'].']'; ?>" id="<?php echo 'if['.$value['id'].']'; ?>" type="<?php echo $value['type']; ?>" value="<?php if (  $options[$value['id']]  != "") { echo esc_attr($options[$value['id']]) ; } else { echo esc_attr($value['std']) ; } ?>" />
    
    <br /><br />
    <input type="checkbox" id="ifeature[if_hide_gplus]" name="ifeature[if_hide_gplus]" value="1" <?php checked( '1', $options['if_hide_gplus'] ); ?>> - Check this box to hide the Google + icon. 
    
    </td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;


case 'linkedin':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><input style="width:300px;" name="<?php echo 'ifeature['.$value['id'].']'; ?>" id="<?php echo 'if['.$value['id'].']'; ?>" type="<?php echo $value['type']; ?>" value="<?php if (  $options[$value['id']]  != "") { echo esc_attr($options[$value['id']]) ; } else { echo esc_attr($value['std']) ; } ?>" />
    
    <br /><br />
    <input type="checkbox" id="ifeature[if_hide_linkedin]" name="ifeature[if_hide_linkedin]" value="1" <?php checked( '1', $options['if_hide_linkedin'] ); ?>> - Check this box to hide the LinkedIn icon. 
    
    </td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;


case 'youtube':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><input style="width:300px;" name="<?php echo 'ifeature['.$value['id'].']'; ?>" id="<?php echo 'if['.$value['id'].']'; ?>" type="<?php echo $value['type']; ?>" value="<?php if (  $options[$value['id']]  != "") { echo esc_attr($options[$value['id']]) ; } else { echo esc_attr($value['std']) ; } ?>" />
    
    <br /><br />
    <input type="checkbox" id="ifeature[if_hide_youtube]" name="ifeature[if_hide_youtube]" value="1" <?php checked( '1', $options['if_hide_youtube'] ); ?>> - Check this box to hide the YouTube icon. 
    
    </td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;


case 'googlemaps':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><input style="width:300px;" name="<?php echo 'ifeature['.$value['id'].']'; ?>" id="<?php echo 'if['.$value['id'].']'; ?>" type="<?php echo $value['type']; ?>" value="<?php if (  $options[$value['id']]  != "") { echo esc_attr($options[$value['id']]) ; } else { echo esc_attr($value['std']) ; } ?>" />
    
    <br /><br />
    <input type="checkbox" id="ifeature[if_hide_googlemaps]" name="ifeature[if_hide_googlemaps]" value="1" <?php checked( '1', $options['if_hide_googlemaps'] ); ?>> - Check this box to hide the Google Maps icon. 
    
    </td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;


case 'email':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><input style="width:300px;" name="<?php echo 'ifeature['.$value['id'].']'; ?>" id="<?php echo 'if['.$value['id'].']'; ?>" type="<?php echo $value['type']; ?>" value="<?php if (  $options[$value['id']]  != "") { echo esc_attr($options[$value['id']]) ; } else { echo esc_attr($value['std']) ; } ?>" />
    
    <br /><br />
    <input type="checkbox" id="ifeature[if_hide_email]" name="ifeature[if_hide_email]" value="1" <?php checked( '1', $options['if_hide_email'] ); ?>> - Check this box to hide the Email icon. 
    
    </td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;

case 'rss':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><input style="width:300px;" name="<?php echo 'ifeature['.$value['id'].']'; ?>" id="<?php echo 'if['.$value['id'].']'; ?>" type="<?php echo $value['type']; ?>" value="<?php if (  $options[$value['id']]  != "") { echo esc_attr($options[$value['id']]) ; } else { echo esc_attr($value['std']) ; } ?>" />
    
    <br /><br />
    <input type="checkbox" id="ifeature[if_hide_rss]" name="ifeature[if_hide_rss]" value="1" <?php checked( '1', $options['if_hide_rss'] ); ?>> - Check this box to hide the RSS icon. 
    
    </td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break; 
 
case 'textarea':
?>
 
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong></label> <br /><small><?php echo $value['desc']; ?></small> </td> 
    <td width="85%"><textarea id="<?php echo 'ifeature['.$value['id'].']'; ?>" name="<?php echo 'ifeature['.$value['id'].']'; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php echo esc_textarea( $options[$value['id']] ); ?></textarea><br /></td>  
 
  
 </tr>
 <tr>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr>
<?php break; 

case 'textarea2':
?>
 
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong></label> <br /><small><?php echo $value['desc']; ?></small> </td> 
    <td width="85%"><br /><textarea id="<?php echo 'ifeature['.$value['id'].']'; ?>" name="<?php echo 'ifeature['.$value['id'].']'; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php echo esc_textarea( $options[$value['id']] ); ?></textarea><br /></td>  
 
  
 </tr>
 <tr>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr>
<?php break; 


case 'text':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><input style="width:300px;" name="<?php echo 'ifeature['.$value['id'].']'; ?>" id="<?php echo 'if['.$value['id'].']'; ?>" type="<?php echo $value['type']; ?>" value="<?php if (  $options[$value['id']]  != "") { echo esc_attr($options[$value['id']]) ; } else { echo esc_attr($value['std']) ; } ?>" /></td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;


case 'select1':
?>
<tr>
<td width="15%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></td>
<td width="85%"><select style="width:300px;" name="<?php echo 'ifeature['.$value['id'].']'; ?>">

<?php
								$selected = $options[$value['id']];
								$p = '';
								$r = '';

								foreach ( $select_font as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";      
								}
								echo $p . $r;   
							?>    

</select></td>
</tr> 
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;

 
case "checkbox":
?>
<tr>
<td width="15%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></td>
<td width="85%">
<input type="checkbox" name="<?php echo 'ifeature['.$value['id'].']'; ?>" id="<?php echo 'ifeature['.$value['id'].']'; ?>" value="1" <?php checked( '1', $options[$value['id']] ); ?>/>
</td>
</tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php break;
 
}
}
?>
     
      </div>  
      <div id="top"><a href='#TOP'><img src="<?php echo get_template_directory_uri() ;?>/images/options/top.png" /></a>
      </div>
      <div style="text-align: left;padding: 5px;"><a href="http://cyberchimps.com/" target="_blank"><img src="<?php echo get_template_directory_uri() ;?>/images/options/cyberchimpsmini.png" /></a></div>
    
    </div>    
</form>
    
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
&nbsp;&nbsp;&nbsp;<small>WARNING THIS RESTORES ALL DEFAULTS</small>
</p>
</form>
	</div>

	<?php
}



function theme_options_validate( $input ) {
	global  $select_font, $select_featured_images;

	// Assign checkbox value
	
	if ( ! isset( $input['if_show_excerpts'] ) )
		$input['if_show_excerpts'] = null;
	$input['if_show_excerpts'] = ( $input['if_show_excerpts'] == 1 ? 1 : 0 );
	
	if ( ! isset( $input['if_show_gplus'] ) )
		$input['if_show_gplus'] = null;
	$input['if_show_gplus'] = ( $input['if_show_gplus'] == 1 ? 1 : 0 ); 
 
	
	if ( ! isset( $input['if_hide_author'] ) )
		$input['if_hide_author'] = null;
	$input['if_hide_author'] = ( $input['if_hide_author'] == 1 ? 1 : 0 ); 
	
	if ( ! isset( $input['if_hide_categories'] ) )
		$input['if_hide_categories'] = null;
	$input['if_hide_categories'] = ( $input['if_hide_categories'] == 1 ? 1 : 0 ); 
	
	if ( ! isset( $input['if_hide_date'] ) )
		$input['if_hide_date'] = null;
	$input['if_hide_date'] = ( $input['if_hide_date'] == 1 ? 1 : 0 ); 
	
	if ( ! isset( $input['if_hide_comments'] ) )
		$input['if_hide_comments'] = null;
	$input['if_hide_comments'] = ( $input['if_hide_comments'] == 1 ? 1 : 0 ); 
	
	if ( ! isset( $input['if_hide_share'] ) )
		$input['if_hide_share'] = null;
	$input['if_hide_share'] = ( $input['if_hide_share'] == 1 ? 1 : 0 ); 
	
	if ( ! isset( $input['if_hide_tags'] ) )
		$input['if_hide_tags'] = null;
	$input['if_hide_tags'] = ( $input['if_hide_tags'] == 1 ? 1 : 0 ); 

  
  if ( ! isset( $input['if_hide_facebook'] ) )
		$input['if_hide_facebook'] = null;
	$input['if_hide_facebook'] = ( $input['if_hide_facebook'] == 1 ? 1 : 0 ); 
	
	if ( ! isset( $input['if_hide_twitter'] ) )
		$input['if_hide_twitter'] = null;
	$input['if_hide_twitter'] = ( $input['if_hide_twitter'] == 1 ? 1 : 0 ); 
	
		if ( ! isset( $input['if_hide_gplus'] ) )
		$input['if_hide_gplus'] = null;
	$input['if_hide_gplus'] = ( $input['if_hide_gplus'] == 1 ? 1 : 0 ); 
	
	if ( ! isset( $input['if_hide_linkedin'] ) )
		$input['if_hide_linkedin'] = null;
	$input['if_hide_linkedin'] = ( $input['if_hide_linkedin'] == 1 ? 1 : 0 ); 
	
	if ( ! isset( $input['if_hide_youtube'] ) )
		$input['if_hide_youtube'] = null;
	$input['if_hide_youtube'] = ( $input['if_hide_youtube'] == 1 ? 1 : 0 ); 
	
	if ( ! isset( $input['if_hide_googlemaps'] ) )
		$input['if_hide_googlemaps'] = null;
	$input['if_hide_googlemaps'] = ( $input['if_hide_googlemaps'] == 1 ? 1 : 0 ); 
	
	if ( ! isset( $input['if_hide_email'] ) )
		$input['if_hide_email'] = null;
	$input['if_hide_email'] = ( $input['if_hide_email'] == 1 ? 1 : 0 ); 
	
	if ( ! isset( $input['if_hide_rss'] ) )
		$input['if_hide_rss'] = null;
	$input['if_hide_rss'] = ( $input['if_hide_rss'] == 1 ? 1 : 0 ); 
  
  if ( ! isset( $input['if_hide_callout'] ) )
		$input['if_hide_callout'] = null;
	$input['if_hide_callout'] = ( $input['if_hide_callout'] == 1 ? 1 : 0 ); 
	
	  if ( ! isset( $input['if_show_fb_like'] ) )
		$input['if_show_fb_like'] = null;
	$input['if_show_fb_like'] = ( $input['if_show_fb_like'] == 1 ? 1 : 0 ); 
  
  
     if ( ! isset( $input['if_hide_slider'] ) )
		$input['if_hide_slider'] = null;
	$input['if_hide_slider'] = ( $input['if_hide_slider'] == 1 ? 1 : 0 ); 
  
  
    if ( ! isset( $input['if_hide_boxes'] ) )
		$input['if_hide_boxes'] = null;
	$input['if_hide_boxes'] = ( $input['if_hide_boxes'] == 1 ? 1 : 0 ); 
  
     if ( ! isset( $input['if_hide_link'] ) )
		$input['if_hide_link'] = null;
	$input['if_hide_link'] = ( $input['if_hide_link'] == 1 ? 1 : 0 ); 
	
	  if ( ! isset( $input['if_slider_navigation'] ) )
		$input['if_slider_navigation'] = null;
	$input['if_slider_navigation'] = ( $input['if_slider_navigation'] == 1 ? 1 : 0 ); 
		  
	if ( ! isset( $input['if_widget_title_bg'] ) )
		$input['if_widget_title_bg'] = null;
	$input['if_widget_title_bg'] = ( $input['if_widget_title_bg'] == 1 ? 1 : 0 ); 
  

  	// Strip HTML from certain options
  	
   $input['if_logo'] = wp_filter_nohtml_kses( $input['if_logo'] );
  
   $input['if_facebook'] = wp_filter_nohtml_kses( $input['if_facebook'] ); 
    
   $input['if_twitter'] = wp_filter_nohtml_kses( $input['if_twitter'] ); 
  
   $input['if_linkedin'] = wp_filter_nohtml_kses( $input['if_linkedin'] );   
  
   $input['if_youtube'] = wp_filter_nohtml_kses( $input['if_youtube'] );  
  
   $input['if_rsslink'] = wp_filter_nohtml_kses( $input['if_rsslink'] );  
  
   $input['if_email'] = wp_filter_nohtml_kses( $input['if_email'] );   
  

	$options = get_option('ifeature');
  if ($_FILES['if_filename']['name'] != '') {
       $overrides = array('test_form' => false); 
       $file = wp_handle_upload($_FILES['if_filename'], $overrides);
       $input['file'] = $file;
   } elseif(isset($_POST['if_filename_text']) && $_POST['if_filename_text'] != '') {
	   $input['file'] = array('url' => $_POST['if_filename_text']);
   } else {
	   $input['file'] = null;
   }

if ($_FILES['if_favfilename']['name'] != '') {
       $overrides = array('test_form' => false); 
       $file2 = wp_handle_upload($_FILES['if_favfilename'], $overrides);
       $input['file2'] = $file2;
   } elseif(isset($_POST['if_favfilename_text']) && $_POST['if_favfilename_text'] != '') {
	   $input['file2'] = array('url' => $_POST['if_favfilename_text']);
   } else {
	   $input['file2'] = null;
   }
   


	return $input;    

}

?>
<?php
  
// Add scripts and stylesheet

  function if_scripts() {
        wp_enqueue_script('ifjquery');
        wp_enqueue_script('ifjqueryui');
        wp_enqueue_script('ifjquerycookie');
        wp_enqueue_script('ifcookie');
        wp_enqueue_script('ifcolor');
   }
    
 function if_styles() {
       wp_enqueue_style('ifcss');
   }

/* Redirect after activation */

if ( is_admin() && isset($_GET['activated'] ) && $pagenow ==	"themes.php" )
	wp_redirect( 'themes.php?page=theme_options' );
	
if ( isset( $_REQUEST['reset'] ))
  wp_redirect( 'themes.php?page=theme_options' );

?>