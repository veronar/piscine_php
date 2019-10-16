<?php
	if (isset($_POST['submit'])) {
		$name = $_POST['filename'];
		if (empty($name))
			$name = "shop";
		else 
			$name = strtolower(str_replace(" ", "-", $name));
		$title = $_POST['filetitle'];
		$price = $_POST['fileprice'];
		$quan = $_POST['filequan'];
		$type = $_POST['filetype'];
		$file = $_FILES['file'];
		$fileName = $file["name"];
		$fileType = $file["type"];
		$fileTemp = $file["tmp_name"];
		$fileError = $file["error"];
		$fileSize = $file["size"];
		$fileExt = explode(".", $fileName);
		$fileActExt = strtolower(end($fileExt));
		$allowed = array("jpg", "jpeg", "png");
		if (in_array($fileActExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 2000000) {
					$imgFullName = $name . "." . uniqid("", true) . "." . $fileActExt;
					$fileDest = "../img/shop/" . $imgFullName;
					include_once "dbh_inc.php";
					if (empty($title) || empty($type) || empty($file) || empty($price)) {
						header("Location: ../admin.php?type=prod&error=empty");
						exit();
					} else {
						$sql = "INSERT INTO products (titleProd, imgFullProd, priceProd, quanProd, typeProd)
						VALUES (?, ?, ?, ?, ?);";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo "Error!";
							exit();
						} else {
							mysqli_stmt_bind_param($stmt, "ssdis", $title, $imgFullName, $price, $quan, $type);
							mysqli_stmt_execute($stmt);
							move_uploaded_file($fileTemp, $fileDest);
							header("Location: ../admin.php?type=prod");
							exit();
						}
					}
				} else {
					echo "File size is too big!";
					exit();
				}
			} else {
				echo "You have an error!";
				exit();
			}
		} else {
			echo "You need to upload a proper file type!";
			exit();
		}
	} else if (isset($_POST['addU'])) {
		require ("dbh_inc.php");
		$username = $_POST['name'];
		$email = $_POST['email'];
		$pass = $_POST['passwd'];
		$conpass = $_POST['conpass'];
		if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
		{
			header("Location: ../admin.php?type=upU&error=invaliduid&mail=".$email);
			exit();
		}
		else if ($pass !== $conpass) {
			header("Location: ../admin.php?type=upU&error=invalidpass&uid=".$username."&mail=".$email);
			exit();
		}
		else {
			$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../admin.php?error=sqlerror&type=users");
				exit();
			} else {
				mysqli_stmt_bind_param($stmt, "ss", $username, $email);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$result = mysqli_stmt_num_rows($stmt);
				if ($result > 0) {
					header("Location: ../admin.php?error=userexists&type=users");
					exit();
				} else {
					$sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, typeUsers)
					VALUES (?, ?, ?, 0)";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../admin.php?error=sqlerrormeh&type=users");
						exit();
					} else {
						$hash = password_hash($pass, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hash);
						mysqli_stmt_execute($stmt);
						header("Location: ../admin.php?type=users");
						exit();
					}
				}
			}
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	} else if (isset($_POST['addC'])) {
		require ("dbh_inc.php");
		$sql = "INSERT INTO cart (idUsers, idProd, prodQuan, checked)
				VALUES (?, ?, ?, ?)";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../admin.php?error=sqlerrormeh&type=users");
			exit();
		} else {
			if ($_POST['check'] > 0)
				$check = 1;
			else
				$check = 0;
			mysqli_stmt_bind_param($stmt, "iiii", $_POST['uid'], $_POST['pid'], $_POST['quan'], $check);
			mysqli_stmt_execute($stmt);
			header("Location: ../admin.php?type=cart");
			exit();
		}
	}
