<?php
	session_start();
	if (isset($_SESSION['uidGroup']) && $_SESSION['uidGroup'] === 1 && isset($_POST['delete'])) {
		require ("dbh_inc.php");
		$new = $_POST['id'];
		$sql = "SELECT * FROM products WHERE idProd=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../signup.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "i", $new);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
			unlink("../img/shop/".$row['imgFullProd']);
			$sql = "DELETE FROM products WHERE idProd=?";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../signup.php?error=sqlerrormeh");
				exit();
			} else {
				mysqli_stmt_bind_param($stmt, "i", $new);
				mysqli_stmt_execute($stmt);
				header("Location: ../index.php?success=success");
				exit();
			}
		}
	} else if (isset($_POST['add'])) {
		include_once "dbh_inc.php";
		if (isset($_SESSION['userId']))
			$uid = $_SESSION['userId'];
		else
			$uid = -1;
		$pid = $_POST['id'];
		$sql = "SELECT * FROM cart WHERE idUsers=? AND idProd=? AND checked=0;";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../signup.php?error=sqlerror");
				exit();
			} else {
				mysqli_stmt_bind_param($stmt, "ii", $uid, $pid);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$result = mysqli_stmt_num_rows($stmt);
				if ($result > 0)
					$sql = "UPDATE cart SET prodQuan = prodQuan + 1 WHERE idUsers=? AND idProd=? AND checked=0;";
				else
					$sql = "INSERT INTO cart (idUsers, idProd, prodQuan, checked) VALUES (?, ?, 1, 0);";
			}
		
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "Error!";
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "ii", $uid, $pid);
			mysqli_stmt_execute($stmt);
			header("Location: ../index.php?success=success");
			exit();
		}
	}
