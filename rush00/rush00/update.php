<?php
	require("header.php");
?>

	<form action="includes/update_inc.php" method="post">
		<div class="container-change">
			<form action="update_inc.php">
				<?php
					if ($_GET['type'] == "upU") {
						$sql = "SELECT * FROM users WHERE idUsers=?;";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							header("Location: ../index.php?error=emptyfields");
							exit();
						} else {
							mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							$row = mysqli_fetch_assoc($result);
						}
						echo '<label for="uid"><b>Username</b></label>
						<input type="text" name="uid" value="'.$row['uidUsers'].'" required>
						<label for="email"><b>Email</b></label>
						<input type="email" name="email" value="'.$row['emailUsers'].'" required>
						<input type="hidden" name="id" value="'.$row['idUsers'].'"> 
						<button type="submit" name="changeU">Change</button>';
					} else if ($_GET['type'] == "upP") {
						$sql = "SELECT * FROM products WHERE idProd=?;";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							header("Location: ../index.php?error=emptyfields");
							exit();
						} else {
							mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							$row = mysqli_fetch_assoc($result);
						}
						echo '<label for="id"><b>Title</b></label>
						<input type="text" name="pid" value="'.$row['titleProd'].'" required>
						<input type="number" name="price" value="'.$row['priceProd'].'"required>
						<input type="number" name="quan" value="'.$row['quanProd'].'" required>
						<input type="text" name="type" value="'.$row['typeProd'].'" required>
						<input type="hidden" name="id" value="'.$row['idProd'].'"> 
						<button type="submit" name="changeP">Change</button>';
					} else if ($_GET['type'] == "upC") {
						$sql = "SELECT * FROM cart WHERE orderNum=?;";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							header("Location: ../index.php?error=emptyfields");
							exit();
						} else {
							mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							$row = mysqli_fetch_assoc($result);
						}
						echo '<label for="uid"><b>User id</b></label>
						<input type="number" name="uid" value="'.$row['idUsers'].'" required>
						<label for="pid"><b>Product id</b></label>
						<input type="number" name="pid" value="'.$row['idProd'].'" required>
						<label for="quan"><b>Quantity</b></label>
						<input type="number" name="quan" value="'.$row['prodQuan'].'" required>
						<label for="check"><b>Checked</b></label>
						<input type="number" name="checked" value="'.$row['checked'].'" required>
						<input type="hidden" name="id" value="'.$row['orderNum'].'"> 
						<button type="submit" name="changeC">Change</button>';
					}
				?>
			</form>
		</div>
	</form>

<?php
	require("footer.php");
?>
