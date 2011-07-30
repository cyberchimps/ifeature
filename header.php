<?php 

/*
	Header
	Authors: Tyler Cunningham, Trent Lapinski
	Creates the theme header. 
	Copyright (C) 2011 CyberChimps
	Version 2.0
*/

	$options = get_option('ifeature') ; 
	$logo = $options['file'] ;
	$favicon = $options['file2'];
	$tdurl = get_template_directory_uri();
	
	if (is_search()){
		$title = '';
	}
	
	else {
		$title = get_post_meta($post->ID, 'seo_title' , true);
	}
	
	if (is_search()){
		$pagedescription = '';
	}
	
	else {
		$pagedescription = get_post_meta($post->ID, 'seo_description' , true);
	}
	if (is_search()){
		$keywords = '';
	}
	else {
		$keywords = get_post_meta($post->ID, 'seo_keywords' , true);
	}
	
	$hometitle = $options['if_home_title'];
	$homekeywords = $options['if_home_keywords'];
	$homedescription = $options['if_home_description'];
	
?>
<!DOCTYPE html>
<html <?php language_attributes('xhtml'); ?>>

<head>
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
<!-- iFeature Blog Page SEO options -->
	<?php if ($hometitle != '' AND is_front_page()): ?>
		<meta name="title" content="<?php echo $hometitle ?>" />
	<?php endif; ?> 
	
	<?php if ($homedescription != '' AND is_front_page()): ?>
		<meta name="description" content="<?php echo $homedescription ?>" />
	<?php endif; ?>	
	
	<?php if ($homekeywords != '' AND is_front_page()): ?>
		<meta name="keywords" content="<?php echo $homekeywords ?>" />
	<?php endif; ?>
<!-- /iFeature Blog Page SEO options -->


<!-- iFeature Page SEO options -->

	<?php if ($title != '' AND !is_front_page()): ?>
		<meta name="title" content="<?php echo $title ?>" />
	<?php endif; ?> 
	
	<?php if ($pagedescription != '' AND !is_front_page()): ?>
		<meta name="description" content="<?php echo $pagedescription ?>" />
	<?php endif; ?>	
	
	<?php if ($keywords != '' AND !is_front_page()): ?>
		<meta name="keywords" content="<?php echo $keywords ?>" />
	<?php endif; ?>

<!-- /iFeature Page SEO options -->

	<meta name="distribution" content="global" />
	<meta name="language" content="en" />

<!-- Page title -->
<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         bloginfo('name'); echo ' - '; single_tag_title("Tag Archive for &quot;"); echo '&quot;  '; }
		      elseif (is_archive()) {
		          bloginfo('name'); echo ' - '; wp_title(''); echo ' Archive '; }
		      elseif (is_search()) {
		         bloginfo('name'); echo ' - '; echo 'Search for &quot;'.esc_html($s).'&quot;  '; }
		      elseif ($title == '' AND !(is_404()) && (is_single()) || (is_page())) {
		          bloginfo('name'); echo ' - '; wp_title('');  }
		      elseif (is_404()) {
		          bloginfo('name'); echo ' - '; echo 'Not Found '; }
		      if (is_front_page() AND $hometitle == '') {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      elseif (!is_front_page() AND $title != '') {
		         bloginfo('name'); echo ' - '; echo $title ; }
		      elseif (is_front_page() AND $hometitle != '') {
		         bloginfo('name'); echo ' - '; echo $hometitle ; }
		    
		      if ($paged>1 ) {
		         echo ' - page '. $paged; }
		   ?>
	</title>	
	
	<?php if ($favicon == ""): ?>
			
		<link rel="shortcut icon" href="<?php echo "$tdurl/images/favicon.ico" ; ?>" type="image/x-icon" />
		<?php endif;?>
		<?php if ($favicon != ""): ?>
			<link rel="shortcut icon" href="<?php echo stripslashes($favicon['url']); ?>" type="image/x-icon" />
	<?php endif;?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
		<?php  
		if ($options['if_font'] == "")
			$font = 'Cantarell';
		else
			$font = $options[('if_font')]; ?>
	
	<link href='http://fonts.googleapis.com/css?family=<?php echo $font ?>' rel='stylesheet' type='text/css' />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	    
	<?php wp_head(); ?>
	
	
	
</head>

<body style="font-family:'<?php echo $font ?>'" <?php body_class(); ?> >
	
	<div id="page-wrap">
		
		<div id="main">

			<div id="header">
				<div id="headerwrap">
					<div id="header_right">
						<!-- Inserts Header Contact Area -->
						<?php  $headercontact = $options['if_header_contact'] ; ?>
						
							<?php if ($headercontact == '' ):?>
							<div id="header_contact">
								Enter Contact Information Here
							</div>
							<?php endif;?>
							<?php if ($headercontact != 'hide' ):?>
							<div id="header_contact1">
								<?php echo stripslashes ($headercontact); ?></div> 
							<?php endif;?>
							<?php if ($headercontact == 'hide' ):?>
								<div style ="height: 10%;">&nbsp;</div> 
							<?php endif;?>
						<br />
							<div id="social">
								<?php get_template_part('icons', 'header'); ?>
							</div><!-- end social -->
					</div><!-- end header_right -->
					<!-- Inserts Site Logo -->
					<?php if ($logo != ''):?>
							<div id="logo">
								<a href="<?php echo home_url(); ?>/"><img src="<?php echo stripslashes($logo['url']); ?>" alt="logo"></a>
							</div>
						<?php endif;?>
						<?php if ($logo == '' ):?>
							<div id="logo">
								<h1 class="sitename"><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?> </a></h1>
							</div>
						<?php endif;?>
					<div id="description">
						<h1 class="description"><?php bloginfo('description'); ?></h1>
					</div>
				</div><!-- end headerwrap -->
				
				
				<?php get_template_part('nav', 'header' ); ?>
				
			</div><!-- end header -->
