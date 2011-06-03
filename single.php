<?php 

/*
	Single
	
	Establishes the single post template of iFeature. 
	
	Copyright (C) 2011 CyberChimps
*/

get_header(); ?>

<div id="content_wrap">
	
	<div id="content_left">
	
		<div class="content_padding">
				
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<div class="post_container">
				
					<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
						<h2 class="posts_title"><?php the_title(); ?></h2>
			
						<?php get_template_part ('meta', 'single'); ?>

							<div class="entry">
								<?php the_content(); ?>
							</div><!--end entry-->
						<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
						
							<?php 
								$showfblike		= $options['if_show_fb_like'];
							?>
							<?php if ($showfblike == "1" ):?>
							<div class="fb" >
								<iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink() ?>&layout=standard&show_faces=true&width=450&action=like&colorscheme=light" scrolling="no" frameborder="0"  allowTransparency="true" style="border:none; overflow:hidden; width:530px; height:28px"></iframe>
							</div>
							<?php endif;?>
							<!--end fb-->
						
							<div class="tags">
								<?php the_tags('Tags: ', ', ', '<br />'); ?>
							</div><!--end tags-->

							<div class="postmetadata">
									<?php get_template_part ('share', 'single' ); ?>
								<div class="comments">
									<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
								</div><!--end comments-->	
							</div><!--end postmetadata-->
							
					</div><!--end post_class-->

		<?php comments_template(); ?>
		

		<?php endwhile; endif; ?>
				</div><!--end post_container-->
		</div><!--end content_padding-->
	</div> <!--end content_left-->
	
	<?php get_sidebar(); ?>
		
</div><!--end content_wrap-->
<div style=clear:both;></div>

<?php get_footer(); ?>