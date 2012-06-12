<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/*
	Comments
	Creates the Synapse comments section.
	Copyright (C) 2011 CyberChimps
	Version 2.0
*/

?>

<!-- Begin @synapse synapse_before_comments hook content-->
	<?php synapse_before_comments(); ?>
<!-- Begin @synapse synapse_before_comments hook content-->

<!-- Begin @synapse synapse_comments hook content-->
	<?php synapse_comments(); ?>
<!-- Begin @synapse synapse_comments hook content-->

<!-- Begin @synapse synapse_after_comments hook content-->
	<?php synapse_after_comments(); ?>
<!-- Begin @synapse synapse_after_comments hook content-->