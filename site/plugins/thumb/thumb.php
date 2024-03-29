<?php
/**
* Modified Kirby thumb plugin
*
* Added:
* - High Definition (or Retina) images
* - HD quality setting (seperate from 'normak' quality setting)
* - Support for HD quality setting in config.php file
*
*/

function thumb($obj, $options=array(), $tag=true) {
	$thumb = new thumb($obj, $options);
	return ($tag) ? $thumb->tag() : $thumb->url();
}

class thumb {

	var $obj = null;
	var $root = false;
	var $url = false;
	var $phpMemoryLimit = 36;
	var $sourceWidth = 0;
	var $sourceHeight = 0;
	var $width = 0;
	var $height = 0;
	var $tmpWidth = 0;
	var $tmpHeight = 0;
	var $maxWidth = 0;
	var $maxHeight = 0;
	var $mime = false;
	var $status = array();
	var $upscale = false;
	var $upscaleHd = false;
	var $upscaleResrc = false;
	var $quality = 70;
	var $qualityHd = 50;
	var $alt = false;
	var $crop = false;
	var $hd = false;
	var $multiplier = 1;
	var $container = false;
	var $resrc = false;
	var $resrc_params = false;
	var $resrc_optimize = false;
	var $lazyload = false;

	function __construct($image, $options=array()) {

	$this->root = c::get('thumb.cache.root', c::get('root') . '/thumbs');
	$this->url  = c::get('thumb.cache.url',  c::get('url')  . '/thumbs');
	$this->resrc = c::get('resrc', false);
	$this->resrc_optimize = c::get('resrc.optimize', 'o=60(80)');
	$this->lazyload = @$options['lazyload'];

	// Check  if PHP memory limit is set in config
	$this->mem = c::get('thumb.memory', $this->phpMemoryLimit);

	if(!$image) return false;

	$this->obj = $image;

	// set some values from the image
	$this->sourceWidth  = $this->obj->width();
	$this->sourceHeight = $this->obj->height();
	$this->width        = $this->sourceWidth;
	$this->height       = $this->sourceHeight;
	$this->source       = $this->obj->root();
	$this->mime         = $this->obj->mime();

	// set the max width and height
	$this->maxWidth     = @$options['width'];
	$this->maxHeight    = @$options['height'];

	// set container width if there's no 'inline' container (width)
	if($this->resrc) {
		// if resrc is set, always use the ReSRC container
		$container_width = c::get('resrc.container');
		// set resrc width based on device width (for the mobile first image)
		if($_SESSION['isMobile']) { $param_width = c::get('resrc.initial.small') ; }
		if($_SESSION['isTablet']) { $param_width = c::get('resrc.initial.compact'); }
		if($_SESSION['isDesktop']) { $param_width = c::get('resrc.initial.medium'); }
		// Build param string
		$this->resrc_params = 's=w' . $param_width . '/' . $this->resrc_optimize;
	}
	else {
		// if resrc is not set, use device dependent container
		if($_SESSION['isMobile']) { $container_width = c::get('thumb.small.container'); }
		if($_SESSION['isTablet']) { $container_width = c::get('thumb.compact.container'); }
		if($_SESSION['isDesktop']) { $container_width = c::get('thumb.medium.container'); }
	}

	// if there's no inline (max) width
	if(is_null($this->maxWidth)){
		// set (max) width to container width of context (e.g. small, medium or small)
		$this->maxWidth = $container_width;
	}

	// set the container width
	$this->container    = @$options['container'];

	// if there's an 'inline' container (width)
	if($this->container){
		// and if (max) width is larger than container, set 'inline' container width as max
		if($this->maxWidth > $this->container) {
			$this->maxWidth = $this->container;
		}
	} else {
		// if (max) width is larger than container, set container (width) as max
		if($this->maxWidth > $container_width) {
			$this->maxWidth = $container_width;
		}
	}

	// set the high defenition values
	$this->multiplier   = 2;
	$this->hdWidth      = $this->maxWidth*$this->multiplier;
	$this->hdHeight     = $this->maxHeight*$this->multiplier;

	// set crop
	$this->crop         = @$options['crop'];

	// if resrc is set to treu (in config)
	if($this->resrc) {
		$this->hd = false; // set the hd value alwasy to false
		$this->quality = 100; // set the quality value
	}
	// if resrc is set to false (in config)
	else {

		// set the hd value...
		if(is_bool(a::get($options, 'hd'))) {
			if(!(a::get($options, 'hd'))) {
				// ...to false if options(hd) = boolean and set as false
				$this->hd = false;
			} else {
				// ...to true if options(hd) = boolean and set as true
				$this->hd = true;
			}
		}
		else {
			if(is_null(a::get($options, 'hd'))) {
				// ...to config if options(hd) = not boolean and null
				$this->hd = c::get('thumb.hd', $this->hd);
			}
			else {
				if(a::get($options, 'hd') != 'false') {
					// ...to true if options(hd) = not null and set as value string true
					$this->hd = true;
				} else {
					// ...to true if options(hd) = not null and set as value string false
					$this->hd = false;
				}
			}
		}

		// set the quality value...
		if($this->hd) {
			// if hd is true, set thumbquality to 1) quality hd value set in config, else use 2) default value (50)
			$thumbquality = c::get('thumb.quality.hd', $this->qualityHd);
		} else {
			// else set thumbquality value to 1) quality value set in config, else use 3) default quality value (70)
			$thumbquality = c::get('thumb.quality', $this->quality);
		}
		// ...to the 1) quality value set in 'text', else use 2) thumbquality
		$this->quality = a::get($options, 'quality', $thumbquality);

	}

	// set the upscale value...
	if($this->resrc) {
		$upscalethumb = c::get('resrc.upscale', $this->upscaleResrc);
	} else {
		if($this->hd) {
			// if hd is true, set upscalethumb value to 1) upscale hd value set in config, else use 2) default value (false)
			$upscalethumb = c::get('thumb.upscale.hd', $this->upscaleHd);
		} else {
			// else set upscalethumb value to 1) upscale value set in config, else use 3) default quality value (false)
			$upscalethumb = c::get('thumb.upscale', $this->upscale);
		}
	}
	if(is_bool(@$options['upscale'])) {
		if(!($options['upscale'])) {
			// ...to false if @options[upscale] = boolean and set as false
			$this->upscale = false;
		} else {
			// ...to true if @options[upscale] = boolean and set as true
			$this->upscale = true;
		}
	} else {
		if(is_null(@$options['upscale'])) {
			// ...to upscalethumb if @options[upscale] = not set (null)
			$this->upscale = $upscalethumb;
		} else {
			if(@$options['upscale'] != 'false') {
				// ...to true if @options[upscale] = set as value string true
				$this->upscale = true;
			} else {
				// ...to false if @options[upscale] = set as value string false
				$this->upscale = false;
			}
		}
	}

	// set the alt text
	$this->alt = a::get($options, 'alt', $this->obj->name());

	// set the className text
	$this->className = @$options['class'];

	// set resrc class
	if($this->resrc) {
		// if there are custom classes passed, add a space
		if(!empty($this->className)) {
			$this->className .= ' ';
		}
		if($this->lazyload) {
			$this->className .= 'resrc-lazy';
		}
		else {
			$this->className .= 'resrc';
		}
	}

	// set the new size (pass multiplier as a variable so we can downsize hd sizes if needed)
	$this->size($this->multiplier);

	// create the thumbnail
	$this->create($this->multiplier);

	}

