<?php
function ft_is_sort($input) {
	$arr = array_values($input);
	sort($arr);

	if ($input === $arr) {
		return TRUE;
	}
	return FALSE;
}
?>