<?php
	require("header.php");
?>
	<?php
		if (isset($_GET['error'])) {
			echo '<div class="container">
					<div class="error">';
			if ($_GET['error'] == "userexists")
				echo '<p>User already exists!</p>
						<p>Try logging in instead.</p>';
			else if ($_GET['error'] == "wrongpwd")
				echo '<p>Password incorrect!</p>
						<p>Try again.</p>';
			else if ($_GET['error'] == "nouser")
				echo '<p>No user found!</p>
						<p>Try again.</p>';
			echo '</div>
				</div>';
		}
	?>
	<form action="includes/login_inc.php" method="post">
		<div class="container">
			<label for="name"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="name" value="<?=$_GET['username']?>" required>
			<label for="passwd"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="passwd" required>
			<button type="submit" name="submit" class="createAcc">Login</button>
			<div class="line">
				<span>or</span>
			</div>
			<div class="create">
				<a href="signup.php">Create an account</a>
			</div>
		</div>
	</form>

<?php
	require("footer.php");
?>
