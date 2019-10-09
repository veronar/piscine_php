#!/usr/bin/php
<?php

function ft_split($str) {
	$str_array = explode(" ", $str);
	$str_array = array_filter($str_array);
	return ($str_array);
}

$month = array(
	0 => '/[Jj]anvier/',
	1 => '/[Ff][eé]vrier/',
	2 => '/[Mm]ars/',
	3 => '/[Aa]vril/',
	4 => '/[Mm]ai/',
	5 => '/[Jj]uin/',
	6 => '/[Jj]uillet/',
	7 => '/[Aa]o[uû]t/',
	8 => '/[Ss]eptembre/',
	9 => '/[Oo]ctobre/',
	10 => '/[Nn]ovembre/',
	11 => '/[Dd][ée]cembre/'); 
	// square brackets is for options https://medium.com/factory-mind/regex-tutorial-a-simple-cheatsheet-by-examples-649dc1c3f285

$replace = array( "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");

if ($argc < 2) // checks for arguments
	return;

if (!preg_match('/^([Ll]undi||[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche) [0-9][0-9]? ([Jj]anvier|[Ff][eé]vrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|[Aa]o[uû]t|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd][ée]cembre) [0-9]{4} [0-9]{2}:[0-9]{2}:[0-9]{2}$/', $argv[1])) { //checks for valid input ie that there is a dayof week & month with either upper or lower case, date in numerical & valid time in numerical.  
	echo "Wrong format\n";
	return;
}

unset($argv[0]); // to remove program name ***.php (name of file) from array

$arr = ft_split($argv[1]); // split 1st argument into an array

if (count($arr) != 5){ // another check: format of arguments recieved ie that there are 5
	echo "Wrong format\n";
	return;
}

$arr[2] = preg_replace($month, $replace, $arr[2]); // replaces the name the month with the numerical value of the month

$seconds = strtotime("$arr[3]-$arr[2]-$arr[1] $tab[4]"); //https://www.php.net/manual/en/function.strtotime.php

if (!$seconds){
	echo "Wrong format\n";
	return;
}

echo "$seconds\n";

?>