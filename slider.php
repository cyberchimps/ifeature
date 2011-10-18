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
		$category = $options['if_slider_category'];
		$root = get_template_directory_uri();
		
/* Define blog category */

	if ($category != 'All') {
		$blogcategory = $category;
	}
	
	else {
		$blogcategory = "";
	}
	
/* End blog category */
		
    query_posts('category_name='.$blogcategory.'&showposts=50');
    	
	    if (have_posts()) :
	    	$out = "<div id='slider' class='nivoSlider'>"; 
	    	$i = 0;
	    	
	    	if ($options['if_slider_posts_number'] == '')
	    	$no = '5';
	    	else $no = $options['if_slider_posts_number'];

	    	while (have_posts() && $i<$no) : 
	    	
	    		the_post(); 
	    		
	    		$postimage 		= get_post_meta($post->ID, 'slider_post_image' , true);
	    		$text 		= get_post_meta($post->ID, 'slider_text' , true);
	    		$permalink 	= get_permalink();
	    		$thetitle	= get_the_title(); 
	    		
	    	/* Controls slide image and thumbnails */

	    	if ($postimage != '' ){
	    		$image = $postimage;
	    	}
	    	
	    	else {
	    		$image = "$root/images/ifeaturefree.jpg";
	    	}

	    		
	    	/* Markup for slides */

	    	$out .= "<a href='$permalink'>	
	    				<img src='$image' height='330' width='640' title='#caption$i' />
	    					<div id='caption$i' class='nivo-html-caption'>
                				<font size='4'>$thetitle </font> <br />
                				$text 
                			</div>
	    				</a>
	    			";

	    	/* End slide markup */	
	    	 
	      	$i++;
	      	endwhile;
	      	$out .= "</div>";
	    endif; 
	    
	    $wp_query = $tmp_query;

	    	   
	    if ($options['if_slider_delay'] == '')
	    	$delay = '3500';
	    else $delay = $options['if_slider_delay'];
	  
	    if ($options['if_slider_navigation'] != '1') {
	    	$navigation = 'true';
	    }
	    else {
	    
	     $navigation = 'false'; 
	    	echo '<style type="text/css">';
			echo '.nivo-controlNav {display: none;}';
			echo '#slider {margin-bottom: 5px;}';
			echo '</style>';
	    
	    }
	    
	    wp_reset_query();
/* Begin NivoSlider javascript */ 
    
    $out .= <<<OUT
	<script type="text/javascript">
		var $ = jQuery.noConflict();

	$(window).load(function() {
    $('#slider').nivoSlider({
        effect:'random', // Specify sets like: 'fold,fade,sliceDown'
        slices:15, // For slice animations
        boxCols: 8, // For box animations
        boxRows: 4, // For box animations
        animSpeed:500, // Slide transition speed
        pauseTime:'$delay', // How long each slide will show
        startSlide:0, // Set starting Slide (0 index)
        directionNav:$navigation, // Next & Prev navigation
        directionNavHide:true, // Only show on hover
        controlNavThumbs:false, // Use thumbnails for Control Nav
        controlNavThumbsFromRel:true, // Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', // Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
        keyboardNav:true, // Use left & right arrows
        pauseOnHover:true, // Stop animation while hovering
        manualAdvance:false, // Force manual transitions
        captionOpacity:0.7, // Universal caption opacity
        prevText: 'Prev', // Prev directionNav text
        nextText: 'Next', // Next directionNav text
        beforeChange: function(){}, // Triggers before a slide transition
        afterChange: function(){}, // Triggers after a slide transition
        slideshowEnd: function(){}, // Triggers after all slides have been shown
        lastSlide: function(){}, // Triggers when last slide is shown
        afterLoad: function(){} // Triggers when slider has loaded
    });
	$('#slider').each(function(){
    var \$this = $(this), \$control = $(".nivo-controlNav", this);
    \$control.css({left: (\$this.width() - \$control.width()) / 2}); 
});
});

</script>

OUT;

/* End NivoSlider javascript */ 

echo $out;
