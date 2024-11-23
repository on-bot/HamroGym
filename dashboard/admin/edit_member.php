<?php
require '../../include/db_conn.php';
page_protect();

if (isset($_POST['name'])) {
	$memid = $_POST['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HamroGym | Edit Member</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script type="text/javascript" src="../../js/script.js"></script>
    <style>
        .edit-form {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            padding: 24px;
            max-width: 800px;
            margin: 0 auto;
        }

        .form-header {
            background: var(--primary-color);
            color: var(--white);
            padding: 16px;
            border-radius: 8px 8px 0 0;
            margin: -24px -24px 24px -24px;
            text-align: center;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
        }

        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--gray-300);
            border-radius: 6px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: var(--shadow-sm);
        }

        .button-group {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .btn {
            padding: 8px 24px;
            border-radius: 6px;
            border: none;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--primary-color);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
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

            <div class="edit-form">
                <div class="form-header">
                    <h2>Edit Member Profile</h2>
                </div>
				<hr />
				<?php

				$query  = "SELECT * FROM users u 
				    		   INNER JOIN address a ON u.userid=a.id
				    		   INNER JOIN  health_status h ON u.userid=h.uid
				    		   WHERE userid='$memid'";
				//echo $query;
				$result = mysqli_query($con, $query);
				$sno    = 1;

				$name = "";
				$gender = "";

				if (mysqli_affected_rows($con) == 1) {
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

						$name    = $row['username'];
						$gender = $row['gender'];
						$mobile = $row['mobile'];
						$email   = $row['email'];
						$dob	 = $row['dob'];
						$jdate    = $row['joining_date'];
						$streetname = $row['streetName'];
						$state = $row['state'];
						$city = $row['city'];
						$zipcode = $row['zipcode'];
						$calorie = $row['calorie'];
						$height = $row['height'];
						$weight = $row['weight'];
						$fat = $row['fat'];
						$remarks = $row['remarks'];
					}
				} else {
					echo "<html><head><script>alert('Change Unsuccessful');</script></head></html>";
					echo mysqli_error($con);
				}


				?>
                <form action="edit_mem_submit.php" method="post">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>User ID</label>
                            <input type="text" class="form-control" name="uid" readonly value="<?php echo $memid; ?>">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="uname" value="<?php echo $name; ?>">
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="gender" required>
                                <option value="Male" <?php if($gender == 'Male') echo 'selected'; ?>>Male</option>
                                <option value="Female" <?php if($gender == 'Female') echo 'selected'; ?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="number" class="form-control" name="phone" maxlength="10" value="<?php echo $mobile; ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control" name="dob" value="<?php echo $dob; ?>">
                        </div>
                        <div class="form-group">
                            <label>Joining Date</label>
                            <input type="date" class="form-control" name="jdate" value="<?php echo $jdate; ?>">
                        </div>
                        <div class="form-group">
                            <label>Street Name</label>
                            <input type="text" class="form-control" name="stname" value="<?php echo $streetname; ?>">
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" name="state" value="<?php echo $state; ?>">
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" value="<?php echo $city; ?>">
                        </div>
                        <div class="form-group">
                            <label>Zipcode</label>
                            <input type="text" class="form-control" name="zipcode" value="<?php echo $zipcode; ?>">
                        </div>
                        <div class="form-group">
                            <label>Calorie</label>
                            <input type="text" class="form-control" name="calorie" value="<?php echo $calorie; ?>">
                        </div>
                        <div class="form-group">
                            <label>Height</label>
                            <input type="text" class="form-control" name="height" value="<?php echo $height; ?>">
                        </div>
                        <div class="form-group">
                            <label>Weight</label>
                            <input type="text" class="form-control" name="weight" value="<?php echo $weight; ?>">
                        </div>
                        <div class="form-group">
                            <label>Fat</label>
                            <input type="text" class="form-control" name="fat" value="<?php echo $fat; ?>">
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label>Remarks</label>
                            <textarea class="form-control" name="remarks" style="min-height: 80px; resize: vertical;"><?php echo $remarks; ?></textarea>
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>

<?php
} else {
}
?>