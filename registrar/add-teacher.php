<?php 
session_start();
// Database Connection
include('includes/config.php');

// Validating Session
if (strlen($_SESSION['aid']) == 0) { 
    header('location:index.php');
    exit();
}

// Code for Add New Teacher
if (isset($_POST['submit'])) {
    // Getting Post Values  
    $fname = $_POST['fullname'];
    $tsubject = $_POST['tsubject'];

    // Define the addedby variable
    $addedby = $_SESSION['aid'];

    // Prepare and bind
    $stmt = $con->prepare("INSERT INTO tblteachers (fullName, teacherSubject, AddedBy) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fname, $tsubject, $addedby);

    if ($stmt->execute()) {
        echo "<script>alert('Teacher added successfully.');</script>";
        echo "<script type='text/javascript'> document.location = 'add-teacher.php'; </script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
        // Output the error for debugging purposes
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PreSchool Enrollment System | Add Teacher</title>

  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
  <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
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
            <h1>Add Assign Professor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Assign Professor</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Personal Info</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="addteacher" method="post" enctype="multipart/form-data">
                <div class="card-body">

                  <!-- Full Name -->
                  <div class="form-group">
                    <label for="exampleInputFullname">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Teacher Full Name" required>
                  </div>

                  <!-- Subject -->
                  <div class="form-group">
                    <label for="text">Assign Subject</label>
                    <input type="text" class="form-control" id="tsubject" name="tsubject" placeholder="Enter Subject" required>
                  </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                  </div>
                
                </div>
                <!-- /.card-body -->
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
<script src="../plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
  $('.select2').select2();
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  });
});
</script>
</body>
</html>
