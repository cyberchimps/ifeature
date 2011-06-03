<?php 

/*
	Section: Slider
	Authors: Tyler Cunningham 
	Description: Creates iFeature slider.
	Version: 1.1.0	
	Portions of this code written by Ivan Lazarevic  (email : devet.sest@gmail.com) Copyright 2010    
*/

    	$tmp_query = $wp_query; 
		$options = get_option('ifeature') ;  
    	query_posts('category_name='.$options['if_slider_category'].'&showposts=50');
    	
    	
	    if (have_posts()) :
	    	$out = "<div id='coin-slider'>"; 
	    	$i = 0;
	    	
	    	if ($options['if_slider_posts_number'] == '')
	    	$no = '5';
	    	else $no = $options['if_slider_posts_number'];

	    	while (have_posts() && $i<$no) : 
	    	
	    		the_post(); 
	    		
	    		$image 		= get_post_meta($post->ID, 'slider_post_image' , true);
	    		$text 		= get_post_meta($post->ID, 'slider_text' , true);

	    		$permalink 	= get_permalink();
	    		$thetitle	= get_the_title(); 
	    		if ($image != ''){ 
	    			$out .= "<a href='$permalink'>	
	    						<img src='$image' alt='iFeaturePro' />
	    						<span>
	    							<strong>$thetitle</strong><br />
	    							$text
	    						</span>
	    					</a>
	    			";
	       } 
	       		else {
	       		$out .= "<a href='$permalink'>	
	    						<img src='./wp-content/themes/ifeature/images/ifeaturefree.jpg' alt='iFeaturePro' />
	    						<span>
	    							<strong>$thetitle</strong><br />
	    							$text
	    						</span>
	    					</a>
	    			";
	       } 
	    	 
	      	$i++;
	      	endwhile;
	      	$out .= "</div>";
	    endif; 
	    
	    $wp_query = $tmp_query;

	    	$csEffect = 'random';
	  
	    
	    $csSpw		= get_option('cs-spw') ? get_option('cs-spw') : 7;
	    $csSph		= get_option('cs-sph') ? get_option('cs-sph') : 5;	    
	    
	   
	    if ($options['if_slider_delay'] == '')
	    	$csDelay = '3500';
	    else $csDelay = $options['if_slider_delay'];
	  
	    if ($options['if_slider_navigation'] != '1')
	    	$csNavigation = 'true';
	    else $csNavigation = 'false';
	    
	    wp_reset_query();
    $out .= <<<OUT
<script type="text/javascript">

	$("#coin-slider").coinslider({
		width  		: 640,
		height 		: 330,
		spw			: $csSpw,
		sph			: $csSph,
		delay		: $csDelay,
		navigation	: $csNavigation,
		effect		: '$csEffect'
	
	}); 

</script>

OUT;

echo $out;
