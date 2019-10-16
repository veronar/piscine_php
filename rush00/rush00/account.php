<?php
	require("header.php");
?>

	<div class="container-acc">
		<form action="includes/logout_inc.php" method="post" class="logout">
			<div class="uidInfo">
				<?php echo 'Username: &emsp; '.$_SESSION['uidUser'].'<button type="submit" name="goToUid" class="changebtn">Change</button>';?>
			</div>
			<div class="uidInfo">
				<?php echo 'Email: &emsp; &emsp; &ensp; &nbsp;'.$_SESSION['uidEmail'].'<button type="submit" name="goToEmail" class="changebtn">Change</button>';?>
			</div>
			<div class="uidInfo">
				<?php echo 'Password: &emsp; &ensp;';
				for ($i = 0; $i < strlen($_SESSION['uidPass']); $i++)
					echo '•';
				echo '<button type="submit" name="goToPwd" class="changebtn">Change</button>';
				?>
			</div>
			<div>
				<button type="submit" name="logout">Logout</button>
			</div>
		</form>
	</div>

<?php
	require("footer.php");
?>
