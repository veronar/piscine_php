<?php
	require("header.php");
?>

	<main>
		<section class="shop-links">
			<div class="wrapper">
				<div class="filter">
					<form action="" method="post" class="searchBox">
						<input type="text" name="search" placeholder="Search">
						<button type="submit" name="searchbtn">Search</button>
					</form>
				</div>
				<div class="shop-container">
						<?php
						if (isset($_POST['searchbtn']))
							$sql = "SELECT * FROM products WHERE titleProd LIKE '%".$_POST['search']."%' OR typeProd LIKE '%".$_POST['search']."%'";
						else
							$sql = "SELECT * FROM products;";
						include_once 'includes/dbh_inc.php';
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo 'Error SQL';
						} else {
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							while ($row = mysqli_fetch_assoc($result)) {
								echo'<form action="includes/prod_inc.php" method="post">
									<div style="background-image: url(img/shop/'.$row['imgFullProd'].');"></div>
									<input disabled="disabled" value="&emsp;'.$row['titleProd'].'"></input>
									<input disabled="disabled" value="&emsp;R'.$row['priceProd'].'"></input>';
								if (isset($_SESSION['uidGroup']) && $_SESSION['uidGroup'] === 1)
									echo '<input type="hidden" value="'.$row['idProd'].'" name="id"></input>
									<button type="submit" name="delete">Delete</button>';
								else {
									echo '<input type="hidden" value="'.$row['idProd'].'" name="id"></input>';
									if ($row['quanProd'] == 0)
										echo '<button type="submit" name="add" class="outOfStock" disabled="disabled">Out of stock</button>';
									else if ($row['quanProd'] > 0)
										echo '<button type="submit" name="add" class="addToCart">Add to cart</button>';
								}
								echo '</form>';
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
