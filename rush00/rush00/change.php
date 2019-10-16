<?php
	require("header.php");
?>

<?php
	if (isset($_GET['error'])) {
		echo '<div class="container">
				<div class="error">';
		if ($_GET['error'] == "wrongold")
			echo '<p>Wrong old '.$_GET['type'].'!</p>
					<p>Enter your '.$_GET['type'].'.</p>';
		else if ($_GET['error'] == "usertaken")
			echo '<p>'.$_GET['type'].' is already taken!</p>
					<p>Try using another '.$_GET['type'].'!</p>';
		echo '</div>
			</div>';
	}
?>

<form action="includes/change_inc.php" method="post">
		<div class="container-change">
			<?php
				if (isset($_GET['type']) && $_GET['type'] != "Password")
					echo '<label for="passwd"><b>New '.$_GET['type'].'</b></label>
					<input type="text" placeholder="Enter New '.$_GET['type'].'" name="new" required>';
				else if ($_GET['type'] == "Password")
					echo '<label for="name"><b>Old '.$_GET['type'].'</b></label>
					<input type="password" placeholder="Enter Old '.$_GET['type'].'" name="old" required>
					<label for="passwd"><b>New '.$_GET['type'].'</b></label>
					<input type="password" placeholder="Enter New '.$_GET['type'].'" name="new" required>';
			?>
			<div class="cancelChange">
				<?php
					if (isset($_GET['type'])) {
						if ($_GET['type'] === "Username") {
							echo '<button type="submit" name="changeUid" class="change">Change</button>';
						} else if ($_GET['type'] === "Email") {
							echo '<button type="submit" name="changeEmail" class="change">Change</button>';
						} else if ($_GET['type'] === "Password") {
							echo '<button type="submit" name="changePwd" class="change">Change</button">';
						}
					}
					?>
				</div>
		</div>
	</form>

<?php
	require("footer.php");
?>
