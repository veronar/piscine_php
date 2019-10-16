<?php
	require("header.php");
?>

	<main>
		<section class="shop-links">
			<div class="tabs">
				<a href="admin.php?type=users">Users</a>
				<a href="admin.php?type=prod">Products</a>
				<a href="admin.php?type=cart">Cart</a>
			</div>
			<div class="wrapper">
				<?php
					if (!isset($_GET['type']) || $_GET['type'] == "users")
						echo '<div class="shop-upload">
						<form action="includes/upload_inc.php" method="post">
							<input type="text" placeholder="Enter Username" name="name" required>
							<input type="email" placeholder="Enter Email" name="email" required>
							<input type="password" placeholder="Enter Password" name="passwd" required>
							<input type="password" placeholder="Confirm Password" name="conpass" required>
							<button type="submit" name="addU" class="createAcc">Create account</button>
						</form>
						</div>';
					else if ($_GET['type'] == "prod")
						echo '<div class="shop-upload">
						<form action="includes/upload_inc.php" method="post" enctype="multipart/form-data" class="uploadForm">
							<input type="text" name="filename" placeholder="File name">
							<input type="text" name="filetitle" placeholder="Item title">
							<input type="number" step="any" name="fileprice" placeholder="Item price">
							<input type="number" name="filequan" placeholder="Item quantity">
							<input type="text" name="filetype" placeholder="Item type">
							<input type="file" name="file">
							<button type="submit" name="submit" class="upload">Upload</button>
						</form>
					</div>';
					else if ($_GET['type'] == "cart")
						echo '<div class="shop-upload">
						<form action="includes/upload_inc.php" method="post" class="uploadForm">
							<input type="number" name="uid" placeholder="Users id">
							<input type="number" name="pid" placeholder="Prod id">
							<input type="number" name="quan" placeholder="Prod quan">
							<input type="number" name="check" placeholder="Checked">
							<button type="submit" name="addC" class="upload">Add to cart</button>
						</form>
					</div>';
				?>
				<div class="info-table">
					<?php
					if (!isset($_GET['type']) || $_GET['type'] == "users") {
						$sql = "SELECT * FROM users;";
						include_once 'includes/dbh_inc.php';
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo 'Error SQL';
						} else {
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							echo'<div class="admin-prod"><table class="infoTb">
								<tr>
									<th>idUsers</th>
									<th>uidUsers</th>
									<th>emailUsers</th>
									<th>pwdUsers</th>
									<th>typeUsers</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>';
							while ($row = mysqli_fetch_assoc($result)) {
								echo ' <tr>
									<td>'.$row['idUsers'].'</td>
									<td>'.$row['uidUsers'].'</td>
									<td>'.$row['emailUsers'].'</td>
									<td>'.$row['pwdUsers'].'</td>
									<td>'.$row['typeUsers'].'</td>
									<td> <a href="update.php?id='.$row['idUsers'].'&type=upU" style="color: #11C692;">Edit</a> </td>
									<td> <a href="includes/update_inc.php?id='.$row['idUsers'].'&type=delU" style="color: #fe3533;">Delete</a> </td>
								</tr>
								';
							}
							echo '</div></table>';
						}
					} else if ($_GET['type'] == "prod"){
						$sql = "SELECT * FROM products;";
						include_once 'includes/dbh_inc.php';
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo 'Error SQL';
						} else {
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							echo'<div class="admin-prod"><table class="infoTb">
								<tr>
									<th>idProd</th>
									<th>titleProd</th>
									<th>priceProd</th>
									<th>quanProd</th>
									<th>typeProd</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>';
							while ($row = mysqli_fetch_assoc($result)) {
								echo ' <tr>
									<td>'.$row['idProd'].'</td>
									<td>'.$row['titleProd'].'</td>
									<td>'.$row['priceProd'].'</td>
									<td>'.$row['quanProd'].'</td>
									<td>'.$row['typeProd'].'</td>
									<td> <a href="update.php?id='.$row['idProd'].'&type=upP" style="color: #1d3e6e;">Edit</a> </td>
									<td> <a href="includes/update_inc.php?id='.$row['idProd'].'&type=delP" style="color: #fe3533;">Delete</a> </td>
								</tr>
								';
							}
							echo '</div></table>';
						}
					} else if ($_GET['type'] == "cart") {
						$sql = "SELECT * FROM cart;";
						include_once 'includes/dbh_inc.php';
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo 'Error SQL';
						} else {
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							echo'<div class="admin-prod"><table class="infoTb">
								<tr>
									<th>orderNum</th>
									<th>idUsers</th>
									<th>idProd</th>
									<th>prodQuan</th>
									<th>checked</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>';
							while ($row = mysqli_fetch_assoc($result)) {
								echo ' <tr>
									<td>'.$row['orderNum'].'</td>
									<td>'.$row['idUsers'].'</td>
									<td>'.$row['idProd'].'</td>
									<td>'.$row['prodQuan'].'</td>
									<td>'.$row['checked'].'</td>
									<td> <a href="update.php?id='.$row['orderNum'].'&type=upC" style="color: #1d3e6e;">Edit</a> </td>
									<td> <a href="includes/update_inc.php?id='.$row['orderNum'].'&type=delC" style="color: #fe3533;">Delete</a> </td>
								</tr>
								';
							}
							echo '</div></table>';
						}
					}
				?>
				</div>
			</div>
		</section>
	</main>

<?php
	require("footer.php");
?>
