<?php
require '../../include/db_conn.php';
page_protect();

if (isset($_POST['name'])) {
    $memid = $_POST['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HamroGym | View Member Details</title>
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
                    <h2>Member Details</h2>
                </div>
				<hr />

			<?php
	    
				    $query  = "SELECT * FROM users u 
				    		   INNER JOIN address a ON u.userid=a.id
				    		   INNER JOIN  health_status h ON u.userid=h.uid
				    		   INNER JOIN enrolls_to e on u.userid=e.uid
				    		   INNER JOIN plan p on e.pid=p.pid
				    		   WHERE userid='$memid' and e.renewal='yes'";
				    //echo $query;
				    $result = mysqli_query($con, $query);
				    $sno    = 1;
				    
				    $name="";
				    $gender="";

				    if (mysqli_affected_rows($con) == 1) {
				        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				    
				            $name    = $row['username'];
				            $gender =$row['gender'];
				            $mobile = $row['mobile'];
				            $email   = $row['email'];
				            $dob	 = $row['dob'];         
				            $jdate    = $row['joining_date'];
				          	$streetname=$row['streetName'];
				          	$state=$row['state'];
				          	$city=$row['city'];  
				          	$zipcode=$row['zipcode'];
				            $calorie=$row['calorie'];
				            $height=$row['height'];
				            $weight=$row['weight'];
				            $fat=$row['fat'];
				            $planname=$row['planName'];
				            $pamount=$row['amount'];
				            $pvalidity=$row['validity'];
				            $pdescription=$row['description'];
				            $paiddate=$row['paid_date'];
				            $expire=$row['expire'];
				            $remarks=$row['remarks'];

				        }
				    }
				    else{
				    	 echo "<html><head><script>alert('Change Unsuccessful');</script></head></html>";
				    	 echo mysqli_error($con);
				    }


				?>
                
                <div class="registration-container">
                    <form action="edit_member.php" method="post" class="registration-form">
                        <div class="form-grid">
                            <div class="form-group">
                                <label>User ID</label>
                                <input type="text" name="name" readonly required value="<?php echo $memid ?>">
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" readonly value="<?php echo $name ?>">
                            </div>

                            <div class="form-group">
                                <label>Gender</label>
                                <input type="text" readonly value="<?php echo $gender ?>">
                            </div>

                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" readonly value="<?php echo $mobile ?>">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" readonly value="<?php echo $email ?>">
                            </div>

                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="text" readonly value="<?php echo $dob ?>">
                            </div>

                            <div class="form-group">
                                <label>Joining Date</label>
                                <input type="text" readonly value="<?php echo $jdate ?>">
                            </div>

                            <div class="form-group">
                                <label>Street Name</label>
                                <input type="text" readonly value="<?php echo $streetname ?>">
                            </div>

                            <div class="form-group">
                                <label>State</label>
                                <input type="text" readonly value="<?php echo $state ?>">
                            </div>

                            <div class="form-group">
                                <label>City</label>
                                <input type="text" readonly value="<?php echo $city ?>">
                            </div>

                            <div class="form-group">
                                <label>Zipcode</label>
                                <input type="text" readonly value="<?php echo $zipcode ?>">
                            </div>

                            <div class="form-group">
                                <label>Calorie</label>
                                <input type="text" readonly value="<?php echo $calorie ?>">
                            </div>

                            <div class="form-group">
                                <label>Height</label>
                                <input type="text" readonly value="<?php echo $height ?>">
                            </div>

                            <div class="form-group">
                                <label>Weight</label>
                                <input type="text" readonly value="<?php echo $weight ?>">
                            </div>

                            <div class="form-group">
                                <label>Fat</label>
                                <input type="text" readonly value="<?php echo $weight ?>">
                            </div>

                            <div class="form-group">
                                <label>Plan Name</label>
                                <input type="text" readonly value="<?php echo $planname ?>">
                            </div>

                            <div class="form-group">
                                <label>Plan Amount</label>
                                <input type="text" readonly value="<?php echo $pamount ?>">
                            </div>

                            <div class="form-group">
                                <label>Plan Validity</label>
                                <input type="text" readonly value="<?php echo $pvalidity.' Month' ?>">
                            </div>

                            <div class="form-group">
                                <label>Plan Description</label>
                                <input type="text" readonly value="<?php echo $pdescription ?>">
                            </div>

                            <div class="form-group">
                                <label>Paid Date</label>
                                <input type="text" readonly value="<?php echo $paiddate ?>">
                            </div>

                            <div class="form-group">
                                <label>Expired Date</label>
                                <input type="text" readonly value="<?php echo $expire ?>">
                            </div>

                            <div class="form-group" style="grid-column: span 2;">
                                <label>Remarks</label>
                                <textarea readonly style="resize: none;"><?php echo $remarks ?></textarea>
                            </div>
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn-primary" name="submit">Edit</button>
                            <a href="table_view" class="btn-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

<?php
} else {
    
}
?>
