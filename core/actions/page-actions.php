<?php

add_action('chimps_page_section', 'chimps_page_section_content' );


function chimps_page_section_content() { 
	global $options, $themeslug, $post;
	
	
	$enable = get_post_meta($post->ID, 'page_enable_slider' , true);
	$size = get_post_meta($post->ID, 'page_slider_size' , true);
	$hidetitle = get_post_meta($post->ID, 'hide_page_title' , true);
	$sidebar = get_post_meta($post->ID, 'page_sidebar' , true);
	$callout = get_post_meta($post->ID, 'enable_callout_section' , true);
	$twitterbar = get_post_meta($post->ID, 'enable_twitter_bar' , true);
	$enableboxes = get_post_meta($post->ID, 'enable_box_section' , true);
	$pagecontent = get_post_meta($post->ID, 'hide_page_content' , true);
	$test = get_post_meta($post->ID, 'page_section_order' , true);
	
	if ($sidebar == "1" ) {
		$content_grid = 'grid_12';
	}
	
	else {
		$content_grid = 'grid_8';
	}



?>
<div class="container_12">

	<?php if ($sidebar == "2"): ?>
		<div id="sidebar" class="grid_3">
			<?php get_sidebar('left'); ?>
		</div>
	<?php endif;?>
	
	
<?php if (function_exists('chimps_breadcrumbs')) chimps_breadcrumbs(); ?>
		
		<div id="content" class="<?php echo $content_grid; ?>">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<div class="post_container">
			
				<div class="post" id="post-<?php the_ID(); ?>">
				<?php if ($hidetitle == ""): ?>
				

					<h2 class="posts_title"><?php the_title(); ?></h2>
						<?php endif;?>

					<div class="entry">

						<?php the_content(); ?>
						
					</div><!--end entry-->
					
					<div style=clear:both;></div>
					<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>


				<?php edit_post_link('Edit', '<p>', '</p>'); ?>

				</div><!--end post-->
		
			<?php comments_template(); ?>

			<?php endwhile; endif; ?>
			</div><!--end post_container-->
				
		
		
	</div><!--end content_left-->
	
	<?php if ($sidebar == "0" OR $sidebar == ""): ?>
		<div id="sidebar" class="grid_4">
			<?php get_sidebar(); ?>
		</div>
	<?php endif;?>
	
</div><!--end container_12-->

<div class='clear'>&nbsp;</div>

<?php
}


