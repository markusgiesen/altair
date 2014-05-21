<?php
/**
* Tag Extensions for Kirbytext
*
* Written by Jasper Rooduijn & Jonathan van Wunnik
* Inspired by: https://gist.github.com/2924148, http://getkirby.com/forum/general/topic:45, https://gist.github.com/1711983
*
* Blockquote usage:
* -> Markup based on A List Apart's article: http://j.mp/1oRDK9x, http://j.mp/1h7RLbF
* -> The <cite> tag is not meant for people's names; according to the spec, it is only for works (not people)!
* 1) (blockquote: Tomorrow is another day. attribution: Scarlett O'Hara in Margaret Mitchell's cite: Gone with the Wind)
* 2) (blockquote: I'm going to make him an offer he can't refuse. attribution: Don Vito Corleone's famous line in cite: The Godfather link: http://www.imdb.com/title/tt0068646/)
* 3) (blockquote: Bij fotografie is zien belangrijker dan de tools. lang: nl attribution: Jonathan van Wunnik)
*
* Custom list usage:
* 1) (customlist: yamlfilename class: classname-to-add type: unordered order: default reverse: true)
* -> Simply prints out a list from a yaml textfile. Extension should always be: .yaml
* -> Type can be set: unordered, ordered, definition
* -> Order can be set:  default, alphabetical, random
* -> Reverse order can be set:  true
* -> Classname is added to a wrapping <div>.
*
* Widont usage:
* 1) (widont: dit is een hele lange titel)
* -> If text contains more than 3 spaces, replace last space by a &nbsp;
*
* No hyphen:
* 1) (nohyphen: Bedrijf naam)
* -> Wraps the passed text in a span with class .no-hyphen
*
* Thumb usage:
* 1) (thumb: myimage.jpg width: 400)
* 2) (thumb: myimage.jpg width: 400 height: 200 crop: true alt: Nice alt text!)
* 3) (thumb: myimage.jpg width: 400 height: 200 crop: true hd: true alt: Nice alt text!)
* 4) (thumb: myimage.jpg width: 400 height: 200 crop: true quality: 50 hd: true alt: Nice alt text!)
*
* Figure usage:
* 1) (figure: myimage.jpg width: 1of3)
* 2) (figure: myimage.jpg width: 1of3 caption: Nice figure caption!)
* 2) (figure: myimage.jpg gridsingle: true caption: Single image in a multifigure grid)
* 3) (figure: myimage.jpg width: 2of3 height: 200 crop: true caption: Nice figure caption!)
* 4) (figure: myimage.jpg width: 2of3 height: 200 crop: true hd: true caption: Nice figure caption!)
* 5) (figure: myimage.jpg width: width: 2of3 gridcenter: true caption: A centered image!)
*
* Figure can also be used as a 'Multifigure', usage:
* 1) (figure: myimage.jpg | myimage2.jpg width: 1of2 | 1of2 breakfrom: compact)
*
* Slider usage:
* 1) …
*
* * Fluid video:
* 1) (video: 77383196 type: vimeo)
* 2) (video: hXU63NXzg5A type: youtube ratio: 4by3)
* 2) (video: zJs9p-VNORw type: vimeo ratio: 2by1)
*
**/

class kirbytextExtended extends kirbytext {

	function __construct($text, $markdown=true) {

		parent::__construct($text, $markdown);

		// define custom tags
		$this->addTags('quote');
		$this->addTags('blockquote');
		$this->addTags('customlist');
		$this->addTags('widont');
		$this->addTags('nohyphen');
		$this->addTags('thumb');
		$this->addTags('figure');
		$this->addTags('imgrid');
		$this->addTags('slider');
		$this->addTags('video');

		// define custom attributes
		$this->addAttributes('language', 'attribution', 'cite', 'link'); // (block)quote attributes
		$this->addAttributes('source', 'class', 'type', 'order', 'reverse'); // list attributes
		$this->addAttributes('crop', 'hd', 'upscale', 'quality', 'alt'); // thumb attributes
		$this->addAttributes('caption', 'container', 'breakfrom','offset', 'gridcenter', 'gridsingle'); // figure attributes
		$this->addAttributes('images','margin','per-row','crop-last','container','hd', 'caption'); // imgrid attributes
		$this->addAttributes('ratio', 'type'); // video attributes
	}

