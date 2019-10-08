#!/usr/bin/php
<?php

function ft_split($str) {
	$str_array = explode(" ", $str);
	$str_array = array_filter($str_array);
	sort($str_array);
	return ($str_array);
}

$i = 1;
if (count($argv) <= 1)
	return;
$total_arr = array();

while ($i < count($argv)) {
	$str_arr = ft_split($argv[$i]);
	$total_arr = array_merge($total_arr, $str_arr);
	$i++;
}

$i = 0;
while ($i < count($total_arr)) {
	if (($total_arr[$i][0] >= 'a' && $total_arr[$i][0] <= 'z') || ($total_arr[$i][0] >='A' && $total_arr[$i][0] <= 'Z'))
		$alpha[] = $total_arr[$i];
	else if ($total_arr[$i][0] >= '0' && $total_arr[$i][0] <= '9')
		$number[] = $total_arr[$i];
	else
		$other[] = $total_arr[$i];
	$i++;
}

sort($number, SORT_STRING);
rsort($alpha);
rsort($other);
foreach ($alpha as $elem) {
	echo $elem."\n";
}
foreach ($number as $elem) {
	echo $elem."\n";
}
foreach ($other as $elem) {
	echo $elem."\n";
}

?>