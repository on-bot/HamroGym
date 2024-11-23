<?php
require '../../include/db_conn.php';
page_protect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>HamroGym | Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="stylesheet" href="../../css/dashMain.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<script type="text/javascript" src="../../js/script.js"></script>
</head>

<body>
	<div class="dashboard-container">
		<aside class="sidebar" id="sidebar">
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

			<div class="dashboard-header">
				<h1>Dashboard Overview</h1>
			</div>

			<div class="stats-grid">
				<a href="revenue_month.php" class="stat-card red">
					<i class="fas fa-money-bill-wave"></i>
					<div class="stat-content">
						<h3>Monthly Revenue</h3>
						<div class="stat-value">
							<?php
							date_default_timezone_set("Asia/Kathmandu");
							$date = date('Y-m');
							$revenue = 0;
							$query = "SELECT p.amount FROM enrolls_to e 
                                    JOIN plan p ON e.pid = p.pid 
                                    WHERE e.paid_date LIKE '$date%'";
							$result = mysqli_query($con, $query);
							while ($row = mysqli_fetch_array($result)) {
								$revenue += $row['amount'];
							}
							echo "Rs " . number_format($revenue);
							?>
						</div>
					</div>
				</a>

				<a href="table_view.php" class="stat-card green">
					<i class="fas fa-users"></i>
					<div class="stat-content">
						<h3>Total Members</h3>
						<div class="stat-value">
							<?php
							$query = "SELECT COUNT(*) as total FROM users";
							$result = mysqli_query($con, $query);
							$row = mysqli_fetch_assoc($result);
							echo number_format($row['total']);
							?>
						</div>
					</div>
				</a>

				<a href="over_members_month.php" class="stat-card blue">
					<i class="fas fa-user-plus"></i>
					<div class="stat-content">
						<h3>New Members This Month</h3>
						<div class="stat-value">
							<?php
							$query = "SELECT COUNT(*) as total FROM users 
                                    WHERE joining_date LIKE '$date%'";
							$result = mysqli_query($con, $query);
							$row = mysqli_fetch_assoc($result);
							echo number_format($row['total']);
							?>
						</div>
					</div>
				</a>

				<a href="view_plan.php" class="stat-card purple">
					<i class="fas fa-clipboard-list"></i>
					<div class="stat-content">
						<h3>Active Plans</h3>
						<div class="stat-value">
							<?php
							$query = "SELECT COUNT(*) as total FROM plan WHERE active='yes'";
							$result = mysqli_query($con, $query);
							$row = mysqli_fetch_assoc($result);
							echo number_format($row['total']);
							?>
						</div>
					</div>
				</a>
			</div>
		</main>
	</div>

	<?php include('footer.php'); ?>
	<script>
		function toggleSidebar() {
			document.getElementById('sidebar').classList.toggle('collapsed');
			document.querySelector('.main-content').classList.toggle('expanded');
		}
	</script>
</body>

</html>