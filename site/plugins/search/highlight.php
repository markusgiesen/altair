<?php
function search_highlight($string_input, $query_word, $numOfWordToAdd) {

    // Split input in $before ($query_word) and $after ($query_word)
    $string_input = strip_tags($string_input);
    list($before, $after) = array_pad( explode($query_word, $string_input . ' '), -2, null);
    $before = rtrim($before);
    $after  = ltrim($after);

	// Create array by exploding $before and $after
	$beforeArray = array_reverse(explode(" ", $before));
    $afterArray  = explode(" ", $after);

    // Count words in $beforeArray and $afterArray
    $countBeforeArray = count($beforeArray);
    $countAfterArray  = count($afterArray);

    // Add additional words to $afterString if $countBeforeArray < $numOfWordToAdd
    if($countBeforeArray < $numOfWordToAdd) {
    	$beforeStringShort 	=	$numOfWordToAdd - $countBeforeArray;
    } else {
    	$beforeStringShort	= 0;
    }

	// Add additional words to $BeforeString if $countAfterArray < $numOfWordToAdd
    if($countAfterArray < $numOfWordToAdd) {
    	$afterStringShort 	=	$numOfWordToAdd - $countAfterArray;
    } else {
    	$afterStringShort 	= 0;
    }

	// Create $beforeString
    $beforeString = "";
    // Output all words if $countBeforeArray < $numOfWordToAdd, else output $numOfWordToAdd
	if($countBeforeArray < $numOfWordToAdd) {
        $beforeString 		= 	implode(' ', $beforeArray);
    } else {
        for($i = 0; $i < ($numOfWordToAdd + $afterStringShort); $i++) {
            $beforeString = $beforeArray[$i] . ' ' . $beforeString;
        }
    }

    // Create $afterString
    $afterString = "";
    // Output all words if $countAfterArray < $numOfWordToAdd, else output $numOfWordToAdd
    if($countAfterArray < $numOfWordToAdd) {
        $afterString = implode(' ', $afterArray);
    } else {
        for($i = 0; $i < ($numOfWordToAdd + $beforeStringShort); $i++) {
            $afterString = $afterString . $afterArray[$i] . ' ';
        }
    }

    // Return new string
	$string = $beforeString .' <mark>'. $query_word . '</mark> ' . $afterString;
	return $string;
}