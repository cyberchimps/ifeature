<?php 

/*
	Page
	Establishes the core iFeature page tempate.
	Version: 2.0
	Copyright (C) 2011 CyberChimps

*/

/* Header call. */

	get_header(); 
	
/* End header. */	


	$hidetitle = get_post_meta($post->ID, 'hide_title' , true);

?>

<div id="content_wrap">

	<div id="content_left">
		
		<div class="content_padding">
		
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<div class="post_container">
			
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

					<?php if ($hidetitle == ""): ?>
				
			

					<h2 class="posts_title"><?php the_title(); ?></h2>
						<?php endif;?>


					<div class="entry">

						<?php the_content(); ?>

						<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

					</div><!--end entry-->

				<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

				</div><!--end post-->
				
			<?php comments_template(); ?>

			<?php endwhile; endif; ?>
			</div><!--end post_container-->
			
		</div><!--end content_padding-->
		
	</div><!--end content_left-->

	<div id="sidebar_right"><?php get_sidebar(); ?></div>
</div><!--end content_wrap-->

<div style=clear:both;></div>
<?php get_footer(); ?>
