<?php
	require ("dbh_inc.php");
	session_start();
	$new = $_POST['quan'];
	$id = $_POST['id'];
	if (isset($_POST['editquan'])) {
		$sql = "UPDATE cart SET prodQuan=? WHERE idProd=? AND idUsers=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../signup.php?error=sqlerrormeh");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "iii", $new, $id, $_SESSION['userId']);
			mysqli_stmt_execute($stmt);
			header("Location: ../cart.php?success=success");
			exit();
			}
	} else if (isset ($_POST['delitem'])) {
		$sql = "DELETE FROM cart WHERE idProd=? AND idUsers=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../signup.php?error=sqlerrormeh");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "ii", $id, $_SESSION['userId']);
			mysqli_stmt_execute($stmt);
			header("Location: ../cart.php?success=success");
			exit();
			}
	} else if (isset ($_POST['checkout'])) {
		$sql = "UPDATE cart SET checked = 1 WHERE idUsers=? AND checked = 0;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../signup.php?error=sqlerrormeh");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "i", $_SESSION['userId']);
			mysqli_stmt_execute($stmt);
			header("Location: ../cart.php?success=success");
			exit();
			}
	}
	