	// Quote
	function quote($params) {

		// set default values for attributes
		$defaults = array(
			'language' => c::get('lang.default', 'en')
		);

		// merge the given parameters with the default values
		$options = array_merge($defaults, $params);

		// start the html output
		$html  = '<q class="Quote" ';

		// add the langguage
		if(!empty($params['lang'])) {
			$html  .= 'lang="' . $params['lang'] . '"';
		} else {
			$html  .= 'lang="' . $options['language'] . '"';
		}

		$html .= '>'.html($options['quote']).'</q>';

		return $html;

	}

	// Blockquote
	function blockquote($params) {

		// set default values for attributes
		$defaults = array(
			'language'    => c::get('lang.default', 'en'),
			'attribution' => false,
			'cite'        => false,
			'link'        => false
		);

		// merge the given parameters with the default values
		$options			= array_merge($defaults, $params);

		// start the html output
		$html = '<figure class="Blockquote">';

		// set language tag on blockquote
		if(!empty($params['lang'])) {
			$html .= '<blockquote lang="' . $params['lang'] . '">';
		} else {
			$html .= '<blockquote lang="' . $options['language'] . '">';
		}

		// set blockquote's text
		$html .= '<p>' . smartypants($options['blockquote']) . '</p>';

		// close the blockquote
		$html .= '</blockquote>';

		// open figcaption with attribution, citation and link if one is available
		if(!empty($params['attribution'])) {
			if(!empty($params['cite'])) {
				if(!empty($params['link'])) {
					$html .= '<figcaption>' . smartypants($params['attribution']) . ' <cite><a href="' . html($params['link']) . '" rel="external nofollow">' . smartypants($params['cite']) . '</a></cite></figcaption>';
				} else {
					$html .= '<figcaption>' . smartypants($params['attribution']) . ' <cite>' . smartypants($params['cite']) . '</cite></figcaption>';
				}
			} else {
				$html .= '<figcaption>' . smartypants($params['attribution']) . '</figcaption>';
			}
		}

		// close the html output
		$html .= '</figure>';

		return $html;

	}

	// Custom list
	function customlist($params) {
		// set default values for attributes
		$defaults = array(
			'language'   => c::get('lang.default', 'en'),
			'customlist' => false,
			'class'      => false,
			'type'       => false,
			'order'      => false,
			'reverse'    => false
		);

		// merge the given parameters with the default values
		$options = array_merge($defaults, $params);
		$page    = ($this->obj) ? $this->obj : $site->pages()->active();

		// only add class if one is given
		if(!empty($params['class'])) {
			$css = 'class ="'.$params['class'].'"';
		}

		// set false values for options that are given the string 'false'
		if($options['reverse']=='false'){
			$options['reverse'] = false;
		}

		$type = $options['type'];

		// start the html output
		if($type=='definition'){
			$listtag = 'dl';
		}
		elseif($type=='ordered'){
			$listtag = 'ol';
		}
		else{
			$listtag = 'ul';
		}

		$html = '<'.$listtag.' '.$css.'>';

		// get the kirby url of the yaml file
		$listurl = $page->files()->find($options['customlist'].'.yaml')->url();
		// return content of the yaml file
		$listcontent = f::read($listurl);
		// use kirby yaml parser to get the list items
		$listitem = yaml($listcontent);

		/* --- Ordering --- */

		if($options['order']=='alphabetical'){
			// sort array on key order
			ksort($listitem);
		}

		if($options['reverse']){
			// reverse sort on key order
			$listitem = array_reverse($listitem,true);
		}

		if($options['order']=='random'){
			// randomize array completely
			shuffle($listitem);
		}

		/* --- Displaying --- */

		// lets loop through the listitems and output
		foreach($listitem as $item_key => $item_value){ // loop the first tier

			foreach($item_value as $item_key => $item_value ){ // loop the second tier

				if($type=='definition'){
					$html .= '<dt>'.$item_key.'</dt><dd>'.$item_value.'</dd>';
				}

				else{
					// output the the first tier
					$html .= '<li>';

					if(is_array($item_value)){
						// item has children, display the key
						$html .= $item_key.'<'.$listtag.'>';

						foreach($item_value as $item_key => $item_value ){ // loop the third tier

							// let's loop all the kids
							$html .= '<li><strong>'.$item_key.': </strong><span>'.$item_value.'</span></li>';

						} // END loop the third tier

						$html .= '</'.$listtag.'>';
					}

					else{
						// no children, just display the value
						$html .= $item_value;
					}

					$html .= '</li>';
				}

			} // END loop the second tier

		}  // END loop the first tier

		$html .= '</'.$listtag.'>';

		return $html;
	}

