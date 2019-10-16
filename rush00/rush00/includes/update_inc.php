<?php
	require ("dbh_inc.php");
	if ($_GET['type'] == "delU") {
		$sql = "DELETE FROM users WHERE idUsers=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../admin.php?error=sqlerrormeh");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
			mysqli_stmt_execute($stmt);
			header("Location: ../admin.php?type=users&stat=done");
			exit();
		}
	} else if ($_GET['type'] == "delP") {
		$sql = "DELETE FROM products WHERE idProd=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../admin.php?error=sqlerrormeh");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
			mysqli_stmt_execute($stmt);
			header("Location: ../admin.php?type=prod&stat=done");
			exit();
		}
	} else if ($_GET['type'] == "delC") {
		$sql = "DELETE FROM cart WHERE orderNum=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../admin.php?error=sqlerrormeh");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
			mysqli_stmt_execute($stmt);
			header("Location: ../admin.php?type=cart&stat=done");
			exit();
		}
	} else if (isset($_POST['changeU'])) {
		$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=? AND NOT idUsers=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../admin.php?error=sqlerror&type=users");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "ssi", $_POST['uid'], $_POST['email'], $_POST['id']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$result = mysqli_stmt_num_rows($stmt);
			if ($result > 0) {
				header("Location: ../admin.php?error=userexists&type=users");
				exit();
			} else {
				$sql = "UPDATE users SET uidUsers=?, emailUsers=? WHERE idUsers=?;";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../signup.php?error=sqlerrormeh");
					exit();
				} else {
					mysqli_stmt_bind_param($stmt, "ssi", $_POST['uid'], $_POST['email'], $_POST['id']);
					mysqli_stmt_execute($stmt);
					header("Location: ../admin.php?type=users");
					exit();
				}
			}
		}
	} else if (isset($_POST['changeP'])) {
		$sql = "UPDATE products SET titleProd=?, priceProd=?, quanProd=?, typeProd=? WHERE idProd=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../signup.php?error=sqlerrormeh");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "sdisi", $_POST['pid'], $_POST['price'], $_POST['quan'], $_POST['type'], $_POST['id']);
			mysqli_stmt_execute($stmt);
			header("Location: ../admin.php?type=prod");
			exit();
		}
	} else if (isset($_POST['changeC'])) {
		$sql = "UPDATE cart SET idUsers=?, idProd=?, prodQuan=?, checked=? WHERE orderNum=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../signup.php?error=sqlerrormeh");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "iiiii", $_POST['uid'], $_POST['pid'], $_POST['quan'], $_POST['checked'], $_POST['id']);
			mysqli_stmt_execute($stmt);
			header("Location: ../admin.php?type=cart");
			exit();
		}
	}
