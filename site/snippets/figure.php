<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

// Set variables
$img_upscale = null;
$img_hd = null;
$img_clearing = '';
$quality_overrule = false;
$centerclass = '';
$gridclass = '';
$itemgridclass = '';
$number_of_images = count($images);

// ----------------------------------------------------------
// Prepare variables set by kirbytext
// ----------------------------------------------------------

// Set container width...
if(count($container) > 0) {
	// ...to width set in 'text'
	$base_width = $container[0];
	// check all container widths in config if set base_width doesn't exceed that
	if($_SESSION['isMobile'] && $base_width > c::get('thumb.small.container')){
		$base_width = c::get('thumb.small.container');
	}
	if($_SESSION['isTablet'] && $base_width > c::get('thumb.compact.container')){
		$base_width = c::get('thumb.compact.container');
	}
	$container_set = $base_width;
}
else {
	// ...else set to device specific width set in config
	if($_SESSION['isMobile']) { $base_width = c::get('thumb.small.container'); } // get the base width of our grid from config file
	if($_SESSION['isTablet']) { $base_width = c::get('thumb.compact.container'); } // get the base width of our grid from config file
	if($_SESSION['isDesktop']) { $base_width = c::get('thumb.medium.container'); } // get the base width of our grid from config file
	$container_set = false;
}

// Set breakpoint for class of every image
if(count($breakfrom) > 0) {
	$breakclass = $breakfrom[0];
}
else {
	$breakclass = c::get('thumb.multifigure.break', 'small');
}

// if there's just one quality set, and no wildcard, set quality overrule variable
if( (count($qualities)==1)&&($qualities[0] != '*')) {
	$quality_overrule = $qualities[0];
}

// if there's an offset
if(count($offset) > 0) {
	// Set the first offset, assuming you can only pass one offset
	$offset = $offset[0];
}
else {
	$offset = null;
}

// if the figure should be centered
if(count($gridcenter) > 0) {
	$centerclass = ' Grid--alignCenter';
}

// if there's an alt tag
if(count($caption) > 0) {
	// Alt is same as (passed) caption in text
	$alt = $caption[0];
} else {
	if(count($alt) > 0) {
		// Alt is (passed) alt in text
		$alt = $alt[0]; // Set the first offset, assuming you can only pass one offset
	}
	else {
		// Alt is image file name
		$alt = null;
		// Alt attribute is empty
		// $alt = '';
	}
}

// ----------------------------------------------------------
// Open figure tag
// ----------------------------------------------------------

if($number_of_images > 1 || count($gridcenter) > 0 || count($gridsingle) > 0) {
	$gridclass = ' Grid Grid--withGutterPercentage';
	// $gridclass = ' Grid Grid--withGutter';
	$itemgridclass= 'Grid-cell ';
}
echo '<figure class="FigureImage' .$gridclass . $centerclass . '">';
$itemclassprefix = $itemgridclass . 'FigureImage';


// ----------------------------------------------------------
// Loop through images
// ----------------------------------------------------------

$i = 0;
foreach($images as $image):

	// if overruled (one quality set), use the overrule quality
	if($quality_overrule) {
		$quality = $quality_overrule;
	}
	else {
		// if quality is not set, or wildcard, use default value by passing NULL
		if( (!isset($qualities[$i])) || ($qualities[$i] == '*')) {
			$qualities[$i] = null;
		}
		// set the quality
		$quality = $qualities[$i];
	}

	// set widths of all images
	$width = $widths[$i];

	// check for upscale varibale
	if(count($upscale) > 0){
		$img_upscale = $upscale[0];
	}

	// check for hd varibale
	if(count($hd) > 0){
		$img_hd = $hd[0];
	}

	// If there is one or more width set, use width variable(s)
	if(count($widths) > 0) {
		// the first part (the 1 of 3)
		$classgridpart = str::substr($width, 0, 1);
		// the total (the 3)
		$classgridtot = str::substr($width, 3, 1);
		// calculate rounded width.
		$img_width = round(($base_width / $classgridtot) * $classgridpart);

		$class = $itemclassprefix.'-item u-size' . $width . '--' . $breakclass;
	}
	else {
		$img_width = null;
		$class = $itemclassprefix.'-item';
	}

	// If there is an offset
	if($i == 0 && isset($offset)) {
		$class .= ' u-before' . $offset . '--' . $breakclass;
	}

	// generate a thumb for each multifigure img
	echo thumb($image, array(
		'width'   => $img_width,
		'height'  => false,
		'crop'    => false,
		'upscale' => $img_upscale,
		'hd'      => $img_hd,
		'quality' => $quality,
		'alt'     => $alt,
		'container' => $container_set,
		'class'   => $class,
		'lazyload' => true
		// .u-size1of2--compact .u-before1of2--compact
	));

	$i++;

endforeach;

// ----------------------------------------------------------
// Closing figure tag
// ----------------------------------------------------------

// print a caption if there's one set
if(count($caption) > 0): ?>

	<figcaption>
		<p>
		<?php
		// loop through and display the caption (can be an array of more words or sentences)
		foreach($caption as $text):
			echo $text;
		endforeach;
		?>
		</p>
	</figcaption>

<?php endif; ?>
</figure>
