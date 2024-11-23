<?php
require '../../include/db_conn.php';
page_protect();

if (isset($_POST['submit'])) {
	$usrname = $_POST['login_id'];
	$fulname = $_POST['full_name'];

	$query = "UPDATE admin SET username='" . $usrname . "', Full_name='" . $fulname . "' WHERE username='" . $_SESSION['full_name'] . "'";

	if (mysqli_query($con, $query)) {
		echo "<head><script>alert('Profile Updated Successfully');</script></head></html>";
		echo "<meta http-equiv='refresh' content='0; url=logout.php'>";
	} else {
		echo "<head><script>alert('Update Failed, Please Check Again');</script></head></html>";
		echo "error" . mysqli_error($con);
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>HamroGym | Admin Profile</title>
	<link rel="stylesheet" href="../../css/style.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<script type="text/javascript" src="../../js/script.js"></script>
</head>

<body>
	<div class="dashboard-container">
		<aside class="sidebar">
			<div class="logo-container">
				<img src="../../images/logo.png" alt="HamroGym Logo" class="logo">
			</div>
			<?php include('nav.php'); ?>
		</aside>

		<main class="main-content">
			<header class="top-header">
				<div class="welcome-text">
					Welcome <?php echo $_SESSION['full_name']; ?>
				</div>
				<a href="logout.php" class="logout-btn">
					<i class="fas fa-sign-out-alt"></i> Log Out
				</a>
			</header>

			<div class="content-card">
				<div class="card-header">
					<h2>Edit Profile</h2>
					<p class="text-light" style="color: var(--text-light);">
						(You will be required to Login Again After Profile Update)
					</p>
				</div>

				<form class="registration-form" method="post" action="">
					<div class="form-grid">
						<div class="form-group">
							<label for="login_id">ID</label>
							<div class="input-group">

								<input type="text"
									name="login_id"
									id="login_id"
									value="<?php echo $_SESSION['user_data']; ?>"
									required>
							</div>
						</div>

						<div class="form-group">
							<label for="full_name">Full Name</label>
							<div class="input-group">
								<input type="text"
									name="full_name"
									id="full_name"
									value="<?php echo $_SESSION['username']; ?>"
									maxlength="25"
									required>
							</div>
						</div>

						<div class="form-group">
							<label for="password">Password</label>
							<div class="input-group" style="display: flex; justify-content: space-between; align-items: center;">
								<div style="flex-grow: 1; margin-right: 16px;">
									<input type="text"
										value="*********"
										readonly
										style="background: var(--gray-50);">
								</div>
								<a href="change_pwd.php" class="btn-primary">
									Change Password
								</a>
							</div>
							<span style="color: var(--text-light); font-size: 0.9rem;">
								*For security reasons hidden
							</span>
						</div>
					</div>

					<div class="button-group">
						<button type="submit" name="submit" class="btn-primary">
							Update Profile
						</button>
						<button type="reset" class="btn-secondary">
							Reset
						</button>
					</div>
				</form>
			</div>
		</main>
	</div>

	<?php include('footer.php'); ?>
</body>

</html>