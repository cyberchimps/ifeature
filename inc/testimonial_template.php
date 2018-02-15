<?php
/* Testimonial */

// frontend display
function ifeature_testimonial_render_display()
{
	global $post;
        // Set directory uri 
        $directory_uri = get_template_directory_uri();
        $testimonials = array();
	if(is_page())
	{
		$if_testimonial_title = get_post_meta( $post->ID, 'ir_testimonial_title', true );
 		$testimonial_background = get_post_meta( $post->ID, 'testimonial_background', true );
		 // Get testimonial images		
                $testimonials[0]['img'] = get_post_meta( $post->ID, 'cyberchimps_blog_testimonial_image_one', true );
                $testimonials[1]['img'] = get_post_meta( $post->ID, 'cyberchimps_blog_testimonial_image_two', true );
                $testimonials[2]['img'] = get_post_meta( $post->ID, 'cyberchimps_blog_testimonial_image_three', true );
                
                 // get testimonial clients
                $testimonials[0]['client'] = get_post_meta( $post->ID, 'cyberchimps_blog_client_one', true );
                $testimonials[1]['client'] = get_post_meta( $post->ID, 'cyberchimps_blog_client_two', true );
                $testimonials[2]['client'] = get_post_meta( $post->ID, 'cyberchimps_blog_client_three', true );
                
                // get testimonial  - about clients
                $testimonials[0]['client_abt'] = get_post_meta( $post->ID, 'cyberchimps_blog_client_abt_one', true );
                $testimonials[1]['client_abt'] = get_post_meta( $post->ID, 'cyberchimps_blog_client_abt_two', true );
                $testimonials[2]['client_abt'] = get_post_meta( $post->ID, 'cyberchimps_blog_client_abt_three', true );
                
                  // get testimonial  - about clients
                
                $testimonials[0]['text'] = get_post_meta( $post->ID, 'cyberchimps_testimonial_one_text', true );
                $testimonials[1]['text'] = get_post_meta( $post->ID, 'cyberchimps_testimonial_two_text', true );
                $testimonials[2]['text'] = get_post_meta( $post->ID, 'cyberchimps_testimonial_three_text', true );
                
	}
	else
	{
		$if_testimonial_title = cyberchimps_get_option('ir_testimonial_title');
		$testimonial_background = cyberchimps_get_option('testimonial_background');
                
                // Get testimonial images
                
		$testimonials[0]['img'] = cyberchimps_get_option( 'cyberchimps_blog_testimonial_image_one', $directory_uri . apply_filters( 'cyberchimps_testimonial_img1', '/elements/lib/images/testimonial/client01.jpg' ) );
                $testimonials[1]['img'] = cyberchimps_get_option( 'cyberchimps_blog_testimonial_image_two', $directory_uri . apply_filters( 'cyberchimps_testimonial_img2', '/elements/lib/images/testimonial/client01.jpg' ) );
                $testimonials[2]['img'] = cyberchimps_get_option( 'cyberchimps_blog_testimonial_image_three', $directory_uri . apply_filters( 'cyberchimps_testimonial_img3', '/elements/lib/images/testimonial/client01.jpg' ) );
               
                // get testimonial clients
                $testimonials[0]['client'] = cyberchimps_get_option( 'cyberchimps_blog_client_one', apply_filters( 'cyberchimps_testimonial_client1', 'Nancy Martin' ) );
                $testimonials[1]['client'] = cyberchimps_get_option( 'cyberchimps_blog_client_two', apply_filters( 'cyberchimps_testimonial_client2', 'Nancy Martin' ) );
                $testimonials[2]['client'] = cyberchimps_get_option( 'cyberchimps_blog_client_three', apply_filters( 'cyberchimps_testimonial_client3', 'Nancy Martin' ) );
                
                // get testimonial  - about clients
                
                $testimonials[0]['client_abt'] = cyberchimps_get_option( 'cyberchimps_blog_client_abt_one', apply_filters( 'cyberchimps_testimonial_client_abt1', 'Developer' ) );
                $testimonials[1]['client_abt'] = cyberchimps_get_option( 'cyberchimps_blog_client_abt_two', apply_filters( 'cyberchimps_testimonial_client_abt2', 'Designer' ) );
                $testimonials[2]['client_abt'] = cyberchimps_get_option( 'cyberchimps_blog_client_abt_three', apply_filters( 'cyberchimps_testimonial_client_abt3', 'Developer' ) );
                
                // get testimonial description
                
                $testimonials[0]['text'] = cyberchimps_get_option( 'cyberchimps_testimonial_one_text', apply_filters( 'cyberchimps_testimonial_text1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc nec nisl ut est ultricies pellentesque id eu massa. Pellentesque fermentum posuere odio non accumsan. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris scelerisque auctor ligula sed aliquet' ) );
                $testimonials[1]['text'] = cyberchimps_get_option( 'cyberchimps_testimonial_two_text', apply_filters( 'cyberchimps_testimonial_text2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc nec nisl ut est ultricies pellentesque id eu massa. Pellentesque fermentum posuere odio non accumsan. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris scelerisque auctor ligula sed aliquet' ) );
                $testimonials[2]['text'] = cyberchimps_get_option( 'cyberchimps_testimonial_three_text', apply_filters( 'cyberchimps_testimonial_text3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc nec nisl ut est ultricies pellentesque id eu massa. Pellentesque fermentum posuere odio non accumsan. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris scelerisque auctor ligula sed aliquet' ) );
               
	} 
        $skin_color = cyberchimps_get_option('cyberchimps_skin_color');
        ?>
	<?php 
        if($testimonial_background)
        {
        ?>
                <style type="text/css" media="all">
                                                      #testimonial_section{ 
                                                                  background : url("<?php echo $testimonial_background; ?>") no-repeat scroll 0 0 / cover;
                                                                  background-position:center;
                                                      }	
                </style>
        <?php
        }
        else
        {
          if($skin_color == 'green') 
          {
              
          ?>
            <style>
                      #testimonial_section{
                          background-color: <?php echo '#3a6d07';?>;
                      }
            </style>
           <?php
          }
          else if($skin_color == 'legacy') 
          {
           ?>
            <style>
                      #testimonial_section{
                          background-color: <?php echo '#b6b6b6';?>;
                      }
            </style>
           <?php   
          }         
          else
          {
            ?>
            <style>
                      #testimonial_section{
                          background-color: <?php echo '#b6b6b6';?>;
                      }
            </style>
            <?php
              
          }
          
        
        }
        ?>
					
