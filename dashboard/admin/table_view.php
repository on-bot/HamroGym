<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HamroGym | View Member</title>
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

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Membership Expiry</th>
                                <th>Member ID</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>E-Mail</th>
                                <th>Gender</th>
                                <th>Joining Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "select * from users ORDER BY joining_date";
                            $result = mysqli_query($con, $query);
                            $sno = 1;

                            if (mysqli_affected_rows($con) != 0) {
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $uid = $row['userid'];
                                    $query1 = "select * from enrolls_to WHERE uid='$uid' AND renewal='yes'";
                                    $result1 = mysqli_query($con, $query1);
                                    if (mysqli_affected_rows($con) == 1) {
                                        while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                                            echo "<tr>";
                                            echo "<td>" . $sno . "</td>";
                                            echo "<td>" . $row1['expire'] . "</td>";
                                            echo "<td>" . $row['userid'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "<td>" . $row['mobile'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['gender'] . "</td>";
                                            echo "<td>" . $row['joining_date'] . "</td>";
                                            echo "<td>
                                                <form action='viewall_detail.php' method='post'>
                                                    <input type='hidden' name='name' value='" . $uid . "'/>
                                                    <button type='submit' class='btn-primary'>
                                                        <i class='fas fa-eye'></i> View Details
                                                    </button>
                                                </form>
                                            </td>";
                                            echo "</tr>";
                                            $sno++;
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