	function tag() {

	if(!$this->obj) return false;

	$class = (!empty($this->className)) ? ' class="' . $this->className . '"' : '';

	// if we've cropped a hd image, use multiplier to set the size we need
	if($this->hd){
		$this->width = floor($this->width / $this->multiplier);
		$this->height = floor($this->height / $this->multiplier);
	}

	$resrc_src_prefix = (c::get('resrc.alternate')) ? 'data-' : '';

	if($this->lazyload) {
		return '<img' . $class . ' src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAACCAIAAAASFvFNAAAAEElEQVQIW2P48OkTBDHAWQCpuBD5y5j7pQAAAABJRU5ErkJggg==" data-src="' . $this->url() . '" width="' . $this->width . '" height="' . $this->height . '" alt="' . html($this->alt) . '" /><a href="' . $this->url() . '" class="Lazyloadmsg">View image: ' . html($this->alt) . '</a><noscript><img src="' . $this->url() . '" width="' . $this->width . '" height="' . $this->height . '" alt="' . html($this->alt) . '" /></noscript>';
	}
	else {
		return '<img' . $class . ' ' . $resrc_src_prefix . 'src="' . $this->url() . '" width="' . $this->width . '" height="' . $this->height . '" alt="' . html($this->alt) . '" />';
	}

	}

