<?php
	if (isset($_POST['logout'])) {
		session_start();
		session_unset();
		session_destroy();
		header("Location: ../index.php");
		exit();
	} else if (isset($_POST['goToUid'])) {
		header("Location: ../change.php?type=Username");
		exit();
	} else if (isset($_POST['goToEmail'])) {
		header("Location: ../change.php?type=Email");
		exit();
	} else if (isset($_POST['goToPwd'])) {
		header("Location: ../change.php?type=Password");
		exit();
	}
?>