	// Widon't
	function widont($params) {

		// use the passed text in widont plugin
		$html = widont($params['widont']);

		return $html;
	}

	// No hyphen
	function nohyphen($params) {
		// Wrap the text in a span
		$html = '<span class="u-textNoHyphen">'.$params['nohyphen'].'</span>';

		return $html;
	}

	// Thumb
	function thumb($params) {

		// set default values for attributes
		$defaults = array(
			'width'   => null,
			'height'  => null,
			'crop'    => false,
			'hd'      => null,
			'quality' => null,
			'container' => false,
			'class'   => false,
			'alt'     => false
		);

		// merge the given parameters with the default values
		$options = array_merge($defaults, $params);
		$page    = ($this->obj) ? $this->obj : $site->pages()->active();
		$thumb   = $params['thumb'];
		$image   = $page->images()->find($thumb);

		// check if there is an image
		if(!$image) return false;

		// return the thumb function
		return thumb($image, array(
			'width'   => $options['width'],
			'height'  => $options['height'],
			'crop'    => $options['crop'],
			'hd'      => $options['hd'],
			'quality' => $options['quality'],
			'container' => $options['container'],
			'class'   => $options['class'],
			'alt'     => $options['alt']
		));

	  }

	// Figure
	function figure($params) {

		global $site;

		// set default values for attributes
		$defaults = array(
			'images'    => null,
			'width'     => null,
			'height'    => null,
			'crop'      => false,
			'hd'        => null,
			'upscale'   => null,
			'quality'   => null,
			'container' => false,
			'breakfrom' => null,
			'alt'       => false,
			'offset'    => null,
			'gridcenter'=> null,
			'gridsingle'=> null,
			'caption'   => null,
		);

		// merge the given parameters with the default values
		$options = array_merge($defaults, $params);
		$page    = ($this->obj) ? $this->obj : $site->pages()->active();

		$is_multifigure = false;

		// check if the figure has multiple images to output, check for pipe character: |
		if(strpos($options['figure'],'|')===false) {
			// set the one images as the first in an images array
			$images[0] = $options['figure'];
		}
		else {
			$is_multifigure = true;
			// set all images to the array
			$images = str::split(str_replace(' ', '', $options['figure']), '|');
		}

		$result = array();

		// check if there images passed to the array
		if(empty($images)) return false;
		if($page->images()->count() == 0) return false;

		// build array of image objects
		foreach($images as $img) {
			$imgObj = $page->images()->find($img);
			if($imgObj) $result[] = $imgObj;
		}

		// check of array of images has real items (after building objects)
		if(empty($result)) return false;

		// set variables for both single and multi figures
		$upscale   = str::split($options['upscale']);
		$hd        = str::split($options['hd']);
		$caption   = str::split($options['caption']);
		$container = str::split($options['container']);
		$breakfrom = str::split($options['breakfrom']);
		$offset    = str::split($options['offset']);
		$gridcenter= str::split($options['gridcenter']);
		$gridsingle= str::split($options['gridsingle']);

		if($is_multifigure){
			$widths    = str::split(str_replace(' ', '', $options['width']), '|');
			$qualities = str::split(str_replace(' ', '', $options['quality']), '|');
			$alt       = null;
			$height    = null;
			$crop      = null;
		}

		else {
			$widths    =  str::split($options['width']);
			$qualities =  str::split($options['quality']);
			$alt       = str::split($options['alt']);
			$crop      = str::split($options['crop']);
			$height    = str::split($options['height']);
			if (empty($widths)) $widths = null;
			if (empty($alt))    $alt = null;
			if (empty($height)) $height = null;
			if (empty($crop))   $crop = null;
		}

		// build tag with snippet
		return snippet('figure', array(
				// Image basics
				'images'      => $result,
				'caption'     => $caption,
				// Image widths
				'widths'      => $widths,
				'container'   => $container,
				// Cropping and quality
				'upscale'     => $upscale,
				'hd'          => $hd,
				'qualities'   => $qualities,
				// CSS class specifics
				'offset'      => $offset,
				'breakfrom'   => $breakfrom,
				'gridcenter'  => $gridcenter,
				'gridsingle'  => $gridsingle,
				// Single figure specific settings
				'height'      => $height,
				'crop'        => $crop,
				'alt'         => $alt,
				// Is it a figure or multifigure?
				'multifigure' => $is_multifigure,
				), true);
	}


