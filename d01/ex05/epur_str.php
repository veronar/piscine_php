#!/usr/bin/php
<?php
function epur_str($str) {
	$str = trim($str, " ");
	$str = preg_replace('/\s+/', ' ', $str);
	echo "$str\n";
}
epur_str($argv[1]);
?>
