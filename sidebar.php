<?php

/*
	Sidebar
	
	Creates the widgetized sidebar of iFeature. 
	
	Copyright (C) 2011 CyberChimps
*/

?>

<div id="sidebar_right">
	<div id="sidebar">

    <?php if (dynamic_sidebar('Sidebar Widgets')) : else : ?>
    
        <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
		
		<div class="sidebar-widget-style">
    	<h2 class="sidebar-widget-title">Subscribe</h2>
    	<ul>
    		<li><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
    		<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></li>
    	</ul>
    	</div>
		
		<div class="sidebar-widget-style">    
		<h2 class="sidebar-widget-title">Recent Posts</h2>
		<ul>
		<?php
			$args = array( 'numberposts' => '5' );
			$recent_posts = wp_get_recent_posts( $args );
			foreach( $recent_posts as $post ){
					echo '<li><a href="' . get_permalink($post["ID"]) . '" title="Look '.$post["post_title"].'" >' .   $post["post_title"].'</a> </li> ';
		}
		?>
		</ul>
    	</div>
    
    	<div class="sidebar-widget-style">
    	<h2 class="sidebar-widget-title">Archives</h2>
    	<ul>
    		<?php wp_get_archives('type=monthly'); ?>
    	</ul>
    	</div>
        
        <div class="sidebar-widget-style">
        <h2 class="sidebar-widget-title">Categories</h2>
        <ul>
    	   <?php wp_list_categories('show_count=1&title_li='); ?>
        </ul>
        </div>
        
    	<div class="sidebar-widget-style">
    	<h2 class="sidebar-widget-title">WordPress</h2>
    	<ul>
    		<?php wp_register(); ?>
    		<li><?php wp_loginout(); ?></li>
    		<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
    		<?php wp_meta(); ?>
    	</ul>
    	</div>
	
	<?php endif; ?>
	</div><!--end sidebar-->
</div><!--end sidebar_right-->