<?php

/*
	Section: Pagination
	Authors: Trent Lapinski, Tyler Cunningham 
	Description: Controls iFeature pagination.
	Version: 1.0	
*/

?>

<div class="navigation">
	<div class="next-posts"><?php next_posts_link( __('&laquo; Older Entries', 'ifeature' )); ?></div>
	<div class="prev-posts"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'ifeature' )); ?></div>
</div>