<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HamroGym | Member View</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script type="text/javascript" src="../../js/script.js"></script>
    <style>
        .data-table {
            background: var(--white);
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
        }

        .data-table th {
            background: var(--primary-color);
            color: var(--white);
            padding: 12px 16px;
            text-align: left;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .data-table th:first-child {
            border-top-left-radius: 8px;
        }

        .data-table th:last-child {
            border-top-right-radius: 8px;
        }

        .data-table td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--gray-200);
            font-size: 0.95rem;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:hover {
            background-color: var(--gray-50);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 4px;
            border: none;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 80px;
        }

        .btn-view {
            background: var(--primary-color);
            color: var(--white);
        }

        .btn-edit {
            background: var(--success-color);
            color: var(--white);
        }

        .btn-delete {
            background: var(--error-color);
            color: var(--white);
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        @media (max-width: 1024px) {
            .data-table {
                display: block;
                overflow-x: auto;
            }

            .action-buttons {
                flex-direction: column;
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

            <div class="content-card">
                <div class="card-header">
                    <h2>Member Management</h2>
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
                                <th>Actions</th>
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
                                                <div class='action-buttons'>
                                                    <form action='read_member.php' method='post'>
                                                        <input type='hidden' name='name' value='" . $uid . "'/>
                                                        <button type='submit' class='btn btn-view'>View</button>
                                                    </form>
                                                    <form action='edit_member.php' method='post'>
                                                        <input type='hidden' name='name' value='" . $uid . "'/>
                                                        <button type='submit' class='btn btn-edit'>Edit</button>
                                                    </form>
                                                    <form action='del_member.php' method='post' onsubmit='return confirmDelete()'>
                                                        <input type='hidden' name='name' value='" . $uid . "'/>
                                                        <button type='submit' class='btn btn-delete'>Delete</button>
                                                    </form>
                                                </div>
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

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this member?");
        }
    </script>
</body>
</html>





