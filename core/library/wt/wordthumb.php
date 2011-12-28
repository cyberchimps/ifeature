<?php
/**
 * WordThumb by Mark Maunder http://markmaunder.com/
 * Based on work done by Ben Gillbanks, Tim McDaniels and Darren Hoyt on timthumb
 * http://code.google.com/p/wordthumb/
 * 
 * GNU General Public License, version 2
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 */

//Main config vars
define ('VERSION', '1.07');				// Version of this script 
define ('DEBUG_ON', false);				// Enable debug logging to web server error log (STDERR)
define ('DEBUG_LEVEL', 1);				// Debug level 1 is less noisy and 3 is the most noisy
define ('MEMORY_LIMIT', '30M');				// Set PHP memory limit
define ('BLOCK_EXTERNAL_LEECHERS', false);		// If the image or webshot is being loaded on an external site, display a red "No Hotlinking" gif.

//Image fetching and caching
define ('ALLOW_EXTERNAL', TRUE);			// Allow image fetching from external websites. Will check against ALLOWED_SITES if ALLOW_ALL_EXTERNAL_SITES is false
define ('ALLOW_ALL_EXTERNAL_SITES', FALSE);		// Less secure. 
define ('FILE_CACHE_ENABLED', TRUE);			// Should we store resized/modified images on disk to speed things up?
define ('FILE_CACHE_TIME_BETWEEN_CLEANS', 86400);	// Minimum time between checking if the cache needs cleaning
define ('FILE_CACHE_SIZE', 1000);			// Number of files to store before clearing cache (once time betweeen cleans has elapsed)
define ('FILE_CACHE_MAX_FILE_AGE', 86400);		// How old does a file have to be to be deleted from the cache
define ('FILE_CACHE_SUFFIX', '.wordthumb.txt');		// What to put at the end of all files in the cache directory so we can identify them
define ('FILE_CACHE_DIRECTORY', '');		// Directory where images are cached. Left blank it will use the system temporary directory (which is better for security)
define ('MAX_FILE_SIZE', 10485760);			// 10 Megs is 10485760. This is the max internal or external file size that we'll process.  
define ('CURL_TIMEOUT', 10);				// Timeout duration for Curl. This only applies if you have Curl installed and aren't using PHP's default URL fetching mechanism.

//Browser caching
define ('BROWSER_CACHE_MAX_AGE', 864000);		// Time to cache in the browser
define ('BROWSER_CACHE_DISABLE', false);			// Use for testing if you want to disable all browser caching

//Image width/height
define ('MAX_WIDTH', 1500);				// Maximum image width
define ('MAX_HEIGHT', 1500);				// Maximum image height

/*
	-------====Website Screenshots configuration - BETA====-------
	
	If you just want image thumbnails and don't want website screenshots, you can safely leave this as is.	
	
	If you would like to get website screenshots set up, you will need root access to your own server.

	Enable ALLOW_ALL_EXTERNAL_SITES so you can fetch any external web page. This is more secure now that we're using a non-web folder for cache.
	Enable BLOCK_EXTERNAL_LEECHERS so that your site doesn't generate thumbnails for the whole Internet.

	Instructions to get website screenshots enabled on Ubuntu Linux:

	1. Install Xvfb with the following command: sudo apt-get install subversion libqt4-webkit libqt4-dev g++ xvfb
	2. Go to a directory where you can download some code
	3. Check-out the latest version of CutyCapt with the following command: svn co https://cutycapt.svn.sourceforge.net/svnroot/cutycapt
	4. Compile CutyCapt by doing: cd cutycapt/CutyCapt
	5. qmake
	6. make
	7. cp CutyCapt /usr/local/bin/
	8. Test it by running: xvfb-run --server-args="-screen 0, 1024x768x24" CutyCapt --url="http://markmaunder.com/" --out=test.png
	9. If you get a file called test.png with something in it, it probably worked. Now test the script by accessing it as follows:
	10. http://yoursite.com/path/to/wordthumb.php?src=http://markmaunder.com/&webshot=1

	Notes on performance: 
	The first time a webshot loads, it will take a few seconds.
	From then on it uses the regular wordthumb caching mechanism with the configurable options above
	and loading will be very fast.

	--ADVANCED USERS ONLY--
	If you'd like a slight speedup (about 25%) and you know Linux, you can run the following command which will keep Xvfb running in the background.
	nohup Xvfb :100 -ac -nolisten tcp -screen 0, 1024x768x24 > /dev/null 2>&1 &
	Then set WEBSHOT_XVFB_RUNNING = true below. This will save your server having to fire off a new Xvfb server and shut it down every time a new shot is generated. 
	You will need to take responsibility for keeping Xvfb running in case it crashes. (It seems pretty stable)
	You will also need to take responsibility for server security if you're running Xvfb as root. 


*/
define ('WEBSHOT_ENABLED', false);			//Beta feature. Adding webshot=1 to your query string will cause the script to return a browser screenshot rather than try to fetch an image.
define ('WEBSHOT_CUTYCAPT', '/usr/local/bin/CutyCapt'); //The path to CutyCapt. 
define ('WEBSHOT_XVFB', '/usr/bin/xvfb-run');		//The path to the Xvfb server
define ('WEBSHOT_SCREEN_X', '1024');			//1024 works ok
define ('WEBSHOT_SCREEN_Y', '768');			//768 works ok
define ('WEBSHOT_COLOR_DEPTH', '24');			//I haven't tested anything besides 24
define ('WEBSHOT_IMAGE_FORMAT', 'png');			//png is about 2.5 times the size of jpg but is a LOT better quality
define ('WEBSHOT_TIMEOUT', '300');			//Seconds to wait for a webshot
define ('WEBSHOT_USER_AGENT', "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.9.2.18) Gecko/20110614 Firefox/3.6.18"); //I hate to do this, but a non-browser robot user agent might not show what humans see. So we pretend to be Firefox
define ('WEBSHOT_JAVASCRIPT_ON', true);			//Setting to false might give you a slight speedup and block ads. But it could cause other issues.
define ('WEBSHOT_JAVA_ON', false);			//Have only tested this as fase
define ('WEBSHOT_PLUGINS_ON', true);			//Enable flash and other plugins
define ('WEBSHOT_PROXY', '');				//In case you're behind a proxy server. 
define ('WEBSHOT_XVFB_RUNNING', false);			//ADVANCED: Enable this if you've got Xvfb running in the background.


