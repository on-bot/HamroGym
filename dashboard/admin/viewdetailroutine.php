<?php
require '../../include/db_conn.php';
page_protect();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HamroGym | Detail Routine</title>
    <link rel="stylesheet" href="../../css/style.css">
	<script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .routine-details {
            max-width: 800px;
            margin: 20px auto;
        }

        .routine-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding: 16px;
            background: var(--white);
            border-radius: 8px;
            border: 1px solid var(--gray-200);
        }

        .routine-name {
            font-size: 1.2rem;
            font-weight: 500;
        }

        .routine-logo img {
            max-width: 100px;
            height: auto;
        }

        .day-details {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 16px;
            padding: 16px;
            border: 1px solid var(--gray-200);
            margin-bottom: 8px;
            border-radius: 8px;
            background: var(--white);
        }

        .day-label {
            font-weight: 500;
            color: var(--text-color);
        }

        .day-content {
            color: var(--text-light);
            line-height: 1.6;
        }

        .print-section {
            margin-top: 24px;
            text-align: center;
        }

        @media print {
            .sidebar, .top-header, .print-btn {
                display: none;
            }
            .routine-details {
                margin: 0;
                padding: 20px;
            }
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
                <h2>Routine Detail</h2>
                <div class="user-nav">
                    <span>Welcome <?php echo $_SESSION['full_name']; ?></span>
                    <a href="logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Log Out
                    </a>
                </div>
            </div>

            <?php
            $id = $_GET['id'];
            $sql = "Select * from timetable t Where t.tid=$id";
            $res = mysqli_query($con, $sql);
            if($res){
                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
            }
            ?>

            <!-- Routine Details -->
            <div class="content-card">
                <div id="print" class="routine-details">
                    <div class="routine-header">
                        <div class="routine-name">
                            Routine Name: <?php echo $row['tname']; ?>
                        </div>
                        <div class="routine-logo">
                            <img src="logo.png" alt="HamroGym Logo">
                        </div>
                    </div>

                    <?php
                    $days = [
                        'day1' => 'Day 1',
                        'day2' => 'Day 2',
                        'day3' => 'Day 3',
                        'day4' => 'Day 4',
                        'day5' => 'Day 5',
                        'day6' => 'Day 6'
                    ];

                    foreach($days as $key => $label) {
                        echo '<div class="day-details">
                            <div class="day-label">'.$label.':</div>
                            <div class="day-content">'.$row[$key].'</div>
                        </div>';
                    }
                    ?>
                </div>

                <div class="print-section">
                    <button onclick="myFunction()" class="btn-primary">
                        <i class="fas fa-print"></i> Print Routine
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function myFunction() {
        var prt = document.getElementById("print");
        var WinPrint = window.open('','','left=0,top=0,width=800,height=900,tollbar=0,scrollbars=0,status=0');
        WinPrint.document.write('<html><head><title>Print Routine</title>');
        WinPrint.document.write('<link rel="stylesheet" href="../../css/style.css">');
        WinPrint.document.write('</head><body>');
        WinPrint.document.write(prt.innerHTML);
        WinPrint.document.write('</body></html>');
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    }
    </script>

    <?php include('footer.php'); ?>
</body>
</html>