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

// Set container width...
if(count($container) > 0):
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
else:
	// ...else set to device specific width set in config
	if($_SESSION['isMobile']) { $base_width = c::get('thumb.small.container'); } // get the base width of our grid from config file
	if($_SESSION['isTablet']) { $base_width = c::get('thumb.compact.container'); } // get the base width of our grid from config file
	if($_SESSION['isDesktop']) { $base_width = c::get('thumb.medium.container'); } // get the base width of our grid from config file
	$container_set = false;
endif;

// Set breakpoint for class of every image
if(count($breakfrom) > 0):
	$breakclass = $breakfrom[0];
else:
	$breakclass = c::get('thumb.multifigure.break', 'small');
endif; ?>

<figure class="MultiFigure-item">
	<?php
	// if there's just one quality set, and no wildcard, set overrule variable
	if( (count($qualities)==1)&&($qualities[0] != '*')) {
		$quality_overrule = $qualities[0];
	}

	$i = 0;
	foreach($images as $image):

		// if overruled (one quality set), use the overrule quality
		if($quality_overrule) {
			$quality = $quality_overrule;
		}else{
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

		// is the first char a * ?
		if(str::substr($width, 0, 1) == '*') {
			$img_clearing = ' MultiFigure-image--clear';

			// the first part (the 1 of 3)
			$classgridpart = str::substr($width, 1, 1);
			// the total (the 3)
			$classgridtot = str::substr($width, 4, 1);

			// since it starts with a star, trim that leading star
			$width = trim($width, '*');
		}
		else {
			$img_clearing = '';

			// the first part (the 1 of 3)
			$classgridpart = str::substr($width, 0, 1);
			// the total (the 3)
			$classgridtot = str::substr($width, 3, 1);
		}

		// calculate rounded width.
		$img_width = round(($base_width / $classgridtot) * $classgridpart);
		// generate a thumb for each multifigure img
		echo thumb($image, array(
			'width'   => $img_width,
			'height'  => false,
			'crop'    => false,
			'upscale' => $img_upscale,
			'hd'      => $img_hd,
			'quality' => $quality,
			'alt'     => '',
			'container' => $container_set,
			'class'   => 'MultiFigure-image u-size' . $width . '--' . $breakclass . $img_clearing
			// .u-size1of2--compact
		));

		$i++;

	endforeach;

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
