<?php
require '../../include/db_conn.php';
page_protect();

$uid = 0;
$uname = 0;
$udob = 0;
$ujoin = 0;
$ugender = 0;
$cal = "";
$hei = "";
$wei = "";
$fa = "";
$remar = "";

if (isset($_POST['submit'])) {
	$calorie = $_POST['calorie'];
	$height = $_POST['height'];
	$weight = $_POST['weight'];
	$fat = $_POST['fat'];
	$remarks = $_POST['remarks'];
	$userid = $_POST['usrid'];

	$query = "update health_status set calorie='" . $calorie . "', height='" . $height . "',weight='" . $weight . "',fat='" . $fat . "',remarks='" . $remarks . "' where uid='" . $userid . "'";

	if (mysqli_query($con, $query)) {
		echo "<head><script>alert('Health Status Added ');</script></head></html>";
		echo "<meta http-equiv='refresh' content='0; url=new_health_status.php'>";
	} else {
		echo "<head><script>alert('NOT SUCCESSFUL, Check Again');</script></head></html>";
		echo "error" . mysqli_error($con);
		echo "<meta http-equiv='refresh' content='0; url=new_health_status.php'>";
	}
} else {
	$uid = $_POST['uid'];
	$uname = $_POST['uname'];
	$udob = $_POST['udob'];
	$ujoin = $_POST['ujoin'];
	$ugender = $_POST['ugender'];

	$sql = "select * from health_status where uid='" . $uid . "'";
	$result = mysqli_query($con, $sql);
	if ($result) {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$cal = $row['calorie'];
		$hei = $row['height'];
		$wei = $row['weight'];
		$fa = $row['fat'];
		$remar = $row['remarks'];
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HamroGym | Health Entry</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script type="text/javascript" src="../../js/script.js"></script>
    <style>
        .health-form {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            padding: 24px;
            max-width: 800px;
            margin: 24px auto;
        }

        .form-header {
            background: var(--primary-color);
            color: var(--white);
            padding: 16px 24px;
            border-radius: 8px 8px 0 0;
            margin: -24px -24px 24px -24px;
            text-align: center;
        }

        .form-header h2 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 500;
        }

        .form-content {
            padding: 0 24px;
        }

        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
            gap: 24px;
        }

        .form-label {
            flex: 0 0 140px;
            font-weight: 500;
            color: var(--text-color);
            text-align: right;
        }

        .form-field {
            flex: 1;
            max-width: 300px;
        }

        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--gray-300);
            border-radius: 6px;
            font-size: 0.95rem;
            background: var(--white);
        }

        .form-control[readonly] {
            background: var(--gray-50);
            cursor: not-allowed;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: var(--shadow-sm);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid var(--gray-200);
        }

        .btn {
            padding: 8px 24px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--primary-color);
            color: var(--white);
            border: none;
        }

        .btn-secondary {
            background: var(--white);
            color: var(--text-color);
            border: 1px solid var(--gray-300);
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        @media (max-width: 768px) {
            .health-form {
                margin: 16px;
                padding: 16px;
            }

            .form-row {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
            }

            .form-label {
                flex: none;
                text-align: left;
            }

            .form-field {
                max-width: none;
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

            <div class="health-form">
                <div class="form-header">
                    <h2>Edit Health Status</h2>
                </div>
                <form action="" method="post">
                    <div class="form-content">
                        <div class="form-row">
                            <div class="form-label">Membership ID</div>
                            <div class="form-field">
                                <input type="text" class="form-control" readonly name="usrid" value="<?php echo $uid; ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-label">User Name</div>
                            <div class="form-field">
                                <input type="text" class="form-control" readonly value="<?php echo $uname; ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-label">Date of Birth</div>
                            <div class="form-field">
                                <input type="text" class="form-control" readonly value="<?php echo $udob; ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-label">Gender</div>
                            <div class="form-field">
                                <input type="text" class="form-control" readonly value="<?php echo $ugender; ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-label">Joining Date</div>
                            <div class="form-field">
                                <input type="text" class="form-control" readonly value="<?php echo $ujoin; ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-label">Calorie</div>
                            <div class="form-field">
                                <input type="text" class="form-control" name="calorie" value="<?php echo $cal; ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-label">Height</div>
                            <div class="form-field">
                                <input type="text" class="form-control" name="height" value="<?php echo $hei; ?>" placeholder="Enter Height in cm">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-label">Weight</div>
                            <div class="form-field">
                                <input type="text" class="form-control" name="weight" value="<?php echo $wei; ?>" placeholder="Enter Weight in kg">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-label">Fat</div>
                            <div class="form-field">
                                <input type="text" class="form-control" name="fat" value="<?php echo $fa; ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-label">Remarks</div>
                            <div class="form-field">
                                <textarea class="form-control" name="remarks" placeholder="Remarks not more than 200 characters"><?php echo $remar; ?></textarea>
                            </div>
                        </div>

                        <div class="button-group">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>