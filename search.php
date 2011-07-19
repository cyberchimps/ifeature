<?php 

/*
	Search
	
	Establishes the iFeature search functionality. 
	
	Copyright (C) 2011 CyberChimps
*/

get_header(); ?>

<div id="content_wrap">

	<div id="content_left">
		
		<div class="content_padding">

	<?php if (have_posts()) : ?>

		<h2><?php printf( __( 'Search Results For: %s' ), '<span>' . get_search_query() . '</span>' ); ?></h2>


		<?php while (have_posts()) : the_post(); ?>
		
		<div class="post_container">

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				<?php get_template_part('meta', 'search' ); ?>

				<div class="entry">

					<?php the_excerpt(); ?>

				</div>

			</div>

	</div><!--end post_container-->
		<?php endwhile; ?>

		<?php get_template_part('pagination', 'search'); ?>

	<?php else : ?>

		<h2>No posts found.</h2>

	<?php endif; ?>
		</div><!--end content_padding-->
	</div><!--end content_left-->

	<div id="sidebar_right"><?php get_sidebar(); ?></div>
</div><!--end content_wrap-->
<div class="clear"></div>
<?php get_footer(); ?>
