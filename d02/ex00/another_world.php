#!/usr/bin/php
<?php

function tabs($str) {
	$str = trim($str, " ");
	$str = preg_replace('/[ ]{2,}|[\t]/', ' ', $str);
	return ($str);
}

function epur_str($str) {
	$str = trim($str, " ");
	$str = preg_replace('/\s+/', ' ', $str);
	return ($str);
}

if ($argc <= 1)
	return;

$ret = tabs($argv[1]);
$ret = epur_str($argv[1]);

echo "$ret\n";
?>