<?php
require '../../include/db_conn.php';
page_protect();
if (isset($_POST['userID']) && isset($_POST['planID'])) {
	$uid  = $_POST['userID'];
	$planid = $_POST['planID'];
	$query1 = "select * from users WHERE userid='$uid'";

	$result1 = mysqli_query($con, $query1);

	if (mysqli_affected_rows($con) == 1) {
		while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {

			$name = $row1['username'];
			$query2 = "select * from plan where pid='$planid'";

			$result2 = mysqli_query($con, $query2);
			if ($result2) {
				$planValue = mysqli_fetch_array($result2, MYSQLI_ASSOC);
				$planName = $planValue['planName'];
			}
		}
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>HamroGym | Make Payment</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../../css/style.css">
		<link rel="stylesheet" href="../../css/dashMain.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
						<h2>Make Payment</h2>
					</div>

					<form action="submit_payments.php" method="post" class="payment-form">
						<div class="form-grid">
							<div class="form-group">
								<label>Membership ID</label>
								<input type="text" name="m_id" value="<?php echo $uid; ?>" readonly />
							</div>

							<div class="form-group">
								<label>Name</label>
								<input type="text" name="u_name" value="<?php echo $name; ?>" readonly />
							</div>

							<div class="form-group">
								<label>Current Plan</label>
								<input type="text" name="prevPlan" value="<?php echo $planName; ?>" readonly />
							</div>

							<div class="form-group">
								<label>Select New Plan</label>
								<select name="plan" required onchange="myplandetail(this.value)">
									<option value="">-- Please select --</option>
									<?php
									$query = "select * from plan where active='yes'";
									$result = mysqli_query($con, $query);
									if (mysqli_affected_rows($con) != 0) {
										while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
											echo "<option value='" . $row['pid'] . "'>" . $row['planName'] . "</option>";
										}
									}
									?>
								</select>
							</div>
						</div>

						<div id="plandetls" class="plan-details"></div>

						<div class="button-group">
							<button type="submit" class="btn-primary">
								<i class="fas fa-check"></i> Confirm Payment
							</button>
							<button type="reset" class="btn-secondary">
								<i class="fas fa-undo"></i> Reset
							</button>
						</div>
					</form>
				</div>
			</main>
		</div>

		<script>
			function myplandetail(str) {
				if (str == "") {
					document.getElementById("plandetls").innerHTML = "";
					return;
				}

				const xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("plandetls").innerHTML = this.responseText;
					}
				};
				xhr.open("GET", "plandetail.php?q=" + str, true);
				xhr.send();
			}
		</script>
	</body>

	</html>

<?php
} else {
}
?>