<?php
	session_start();

	function read_data()
	{
		if (!$_POST['login'] || !$_POST['passwd'] || $_POST['submit'] || !$_POST['submit'] === "OK")
		{
			$arr['login'] = $_POST['login'];
			$arr['passwd'] = hash('whirlpool', $_POST['passwd']);
		}
		else {
			echo "Error\n";
			exit();
		}
	}

	$arr = read_data();
	if (!file_exists("../private") || !file_exists("../private/passwd"))
		mkdir("../private");
	if (file_exists("../private/passwd"))
	{
		$arr_store = unserialize(file_get_contents("../private/passwd"));
		foreach ($arr_store as $user)
		{
			if ($user["login"] === $_POST["login"])
			{
				echo "ERROR\n";
				return ;
			}
		}
	}
	$ar_store[] = $arr;
	file_put_contents("../private/passwd", serialize($arr_store));
	echo "OK\n";
?>