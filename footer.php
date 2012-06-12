<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/*
	
	Footer
	Establishes the widgetized footer and static post-footer section of iFeature. 
	Copyright (C) 2011 CyberChimps
	Version 2.0
	
*/

global $options, $themeslug;

?>
	
<?php if ($options->get($themeslug.'_disable_footer') != "0"):?>	

</div><!--end container wrap-->

	<div id="footer">
     	<div class="container">
     		<div class="row">
    	
	<!-- Begin @synapse footer hook content-->
		<?php synapse_footer(); ?>
	<!-- End @synapse footer hook content-->
	
	<?php endif;?>
	

		</div><!--end footer_wrap-->
	</div><!--end footer-->
</div> 

<?php if ($options->get($themeslug.'_disable_afterfooter') != "0"):?>

	<div id="afterfooter">
		<div id="afterfooterwrap">
		<div class="row">	
		<!-- Begin @synapse afterfooter hook content-->
			<?php synapse_secondary_footer(); ?>
		<!-- End @synapse afterfooter hook content-->
				
		</div>  <!--end afterfooterwrap-->	
	</div> <!--end afterfooter-->	
		</div> 	
	<?php endif;?>
	
	<?php wp_footer(); ?>	
</body>

</html>
