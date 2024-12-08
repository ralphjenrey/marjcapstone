<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['rid'])) {
  header('location:index.php');
  exit();
}

if (isset($_POST['update'])) {
  $registrarId = $_SESSION['rid'];
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];

  // Validation
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format');</script>";
    exit();
  }

  if (!ctype_alpha($firstName) || !ctype_alpha($lastName)) {
    echo "<script>alert('Names should only contain letters');</script>";
    exit();
  }

  // Update using prepared statement
  $stmt = $con->prepare("UPDATE tblregistrar SET firstName=?, lastName=?, email=? WHERE id=?");
  $stmt->bind_param("sssi", $firstName, $lastName, $email, $registrarId);

  if ($stmt->execute()) {
    echo "<script>alert('Profile updated successfully');</script>";
    // Update session variables
    $_SESSION['fname'] = $firstName;
    $_SESSION['lname'] = $lastName;
    $_SESSION['email'] = $email;
  } else {
    echo "<script>alert('Something went wrong. Please try again');</script>";
  }

  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!--Function Email Availabilty---->


</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include_once("includes/navbar.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include_once("includes/sidebar.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>My Profile</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">My Profile</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <?php
      $registrarId = intval($_SESSION['rid']);
      $stmt = $con->prepare("SELECT firstName, lastName, email FROM tblregistrar WHERE id = ?");
      $stmt->bind_param("i", $registrarId);
      $stmt->execute();
      $result = $stmt->get_result();
      $registrar = $result->fetch_assoc();
      $stmt->close();
      ?>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Profile</h3>
                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" name="firstName" value="<?= htmlspecialchars($registrar['firstName']) ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" name="lastName" value="<?= htmlspecialchars($registrar['lastName']) ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" value="<?= htmlspecialchars($registrar['email']) ?>" class="form-control" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
</body>

</html>