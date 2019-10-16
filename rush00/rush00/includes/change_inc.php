<?php
		require ("dbh_inc.php");
		session_start();
		$old = $_POST['old'];
		$new = $_POST['new'];
		if (isset($_POST['changeUid'])) {
			$new = $_POST['new'];
			$sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../signup.php?error=sqlerror");
				exit();
			} else {
				mysqli_stmt_bind_param($stmt, "s", $new);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$result = mysqli_stmt_num_rows($stmt);
				if ($result > 0) {
					header("Location: ../change.php?type=Username&error=userexists");
					exit();
				} else {
					$sql = "UPDATE users SET uidUsers=? WHERE uidUsers=?";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../signup.php?error=sqlerrormeh");
						exit();
					} else {
						mysqli_stmt_bind_param($stmt, "ss", $new, $_SESSION['uidUser']);
						mysqli_stmt_execute($stmt);
						$_SESSION['uidUser'] = $new;
						header("Location: ../index.php?success=success");
						exit();
					}
				}
			}
		} else if (isset($_POST['changeEmail'])) {
			$sql = "SELECT * FROM users WHERE emailUsers=?";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../signup.php?error=sqlerror");
				exit();
			} else {
				mysqli_stmt_bind_param($stmt, "s", $new);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$result = mysqli_stmt_num_rows($stmt);
				if ($result > 0) {
					header("Location: ../change.php?type=Email&error=userexists");
					exit();
				} else {
					$sql = "UPDATE users SET emailUsers=? WHERE emailUsers=?";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../signup.php?error=sqlerrormeh");
						exit();
					} else {
						mysqli_stmt_bind_param($stmt, "ss", $new, $_SESSION['uidEmail']);
						mysqli_stmt_execute($stmt);
						$_SESSION['uidEmail'] = $new;
						header("Location: ../index.php?success=success");
						exit();
					}
				}
			}
		} else if (isset($_POST['changePwd'])){
			if ($old != $_SESSION['uidPass']) {
				header("Location: ../change.php?type=Password&error=wrongold");
				exit();
			}
			$sql = "SELECT * FROM users WHERE uidUsers=?";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../signup.php?error=sqlerror");
				exit();
			} else {
				mysqli_stmt_bind_param($stmt, "s", $_SESSION['uidUser']);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$result = mysqli_stmt_num_rows($stmt);
				if ($result == 0) {
					header("Location: ../login.php?error=error");
					exit();
				} else {
					$sql = "UPDATE users SET pwdUsers=? WHERE uidUsers=?";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../signup.php?error=sqlerrormeh");
						exit();
					} else {
						$hash = password_hash($new, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt, "ss", $hash, $_SESSION['uidUser']);
						mysqli_stmt_execute($stmt);
						$_SESSION['uidPass'] = $new;
						header("Location: ../index.php?success=success");
						exit();
					}
				}
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	} else {
		header("Location: ../index.php");
		exit();
	}
