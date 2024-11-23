<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>HamroGym | Create Routine</title>
  <link rel="stylesheet" href="../../css/style.css">
  <script type="text/javascript" src="../../js/Script.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <style>
    /* Additional styles specific to routine form */
    .routine-form textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid var(--gray-300);
      border-radius: 8px;
      font-size: 0.95rem;
      transition: all 0.2s ease;
      background: var(--white);
      resize: none;
      height: 80px;
    }

    .routine-form textarea:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: var(--shadow-sm);
    }

    .routine-heading {
      color: var(--text-color);
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
    }
  </style>
</head>

<body class="page-body">
  <div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="logo-container">
        <img src="../../images/logo.png" alt="HamroGym Logo" class="logo">
      </div>
      <?php include('nav.php'); ?>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Top Header -->
      <div class="top-header">
        <h3>Create Routine</h3>
        <div class="user-nav">
          <span>Welcome <?php echo $_SESSION['full_name']; ?></span>
          <a href="logout.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Log Out
          </a>
        </div>
      </div>

      <!-- Routine Form Card -->
      <div class="content-card">
        <div class="card-header">
          <h2>New Routine</h2>
        </div>

        <form class="routine-form" method="post" action="saveroutine.php">
          <div class="form-grid">
            <div class="form-group">
              <label>Routine Name</label>
              <div class="input-group">
                <input type="text" name="rname" required placeholder="Enter routine name">
              </div>
            </div>
          </div>

          <div class="form-grid">
            <!-- Day inputs -->
            <?php for ($i = 1; $i <= 6; $i++) { ?>
              <div class="form-group">
                <label>Day <?php echo $i; ?></label>
                <textarea
                  name="day<?php echo $i; ?>"
                  placeholder="Enter exercises for Day <?php echo $i; ?>"></textarea>
              </div>
            <?php } ?>
          </div>

          <div class="button-group">
            <button type="submit" name="submit" class="btn-primary">
              Add Routine
            </button>
            <button type="reset" class="btn-secondary">
              Reset
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php include('footer.php'); ?>
</body>

</html>