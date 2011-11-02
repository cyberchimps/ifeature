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
	'0' => array('value' =>'Arial','label' => 'Arial (default)'),'1' => array('value' =>'Allan','label' => 'Allan'),'2' => array('value' =>'Alice','label' => 'Alice'),'4' => array('value' =>'Cantarell','label' => 'Cantarell'),'5' => array('value' =>'Courier New','label' => 'Courier New'),'6' => array('value' =>'Georgia','label' => 'Georgia'),'6' => array('value' =>'Lucida Grande','label' => 'Lucida Grande'),'7' => array('value' =>'Tahoma','label' => 'Tahoma'),'8' => array('value' =>'Times New Roman','label' => 'Times New Roman'),'9' => array('value' =>'Ubuntu','label' => 'Ubuntu'),

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

array( "name" => __( 'Logo URL', 'ifeature' ),  
    "desc" => __( 'Use the image uploader or enter your own URL into the input field to use an image as your logo. To display the site title as text, leave blank.', 'ifeature' ),  
    "id" => $shortname."_logo",  
    "type" => "upload",  
    "std" => ""),  
 
    
array( "name" =>  __( 'Header Contact Area', 'ifeature' ),
    "desc" => __( 'Enter contact info such as phone number for the top right corner of the header. It can be HTML (to hide enter the word: hide).', 'ifeature' ),  
    "id" => $shortname."_header_contact",  
    "type" => "textarea",
    "std" => ""),
    
array( "name" => __( 'Custom Favicon', 'ifeature' ), 
    "desc" => __( 'A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image.', 'ifeature' ),  
    "id" => $shortname."_favicon",  
    "type" => "upload2",  
    "std" => ""), 
    
array( "name" => __( 'Disable Breadcrumbs', 'ifeature' ),
    "desc" => __( 'Check this box to disable breadcrumb links.', 'ifeature' ),  
    "id" => $shortname."_disable_breadcrumbs",  
      "type" => "checkbox",  
    "std" => "false"),
    
array( "name" =>  __( 'Footer Copyright', 'ifeature' ),
    "desc" => __( 'Enter Copyright text used on the right side of the footer. It can be HTML.', 'ifeature' ),  
    "id" => $shortname."_footer_text",  
    "type" => "textarea",  
    "std" => ""),