	// IMG grid
	function imgrid($params) {

		global $site;

		// set default values for attributes
		$defaults = array(
			'images'    => null,
			'container' => null,
			'margin'    => null,
			'per-row'   => null,
			'crop-last' => null,
			'hd'        => null,
			'caption'   => null,
		);

		// merge the given parameters with the default values
		$options		= array_merge($defaults, $params);

		// set default values for attribues
		$page      = ($this->obj) ? $this->obj : $site->pages()->active();
		$images    = str::split(str_replace(' ', '', $options['imgrid']), '|');
		$margin    = str::split($options['margin']);
		$per_row   = str::split($options['per-row']);
		$crop_last = str::split($options['crop-last']);
		$container = str::split($options['container']);
		$hd        = str::split($options['hd']);
		$caption   = str::split($options['caption']);
		$result    = array();

		// check if there is an image
		if(empty($images)) return false;
		if($page->images()->count() == 0) return false;

		// build tag with snippet
		return snippet('imgrid', array(
			'images'    => $images, // the array with requested images
			'imagelist' => $page->images(), // the object of available page images
			'margin'    => $margin,
			'per_row'   => $per_row,
			'crop_last' => $crop_last,
			'hd'        => $hd,
			'container' => $container,
			'caption'   => $caption
		), true);

	}

		// Fluid videos
	function video($params) {

		global $site;

		// set default values for attributes
		$defaults = array(
			'ratio'    => null,
			'type'     => null,
		);

		// merge the given parameters with the default values
		$options		= array_merge($defaults, $params);

		// set default values for attribues
		$page      = ($this->obj) ? $this->obj : $site->pages()->active();
		$video     = $options['video'];
		$type      = $options['type'];
		$ratio     = $options['ratio'];

		// fill the ratio string
		if($ratio == ''){
			$ratio = 'FluidEmbed--16by9';
		}
		else {
			$ratio = 'FluidEmbed--' . $ratio;
		}

		// display the video container with ratio
		$html = '<figure class="FluidEmbed '. $ratio .'">';

		// display the embedcode
		if($type == 'vimeo') {
			$html .= '<iframe src="//player.vimeo.com/video/' . $video . '?title=0&amp;byline=0&amp;portrait=0&amp;color=0000ff" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
		}
		elseif ($type == 'youtube') {
			$html .= '<iframe width="853" height="480" src="//www.youtube.com/embed/' . $video . '?rel=0" frameborder="0" allowfullscreen></iframe>';
		}
		else {
			$html .= '<a href="' . $video . '" class="FluidEmbed-item">' . $video . '</a>';
		}

		// close the videocontainer
		$html .= '</figure>';

		return $html;

	}

	// Slider
	// function slider($params) {
	//
	// 	global $site;
	//
	//	// set default values for attribues
	// 	$page   = ($this->obj) ? $this->obj : $site->pages()->active();
	// 	$images = str::split($params['slider'], ' ');
	// 	$result = array();
	//
	//	// check if there is an image
	// 	if(empty($images)) return false;
	// 	if($page->images()->count() == 0) return false;
	//
	// 	foreach($images as $img) {
	// 		$imgObj = $page->images()->find($img);
	// 		if($imgObj) $result[] = $imgObj;
	// 	}
	//
	// 	if(empty($result)) return false;
	//
	//	// build tag with snippet
	// 	return snippet('slider', array('images' => $result), true);
	//
	// }

}
