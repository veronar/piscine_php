<?php
function ft_split($str) {
	$str_array = explode(" ", $str);
	$str_array = array_filter($str_array);
	sort($str_array);
	return ($str_array);
}
?>