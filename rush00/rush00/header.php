<?php
	session_start();
	require_once("install.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Store</title>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	</head>
	<body>
		<header>
			<div class="topnav">
				<div class="menu">
					<a href="index.php">Home</a>
					<?php
					if (isset($_SESSION['userId']) && $_SESSION['userId'] === 1)
						echo '<a href="admin.php">Admin</a>';
					?>
				</div>
				<div class="logpage">
					<a href="cart.php">
					<?php
						if (isset($_SESSION['userId']))
							$uid = $_SESSION['userId'];
						else
							$uid = -1;
						include_once 'includes/dbh_inc.php';
						$sql = "SELECT SUM(prodQuan) AS tot FROM cart WHERE idUsers=? AND checked=0;";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							header("Location: ../index.php?error=emptyfields");
							exit();
						} else {
							mysqli_stmt_bind_param($stmt, "s", $uid);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							$row = mysqli_fetch_assoc($result);
						} 
						$sum = $row['tot'];
						if ($sum == 0)
							echo "";
						else
							echo '('.$sum.')';
					?>
					<i class="fas fa-shopping-cart"></i></a>
					<?php
						if (isset($_SESSION['uidUser'])) {
							echo '
									<a class="log" href="account.php">'.$_SESSION['uidUser'].' <i class="fas fa-user-circle"></i></a>';
						} else {
							echo '
									<a class="log" href="login.php">Login</a>
									<a class="log" href="signup.php">Register</a>';
						}
					?>
				</div>
			</div>
		</header>
