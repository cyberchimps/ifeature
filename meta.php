<?php

/*
	Section: Meta
	Authors: Trent Lapinski, Tyler Cunningham 
	Description: Creates post meta content.
	Version: 1.0	
*/

?>

<div class="meta">
	Published by <?php the_author() ?> on <a href="<?php the_permalink() ?>"><?php the_time('F jS, Y') ?></a> - in <?php the_category(', ') ?>
</div>