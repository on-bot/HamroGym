﻿<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HamroGym | Income per Month</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script type="text/javascript" src="../../js/script.js"></script>
    <style>
        .filter-form {
            display: flex;
            gap: 16px;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .filter-form select {
            padding: 12px;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            font-size: 0.95rem;
            min-width: 200px;
            background: var(--white);
        }
        
        .filter-form select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: var(--shadow-sm);
        }
        
        #memmonth {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.95rem;
        }
        
        #memmonth th, #memmonth td {
            padding: 16px;
            border-bottom: 1px solid var(--gray-200);
            text-align: left;
        }
        
        #memmonth th {
            background: var(--gray-50);
            font-weight: 500;
            color: var(--text-light);
        }
        
        #memmonth tr:hover {
            background-color: var(--gray-50);
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
                    <h2>Income Per Month</h2>
                </div>

                <form class="filter-form">
                    <?php
                    // Set start and end year range
                    $yearArray = range(2000, date('Y'));
                    ?>
                    <div class="input-group">
                        <select name="year" id="syear">
                            <option value="0">Select Year</option>
                            <?php
                            foreach ($yearArray as $year) {
                                $selected = ($year == date('Y')) ? 'selected' : '';
                                echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <?php
                    // Set the month array
                    $formattedMonthArray = array(
                        "01" => "January", "02" => "February", "03" => "March", "04" => "April",
                        "05" => "May", "06" => "June", "07" => "July", "08" => "August",
                        "09" => "September", "10" => "October", "11" => "November", "12" => "December",
                    );
                    ?>
                    <div class="input-group">
                        <select name="month" id="smonth">
                            <option value="0">Select Month</option>
                            <?php
                            foreach ($formattedMonthArray as $month) {
                                $mm = implode(array_keys($formattedMonthArray, $month));
                                $selected = ($mm == date('m')) ? 'selected' : '';
                                echo '<option '.$selected.' value="'.$mm.'">'.$month.'</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button type="button" class="btn-primary" onclick="showMember();">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>

                <div class="table-responsive">
                    <table id="memmonth"></table>
                </div>
            </div>
        </main>
    </div>

    <script>
    function showMember() {
        var year = document.getElementById("syear");
        var month = document.getElementById("smonth");
        var iyear = year.selectedIndex;
        var imonth = month.selectedIndex;
        var mnumber = month.options[imonth].value;
        var ynumber = year.options[iyear].value;
        
        if(mnumber == "0" || ynumber == "0") {
            document.getElementById("memmonth").innerHTML = "";
            return;
        }
        
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                document.getElementById("memmonth").innerHTML = this.responseText;
            }
        };
        xhr.open("GET", "income_month.php?mm=" + mnumber + "&yy=" + ynumber + "&flag=0", true);
        xhr.send();
    }

    // Initial load
    window.onload = function() {
        collapseSidebar();
        showMember();
    };
    </script>

    <?php include('footer.php'); ?>
</body>
</html>