array( "name" => __( 'Google Analytics Code', 'ifeature' ), 
    "desc" => __( 'You can paste your Google Analytics or other tracking code in this box. This will be automatically be added to the footer.', 'ifeature' ),  
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

array( "name" => __( 'Choose a font:', 'ifeature' ),  
    "desc" => __( '(Default is Arial)', 'ifeature' ),  
    "id" => $shortname."_font",  
    "type" => "select1",  
    "std" => ""),
    
array( "name" => __( 'Link Color:', 'ifeature' ),  
    "desc" => __( 'Use the color picker to select the site link color', 'ifeature' ),  
    "id" => $shortname."_link_color",  
      "type" => "color2",  
    "std" => "false"),
    
array( "name" => __( 'Enable Widget Title Background:', 'ifeature' ),  
    "desc" => __( 'Check this box to enable the classic widget title backgrounds.', 'ifeature' ),  
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

array( "name" => __( 'Post Excerpts:', 'ifeature' ),  
    "desc" => __( 'Use the following options to control excerpts.', 'ifeature' ),  
    "id" => $shortname."_excerpts",  
      "type" => "excerpts",  
    "std" => "false"),

array( "name" => __('Featured Images:' , 'ifeature' ),  
    "desc" => __( 'Use the following options to control featured image alignment and size.', 'ifeature' ),  
    "id" => $shortname."_featured_images",  
      "type" => "featured",  
    "std" => "false"),

array( "name" => __( 'Hide Post Elements:', 'ifeature' ),  
    "desc" => __( 'Use the following checkboxes to hide various post elements.' , 'ifeature' ),  
    "id" => $shortname."_hide_post_elements",  
    "type" => "post",  
    "std" => "false"),

array(  "name" => __( 'Show Facebook Like Button:', 'ifeature' ),
	"desc" => __( 'Check this box to show the Facebook Like Button on blog posts.', 'ifeature' ),
	"id" => $shortname."_show_fb_like",
	"type" => "checkbox",
	"std" => "false"),  
	
array(  "name" => __( 'Show Google +1 button:', 'ifeature' ),
	"desc" => __( 'Check this box to show the Google +1 Button on blog posts.', 'ifeature' ),
	"id" => $shortname."_show_gplus",
	"type" => "checkbox",
	"std" => "false"),   

array( "name" => __( 'Home Description:', 'ifeature' ),  
    "desc" => __( 'Enter the META description of your homepage here.', 'ifeature' ),  
    "id" => $shortname."_home_description",  
    "type" => "textarea",  
    "std" => ""),
    
array( "name" => __( 'Home Keywords:', 'ifeature' ),  
    "desc" => __( 'Enter the META keywords of your homepage here (separated by commas).', 'ifeature' ),  
    "id" => $shortname."_home_keywords",  
    "type" => "textarea",  
    "std" => ""),
    
array( "name" => __(' Optional Home Title:', 'ifeature' ),  
    "desc" => __( 'Enter an alternative title of your homepage here (default is site tagline).', 'ifeature' ),  
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

array( "name" => __( 'Hide iFeature Slider:', 'ifeature' ),  
    "desc" => __( 'Check this box to hide the Feature Slider on the homepage.', 'ifeature' ),  
    "id" => $shortname."_hide_slider",  
    "type" => "checkbox",  
    "std" => "false"),
    
array( "name" => __( 'Show Posts From Blog Category:', 'ifeature' ),  
    "desc" => __('(Default is all)', 'ifeature'),  
    "id" => $shortname."_slider_category",  
    "type" => "select6",  
    "std" => ""),

array( "name" => __( 'Number of Featured Posts:', 'ifeature' ),   
    "desc" => __( '(Default is 5', 'ifeature' ),  
    "id" => $shortname."_slider_posts_number",  
    "type" => "text",  
    "std" => ""),  

array( "name" => __( 'Slider Delay Time (in milliseconds):', 'ifeature' ),  
    "desc" => __( '(Default is 3500)', 'ifeature' ),  
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

array( "name" => __( 'Facebook URL:', 'ifeature' ),  
    "desc" => __( 'Enter your Facebook page URL for the Facebook social icon.', 'ifeature' ),  
    "id" => $shortname."_facebook",  
    "type" => "facebook",  
    "std" => "http://facebook.com"),

array( "name" => __( 'Twitter URL:', 'ifeature' ),  
    "desc" => __( 'Enter your Twitter URL for Twitter social icon.', 'ifeature' ),  
    "id" => $shortname."_twitter",  
    "type" => "twitter",  
    "std" => "http://twitter.com"),
    
array( "name" => __( 'Google Plus URL:', 'ifeature' ),  
    "desc" => __( 'Enter your Google Plus url (we recommend using the http://gplus.to/ shortener).', 'ifeature' ),  
    "id" => $shortname."_gplus",  
    "type" => "gplus",  
    "std" => "https://plus.google.com"),
    
array( "name" => __( 'Flickr URL:', 'ifeature' ),  
    "desc" => __( 'Enter your Flickr URL for the Flickr social icon.', 'ifeature' ),
    "id" => $shortname."_flickr",  
    "type" => "flickr",  
    "std" => "http://flickr.com/"),
    
array( "name" => __( 'LinkedIn URL:', 'ifeature' ),  
    "desc" => __( 'Enter your LinkedIn URL for the LinkedIn social icon.', 'ifeature' ),  
    "id" => $shortname."_linkedin",  
    "type" => "linkedin",  
    "std" => "http://linkedin.com"),  
    
array( "name" => __( 'YouTube URL:', 'ifeature' ),  
    "desc" => __(' Enter your YouTube URL for the YouTube social icon.', 'ifeature' ),  
    "id" => $shortname."_youtube",  
    "type" => "youtube",  
    "std" => "http://youtube.com"),  
    
array( "name" => __( 'Google Maps URL:', 'ifeature' ) ,  
    "desc" => __( 'Enter your Google Maps URL for the Google Maps social icon.', 'ifeature' ),  
    "id" => $shortname."_googlemaps",  
    "type" => "googlemaps",  
    "std" => "http://google.com/maps"),  

array( "name" => __( 'Email:', 'ifeature' ),  
    "desc" => __( 'Enter your contact email address for email social icon.', 'ifeature' ),  
    "id" => $shortname."_email",  
    "type" => "email",  
    "std" => "no@way.com"),
    
array( "name" => __( 'Custom RSS Link:', 'ifeature' ),  
    "desc" => __( 'Enter Feedburner URL, or leave blank for default RSS feed.', 'ifeature' ),  
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
		<li><a href="http://cyberchimps.com/support" target="_blank"><?php printf( __( 'Support', 'ifeature' )); ?></a></li>
		<li><a href="http://cyberchimps.com/ifeature-free/docs" target="_blank"> <?php printf( __( 'Documentation', 'ifeature' )); ?></a></li>
		<li><a href="http://cyberchimps.com/forum/" target="_blank"><?php printf( __( 'Forum', 'ifeature' )); ?></a></li>
		<li><a href="http://twitter.com/#!/cyberchimps" target="_blank"><?php printf( __( 'Twitter', 'ifeature' ));?></a></li>
		<li><a href="http://facebook.com/cyberchimps/" target="_blank"><?php printf( __( 'Facebook', 'ifeature' ));?></a></li>
		<li><a href="http://cyberchimps.com/store/" target="_blank"><?php printf( __( 'CyberChimps Store', 'ifeature' )); ?></a></li>
		<li><a href="http://cyberchimpspro.com/" target="_blank"><?php printf( __( 'CyberChimps Pro', 'ifeature' )); ?></a></li>
		
		
	</ul>
	</div>

      
    <div id="tabs" style="clear:both;">   
    <ul class="tabNavigation">
        <li><a href="#if-tab1"><span><?php printf( __( 'General', 'ifeature' )); ?></span></a></li>
        <li><a href="#if-tab2"><span><?php printf( __( 'Design' ,'ifeature' )); ?></span></a></li>
        <li><a href="#if-tab3"><span><?php printf( __( 'Blog', 'ifeature' )); ?></span></a></li>
        <li><a href="#if-tab4"><span><?php printf( __( 'iFeature Slider', 'ifeature' )); ?></span></a></li>
        <li><a href="#if-tab5"><span><?php printf( __( 'Social', 'ifeature' )); ?></span></a></li>        
      
    
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
    <td width="85%"><?php printf( __( 'Read the', 'ifeature' )); ?> <a href="http://cyberchimps.com/question/general-settings-tab/" target="_blank"><?php printf( __( 'General Options Tab FAQ', 'ifeature' )); ?></a></td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;

case 'design_faq':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><?php printf( __( 'Read the', 'ifeature' )); ?> <a href="http://cyberchimps.com/question/design-settings-tab/" target="_blank"><?php printf( __( 'Design Options Tab FAQ', 'ifeature' )); ?></a></td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;

case 'social_faq':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><?php printf( __( 'Read the', 'ifeature' )); ?> <a href="http://cyberchimps.com/question/social-settings-tab/" target="_blank"><?php printf( __( 'Social Options Tab FAQ', 'ifeature' )); ?></a></td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;

case 'blog_faq':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><?php printf( __( 'Read the', 'ifeature' )); ?> <a href="http://cyberchimps.com/question/blog-settings-tab/" target="_blank"><?php printf( __( 'Blog Options Tab FAQ', 'ifeature' )); ?></a></td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;

case 'slider_faq':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><?php printf( __( 'Read the', 'ifeature' )); ?>  <a href="http://cyberchimps.com/question/ifeature-slider-settings-tab/" target="_blank"><?php printf( __( 'Slider Options Tab FAQ', 'ifeature' )); ?></a></td>

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
    <input type="checkbox" id="ifeature[if_show_excerpts]" name="ifeature[if_show_excerpts]" value="1" <?php checked( '1', $options['if_show_excerpts'] ); ?>> - <?php printf( __( 'Show Excerpts', 'ifeature' )); ?>
<br /><br />

	<?php
		if (isset($options['if_excerpt_link_text']) == "")
			$textlink = '(Read More...)';
			
		else
			$textlink = $options['if_excerpt_link_text']; 
	?>
	
   <input type="text" id="ifeature[if_excerpt_link_text]" name="ifeature[if_excerpt_link_text]" value="<?php echo $textlink ;?>"> - <?php printf( __( 'Excerpt Link Text', 'ifeature' )); ?>
<br /><br />

	<?php
		if (isset($options['if_excerpt_length']) == "")
			$length = '55';
			
		else
			$length = $options['if_excerpt_length']; 
	?>

     <input type="text" id="ifeature[if_excerpt_length]" name="ifeature[if_excerpt_length]" value="<?php echo $length ;?>" > - <?php printf( __( 'Excerpt Character Length', 'ifeature' )); ?>
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
    <input type="checkbox" id="ifeature[if_hide_author]" name="ifeature[if_hide_author]" value="1" <?php checked( '1', $options['if_hide_author'] ); ?>> - <?php printf( __('Author', 'ifeature' )); ?>
<br /><br />

   <input type="checkbox" id="ifeature[if_hide_categories]" name="ifeature[if_hide_categories]" value="1" <?php checked( '1', $options['if_hide_categories'] ); ?>> - <?php printf( __('Categories', 'ifeature' )); ?>
<br /><br />

   <input type="checkbox" id="ifeature[if_hide_date]" name="ifeature[if_hide_date]" value="1" <?php checked( '1', $options['if_hide_date'] ); ?>> - <?php printf( __( 'Date', 'ifeature' )); ?>
<br /><br />

   <input type="checkbox" id="ifeature[if_hide_comments]" name="ifeature[if_hide_comments]" value="1" <?php checked( '1', $options['if_hide_comments'] ); ?>> - <?php printf( __( 'Comments', 'ifeature' )); ?>
<br /><br />

   <input type="checkbox" id="ifeature[if_hide_share]" name="ifeature[if_hide_share]" value="1" <?php checked( '1', $options['if_hide_share'] ); ?>> - <?php printf( __( 'Sharing', 'ifeature' )); ?>
<br /><br />

   <input type="checkbox" id="ifeature[if_hide_tags]" name="ifeature[if_hide_tags]" value="1" <?php checked( '1', $options['if_hide_tags'] ); ?>> - <?php printf( __( 'Tags'. 'ifeature' )); ?>
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

<?php printf( __( 'Define a custom Featured Image size below (default is 100 by 100):' , 'ifeature' )); ?>

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

<input type="text" id="ifeature[if_featured_image_height]" name="ifeature[if_featured_image_height]"  value="<?php echo $featureheight ;?>" style="width: 300px;"> - <?php printf( __( 'Height', 'ifeature' )); ?>

<br /><br />

<input type="text" id="ifeature[if_featured_image_width]" name="ifeature[if_featured_image_width]"  value="<?php echo $featurewidth ;?>" style="width: 300px;"> - <?php printf( __( 'Width', 'ifeature' )); ?>

</td>
</tr> 
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;


case 'upload':
?>   


<tr>

<td width="15%" rowspan="2" valign="middle"><strong><?php printf( __(' Custom Logo' , 'ifeature' )); ?></strong>


 
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
    <small><?php printf( __( 'Upload a logo image to use', 'ifeature' )); ?></small>


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

<td width="15%" rowspan="2" valign="middle"><strong><?php printf( __( 'Custom Favicon', 'ifeature' )); ?></strong>


 
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
    <small><?php printf( __( 'Upload a favicon image to use', 'ifeature' )); ?></small>


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
    <input type="checkbox" id="ifeature[if_hide_facebook]" name="ifeature[if_hide_facebook]" value="1" <?php checked( '1', $options['if_hide_facebook'] ); ?>> - <?php printf( __( 'Check this box to hide the Facebook icon.', 'ifeature' )); ?>
    
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
    <input type="checkbox" id="ifeature[if_hide_twitter]" name="ifeature[if_hide_twitter]" value="1" <?php checked( '1', $options['if_hide_twitter'] ); ?>> - <?php printf( __( 'Check this box to hide the Twitter icon.', 'ifeature' )); ?>

    
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
    <input type="checkbox" id="ifeature[if_hide_gplus]" name="ifeature[if_hide_gplus]" value="1" <?php checked( '1', $options['if_hide_gplus'] ); ?>> - <?php printf( __( 'Check this box to hide the Google + icon.', 'ifeature' )); ?> 
    
    </td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;

case 'flickr':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><input style="width:300px;" name="<?php echo 'ifeature['.$value['id'].']'; ?>" id="<?php echo 'if['.$value['id'].']'; ?>" type="<?php echo $value['type']; ?>" value="<?php if (  $options[$value['id']]  != "") { echo esc_attr($options[$value['id']]) ; } else { echo esc_attr($value['std']) ; } ?>" />
    
    <br /><br />
    <input type="checkbox" id="ifeature[if_hide_flickr]" name="ifeature[if_hide_flickr]" value="1" <?php checked( '1', $options['if_hide_flickr'] ); ?>> - <?php printf( __( 'Check this box to hide the Flickr icon.', 'ifeature' )); ?> 
    
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
    <input type="checkbox" id="ifeature[if_hide_linkedin]" name="ifeature[if_hide_linkedin]" value="1" <?php checked( '1', $options['if_hide_linkedin'] ); ?>> - <?php printf( __( 'Check this box to hide the LinkedIn icon.', 'ifeature' )); ?> 
    
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
    <input type="checkbox" id="ifeature[if_hide_youtube]" name="ifeature[if_hide_youtube]" value="1" <?php checked( '1', $options['if_hide_youtube'] ); ?>> - <?php printf( __( 'Check this box to hide the YouTube icon.', 'ifeature' )); ?>  
    
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
    <input type="checkbox" id="ifeature[if_hide_googlemaps]" name="ifeature[if_hide_googlemaps]" value="1" <?php checked( '1', $options['if_hide_googlemaps'] ); ?>> - <?php printf( __( 'Check this box to hide the Google Maps icon. ', 'ifeature' )); ?> 
    
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
    <input type="checkbox" id="ifeature[if_hide_email]" name="ifeature[if_hide_email]" value="1" <?php checked( '1', $options['if_hide_email'] ); ?>> -  <?php printf( __( 'Check this box to hide the Email icon. ', 'ifeature' )); ?>
    
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
    <input type="checkbox" id="ifeature[if_hide_rss]" name="ifeature[if_hide_rss]" value="1" <?php checked( '1', $options['if_hide_rss'] ); ?>> - <?php printf( __( 'Check this box to hide the RSS icon.', 'ifeature' )); ?>
    
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
&nbsp;&nbsp;&nbsp;<small><?php printf( __( 'WARNING THIS RESTORES ALL DEFAULTS', 'ifeature' )); ?></small>
</p>
</form>
	</div>

	<?php
}



function theme_options_validate( $input ) {
	global  $select_font, $select_featured_images;

	// Assign checkbox value
	$names = array(
  	'if_show_excerpts',
  	'if_show_gplus',
  	'if_hide_author',
  	'if_hide_categories',
  	'if_hide_date',
  	'if_hide_comments',
  	'if_hide_share',
  	'if_hide_tags',
  	'if_hide_facebook',
  	'if_hide_twitter',
  	'if_hide_gplus',
  	'if_hide_flickr',
  	'if_hide_linkedin',
  	'if_hide_youtube',
  	'if_hide_googlemaps',
  	'if_hide_email',
  	'if_hide_rss',
  	'if_hide_callout',
  	'if_show_fb_like',
  	'if_hide_slider',
  	'if_hide_boxes',
  	'if_hide_link',
  	'if_slider_navigation',
  	'if_widget_title_bg',
  	'if_disable_breadcrumbs',
	);
	
	foreach($names as $name)
	{
  	if ( ! isset( $input[$name] ) )
  		$input[$name] = null;
  	$input[$name] = ( $input[$name] == 1 ? 1 : 0 );
	}

	// Strip HTML from certain options
  $names = array(
    'if_filename_text',
    'if_favfilename_text',
    'if_facebook',
    'if_twitter',
    'if_gplus',
    'if_flickr',
    'if_googlemaps',
    'if_linkedin',
    'if_youtube',
    'if_rsslink',
    'if_email',
  );
  
  foreach($names as $name)
  {
    if(!isset($input[$name])) $input[$name]='';
    $input[$name] = wp_filter_nohtml_kses( $input[$name] );
  }
  	

  

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