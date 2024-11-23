<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HamroGym | Payments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/dashMain.css">
    <script type="text/javascript" src="../../js/Script.js"></script>
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
                    <h2>Payments Due</h2>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Expiry Date</th>
                                <th>Name</th>
                                <th>Member ID</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM enrolls_to WHERE renewal='yes' ORDER BY expire";
                            $result = mysqli_query($con, $query);
                            $sno = 1;

                            if (mysqli_affected_rows($con) != 0) {
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $uid = $row['uid'];
                                    $planid = $row['pid'];
                                    $query1 = "SELECT * FROM users WHERE userid='$uid'";
                                    $result1 = mysqli_query($con, $query1);
                                    
                                    if (mysqli_affected_rows($con) == 1) {
                                        while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $sno++; ?></td>
                                                <td><?php echo $row['expire']; ?></td>
                                                <td><?php echo $row1['username']; ?></td>
                                                <td><?php echo $row1['userid']; ?></td>
                                                <td><?php echo $row1['mobile']; ?></td>
                                                <td><?php echo $row1['email']; ?></td>
                                                <td><?php echo $row1['gender']; ?></td>
                                                <td>
                                                    <form action='make_payments.php' method='post'>
                                                        <input type='hidden' name='userID' value='<?php echo $uid; ?>'/>
                                                        <input type='hidden' name='planID' value='<?php echo $planid; ?>'/>
                                                        <button type="submit" class="btn-primary">
                                                            <i class="fas fa-plus"></i> Add Payment
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>