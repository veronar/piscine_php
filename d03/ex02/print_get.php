<?php
if ($_GET)
{
	foreach ($_GET as $elem => $value) {
		echo "$elem".": ". "$value\n";
	}
}
?>