<?php

/*
	Search Form
	
	Creates the iFeature search form 
	
	Copyright (C) 2011 CyberChimps
*/

?>

<form method="get" class="searchform" action="<?php echo home_url(); ?>/">
		<div><input type="text" name="s" class="s" value="Search" id="searchsubmit" onfocus="if (this.value == 'Search') this.value = '';" /></div>
	<div><input type="submit" class="searchsubmit" value="" /></div>
</form>