<?php
/**
* Twitterbar actions used by the CyberChimps Synapse Core Framework
*
* Author: Tyler Cunningham
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Synapse
* @since 1.0
*/

/**
* Synapse Twitterbar actions
*/
add_action( 'synapse_twitterbar_section', 'synapse_twitterbar_section_content' );

/**
* Retrieves the Twitterbar options and sets up the HTML
*/
function synapse_twitterbar_section_content() {
	global $options, $themeslug, $post; //call globals
	$root = get_template_directory_uri();
	
	if (is_page()) {
	$handle = get_post_meta($post->ID, 'twitter_handle' , true); 
	}
	else {
	$handle = $options->get($themeslug.'_blog_twitter');
	}
	
//Get Latest Tweet
function latest_tweet($username,$tweetnumber){
$url = "http://search.twitter.com/search.atom?q=from:$username&amp;rpp=10";
$xml = simplexml_load_file($url);
$tweettitle = $xml->entry[$tweetnumber]->title;
$mytweet = $xml->entry[$tweetnumber]->content;
$firstChar = substr($tweettitle, 0, 1);
//Exclude @ replies
if($firstChar == "@"){
//If this tweet is an @ reply move on to the previous one
while ($firstChar == "@"){
$tweetnumber++;
$tweettitle = $xml->entry[$tweetnumber]->title;
$mytweet = $xml->entry[$tweetnumber]->content;
$firstChar = substr($tweettitle, 0, 1);
if($firstChar != "@"){
//If the previous tweet is not an @ reply output it
return $mytweet;
}
}
}else{
//If first tweet is not an @ reply output it
return $mytweet;
}
}
//End Get Latest Tweet

function profileXML($user)

           {

$objDOM = new DOMDocument();

$objDOM->load("http://api.twitter.com/1/users/show.xml?screen_name=".$user);

$note = $objDOM->getElementsByTagName("user");



foreach($note as $value )

       {

$id = $value->getElementsByTagName("id");

$id  = $id->item(0)->nodeValue;

$profile["id"]=$id;

                
}    


return $profile;



}


	?>
	<div class="row">
		<div id="twitterbar" class="twelve columns"><!--id="twitterbar"-->
			<div id="twittertext">
				<a href=" http://twitter.com/<?php echo $handle ; ?>" > <img src="<?php echo "$root/images/twitterbird.png" ?>" /> <?php echo $handle ;?> - </a><?php echo  latest_tweet($handle, 1); print_r(profileXML("cyberchimps")); ?>
			</div>
		</div><!--end twitterbar--> 
	</div>
		<?php
}	

/**
* End
*/

?>