	function filename() {

	$options = false;

	$options .= ($this->maxWidth)  ? '.' . $this->maxWidth  : '.' . 0;
	$options .= ($this->maxHeight) ? '.' . $this->maxHeight : '.' . 0;

	$options .= ($this->upscale)   ? '.' . 1  : '.' . 0;
	$options .= ($this->crop)      ? '.' . 1  : '.' . 0;

	$options .= '.' . $this->quality;

	// Add .hd to image filename when 'hd' => true else nothing
	$options .= ($this->hd)        ? '.hd'    : '';

	return md5($this->source) . $options . '.' . $this->obj->extension;

	}

	function file() {
		return $this->root . '/' . $this->filename();
	}

	function url() {
		$resrc_domain_prefix = ($this->resrc) ? 'http://app.resrc.it/' . $this->resrc_params . '/http://' . c::get('resrc.domain') : '';
		return (error($this->status)) ? $this->obj->url() : $resrc_domain_prefix . $this->url . '/' . $this->filename();
	}

	function size($multiplier) {

	// Check if HD is true. If yes use hdWidth and hdHeight else use maxWidth maxHeight.
	if($this->hd) {
		$maxWidth  = $this->hdWidth;
		$maxHeight = $this->hdHeight;
	} else {
		$maxWidth  = $this->maxWidth;
		$maxHeight = $this->maxHeight;
	}
	$upscale = $this->upscale;

	// if we're cropping the image
	if($this->crop == true) {

		if(!$maxWidth)  $maxWidth  = $maxHeight;
		if(!$maxHeight) $maxHeight = $maxWidth;

		$sourceRatio = size::ratio($this->sourceWidth, $this->sourceHeight);
		$thumbRatio  = size::ratio($maxWidth, $maxHeight);

		if($sourceRatio > $thumbRatio) {
		// fit the height of the source
		$size = size::fit_height($this->sourceWidth, $this->sourceHeight, $maxHeight, true);
		} else {
		// fit the width of the source
		$size = size::fit_width($this->sourceWidth, $this->sourceHeight, $maxWidth, true);
		}

		$this->tmpWidth  = $size['width'];
		$this->tmpHeight = $size['height'];

		$this->width     = $maxWidth;
		$this->height    = $maxHeight;

		return $size; // and stop script.

	}

	// if there's a maxWidth and a maxHeight
	if($maxWidth && $maxHeight) {

		// if the source width is bigger then the source height
		// we need to fit the width
		if($this->sourceWidth > $this->sourceHeight) {
		$size = size::fit_width($this->sourceWidth, $this->sourceHeight, $maxWidth, $upscale);

		// do another check for the maxHeight
		if($size['height'] > $maxHeight) $size = size::fit_height($size['width'], $size['height'], $maxHeight);

		} else {
		$size = size::fit_height($this->sourceWidth, $this->sourceHeight, $maxHeight, $upscale);

		// do another check for the maxWidth
		if($size['width'] > $maxWidth) $size = size::fit_width($size['width'], $size['height'], $maxWidth);

		}

	} elseif($maxWidth) {
		$size = size::fit_width($this->sourceWidth, $this->sourceHeight, $maxWidth, $upscale);
	} elseif($maxHeight) {
		$size = size::fit_height($this->sourceWidth, $this->sourceHeight, $maxHeight, $upscale);
	} else {
		$size = array('width' => $this->sourceWidth, 'height' => $this->sourceHeight);
	}

	$this->width  = $size['width'];
	$this->height = $size['height'];

	return $size;

	}

