<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>HamroGym | New Plan</title>
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
					<h2>Create New Plan</h2>
				</div>

				<form class="registration-form" method="post" action="submit_plan_new.php">
					<div class="form-grid">
						<div class="form-group">
							<label for="planID">Plan ID</label>
							<div class="input-group">
								<input type="text" name="planid" id="planID" readonly
									value="<?php echo getRandomWord(); ?>"
									class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label for="planName">Plan Name</label>
							<div class="input-group">
								<input type="text" name="planname" id="planName"
									placeholder="Enter plan name" required>
							</div>
						</div>

						<div class="form-group">
							<label for="planDesc">Plan Description</label>
							<div class="input-group">
								<input type="text" name="desc" id="planDesc"
									placeholder="Enter plan description" required>
							</div>
						</div>

						<div class="form-group">
							<label for="planVal">Plan Validity (months)</label>
							<div class="input-group">
								<input type="number" name="planval" id="planVal"
									placeholder="Enter validity in months" required>
							</div>
						</div>

						<div class="form-group">
							<label for="planAmnt">Plan Amount</label>
							<div class="input-group">
								<input type="text" name="amount" id="planAmnt"
									placeholder="Enter plan amount" required>
							</div>
						</div>
					</div>

					<div class="button-group">
						<button type="submit" name="submit" class="btn-primary">Create Plan
						</button>
						<button type="reset" class="btn-secondary">
							Reset
						</button>
					</div>
				</form>
			</div>
		</main>
	</div>

	<?php
	function getRandomWord($len = 6)
	{
		$word = array_merge(range('A', 'Z'));
		shuffle($word);
		return substr(implode($word), 0, $len);
	}
	?>
</body>

</html>