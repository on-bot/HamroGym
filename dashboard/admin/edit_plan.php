<?php
require '../../include/db_conn.php';
page_protect();

// Fetch plan data first
$id = $_GET['id'];
$sql = "SELECT * FROM plan WHERE pid='$id'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>HamroGym | Update Plan</title>
	<link rel="stylesheet" href="../../css/style.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<script type="text/javascript" src="../../js/script.js"></script>
	<style>
		.input-group input[readonly] {
			background-color: var(--gray-50);
			cursor: not-allowed;
		}
	</style>
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
					Log Out
				</a>
			</header>

			<div class="content-card">
				<div class="card-header">
					<h2>Update Plan</h2>
				</div>

				<form class="registration-form" method="post" action="updateplan.php">
					<div class="form-grid">
						<div class="form-group">
							<label for="planID">Plan ID</label>
							<div class="input-group">
								<input type="text" name="planid" id="planID" readonly
									value="<?php echo htmlspecialchars($row['pid']); ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="planName">Plan Name</label>
							<div class="input-group">
								<input type="text" name="planname" id="planName" required
									value="<?php echo htmlspecialchars($row['planName']); ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="planDesc">Plan Description</label>
							<div class="input-group">
								<input type="text" name="desc" id="planDesc" required
									value="<?php echo htmlspecialchars($row['description']); ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="planVal">Plan Validity (months)</label>
							<div class="input-group">
								<input type="number" name="planval" id="planVal" required
									value="<?php echo htmlspecialchars($row['validity']); ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="planAmnt">Plan Amount</label>
							<div class="input-group">
								<input type="text" name="amount" id="planAmnt" required
									value="<?php echo htmlspecialchars($row['amount']); ?>">
							</div>
						</div>
					</div>

					<div class="button-group">
						<button type="submit" name="submit" class="btn-primary">
							Update Plan
						</button>
						<button type="reset" class="btn-secondary">
							Reset
						</button>
					</div>
				</form>
			</div>
		</main>
	</div>

</body>

</html>