	function create($multiplier) {

	$file = $this->file();

	if(!function_exists('gd_info')) return $this->status = array(
		'status' => 'error',
		'msg'    => 'GD Lib is not installed'
	);

	if(file_exists($file) && (filectime($this->source) < filectime($file) || filemtime($this->source) < filemtime($file))) return $this->status = array(
		'status' => 'success',
		'msg'    => 'The file exists'
	);

	if(!is_writable(dirname($file))) return $this->status = array(
		'status' => 'error',
		'msg'    => 'The image file is not writable'
	);

	switch($this->mime) {
		case 'image/jpeg':
		$image = @imagecreatefromjpeg($this->source);
		break;
		case 'image/png':
		$image = @imagecreatefrompng($this->source);
		break;
		case 'image/gif':
		$image = @imagecreatefromgif($this->source);
		break;
		default:
		return $this->status = array(
			'status' => 'error',
			'msg'    => 'The image mime type is invalid'
		);
		break;
	}

	if(!$image) return array(
		'status' => 'error',
		'msg'    => 'The image could not be created'
	);

	// Make enough memory available to scale bigger images
	ini_set('memory_limit', $this->mem . 'M');

	if($this->crop == true) {

		// Starting point of crop
		$startX = floor($this->tmpWidth  / 2) - floor($this->width / 2);
		$startY = floor($this->tmpHeight / 2) - floor($this->height / 2);

		// Adjust crop size if the image is too small
		if($startX < 0) $startX = 0;
		if($startY < 0) $startY = 0;

		// create a temporary resized version of the image first
		$thumb = imagecreatetruecolor($this->tmpWidth, $this->tmpHeight);
		imagesavealpha($thumb, true);
		$color = imagecolorallocatealpha($thumb, 0, 0, 0, 127);
		imagefill($thumb, 0, 0, $color);
		imagecopyresampled($thumb, $image, 0, 0, 0, 0, $this->tmpWidth, $this->tmpHeight, $this->sourceWidth, $this->sourceHeight);

		// crop that image afterwards
		$cropped = imagecreatetruecolor($this->width, $this->height);
		imagesavealpha($cropped, true);
		$color   = imagecolorallocatealpha($cropped, 0, 0, 0, 127);
		imagefill($cropped, 0, 0, $color);
		imagecopyresampled($cropped, $thumb, 0, 0, $startX, $startY, $this->tmpWidth, $this->tmpHeight, $this->tmpWidth, $this->tmpHeight);
		imagedestroy($thumb);

		// reasign the variable
		$thumb = $cropped;

	} else {
		$thumb = imagecreatetruecolor($this->width, $this->height);
		imagesavealpha($thumb, true);
		$color = imagecolorallocatealpha($thumb, 0, 0, 0, 127);
		imagefill($thumb, 0, 0, $color);
		imagecopyresampled($thumb, $image, 0, 0, 0, 0, $this->width, $this->height, $this->sourceWidth, $this->sourceHeight);

	}

	switch($this->mime) {
		case 'image/jpeg' :
			// if progressive is set to true in config and resrc is false...
			if(!$this->resrc && c::get('thumb.progressive')) {
				// convert thumb images to progressive
				imageinterlace($thumb, 1);
			}
			imagejpeg($thumb, $file, $this->quality);
			break;
		case 'image/png' :
			// convert to truecolor palette of 256 colors
			// warning: this destroys alpha transparency (png-24 transparency),
			// and colors can become dull/off, but should not be a big
			// issue with content images — it's a HUGE file size saver!
			// if color accuracy is paramount, then disable this function!
			imagetruecolortopalette($thumb, false, 256);
			// quality parameter changed to 6 (was 0); can be 0 to 9
			// a quality of 6 is a nice balance bewteen small(er) size, and not
			// having a significant impact on processing (see: http://j.mp/NqIUJ5)
			// quality parameter is actually a compression parameter, as png
			// compression is always lossless
			imagepng($thumb, $file, 6);
			break;
		case 'image/gif' :
			imagegif($thumb, $file);
			break;
	}

	imagedestroy($thumb);

	return $this->status = array(
		'status' => 'success',
		'msg'    => 'The image has been created',
	);

	}

}
