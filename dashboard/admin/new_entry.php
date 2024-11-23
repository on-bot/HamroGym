<?php
require '../../include/db_conn.php';
page_protect();
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>HamroGym | New User</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="stylesheet" href="../../css/dashMain.css">
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

			<div class="registration-container">
				<h2>New Registration</h2>
				<form action="new_submit.php" method="post" class="registration-form">
					<div class="form-grid">
						<div class="form-group">
							<label>Membership ID:</label>
							<input type="text" name="m_id" value="<?php echo time(); ?>" readonly required>
						</div>

						<div class="form-group">
							<label>Name:</label>
							<input type="text" name="u_name" required>
						</div>

						<div class="form-group">
							<label>Street Name:</label>
							<input type="text" name="street_name" required>
						</div>

						<div class="form-group">
							<label>City:</label>
							<input type="text" name="city" required>
						</div>

						<div class="form-group">
							<label>Zipcode:</label>
							<input type="number" name="zipcode" maxlength="6" required>
						</div>

						<div class="form-group">
							<label>State:</label>
							<input type="text" name="state" required>
						</div>

						<div class="form-group">
							<label>Gender:</label>
							<select name="gender" required>
								<option value="">--Please Select--</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								<option value="Others">Others</option>
							</select>
						</div>

						<div class="form-group">
							<label>Date of Birth:</label>
							<input type="date" name="dob" required>
						</div>

						<div class="form-group">
							<label>Phone No:</label>
							<input type="number" name="mobile" maxlength="10" required>
						</div>

						<div class="form-group">
							<label>Email ID:</label>
							<input type="email" name="email" required>
						</div>

						<div class="form-group">
							<label>Joining Date:</label>
							<input type="date" name="jdate" required>
						</div>

						<div class="form-group">
							<label>Plan:</label>
							<select name="plan" required onchange="myplandetail(this.value)">
								<option value="">--Please Select--</option>
								<?php
								$query = "select * from plan where active='yes'";
								$result = mysqli_query($con, $query);
								if (mysqli_affected_rows($con) != 0) {
									while ($row = mysqli_fetch_row($result)) {
										echo "<option value=" . $row[0] . ">" . $row[1] . "</option>";
									}
								}
								?>
							</select>
						</div>
					</div>

					<div id="plandetls"></div>

					<div class="button-group">
						<button type="submit" class="btn-primary">Register</button>
						<button type="reset" class="btn-secondary">Reset</button>
					</div>
				</form>
			</div>
		</main>
	</div>
</body>

</html>