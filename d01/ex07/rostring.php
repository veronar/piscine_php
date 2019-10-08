#!/usr/bin/php
<?php

function ft_split($str) {
	$str_array = explode(" ", $str);
	$str_array = array_filter($str_array);
	return ($str_array);
}

function epur_str($str) {
	$str = trim($str, " ");
	$str = preg_replace('/\s+/', ' ', $str);
	return ($str);
}

$str = epur_str($argv[1]);
$arr = ft_split($str);
array_push($arr, array_shift($arr));

$i = 0;
while ($i < (count($arr)-1)) {
	echo "$arr[$i] ";
	$i++;
}
echo "$arr[$i]\n";

?>