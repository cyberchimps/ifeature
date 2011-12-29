<?php
/**
* Searchform used by the iFeature theme.
*
* Authors: Tyler Cunningham, Trent Lapinski.
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: license.txt.
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package iFeature
* @since 3.1
*/
?>

<form method="get" class="searchform" action="<?php echo home_url(); ?>/">
	<div id="magnify"><img src="<?php echo get_template_directory_uri() ;?>/images/magnify.png" alt="magnify" /></div>
	<div><input type="text" name="s" class="s" value="Search" id="searchsubmit" onfocus="if (this.value == 'Search') this.value = '';" /></div>
	<div><input type="submit" class="searchsubmit" value="" /></div>
</form>