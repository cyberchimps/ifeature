<?php

/*
	Section: Meta
	Authors: Trent Lapinski, Tyler Cunningham 
	Description: Creates post meta content.
	Version: 2.0	
*/
	$options = get_option('ifeature');
	
	$author = $options['if_hide_author'];
	$category = $options['if_hide_categories'];
	$date = $options['if_hide_date'];
	$comments = $options['if_hide_comments'];


?>

<div class="meta">
<?php if ($author != '1'):?><?php printf( __( 'Published by', 'ifeature' )); ?> <?php the_author_posts_link(); ?> <?php endif;?> <?php if ($category != '1'):?><?php printf( __( 'in', 'ifeature' )); ?> <?php the_category(', ') ?> <?php endif;?><?php if ($date != '1'):?> <?php printf( __( 'on', 'ifeature' )); ?> <a href="<?php the_permalink() ?>"><?php the_time('F jS, Y') ?></a><?php endif;?></div>
