#!/usr/bin/php
<?php
while (!feof(STDIN)) {
	echo "Enter a number: ";
	$input = rtrim(fgets(STDIN));
	if (is_numeric($input)) {
		if ($input % 2 == 0) {
			echo "The number $input is even\n";
		}
		elseif ($input % 2 != 0) {
			echo "The number $input is odd\n";
		}
	}
	elseif (feof(STDIN)) {
		echo "\n";
	}
	else {
		echo "'$input' is not a number\n";
	}
}
?>