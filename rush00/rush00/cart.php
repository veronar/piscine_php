<?php
	require("header.php");
	if (isset($_SESSION['uidUser'])) {

	} else {
		header("Location: login.php");
		exit();
	}
?>

	<div class="cartainer">
		
	<div class="wrapper">
		<?php
		$tot = 0;
			include_once 'includes/dbh_inc.php';
			$sql = "SELECT * FROM products INNER JOIN cart ON products.idProd = cart.idProd WHERE idUsers=".$_SESSION['userId']." AND checked=0;";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				echo 'Error SQL';
			} else {
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				while ($row = mysqli_fetch_assoc($result)) {
					echo '<form action="./includes/cart_inc.php" method="post">
					<div class="prodInfo">
					<p class="cartem">Item: '.$row['titleProd'].' <br>
					Price: R '.$row['priceProd'].'</p>
					<input class="cartid" type="hidden" value="'.$row['idProd'].'" name="id">
					<input class="carquan" type="number" value="'.$row['prodQuan'].'" name="quan"/> 
					<div>
					<button type="submit" name="editquan">Edit</button>
					<button type="submit" name="delitem">Delete</button>
					</div>
					</div>
					</form>';
					$tot += $row['priceProd'] * $row['prodQuan'];
				}
			}
			echo '<p class="cartotal"> Grand total: R '.$tot.' </p>';
			
		?>
		<form action="includes/cart_inc.php" method="post">
			<div>
				<button type="submit" name="checkout" class="checkout">checkout</button>
			</div>
		</form>
		
		</div>

	</div>

<?php
	require("footer.php");
?>


