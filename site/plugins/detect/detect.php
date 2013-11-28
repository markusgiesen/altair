<?php

// Loaded the Mobile_Detect.php script form 'plugins/detect/' folder with Kirby, now create the class
$detect = new Mobile_Detect();

// Set session variable for the device to false
$_SESSION['isTablet'] = false;
$_SESSION['isMobile'] = false;
$_SESSION['isDesktop'] = false;

// Set session variable per device
if($detect->isTablet()){
	$_SESSION['isTablet'] = true;
}
elseif($detect->isMobile()){
	$_SESSION['isMobile'] = true;
}
else{
	$_SESSION['isDesktop'] = true; // if device can't be detected, assume it's desktop.
}

// Function to load (device specific) template snippets
function snippet_detect($snippet, $data=array(), $overflow=false, $return=false) {

	// Set variables used for snippet filename
	if($_SESSION['isTablet']){
		$deviceClass = 'tablet';
	}
	if($_SESSION['isMobile']){
		$deviceClass = 'mobile';
	}
	if($_SESSION['isDesktop']){
		$deviceClass = 'desktop';
	}

	// Load snippet file
	if ($deviceClass == 'tablet' && $overflow == 'tablet=>desktop') {
		// Embed desktop instead of tablet (template) snippet
		return tpl::loadFile(c::get('root.site') . '/snippets/' . $snippet . '.desktop' . '.php', $data, $return);
	} else if ($deviceClass == 'mobile') {
		// Embed mobile (template) snippet (default snippet, without device specific postfix)
		return tpl::loadFile(c::get('root.site') . '/snippets/' . $snippet . '.php', $data, $return);
	} else {
		// Embed device specific (template) snippet
		return tpl::loadFile(c::get('root.site') . '/snippets/' . $snippet . '.' . $deviceClass . '.php', $data, $return);
	}

}