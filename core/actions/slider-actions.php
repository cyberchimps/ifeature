<?php
/**
* Slider actions used by the CyberChimps Core Framework 
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
* Extend slider actions
*/

add_action ('chimps_blog_slider_lite', 'chimps_blog_slider_lite_content' );

/**
* Lite slider functions
*/
function chimps_blog_slider_lite_content() {

/* Call globals. */	

	global $themename, $themeslug, $options, $wp_query, $post;

/* End globals. */

/* Define variables. */	

        $tmp_query = $wp_query; 
		$category = $options->get($themeslug.'_slider_category');
		$root = get_template_directory_uri();

echo "<div id='slider-wrapper'>";
		
/* Define blog category */

	if ($category == 'all' OR $category == 'All' OR $category == '') {
		$blogcategory = '';
	}
	
	else {
		$blogcategory = $category;
	}
	

	
/* End blog category */
		
    query_posts('category_name='.$blogcategory.'&showposts=50');
    	
	    if (have_posts()) :
	    	$out = "<div id='slider' class='nivoSlider'>"; 
	    	$i = 0;
	    	
	    	if ($options->get($themeslug.'_slider_posts_number') == '')
	    	$no = '5';
	    	else $no = $options->get($themeslug.'_slider_posts_number');

	    	while (have_posts() && $i<$no) : 
	    	
	    		the_post(); 
	    		
	    		$postimage 	= get_post_meta($post->ID, 'slider_image' , true);
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

	    	   
	    if ($options->get($themeslug.'_slider_delay') == '')
	    	$delay = '3500';
	    else $delay = $options->get($themeslug.'_slider_delay');
	  
	    if ($options->get($themeslug.'hide_slider_navigation') != '0' OR $options->get($themeslug.'hide_slider_navigation') == '' ) {
	    	$navigation = 'true';
	    }
	    else {
	    
	     $navigation = 'false'; 
	    	echo '<style type="text/css">';
			echo ".nivo-controlNav {display: none;}";
		echo ".slider_nav {display: none;}";
		echo '#slider-wrapper {margin-bottom: 20px;}';
			echo '</style>';
	    
	    }
	    
	    wp_reset_query();
/* Begin NivoSlider javascript */ 
    
    $out .= <<<OUT
	<script type="text/javascript">
	jQuery(document).ready(function($) {
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
});

</script>

OUT;

/* End NivoSlider javascript */ 

echo $out;
/* END */ 

echo "</div>";

?>
<div class="slider_nav" style="width: 640px; ">&nbsp;</div>
<div class='clear'>&nbsp;</div>
<?php

}

/**
* End
*/

?>