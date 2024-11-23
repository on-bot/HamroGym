<?php
require '../../include/db_conn.php';
page_protect();
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HamroGym | View Routine</title>
    <link rel="stylesheet" href="../../css/style.css">
	<script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .nav-menu .routine-menu > a {
            background: var(--gray-100);
            color: var(--primary-color);
        }

        .view-details-btn {
            min-width: 120px;
            text-align: center;
        }
    </style>
</head>

<body class="page-body">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo-container">
                <a href="main.php">
                    <img src="../../images/logo.png" alt="HamroGym Logo" class="logo">
                </a>
            </div>
            <?php include('nav.php'); ?>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="top-header">
                <h2>Routines</h2>
                <div class="user-nav">
                    <span>Welcome <?php echo $_SESSION['full_name']; ?></span>
                    <a href="logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Log Out
                    </a>
                </div>
            </div>

            <!-- Content Card -->
            <div class="content-card">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Routine Name</th>
                                <th>Routine Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query  = "select * from timetable";
                            $result = mysqli_query($con, $query);
                            $sno    = 1;

                            if (mysqli_affected_rows($con) != 0) {
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>".$sno."</td>";
                                    echo "<td>" . $row['tname'] . "</td>";
                                    echo '<td>
                                        <a href="viewdetailroutine.php?id='.$row['tid'].'" 
                                           class="btn-primary view-details-btn">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                    </td>';
                                    echo "</tr>";
                                    $sno++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>

										
