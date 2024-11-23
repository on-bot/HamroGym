<?php

session_start();
if (isset($_SESSION["user_data"])) {
	header("location:./dashboard/admin/");
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>HamroGym | Login</title>
	<link rel="stylesheet" href="./css/style.css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
	<div class="login-wrapper">
		<div class="login-container">
			<div class="login-header">
				<img src="./images/logo.png" alt="HamroGym Logo" class="logo" />
				<p class="welcome-text">Welcome back! Please login to access the admin area</p>
			</div>

			<form action="secure_login.php" method="post" class="login-form">
				<div class="form-group">
					<div class="input-group">
						<i class="fa-solid fa-user"></i>
						<input type="text"
							name="user_id_auth"
							placeholder="User ID"
							required>
					</div>
				</div>

				<div class="form-group">
					<div class="input-group">
						<i class="fa-solid fa-lock"></i>
						<input type="password"
							name="pass_key"
							placeholder="Password"
							required>
					</div>
				</div>

				<button type="submit" name="btnLogin" class="login-button">
					Login <i class="fa-solid fa-right-to-bracket"></i>
				</button>
			</form>

			<a href="forgot_password.php" class="forgot-password">
				Forgot your password?
			</a>
		</div>
	</div>
</body>

</html>

</html>