<?php
	$servername = "localhost";
	$username = "root";
	$password = "root42";
	$db = "shop";

	$conn = mysqli_connect($servername, $username, $password);
	if (!$conn)
		die("Connection failed: ".mysqli_connect_error());
	$selected = mysqli_select_db($conn, $db);
	if (!$selected) {
		$sql = "CREATE DATABASE IF NOT EXISTS $db";
		if (!mysqli_query($conn, $sql))
			echo "Error creating database: ".mysqli_error($conn);
		mysqli_close($conn);
		$conn = mysqli_connect($servername, $username, $password, $db);
		if (!$conn)
			die("Connection failed: ".mysqli_connect_error());
		$sql = "CREATE TABLE IF NOT EXISTS users (
			idUsers INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
			uidUsers TINYTEXT NOT NULL,
			emailUsers TINYTEXT NOT NULL,
			pwdUsers LONGTEXT NOT NULL,
			typeUsers INT(1) NOT NULL
			)";
		if (!mysqli_query($conn, $sql))
			echo "Error creating users table: ".mysqli_error($conn);
		$sql = "CREATE TABLE IF NOT EXISTS products (
			idProd INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
			titleProd LONGTEXT NOT NULL,
			imgFullProd LONGTEXT NOT NULL,
			priceProd FLOAT NOT NULL,
			quanProd INT(11) NOT NULL,
			typeProd LONGTEXT NOT NULL
			)";
		if (!mysqli_query($conn, $sql))
			echo "Error creating products table: ".mysqli_error($conn);
		$sql = "CREATE TABLE IF NOT EXISTS cart (
			orderNum INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
			idUsers INT(11) NOT NULL,
			idProd INT(11) NOT NULL,
			prodQuan INT(11) NOT NULL,
			checked INT(1) NOT NULL
			)";
		if (!mysqli_query($conn, $sql))
			echo "Error creating cart: ".mysqli_error($conn);
		$hash = password_hash('admin', PASSWORD_DEFAULT);
		$sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, typeUsers)
		VALUES ('admin', 'admin', '".$hash."', 1)";
		if (!mysqli_query($conn, $sql))
			echo "Error creating admin: ".mysqli_error($conn);
		$sql = "DELETE FROM cart WHERE idUsers=-1";
		if (!mysqli_query($conn, $sql))
			echo "Error creating admin: ".mysqli_error($conn);
	}
	mysqli_close($conn);
?>
