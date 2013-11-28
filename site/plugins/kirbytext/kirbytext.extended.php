<?php
/**
* Tag Extensions for Kirbytext
*
* Written by Jasper Rooduijn & Jonathan van Wunnik
* Inspired by: https://gist.github.com/2924148, http://getkirby.com/forum/general/topic:45, https://gist.github.com/1711983
*
* Blockquote usage:
* 1) (blockquote: My quote here cite: Jonathan van Wunnik)
* 2) (blockquote: My quote here lang: fr cite: Jonathan van Wunnik link: http://artlantis.nl)
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
* 1) (figure: myimage.jpg width: 400)
* 2) (figure: myimage.jpg width: 400 caption: Nice figure caption!)
* 3) (figure: myimage.jpg width: 400 height: 200 crop: true caption: Nice figure caption!)
* 4) (figure: myimage.jpg width: 400 height: 200 crop: true hd: true caption: Nice figure caption!)
*
* Multi (image) figure usage:
* 1) …
*
* Slider usage:
* 1) …
*
* * Fluid video:
* 1) (fluidvideo: 77383196 type: vimeo)
* 2) (fluidvideo: hXU63NXzg5A type: youtube ratio: 4by3)
* 2) (fluidvideo: zJs9p-VNORw type: vimeo ratio: 2by1)
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
		$this->addTags('multifigure');
		$this->addTags('imgrid');
		$this->addTags('slider');
		$this->addTags('fluidvideo');

		// define custom attributes
		$this->addAttributes('language', 'cite', 'link'); // quote attributes
		$this->addAttributes('source', 'class', 'type', 'order', 'reverse'); // list attributes
		$this->addAttributes('crop', 'hd', 'upscale', 'quality', 'alt'); // thumb attributes
		$this->addAttributes('caption'); // figure attributes
		$this->addAttributes('container', 'breakfrom'); // multifigure attributes
		$this->addAttributes('images','margin','per-row','crop-last','container','hd', 'caption'); // imgrid attributes
		$this->addAttributes('ratio', 'type'); // fluidvideo attributes
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
		$html  = '<q ';

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
			'language' => c::get('lang.default', 'en'),
			'cite'     => false,
			'link'     => false
		);

		// merge the given parameters with the default values
		$options			= array_merge($defaults, $params);

		// start the html output
		if(!empty($params['lang'])) {
			$html  = '<blockquote lang="' . $params['lang'] . '">';
		} else {
			$html  = '<blockquote lang="' . $options['language'] . '">';
		}
		$html .= '<p>' . html($options['blockquote']) . '</p>';

		// only add citation if one is available
		if(!empty($params['cite'])) {

			if(!empty($params['link'])) {
				$html .= '<footer>&mdash; <cite><a href="' . html($params['link']) . '" class="js-external">' . html($params['cite']) . '</a></cite></footer>';
			} else {
				$html .= '<footer>&mdash; <cite>' . html($params['cite']) . '</cite></footer>';
			}

		}

		$html .= '</blockquote>';

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
			$css = ' class ="'.$params['class'].'"';
		}

		// set false values for options that are given the string 'false'
		if($options['reverse']=='false'){
			$options['reverse'] = false;
		}

		$type = $options['type'];

		// start the html output
		$html  = '<div'.$css.'>';
		if($type=='definition'){
			$listtag = 'dl';
		}
		elseif($type=='ordered'){
			$listtag = 'ol';
		}
		else{
			$listtag = 'ul';
		}

		$html .= '<'.$listtag.'>';

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

		$html .= '</div>';

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
		$html = '<span class="u-noHyphen">'.$params['nohyphen'].'</span>';

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

		// set default values for attributes
		$defaults = array(
			'width'   => null,
			'height'  => null,
			'crop'    => false,
			'hd'      => null,
			'upscale' => null,
			'quality' => null,
			'container' => false,
			'alt'     => false
		);

		// merge the given parameters with the default values
		$options = array_merge($defaults, $params);
		$page    = ($this->obj) ? $this->obj : $site->pages()->active();
		$figure  = $params['figure'];
		$image   = $page->images()->find($figure);
		$thumb   = thumb($image, array(
						'width'   => $options['width'],
						'height'  => $options['height'],
						'crop'    => $options['crop'],
						'hd'      => $options['hd'],
						'upscale' => $options['upscale'],
						'quality' => $options['quality'],
						'container' => $options['container'],
						'alt'     => $options['alt']
					));


		// start the html output
		$html  = '<figure>';
		$html .= $thumb;

		// only add a caption if one is available
		if(!empty($params['caption'])) {
			$html .= '<figcaption>' . $params['caption'] . '</figcaption>';
		}
		$html .= '</figure>';

		return $html;

	}

	// Multi Figure
	function multifigure($params) {

		global $site;

		// set default values for attributes
		$defaults = array(
			'images'    => null,
			'widths'    => null,
			'quality'   => null,
			'upscale'   => null,
			'hd'        => null,
			'caption'   => null,
			'container' => null,
			'breakfrom'     => null
		);

		// merge the given parameters with the default values
		$options		= array_merge($defaults, $params);

		// set default values for attribues
		$page      = ($this->obj) ? $this->obj : $site->pages()->active();
		$images    = str::split(str_replace(' ', '', $options['multifigure']), '|');
		$widths    = str::split(str_replace(' ', '', $options['width']), '|');
		$upscale   = str::split($options['upscale']);
		$hd        = str::split($options['hd']);
		$qualities = str::split(str_replace(' ', '', $options['quality']), '|');
		$caption   = str::split($options['caption']);
		$container = str::split($options['container']);
		$breakfrom = str::split($options['breakfrom']);
		$result    = array();

		// check if there is an image
		if(empty($images)) return false;
		if($page->images()->count() == 0) return false;

		foreach($images as $img) {
		  $imgObj = $page->images()->find($img);
		  if($imgObj) $result[] = $imgObj;
		}

		if(empty($result)) return false;

		// build tag with snippet
		return snippet('multi_figure', array(
			'images'    => $result,
			'widths'    => $widths,
			'upscale'   => $upscale,
			'hd'        => $hd,
			'qualities' => $qualities,
			'caption'   => $caption,
			'container' => $container,
			'breakfrom' => $breakfrom,
		), true);

	}

	// Multi Figure
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
	function fluidvideo($params) {

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
		$video     = $options['fluidvideo'];
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
