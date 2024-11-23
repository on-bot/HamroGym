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
        .routine-form {
            max-width: 800px;
            margin: 0 auto;
        }

        .routine-form .form-group {
            display: flex;
            align-items: flex-start;
            margin-bottom: 24px;
            gap: 20px;
        }

        .routine-form label {
            min-width: 120px;
            padding-top: 12px;
        }

        .routine-form textarea {
            flex: 1;
            min-height: 80px;
            padding: 12px;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            resize: vertical;
        }

        .routine-form textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: var(--shadow-sm);
        }

        .print-btn {
            margin-left: 12px;
        }

        .nav-menu .routine-menu > a {
            background: var(--gray-100);
            color: var(--primary-color);
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

            <!-- Content Card -->
            <div class="content-card">
                <div class="card-header">
                    <h3>Edit Routine</h3>
                </div>

                <form id="form1" method="post" action="updateroutine.php" class="routine-form">
                    <input type="hidden" name="tid" value="<?php echo $id ?>">

                    <div class="form-group">
                        <label>Routine Name</label>
                        <input type="text" name="routinename" value="<?php echo $row['tname'] ?>" 
                               class="input-group input" required>
                    </div>

                    <?php
                    $days = ['day1', 'day2', 'day3', 'day4', 'day5', 'day6'];
                    foreach($days as $index => $day) {
                        echo '<div class="form-group">
                            <label>Day '.($index + 1).'</label>
                            <textarea name="'.$day.'" required>'.$row[$day].'</textarea>
                        </div>';
                    }
                    ?>

                    <div class="button-group">
                        <button type="submit" name="submit" class="btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <button type="reset" class="btn-secondary">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="button" onclick="myFunction()" class="btn-secondary print-btn">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function myFunction() {
        var prt = document.getElementById("form1");
        var WinPrint = window.open('','','left=0,top=0,width=800,height=900,tollbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prt.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    }
    </script>

    <?php include('footer.php'); ?>
</body>
</html>


										

