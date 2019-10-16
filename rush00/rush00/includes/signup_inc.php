<?php
	if (isset($_POST['submit'])) {
		require ("dbh_inc.php");

		$username = $_POST['name'];
		$email = $_POST['email'];
		$pass = $_POST['passwd'];
		$conpass = $_POST['conpass'];
		if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
		{
			header("Location: ../signup.php?error=invaliduid&mail=".$email);
			exit();
		}
		else if ($pass !== $conpass) {
			header("Location: ../signup.php?error=invalidpass&uid=".$username."&mail=".$email);
			exit();
		}
		else {
			$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../signup.php?error=sqlerror");
				exit();
			} else {
				mysqli_stmt_bind_param($stmt, "ss", $username, $email);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$result = mysqli_stmt_num_rows($stmt);
				if ($result > 0) {
					header("Location: ../login.php?error=userexists");
					exit();
				} else {
					$sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, typeUsers)
					VALUES (?, ?, ?, 0)";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../signup.php?error=sqlerrormeh");
						exit();
					} else {
						$hash = password_hash($pass, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hash);
						mysqli_stmt_execute($stmt);
						$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							header("Location: ../index.php?error=emptyfields");
							exit();
						} else {
							mysqli_stmt_bind_param($stmt, "ss", $username, $username);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							$row = mysqli_fetch_assoc($result);
						} 
						session_start();
						$_SESSION['userId'] = $row['idUsers'];
						$sql = "UPDATE cart SET idUsers=? WHERE idUsers=-1;";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							header("Location: ../index.php?error=emptyfields");
							exit();
						} else {
							mysqli_stmt_bind_param($stmt, "i", $row['idUsers']);
							mysqli_stmt_execute($stmt);
						}
						$_SESSION['uidUser'] = $username;
						$_SESSION['uidGroup'] = 0;
						$_SESSION['uidEmail'] = $email;
						$_SESSION['uidPass'] = $pass;
						header("Location: ../index.php?success=success");
						exit();
					}
				}
			}
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}
	else {
		header("Location: ../index.php");
		exit();
	}
