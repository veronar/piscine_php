#!/usr/bin/php
<?php

function ft_split($str) {
	$str_array = explode(" ", $str);
	$str_array = array_filter($str_array);
	sort($str_array);
	return ($str_array);
}

$i = 1;

while ($i < count($argv)) {
	$str_arr = ft_split($argv[$i]);
	if (count($total_arr) > 0) {
		$total_arr = array_merge($total_arr, $str_arr);
	}
	else {
		$total_arr = $str_arr;
	}
	$i++;
}
sort($total_arr);

$i = 0;

while ($i < count($total_arr)) {
	echo "$total_arr[$i]\n";
	$i++;
}

?>