<?php
	/* $testimonial_args = array(
					'numberposts'         => 3,
					'offset'              => 0,
					'testimonial_categories' => $testimonial_category,
					'orderby'             => 'post_date',
					'order'               => 'ASC',
					'post_type'           => 'testimonial_posts',
					'post_status'         => 'publish',
					'suppress_filters'    => false
				);
		
				$testimonial_posts2 = get_posts( $testimonial_args ); */

?>
	<div id="if_testimonial_top">
		<?php if( !empty($if_testimonial_title) ) { ?>
			
		
				<?php if(!empty($if_testimonial_title)) { ?>
				<h2 class="if_main_title">
					<?php echo $if_testimonial_title; ?>
				</h2>
				<?php } ?>
		
			
		<?php } ?>
	</div> 


      <section class="if_slider_text_img">
        <div id="slider2" class="flexslider">
          <ul class="slides">
			<?php	foreach( $testimonials as $testimonial) {
        					 ?>

				<li class="col-md-12">
                                    <span class="if_testimonial_text"><?php if(!empty($testimonial['text'])){echo $testimonial['text'];} ?></span>
					<?php if(!empty($testimonial['text']))
							{ ?>
							<hr class="after_testimonial_text"> </hr>
					<?php } ?>
					<div class="if_testimonial_author">
                                                <?php  if(!empty($testimonial['client'])){echo $testimonial['client'];} ?>
					</div>
					<div class="if_testimonial_abt_author">
                                                <?php if(!empty($testimonial['client_abt'])){echo $testimonial['client_abt'];} ?>
					</div>
				</li>
			<?php  } ?>
    		
            
          </ul>
        </div>
	<?php $slide_counters = 0; ?>
        <div id="carousel2" class="flexslider">
          <ul class="slides if_carousel" >
			<?php	foreach( $testimonials as $testimonial ) {
                          if(!empty($testimonial['img'])){

					/* Post-specific variables */
					//$image    = get_post_meta( $post2->ID, 'testimonial_post_image', true );
					?>
					
 					<li class="col-md-4"> 
						<a id="carousel-selector-<?php echo $slide_counters; ?>" class="<?php echo ( $slide_counters == 0 ) ? "selected" : ""; ?>">
                            <img src="<?php echo $testimonial['img']; ?>" class="img-responsive">
							
                        </a>
						
					</li>
			<?php  $slide_counters++; 
					} 
                        } 
                                        ?>
  	    		
            
          </ul>
        </div>
      </section> 
  
	<script type="text/javascript" charset="utf-8">
	(function($) {

	// store the slider in a local variable
	  var $window = $(window),
		  flexslider = { vars:{} };
	 
	  // tiny helper function to add breakpoints
	  function getGridSize() {
		return (window.innerWidth < 480) ? 70 :
			   (window.innerWidth < 767) ? 90 :
		       (window.innerWidth < 1200) ? 100 : 130;
	  }
	 
	$(window).load(function() {
		 $('#carousel2').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: true,
			slideshow: false,
			slideshowSpeed: 7000,
			itemWidth: getGridSize(),
			itemMargin: 20,
			asNavFor: '#slider2'
		  });
		 
		  $('#slider2').flexslider({
			animation: "slide",
			controlNav: false,
			directionNav: false,
			animationLoop: true,
			slideshow: false,
			slideshowSpeed: 7000,
			sync: "#carousel2"
		  });
		});
		// check grid size on resize event
	  $window.resize(function() {
		var gridSize = getGridSize();
	 
		flexslider.vars.itemWidth = gridSize;
	  });
						})(jQuery);
			</script> 


<?php
}