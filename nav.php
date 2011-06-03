<?php
/*

	Section: Navigation
	Author: Tyler Cunningham
	Description: Creates site navigation
	Version: 0.1
	
*/

	$homeimage		= get_option('if_menuicon') ? '': 'default';

?>

<div id="navbackground">

<div id="navcontainer">

<?php if ($homeimage == 'default' ):?>
<div id="homebutton"><a href="<?php echo home_url(); ?>/"><img src="<?php echo get_template_directory_uri(); ?>/images/home.png?>" alt="Home" /></a></div>
<?php endif;?>
<?php if ($homeimage != 'default' ):?>
<div id="homebutton"><a href="<?php echo home_url(); ?>/"><img src="<?php echo $homeimage?>" alt="Home" /></a></div>
<?php endif;?>
<div id="searchbar">
<?php get_search_form(); ?>
</div>
    <div id="sfwrapper">
        <?php wp_nav_menu( array(
	    'theme_location' => 'header-menu', // Setting up the location for the main-menu, Main Navigation.
	    'menu_class' => 'sf-menu', //Adding the class for dropdowns
	    'container_id' => 'navwrap', //Add CSS ID to the containter that wraps the menu.
	    'fallback_cb' => 'ifeature_menu_fallback', //if wp_nav_menu is unavailable, WordPress displays wp_page_menu function, which displays the pages of your blog.
	    )
	);
    ?>
    </div>

</div><!--end navcontainer-->
    
</div>    
<!--end nav.php-->