<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HamroGym | View Plan</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script type="text/javascript" src="../../js/script.js"></script>
    <style>
        .action-cell {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        
        .action-cell form {
            margin: 0;
        }
        
        .orange-btn {
            background: #e74c3c;
            color: var(--white);
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .orange-btn:hover {
            background: #d44637;
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
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

            <div class="content-card">
                <div class="card-header">
                    <h2>Manage Plans</h2>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Plan ID</th>
                                <th>Plan Name</th>
                                <th>Plan Details</th>
                                <th>Months</th>s
                                <th>Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query  = "select * from plan where active='yes' ORDER BY amount DESC";
                            $result = mysqli_query($con, $query);
                            $sno    = 1;
                            
                            if (mysqli_affected_rows($con) != 0) {
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $msgid = $row['pid'];
                                    
                                    echo "<tr>";
                                    echo "<td>" . $sno . "</td>";
                                    echo "<td>" . $row['pid'] . "</td>";
                                    echo "<td>" . $row['planName'] . "</td>";
                                    echo "<td>" . $row['description'] . "</td>";
                                    echo "<td>" . $row['validity'] . "</td>";
                                    echo "<td>Rs " . $row['amount'] . "</td>";
                                    echo "<td class='action-cell'>
                                            <a href='edit_plan.php?id=" . $row['pid'] . "' class='btn-primary'>
                                                <i class='fas fa-edit'></i> Edit
                                            </a>
                                            <form action='del_plan.php' method='post' onSubmit='return ConfirmDelete();'>
                                                <input type='hidden' name='name' value='" . $msgid . "'/>
                                                <button type='submit' class='orange-btn'>
                                                    <i class='fas fa-trash'></i> Delete
                                                </button>
                                            </form>
                                          </td>";
                                    echo "</tr>";
                                    $sno++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        function ConfirmDelete() {
            return confirm("Are you sure you want to delete this plan?");
        }
    </script>
</body>
</html>