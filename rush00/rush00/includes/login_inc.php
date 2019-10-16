<?php
	if (isset($_POST['submit'])) {
		require ("dbh_inc.php");
		$uid = $_POST['name'];
		$pass = $_POST['passwd'];
		$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../index.php?error=emptyfields");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "ss", $uid, $uid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				$passcheck = password_verify($pass, $row['pwdUsers']);
				if ($passcheck == false) {
					header("Location: ../login.php?error=wrongpwd&username=$uid");
					exit();
				} else if ($passcheck == true) {
					session_start();
					if ($row['idUsers'] !== 1) {
						$sql = "UPDATE cart SET idUsers=? WHERE idUsers=-1;";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							header("Location: ../index.php?error=emptyfields");
							exit();
						} else {
							mysqli_stmt_bind_param($stmt, "i", $row['idUsers']);
							mysqli_stmt_execute($stmt);
						}
					}
					$_SESSION['userId'] = $row['idUsers'];
					$_SESSION['uidUser'] = $row['uidUsers'];
					$_SESSION['uidEmail'] = $row['emailUsers'];
					$_SESSION['uidGroup'] = $row['typeUsers'];
					$_SESSION['uidPass'] = $pass;
					if ($row['idUsers'] === 1)
						header("Location: ../admin.php?success=success");
					else
						header("Location: ../index.php?success=success");
					exit();
				} else {
					header("Location: ../index.php?error=error");
					exit();
				}
			} else {
				header("Location: ../login.php?error=nouser");
				exit();
			}
		}
	} else {
		header("Location: ../login.php");
		exit();
	}
