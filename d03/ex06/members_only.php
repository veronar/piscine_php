<?php

if ($_SERVER['PHP_AUTH_USER'] == "zaz" && $_SERVER['PHP_AUTH_PW'] == "Ilovemylittleponey") {
	header('content-type: text/html');
	$file = file_get_contents("../img/42.png");
	$str = base64_encode($file);
	echo "<html><body>\nHello Zaz<br />\n<img src='data:image/png;base64,$str'>\n</body></html>\n";
}
else
{
	header('WWW-Authenticate: Basic realm="Member area"');
	header('HTTP/1.0 401 Unauthorized');
	echo "<html><body>That area is accessible for members only</body></html>\n";
}

?>