<?php
/*
Template Name: Full Width Page
Copyright (C) 2011 CyberChimps
*/
?>

<?php get_header(); ?>

<div id="content_wrap">

	<div id="content_fullwidth">
	
		<div class="content_padding">
		
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<div class="post_container">
			
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

					<h2 class="posts_title"><?php the_title(); ?></h2>

					<div class="entry">

						<?php the_content(); ?>

						<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

					</div>

				<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

				</div> <!--end have_posts-->
				
			</div><!--end post_container-->
		
			<?php comments_template(); ?>

			<?php endwhile; endif; ?>
			
		</div> <!--end content_padding-->
	</div> <!--end content_fullwidth-->
</div>  <!--end content_wrap-->

<?php get_footer(); ?>
