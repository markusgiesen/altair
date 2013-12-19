<?php
function truncate($input, $numwords, $padding="")
{
	$output = strtok($input, " \n");
	while(--$numwords > 0) $output .= " " . strtok(" \n");
	if($output != $input) $output .= $padding;
	// Original PHP code by Chirp Internet: www.chirp.com.au
	// Please acknowledge use of this code by including this header.

	$opened = array();

	// loop through opened and closed tags in order
	if(preg_match_all("/<(\/?[a-z]+)>?/i", $output, $matches)) {
		foreach($matches[1] as $tag) {
			if(preg_match("/^[a-z]+$/i", $tag, $regs)) {
				// a tag has been opened
				if(strtolower($regs[0]) != 'br') $opened[] = $regs[0];
			} elseif(preg_match("/^\/([a-z]+)$/i", $tag, $regs)) {
				// a tag has been closed
				unset($opened[array_pop(array_keys($opened, $regs[1]))]);
			}
		}
	}

	// close tags that are still open
	if($opened) {
		$tagstoclose = array_reverse($opened);
		foreach($tagstoclose as $tag) $output .= "</$tag>";
	}

	return $output;
}
?>
