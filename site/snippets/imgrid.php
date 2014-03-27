<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

// set gutter in percent
$grid_gutter_percentage = 1;

$i = 0;

$img_per_row = null; // set average images per row to 1 by default
$crop_last_img = true; // set to true by default if nothing is set in Kirbytext
$img_hd = null;
$fig_caption = null;


// check for average image per row
if(count($per_row) > 0) {
	$img_per_row = $per_row[0];
}


// check for crop last varibale
if(count($crop_last) > 0) {
	// set to true, if not set as value string fasle
	if($crop_last[0] != 'false') {
		$crop_last_img = true;
	// else set to false
	} else {
		$crop_last_img = false;
	}
}

// check for hd varibale
if(count($hd) > 0) {
	$img_hd = $hd[0];
}

// check for caption
if(count($caption) > 0) {
	$fig_caption = $caption[0];
}

// check for container variable
if(count($container) > 0) {
	// ...to width set in 'text'
	$base_width = $container[0];

	// check all container widths in config if set base_width doesn't exceed that.
	if($_SESSION['isMobile'] && $base_width > c::get('thumb.small.container')){
		$base_width = c::get('thumb.small.container');
	}
	if($_SESSION['isTablet'] && $base_width > c::get('thumb.compact.container')){
		$base_width = c::get('thumb.compact.container');
	}

} else {
	// ...else set to device specific width set in config
	if($_SESSION['isMobile']) { $base_width = c::get('thumb.small.container'); } // get the base width of our grid from config file
	if($_SESSION['isTablet']) { $base_width = c::get('thumb.compact.container'); } // get the base width of our grid from config file
	if($_SESSION['isDesktop']) { $base_width = c::get('thumb.medium.container'); } // get the base width of our grid from config file
}

// loop through provided images
foreach($images as $imagename) {

	// only if the requested is found in the folder
	if($imagelist->find($imagename)) {

		// get the filename from the file in the folder
		$filename = $imagelist->find($imagename)->filename();

		// add image from object page->images() to a new array
		$imagearray[$imagename+$i] = $imagelist->find($imagename);
	}
	$i++;
}

// pass constructed array with images and the set parameters to the imgrid plugin
imgrid($imagearray, $base_width, $grid_gutter_percentage, $img_per_row, $crop_last_img, true, $img_hd, $fig_caption);

?>
