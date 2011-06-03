<?php
/*

	Section: Share
	Author: Trent Lapinski
	Description: Share functionality for posts.
	Version: 0.1
	
*/
?>

<div class="share">
<a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/share/facebook.png" alt="Share on Facebook" /></a> <a href="http://twitter.com/home?status=<?php the_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/share/twitter.png" alt="Share on Twitter" /></a> <a href="http://reddit.com/submit?url=<?php the_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/share/reddit.png" alt="Share on Reddit" /></a> <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/share/linkedin.png" alt="Share on LinkedIn" /></a>
</div>