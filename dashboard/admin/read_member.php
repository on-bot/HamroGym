		<?php
		require '../../include/db_conn.php';
		page_protect();
		?>


		<!DOCTYPE html>
		<html lang="en">

		<head>
			<title>HamroGym | Member History</title>
			<link rel="stylesheet" href="../../css/style.css">
			<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
			<script type="text/javascript" src="../../js/script.js"></script>
			<style>
				.member-info {
					background: var(--white);
					padding: 24px;
					border-radius: 8px;
					box-shadow: var(--shadow-sm);
					margin-bottom: 24px;
				}

				.member-details,
				.payment-history {
					background: var(--white);
					border-radius: 8px;
					box-shadow: var(--shadow-sm);
					margin-bottom: 32px;
					overflow: hidden;
				}

				.section-title {
					background: var(--primary-color);
					color: var(--white);
					padding: 16px 24px;
					margin: 0;
					font-size: 1.1rem;
				}

				.data-table {
					width: 100%;
					border-collapse: separate;
					border-spacing: 0;
				}

				.data-table th {
					background: var(--gray-100);
					padding: 12px 16px;
					text-align: left;
					color: var(--text-color);
					font-weight: 500;
					border-bottom: 2px solid var(--gray-200);
				}

				.data-table td {
					padding: 12px 16px;
					border-bottom: 1px solid var(--gray-200);
				}

				.data-table tr:last-child td {
					border-bottom: none;
				}

				.data-table tr:hover {
					background: var(--gray-50);
				}

				.btn-memo {
					background: var(--primary-color);
					color: var(--white);
					padding: 6px 16px;
					border-radius: 4px;
					text-decoration: none;
					display: inline-block;
					font-size: 0.9rem;
					transition: all 0.2s ease;
				}

				.btn-memo:hover {
					background: var(--primary-dark);
					transform: translateY(-1px);
				}

				@media (max-width: 768px) {
					.data-table {
						display: block;
						overflow-x: auto;
					}

					.member-info,
					.member-details,
					.payment-history {
						margin: 16px;
					}
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
							<i class="fas fa-sign-out-alt"></i> Log Out
						</a>
					</header>

					<?php
					$id = $_POST['name'];
					$query = "select * from users WHERE userid='$id'";
					$result = mysqli_query($con, $query);

					if (mysqli_affected_rows($con) != 0) {
						while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							$name = $row['username'];
							$memid = $row['userid'];
							$gender = $row['gender'];
							$mobile = $row['mobile'];
							$email = $row['email'];
							$joinon = $row['joining_date'];
						}
					}
					?>

					<div class="member-details">
						<h3 class="section-title">Member Details</h3>
						<table class="data-table">
							<thead>
								<tr>
									<th>Membership ID</th>
									<th>Name</th>
									<th>Gender</th>
									<th>Mobile</th>
									<th>Email</th>
									<th>Join Date</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $memid; ?></td>
									<td><?php echo $name; ?></td>
									<td><?php echo $gender; ?></td>
									<td><?php echo $mobile; ?></td>
									<td><?php echo $email; ?></td>
									<td><?php echo $joinon; ?></td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="payment-history">
						<h3 class="section-title">Payment History</h3>
						<table class="data-table">
							<thead>
								<tr>
									<th>Sl.No</th>
									<th>Plan Name</th>
									<th>Plan Description</th>
									<th>Validity</th>
									<th>Amount</th>
									<th>Payment Date</th>
									<th>Expire Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query1 = "select * from enrolls_to WHERE uid='$memid'";
								$result = mysqli_query($con, $query1);
								$sno = 1;

								if (mysqli_affected_rows($con) != 0) {
									while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
										$pid = $row['pid'];
										$query2 = "select * from plan where pid='$pid'";
										$result2 = mysqli_query($con, $query2);
										if ($result2) {
											$row1 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
											echo "<tr>";
											echo "<td>" . $sno . "</td>";
											echo "<td>" . $row1['planName'] . "</td>";
											echo "<td>" . $row1['description'] . "</td>";
											echo "<td>" . $row1['validity'] . "</td>";
											echo "<td>" . $row1['amount'] . "</td>";
											echo "<td>" . $row['paid_date'] . "</td>";
											echo "<td>" . $row['expire'] . "</td>";
											echo "<td><a href='gen_invoice.php?id=" . $row['uid'] . "&pid=" . $row['pid'] . "&etid=" . $row['et_id'] . "' class='btn-memo'>Memo</a></td>";
											echo "</tr>";
											$sno++;
										}
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</main>
			</div>
		</body>

		</html>