// If ALLOW_EXTERNAL is true and ALLOW_ALL_EXTERNAL_SITES is false, then external images will only be fetched from these domains and their subdomains. 
$ALLOWED_SITES = array (
		'flickr.com',
		'picasa.com',
		'img.youtube.com',
		'upload.wikimedia.org',
);
// -------------------------------------------------------------
// -------------- STOP EDITING CONFIGURATION HERE --------------
// -------------------------------------------------------------

wordthumb::start();

class wordthumb {
	protected $src = "";
	protected $url = false;
	protected $myHost = "";
	protected $isURL = false;
	protected $cachefile = '';
	protected $errors = array();
	protected $toDeletes = array();
	protected $cacheDirectory = '';
	protected $startTime = 0;
	protected $lastBenchTime = 0;
	protected $isOwnHost = false;
	protected $cropTop = false;
	protected $salt = "";
	protected $fileCacheVersion = 1; //Generally if wordthumb.php is modifed (upgraded) then the salt changes and all cache files are recreated. This is a backup mechanism to force regen.
	protected $filePrependSecurityBlock = "<?php die('Execution denied!'); //"; //Designed to have three letter mime type, space, question mark and greater than symbol appended. 6 bytes total.
	protected static $curlDataWritten = 0;
	protected static $curlFH = false;
	public static function start(){
		$word = new wordthumb();
		$word->handleErrors();
		$word->securityChecks();
		if($word->tryBrowserCache()){
			exit(0);
		}
		$word->handleErrors();
		if(FILE_CACHE_ENABLED && $word->tryServerCache()){
			exit(0);
		}
		$word->handleErrors();
		$word->run();
		$word->handleErrors();
		exit(0);
	}
	public function __construct(){
		global $ALLOWED_SITES;
		$this->startTime = microtime(true);
		$this->debug(1, "Starting new request from " . $this->getIP() . " to " . $_SERVER['REQUEST_URI']);
		//On windows systems I'm assuming fileinode returns an empty string or a number that doesn't change. Check this.
		$this->salt = @filemtime(__FILE__) . '-' . @fileinode(__FILE__);
		$this->debug(3, "Salt is: " . $this->salt);
		if(FILE_CACHE_DIRECTORY){
			if(! is_dir(FILE_CACHE_DIRECTORY)){
				@mkdir(FILE_CACHE_DIRECTORY);
				if(! is_dir(FILE_CACHE_DIRECTORY)){
					$this->error("Could not create the file cache directory.");
					return false;
				}
			}
			$this->cacheDirectory = FILE_CACHE_DIRECTORY;
			touch($this->cacheDirectory . '/index.php');
			touch($this->cacheDirectory . '/index.html');
		} else {
			$this->cacheDirectory = sys_get_temp_dir();
		}
		$this->myHost = preg_replace('/^www\./i', '', $_SERVER['HTTP_HOST']);
		$this->src = $this->param('src');
		$this->url = parse_url($this->src);
		if(strlen($this->src) <= 3){
			$this->error("No image specified");
			return false;
		}
		if(BLOCK_EXTERNAL_LEECHERS && array_key_exists('HTTP_REFERER', $_SERVER) && (! preg_match('/^https?:\/\/(?:www\.)?' . $this->myHost . '(?:$|\/)/i', $_SERVER['HTTP_REFERER']))){
			$imgData = base64_decode("R0lGODlhUAAMAIAAAP8AAP///yH5BAAHAP8ALAAAAABQAAwAAAJpjI+py+0Po5y0OgAMjjv01YUZ\nOGplhWXfNa6JCLnWkXplrcBmW+spbwvaVr/cDyg7IoFC2KbYVC2NQ5MQ4ZNao9Ynzjl9ScNYpneb\nDULB3RP6JuPuaGfuuV4fumf8PuvqFyhYtjdoeFgAADs=");
			header('Content-Type: image/gif');
			header('Content-Length: ' . sizeof($imgData));
			header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
			header("Pragma: no-cache");
			header('Expires: ' . gmdate ('D, d M Y H:i:s', time()));
			echo $imgData;
			return false;
			exit(0);
		}
		if(preg_match('/https?:\/\/(?:www\.)?' . $this->myHost . '(?:$|\/)/i', $this->src)){
			$this->isOwnHost = true;
		}
		if(preg_match('/^https?:\/\/[^\/]+/i', $this->src)){
			$this->debug(2, "Is a request for an external URL: " . $this->src);
			$this->isURL = true;
		} else {
			$this->debug(2, "Is a request for an internal file: " . $this->src);
		}
		if($this->isURL && (! ALLOW_EXTERNAL)){
			$this->error("You are not allowed to fetch images from an external website.");
			return false;
		}
		if($this->isURL){
			if(ALLOW_ALL_EXTERNAL_SITES || $this->isOwnHost){
				$this->debug(2, "Fetching from all external sites is enabled or this is our own server.");
			} else {
				$this->debug(2, "Fetching only from selected external sites is enabled.");
				$allowed = false;
				foreach($ALLOWED_SITES as $site){
					if (preg_match ('/(?:^|\.)' . $site . '$/i', $this->url['host'])) {
						$this->debug(3, "URL hostname {$this->url['host']} matches $site so allowing.");
						$allowed = true;
					}
				}
				if(! $allowed){
					return $this->error("You may not fetch images from that site. To enable this site in wordthumb, you can either add it to \$ALLOWED_SITES and set ALLOW_EXTERNAL=true. Or you can set ALLOW_ALL_EXTERNAL_SITES=true, depending on your security needs.");
				}
			}
		}

		$cachePrefix = ($this->isURL ? 'wordthumb_ext_' : 'wordthumb_int_');
		$this->cachefile = $this->cacheDirectory . '/' . $cachePrefix . md5($this->salt . $_SERVER ['QUERY_STRING'] . $this->fileCacheVersion) . FILE_CACHE_SUFFIX;
		$this->debug(2, "Cache file is: " . $this->cachefile);

		return true;
	}
	public function __destruct(){
		foreach($this->toDeletes as $del){
			$this->debug(2, "Deleting temp file $del");
			@unlink($del);
		}
	}
	public function run(){
		if($this->isURL){
			if(! ALLOW_EXTERNAL){
				$this->debug(1, "Got a request for an external image but ALLOW_EXTERNAL is disabled so returning error msg.");
				$this->error("You are not allowed to fetch images from an external website.");
				return false;
			}
			$this->debug(3, "Got request for external image. Starting serveExternalImage.");
			if($this->param('webshot')){
				if(WEBSHOT_ENABLED){
					$this->debug(3, "webshot param is set, so we're going to take a webshot.");
					$this->serveWebshot();
				} else {
					$this->error("You added the webshot parameter but webshots are disabled on this server. You need to set WEBSHOT_ENABLED == true to enable webshots.");
				}
			} else {
				$this->debug(3, "webshot is NOT set so we're going to try to fetch a regular image.");
				$this->serveExternalImage();
			}
		} else {
			$this->debug(3, "Got request for internal image. Starting serveInternalImage()");
			$this->serveInternalImage();
		}
		return true;
	}
	protected function handleErrors(){
		if($this->haveErrors()){ 
			$this->serveErrors(); 
			exit(0); 
		}
		return false;
	}
	protected function tryBrowserCache(){
		if(BROWSER_CACHE_DISABLE){ $this->debug(3, "Browser caching is disabled"); return false; }
		if (!empty ($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
			if (strtotime ($_SERVER['HTTP_IF_MODIFIED_SINCE']) < strtotime ('now')) {
				header ('HTTP/1.1 304 Not Modified');
				$this->debug(1, "Returning 304 not modified");
				return true;
			}
		}
		return false;
	}
	protected function tryServerCache(){
		$this->debug(3, "Trying server cache");
		if(file_exists($this->cachefile)){
			$this->debug(3, "Cachefile {$this->cachefile} exists");
			if($this->isURL){
				$this->debug(3, "This is an external request, so checking if the cachefile is empty which means the request failed previously.");
				if(filesize($this->cachefile) < 1){
					$this->debug(3, "Found an empty cachefile indicating a failed earlier request. Checking how old it is.");
					//Fetching error occured previously
					if(time() - filemtime($this->cachefile) > WAIT_BETWEEN_FETCH_ERRORS){
						$this->debug(3, "File is older than " . WAIT_BETWEEN_FETCH_ERRORS . " seconds. Deleting and returning false so app can try and load file.");
						unlink($this->cachefile);
						return false; //to indicate we didn't serve from cache and app should try and load
					} else {
						$this->debug(3, "Empty cachefile is still fresh so returning message saying we had an error fetching this image from remote host.");
						$this->error("An error occured fetching image.");
						return false; 
					}
				}
			} else {
				$this->debug(3, "Trying to serve cachefile {$this->cachefile}");
			}
			if($this->serveCacheFile()){
				$this->debug(3, "Succesfully served cachefile {$this->cachefile}");
				return true;
			} else {
				$this->debug(3, "Failed to serve cachefile {$this->cachefile} - Deleting it from cache.");
				//Image serving failed. We can't retry at this point, but lets remove it from cache so the next request recreates it
				unlink($this->cachefile);
				return true;
			}
		}
	}
	protected function error($err){
		$this->debug(3, "Adding error message: $err");
		$this->errors[] = $err;
		return false;

	}
	protected function haveErrors(){
		if(sizeof($this->errors) > 0){
			return true;
		}
		return false;
	}
	protected function serveErrors(){
		$html = '<ul>';
		foreach($this->errors as $err){
			$html .= '<li>' . htmlentities($err) . '</li>';
		}
		$html .= '</ul>';
		header ('HTTP/1.1 400 Bad Request');
		echo '<h1>A WordThumb error has occured</h1>The following error(s) occured:<br />' . $html . '<br />';
		echo '<br />Query String : ' . htmlentities ($_SERVER['QUERY_STRING']);
		echo '<br />WordThumb version : ' . VERSION . '</pre>';
	}
	protected function serveInternalImage(){
		$localImage = $this->getLocalImagePath($this->src);
		$this->debug(3, "Local image path is $localImage");
		if(! $localImage){
			$this->error("Could not find the internal image you specified.");
			return false;
		}
		if(! is_file($localImage)){
			$this->error("The local file you specified is not a valid file.");
			return false;
		}
		$fileSize = filesize($localImage);
		if($fileSize > MAX_FILE_SIZE){
			$this->error("The file you specified is greater than the maximum allowed file size.");
			return false;
		}
		if($fileSize <= 0){
			$this->error("The file you specified is <= 0 bytes.");
			return false;
		}
		$this->debug(3, "Calling processImageAndWriteToCache() for local image.");
		if($this->processImageAndWriteToCache($localImage)){
			$this->serveCacheFile();
			return true;
		} else { 
			return false;
		}
	}
	protected function cleanCache(){
		$this->debug(3, "cleanCache() called");
		$lastCleanFile = $this->cacheDirectory . '/wordthumb_cacheLastCleanTime.touch';
		
		//If this is a new wordthumb installation we need to create the file
		if(! is_file($lastCleanFile)){
			$this->debug(1, "File tracking last clean doesn't exist. Creating $lastCleanFile");
			touch($lastCleanFile);
			return;
		}
		if(@filemtime($lastCleanFile) < (time() - FILE_CACHE_TIME_BETWEEN_CLEANS) ){ //Cache was last cleaned more than 1 day ago
			$this->debug(1, "Cache was last cleaned more than 1 day ago. Cleaning now.");
			// Very slight race condition here, but worst case we'll have 2 or 3 servers cleaning the cache simultaneously once a day.
			touch($lastCleanFile);
			$files = glob($this->cacheDirectory . '/*' . FILE_CACHE_SUFFIX);
			$this->debug(3, "Found " . sizeof($files) . " files in cache.");
			if(sizeof($files) < FILE_CACHE_SIZE){
				$this->debug(3, "Number of files is less than max. Not cleaning.");
				return false;
			}
			$this->debug(3, "Number of files in cache exceeds max. Cleaning.");
			$timeAgo = time() - FILE_CACHE_MAX_FILE_AGE;
			foreach($files as $file){
				if(@filemtime($file) < $timeAgo){
					$this->debug(3, "Deleting cache file $file older than max age.");
					@unlink($file);
				}
			}
			return true;
		} else {
			$this->debug(3, "Cache was cleaned less than a day ago so no cleaning needed.");
		}
		return false;
	}
	protected function processImageAndWriteToCache($localImage){
		$imageInfo = getimagesize($localImage);
		$mimeType = $imageInfo['mime'];
		$this->debug(3, "Mime type of image is {$imageInfo['mime']}");
		if(! preg_match('/^image\/(?:gif|jpg|jpeg|png)$/i', $mimeType)){
			return $this->error("The image being resized is not a valid gif, jpg or png.");
		}

		if (!function_exists ('imagecreatetruecolor')) {
		    return $this->error('GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library');
		}

		if (function_exists ('imagefilter') && defined ('IMG_FILTER_NEGATE')) {
			$imageFilters = array (
				1 => array (IMG_FILTER_NEGATE, 0),
				2 => array (IMG_FILTER_GRAYSCALE, 0),
				3 => array (IMG_FILTER_BRIGHTNESS, 1),
				4 => array (IMG_FILTER_CONTRAST, 1),
				5 => array (IMG_FILTER_COLORIZE, 4),
				6 => array (IMG_FILTER_EDGEDETECT, 0),
				7 => array (IMG_FILTER_EMBOSS, 0),
				8 => array (IMG_FILTER_GAUSSIAN_BLUR, 0),
				9 => array (IMG_FILTER_SELECTIVE_BLUR, 0),
				10 => array (IMG_FILTER_MEAN_REMOVAL, 0),
				11 => array (IMG_FILTER_SMOOTH, 0),
			);
		}

		// get standard input properties
		$new_width =  (int) abs ($this->param('w', 0));
		$new_height = (int) abs ($this->param('h', 0));
		$zoom_crop = (int) $this->param('zc', 1);
		$quality = (int) abs ($this->param('q', 90));
		$align = $this->cropTop ? 't' : $this->param('a', 'c');
		$filters = $this->param('f', '');
		$sharpen = (bool) $this->param('s', 0);
		$canvas_color = $this->param('cc', 'ffffff');

		// set default width and height if neither are set already
		if ($new_width == 0 && $new_height == 0) {
		    $new_width = 100;
		    $new_height = 100;
		}

		// ensure size limits can not be abused
		$new_width = min ($new_width, MAX_WIDTH);
		$new_height = min ($new_height, MAX_HEIGHT);

		// set memory limit to be able to have enough space to resize larger images
		ini_set ('memory_limit', MEMORY_LIMIT);

		// open the existing image
		$image = $this->openImage ($mimeType, $localImage);
		if ($image === false) {
			return $this->error('Unable to open image.');
		}

		// Get original width and height
		$width = imagesx ($image);
		$height = imagesy ($image);
		$origin_x = 0;
		$origin_y = 0;

		// generate new w/h if not provided
		if ($new_width && !$new_height) {
			$new_height = floor ($height * ($new_width / $width));
		} else if ($new_height && !$new_width) {
			$new_width = floor ($width * ($new_height / $height));
		}

		// scale down and add borders
		if ($zoom_crop == 3) {

			$final_height = $height * ($new_width / $width);

			if ($final_height > $new_height) {
				$new_width = $width * ($new_height / $height);
			} else {
				$new_height = $final_height;
			}

		}

		// create a new true color image
		$canvas = imagecreatetruecolor ($new_width, $new_height);
		imagealphablending ($canvas, false);

		if (strlen ($canvas_color) < 6) {
			$canvas_color = 'ffffff';
		}

		$canvas_color_R = hexdec (substr ($canvas_color, 0, 2));
		$canvas_color_G = hexdec (substr ($canvas_color, 2, 2));
		$canvas_color_B = hexdec (substr ($canvas_color, 2, 2));

		// Create a new transparent color for image
		$color = imagecolorallocatealpha ($canvas, $canvas_color_R, $canvas_color_G, $canvas_color_B, 127);

		// Completely fill the background of the new image with allocated color.
		imagefill ($canvas, 0, 0, $color);

		// scale down and add borders
		if ($zoom_crop == 2) {

			$final_height = $height * ($new_width / $width);

			if ($final_height > $new_height) {

				$origin_x = $new_width / 2;
				$new_width = $width * ($new_height / $height);
				$origin_x = round ($origin_x - ($new_width / 2));

			} else {

				$origin_y = $new_height / 2;
				$new_height = $final_height;
				$origin_y = round ($origin_y - ($new_height / 2));

			}

		}

		// Restore transparency blending
		imagesavealpha ($canvas, true);

		if ($zoom_crop > 0) {

			$src_x = $src_y = 0;
			$src_w = $width;
			$src_h = $height;

			$cmp_x = $width / $new_width;
			$cmp_y = $height / $new_height;

			// calculate x or y coordinate and width or height of source
			if ($cmp_x > $cmp_y) {

				$src_w = round ($width / $cmp_x * $cmp_y);
				$src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);

			} else if ($cmp_y > $cmp_x) {

				$src_h = round ($height / $cmp_y * $cmp_x);
				$src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);

			}

			// positional cropping!
			if ($align) {
				if (strpos ($align, 't') !== false) {
					$src_y = 0;
				}
				if (strpos ($align, 'b') !== false) {
					$src_y = $height - $src_h;
				}
				if (strpos ($align, 'l') !== false) {
					$src_x = 0;
				}
				if (strpos ($align, 'r') !== false) {
					$src_x = $width - $src_w;
				}
			}

			imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);

		} else {

			// copy and resize part of an image with resampling
			imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

		}

		if ($filters != '' && function_exists ('imagefilter') && defined ('IMG_FILTER_NEGATE')) {
			// apply filters to image
			$filterList = explode ('|', $filters);
			foreach ($filterList as $fl) {

				$filterSettings = explode (',', $fl);
				if (isset ($imageFilters[$filterSettings[0]])) {

					for ($i = 0; $i < 4; $i ++) {
						if (!isset ($filterSettings[$i])) {
							$filterSettings[$i] = null;
						} else {
							$filterSettings[$i] = (int) $filterSettings[$i];
						}
					}

					switch ($imageFilters[$filterSettings[0]][1]) {

						case 1:

							imagefilter ($canvas, $imageFilters[$filterSettings[0]][0], $filterSettings[1]);
							break;

						case 2:

							imagefilter ($canvas, $imageFilters[$filterSettings[0]][0], $filterSettings[1], $filterSettings[2]);
							break;

						case 3:

							imagefilter ($canvas, $imageFilters[$filterSettings[0]][0], $filterSettings[1], $filterSettings[2], $filterSettings[3]);
							break;

						case 4:

							imagefilter ($canvas, $imageFilters[$filterSettings[0]][0], $filterSettings[1], $filterSettings[2], $filterSettings[3], $filterSettings[4]);
							break;

						default:

							imagefilter ($canvas, $imageFilters[$filterSettings[0]][0]);
							break;

					}
				}
			}
		}

		// sharpen image
		if ($sharpen && function_exists ('imageconvolution')) {

			$sharpenMatrix = array (
					array (-1,-1,-1),
					array (-1,16,-1),
					array (-1,-1,-1),
					);

			$divisor = 8;
			$offset = 0;

			imageconvolution ($canvas, $sharpenMatrix, $divisor, $offset);

		}
		$tempfile = tempnam($this->cacheDirectory, 'wordthumb_tmpimg_');
		$imgType = "";
		if(preg_match('/^image\/(?:jpg|jpeg)$/i', $mimeType)){ 
			imagejpeg($canvas, $tempfile, $quality); 
			$imgType = 'jpg';
		} else if(preg_match('/^image\/png$/i', $mimeType)){ 
			imagepng($canvas, $tempfile, floor($quality * 0.09));
			$imgType = 'png';
		} else if(preg_match('/^image\/gif$/i', $mimeType)){
			imagepng($canvas, $tempfile, floor($quality * 0.09));
			$imgType = 'gif';
		} else {
			return $this->error("Sanity failed. Could not match mime type after verifying it previously.");
		}
		$this->debug(3, "Rewriting image with security header.");
		$tempfile2 = tempnam($this->cacheDirectory, 'wordthumb_tmpimg_');
		$context = stream_context_create ();
		$fp = fopen($tempfile,'r',0,$context);
		file_put_contents($tempfile2, $this->filePrependSecurityBlock . $imgType . ' ?>'); //6 extra bytes, first 3 being image type 
		file_put_contents($tempfile2, $fp, FILE_APPEND);
		fclose($fp);
		unlink($tempfile);
		$this->debug(3, "Locking and replacing cache file.");
		$lockFile = $this->cachefile . '.lock';
		$fh = fopen($lockFile, 'w');
		if(! $fh){
			return $this->error("Could not open the lockfile for writing an image.");
		}
		if(flock($fh, LOCK_EX)){
			@unlink($this->cachefile); //rename generally overwrites, but doing this in case of platform specific quirks. File might not exist yet.
			rename($tempfile2, $this->cachefile);
			flock($fh, LOCK_UN);
			fclose($fh);
			unlink($lockFile);
		} else {
			fclose($fh);
			unlink($lockFile);
			unlink($tempfile2);
			return $this->error("Could not get a lock for writing.");
		}
		$this->debug(3, "Done image replace with security header. Cleaning up and running cleanCache()");
		imagedestroy($canvas);
		$this->cleanCache();
		return true;
	}
	protected function getLocalImagePath($src){
		$this->debug(1, "Getting local image path for $src");
		if (file_exists ($_SERVER['DOCUMENT_ROOT'] . '/' . $src)) {
			$this->debug(3, "Found file as " . $_SERVER['DOCUMENT_ROOT'] . '/' . $src);
			return $_SERVER['DOCUMENT_ROOT'] . '/' . $src;
		}
		$base = $_SERVER['DOCUMENT_ROOT'];
		foreach (explode('/', str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME'])) as $sub){
			$base .= $sub . '/';
			$this->debug(3, "Trying file as: " . $base . $src);
			if(file_exists($base . $src)){
				$this->debug(3, "Found file as: " . $base . $src);
				return $base . $src;
			}
		}
		if (!isset ($_SERVER['DOCUMENT_ROOT'])) { //Mostly taken from the original source. I don't have a MS server to test this and it seems dodgy, so a second pair of eyes would be good here. 
			$this->debug(3, "DOCUMENT_ROOT is not set so this is probably Windows.");
			$path = str_replace ("/", "\\", $_SERVER['ORIG_PATH_INFO']);
			$path = str_replace ($path, '', $_SERVER['SCRIPT_FILENAME']);
			$this->debug(3, "Trying file: " . realpath($path) . '/' . $src);
			if (file_exists (realpath($path) . '/' . $src)) {
				$this->debug(3, "Found file as: " . realpath($path) . '/' . $src);
				return realpath ($path) . '/' . $src;
			}
		}
		return false;
	}
	protected function toDelete($name){
		$this->debug(3, "Scheduling file $name to delete on destruct.");
		$this->toDeletes[] = $name;
	}
	protected function serveWebshot(){
		$this->debug(3, "Starting serveWebshot");
		$instr = "Please follow the instructions at http://code.google.com/p/wordthumb/ to set your server up for taking website screenshots.";
		if(! is_file(WEBSHOT_CUTYCAPT)){
			return $this->error("CutyCapt is not installed. $instr");
		}
		if(! is_file(WEBSHOT_XVFB)){
			return $this->Error("Xvfb is not installed. $instr");
		}
		$cuty = WEBSHOT_CUTYCAPT;
		$xv = WEBSHOT_XVFB;
		$screenX = WEBSHOT_SCREEN_X;
		$screenY = WEBSHOT_SCREEN_Y;
		$colDepth = WEBSHOT_COLOR_DEPTH;
		$format = WEBSHOT_IMAGE_FORMAT;
		$timeout = WEBSHOT_TIMEOUT * 1000;
		$ua = WEBSHOT_USER_AGENT;
		$jsOn = WEBSHOT_JAVASCRIPT_ON ? 'on' : 'off';
		$javaOn = WEBSHOT_JAVA_ON ? 'on' : 'off';
		$pluginsOn = WEBSHOT_PLUGINS_ON ? 'on' : 'off';
		$proxy = WEBSHOT_PROXY ? ' --http-proxy=' . WEBSHOT_PROXY : '';
		$tempfile = tempnam($this->cacheDirectory, 'wordthumb_webshot');
		$url = $this->src;
		if(! preg_match('/^https?:\/\/[a-zA-Z0-9\.\-]+/i', $url)){
			return $this->error("Invalid URL supplied.");
		}
		$url = preg_replace('/[^A-Za-z0-9\-\.\_\~:\/\?\#\[\]\@\!\$\&\'\(\)\*\+\,\;\=]+/', '', $url); //RFC 3986
		//Very important we don't allow injection of shell commands here. URL is between quotes and we are only allowing through chars allowed by a the RFC 
		// which AFAIKT can't be used for shell injection. 
		if(WEBSHOT_XVFB_RUNNING){
			putenv('DISPLAY=:100.0');
			$command = "$cuty $proxy --max-wait=$timeout --user-agent=\"$ua\" --javascript=$jsOn --java=$javaOn --plugins=$pluginsOn --js-can-open-windows=off --url=\"$url\" --out-format=$format --out=$tempfile";
		} else {
			$command = "$xv --server-args=\"-screen 0, {$screenX}x{$screenY}x{$colDepth}\" $cuty $proxy --max-wait=$timeout --user-agent=\"$ua\" --javascript=$jsOn --java=$javaOn --plugins=$pluginsOn --js-can-open-windows=off --url=\"$url\" --out-format=$format --out=$tempfile";
		}
		$this->debug(3, "Executing command: $command");
		$out = `$command`;
		$this->debug(3, "Received output: $out");
		if(! is_file($tempfile)){
			error_log("CutyCapt failed with the following output: " . $out);
			return $this->error("The command to create a thumbnail failed.");
		}
		$this->cropTop = true;
		if($this->processImageAndWriteToCache($tempfile)){
			$this->debug(3, "Image processed succesfully. Serving from cache");
			return $this->serveCacheFile();
		} else {
			return false;
		}
	}
	protected function serveExternalImage(){
		if(! preg_match('/^https?:\/\/[a-zA-Z0-9\-\.]+/i', $this->src)){
			$this->error("Invalid URL supplied.");
			return false;
		}
		$tempfile = tempnam($this->cacheDirectory, 'wordthumb');
		$this->debug(3, "Fetching external image into temporary file $tempfile");
		$this->toDelete($tempfile);

		if(function_exists('curl_init')){
			$this->debug(3, "Curl is installed so using it to fetch image.");
			self::$curlFH = fopen($tempfile, 'w');
			self::$curlDataWritten = 0;
			$curl = curl_init($this->src);
			curl_setopt ($curl, CURLOPT_TIMEOUT, CURL_TIMEOUT);
			curl_setopt ($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.122 Safari/534.30");
			curl_setopt ($curl, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt ($curl, CURLOPT_HEADER, 0);
			curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt ($curl, CURLOPT_WRITEFUNCTION, 'wordthumb::curlWrite');
			
			$curlResult = curl_exec($curl);
			curl_close($curl);
			fclose(self::$curlFH);

			if(! $curlResult){
				$this->debug(3, "Error fetching using curl: " . curl_error($curl));
				unlink($this->cachefile);
				touch($this->cachefile);
				$this->error("Error reading the URL you specified from remote host." . curl_error($curl));
				return false;
			}
		} else {
			$img = @file_get_contents ($this->src);
			if($img === false){
				$err = error_get_last();
				$this->debug(3, "Error trying to fetch remote image using file_get_contents: $err");
				$this->error("Could not fetch remote file {$this->src}: " . $err['message']);
				return false;
			}
			if(! file_put_contents($tempfile, $img)){
				$this->error("Could not write the contents of remote image to temporary file.");
				return false;
			}
		}
		$imageInfo = getimagesize($tempfile);
		if(! preg_match("/^image\/(?:jpg|jpeg|gif|png)$/i", $imageInfo['mime'])){
			$this->debug(3, "Remote file has invalid mime type: {$imageInfo['mime']}");
			unlink($this->cachefile);
			touch($this->cachefile);
			$this->error("The remote file is not a valid image.");
			return false;
		}
		if($this->processImageAndWriteToCache($tempfile)){
			$this->debug(3, "Image processed succesfully. Serving from cache");
			return $this->serveCacheFile();
		} else {
			return false;
		}
	}
	public static function curlWrite($h, $d){
		fwrite(self::$curlFH, $d);
		self::$curlDataWritten += strlen($d);
		if(self::$curlDataWritten > MAX_FILE_SIZE){
			return 0;
		} else {
			return strlen($d);
		}
	}
	protected function serveCacheFile(){
		$this->debug(3, "Serving {$this->cachefile}");
		if(! is_file($this->cachefile)){
			$this->error("serveCacheFile called in wordthumb but we couldn't find the cached file.");
			return false;
		}
		$fp = fopen($this->cachefile, 'rb');
		if(! $fp){ return $this->error("Could not open cachefile."); }
		fseek($fp, strlen($this->filePrependSecurityBlock), SEEK_SET);
		$imgType = fread($fp, 3);
		fseek($fp, 3, SEEK_CUR);
		if(ftell($fp) != strlen($this->filePrependSecurityBlock) + 6){
			unlink($this->cachefile);
			return $this->error("The cached image file seems to be corrupt.");
		}
		$imageDataSize = filesize($this->cachefile) - (strlen($this->filePrependSecurityBlock) + 6);
		$this->sendImageHeaders($imgType, $imageDataSize);
		$bytesSent = @fpassthru($fp);
		fclose($fp);
		if($bytesSent > 0){
			return true;
		}
		$content = file_get_contents ($this->cachefile);
		if ($content != FALSE) {
			$content = substr($content, strlen($this->filePrependSecurityBlock) + 6);
			echo $content;
			$this->debug(3, "Served using file_get_contents and echo");
			return true;
		} else {
			$this->error("Cache file could not be loaded.");
			return false;
		}
	}
	protected function sendImageHeaders($mimeType, $dataSize){
		$gmdate_expires = gmdate ('D, d M Y H:i:s', strtotime ('now +10 days')) . ' GMT';
		$gmdate_modified = gmdate ('D, d M Y H:i:s') . ' GMT';
		// send content headers then display image
		header ('Content-Type: ' . $mimeType);
		header ('Accept-Ranges: none'); //Changed this because we don't accept range requests
		header ('Last-Modified: ' . $gmdate_modified);
		header ('Content-Length: ' . $dataSize);
		if(BROWSER_CACHE_DISABLE){
			$this->debug(3, "Browser cache is disabled so setting non-caching headers.");
			header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
			header("Pragma: no-cache");
			header('Expires: ' . gmdate ('D, d M Y H:i:s', time()));
		} else {
			$this->debug(3, "Browser caching is enabled");
			header('Cache-Control: max-age=' . BROWSER_CACHE_MAX_AGE . ', must-revalidate');
			header('Expires: ' . $gmdate_expires);
		}
		return true;
	}
	protected function securityChecks(){
	}
	protected function param($property, $default = ''){
		if (isset ($_GET[$property])) {
			return $_GET[$property];
		} else {
			return $default;
		}
	}
	protected function openImage($mimeType, $src){
		switch ($mimeType) {
			case 'image/jpg':
				$image = imagecreatefromjpeg ($src);
				break;
			case 'image/jpeg':
				$image = imagecreatefromjpeg ($src);
				break;

			case 'image/png':
				$image = imagecreatefrompng ($src);
				break;

			case 'image/gif':
				$image = imagecreatefromgif ($src);
				break;
		}

		return $image;
	}
	protected function getIP(){
		$rem = @$_SERVER["REMOTE_ADDR"];
		$ff = @$_SERVER["HTTP_X_FORWARDED_FOR"];
		$ci = @$_SERVER["HTTP_CLIENT_IP"];
		if(preg_match('/^(?:192\.168|172\.16|10\.|127\.)/', $rem)){ 
			if($ff){ return $ff; }
			if($ci){ return $ci; }
			return $rem;
		} else {
			if($rem){ return $rem; }
			if($ff){ return $ff; }
			if($ci){ return $ci; }
			return "UNKNOWN";
		}
	}
	protected function debug($level, $msg){
		if(DEBUG_ON && $level <= DEBUG_LEVEL){
			$execTime = sprintf('%.6f', microtime(true) - $this->startTime);
			$tick = sprintf('%.6f', 0);
			if($this->lastBenchTime > 0){
				$tick = sprintf('%.6f', microtime(true) - $this->lastBenchTime);
			}
			$this->lastBenchTime = microtime(true);
			error_log("WordThumb Debug line " . __LINE__ . " [$execTime : $tick]: $msg");
		}
	}
}
?>
