<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HamroGym | Change Password</title>
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
                    <h2>Change Password</h2>
                </div>

                <form class="registration-form" method="POST" action="change_s_pwd.php" enctype="multipart/form-data">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="login_id">ID</label>
                            <div class="input-group">

                                <input type="text" 
                                    name="login_id" 
                                    id="login_id" 
                                    readonly 
                                    value="<?php echo $_SESSION['user_data']; ?>" 
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="login_key">Login Key</label>
                            <div class="input-group">
                                <input type="text" 
                                    name="login_key" 
                                    id="login_key" 
                                    placeholder="Your secret key" 
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pwfield">New Password</label>
                            <div class="input-group">

                                <input type="password" 
                                    name="pwfield" 
                                    id="pwfield" 
                                    placeholder="Enter new password" 
                                    minlength="6" 
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirmfield">Confirm Password</label>
                            <div class="input-group">

                                <input type="password" 
                                    name="confirmfield" 
                                    id="confirmfield" 
                                    placeholder="Confirm new password" 
                                    minlength="6" 
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="submit" name="submit" class="btn-primary">
Change Password
                        </button>
                        <button type="reset" class="btn-secondary">
Reset
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <?php include('footer.php'); ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const password = document.getElementById('pwfield');
        const confirm = document.getElementById('confirmfield');

        form.addEventListener('submit', function(event) {
            if (password.value !== confirm.value) {
                event.preventDefault();
                alert('Passwords do not match!');
            }
        });
    });
    </script>
</body>
</html>