<?php

/*
	
	Footer
	Establishes the widgetized footer and static post-footer section of iFeature. 
	Copyright (C) 2011 CyberChimps
	Version 2.0
	
*/

global $options, $themeslug;

?>

</div><!--end container 12 main wrap-->	

<div id="footer">
     <div class="container_12">
    	
	<!-- Begin @Core footer hook content-->
		<?php chimps_footer(); ?>
	<!-- End @Core footer hook content-->
			   
	</div><!--end footer_wrap-->
</div><!--end footer-->
	
	<div id="afterfooter">
		<div id="afterfooterwrap">
		
		<!-- Begin @Core afterfooter hook content-->
			<?php chimps_afterfooter(); ?>
		<!-- End @Core afterfooter hook content-->
				
		</div>  <!--end afterfooterwrap-->	
	</div> <!--end afterfooter-->	
	
	
	<?php wp_footer(); ?>	
</body>

</html>
