<?php
	require("header.php");
?>

	<form action="includes/signup_inc.php" method="post">
		<div class="container">
			<label for="name"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="name" required>
			<label for="email"><b>Email</b></label>
			<input type="email" placeholder="Enter Email" name="email" required>
			<label for="passwd"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="passwd" required>
			<input type="password" placeholder="Confirm Password" name="conpass" required>
			<button type="submit" name="submit" class="createAcc">Create account</button>
			<div class="line">
				<span>or</span>
			</div>
			<div class="create">
				<a href="login.php">Login</a>
			</div>
		</div>
	</form>

<?php
	require("footer.php");
?>
