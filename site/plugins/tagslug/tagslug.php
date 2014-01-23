<?php

function tagslug($text){
  // replace & by -and-
  $text = str_replace('&', '-and-', $text);

  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

  // trim
  $text = trim($text, '-');

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // lowercase
  $text = strtolower($text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  if (empty($text)){
    return 'n-a';
  }

  return $text;
}

function tagunslug($text){
  // replace -and- by <space>&<space>
  $text = str_replace('-and-', ' & ', $text);

  // replace - buy <space>
  $text = str_replace('-', ' ', $text);

  // uppercase
  $text = ucwords($text);

  return $text;
}
