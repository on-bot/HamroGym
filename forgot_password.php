<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HamroGym | Change Password</title>
    <link rel="stylesheet" href="./css/style.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <div class="login-header">
                <img src="./images/logo.png" alt="HamroGym Logo" class="logo"/>
                <p class="welcome-text">Change Your Password</p>
            </div>
            
            <form action="change_s_pwd.php" method="POST" class="login-form">
                <div class="form-group">
                    <div class="input-group">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="login_id" placeholder="Your Login ID" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <i class="fa-solid fa-key"></i>
                        <input type="text" name="login_key" placeholder="Your Secret Key" required >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="pwfield" id="pwfield" placeholder="New Password" required >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="confirmfield" id="confirmfield" placeholder="Confirm New Password" required>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" name="btnLogin" class="login-button">
                        Change Password <i class="fa-solid fa-check"></i>
                    </button>
                    <a href="./index.php" class="cancel-button">
                        Cancel <i class="fa-solid fa-times"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>