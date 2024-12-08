<?php 
session_start();
include('includes/config.php');

// Validate Session
if(!isset($_SESSION['rid'])) {
    header('location:index.php');
    exit();
}

// Change Password Logic
if(isset($_POST['change'])) {
    $registrarId = $_SESSION['rid'];
    $currentPassword = $_POST['currentpassword'];
    $newPassword = $_POST['newpassword'];
    
    // Get current password hash
    $stmt = $con->prepare("SELECT password FROM tblregistrar WHERE id = ?");
    $stmt->bind_param("i", $registrarId);
    $stmt->execute();
    $result = $stmt->get_result();
    $registrar = $result->fetch_assoc();
    
    // Verify current password
    if(password_verify($currentPassword, $registrar['password'])) {
        // Hash new password
        $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
        
        // Update password
        $updateStmt = $con->prepare("UPDATE tblregistrar SET password = ? WHERE id = ?");
        $updateStmt->bind_param("si", $newPasswordHash, $registrarId);
        
        if($updateStmt->execute()) {
            echo "<script>alert('Password changed successfully.');</script>";
        } else {
            echo "<script>alert('Failed to update password.');</script>";
        }
        $updateStmt->close();
    } else {
        echo "<script>alert('Current password is incorrect.');</script>";
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
<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   
</script>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Change Password</li>
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
                <h3 class="card-title">Change your Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
<form method="post"  name="changepassword" onsubmit="return checkpass();">  
                <div class="card-body">

<!-- Current Password--->
   <div class="form-group">
                    <label for="exampleInputFullname">Current Password</label>
                <input class="form-control" id="currentpassword" name="currentpassword"  type="password" required="true">
                  </div>
<!---New Password---->
 <div class="form-group">
<label for="exampleInputEmail1">New Password</label>
<input class="form-control " id="newpassword" type="password" name="newpassword" required="true">
</div>

<!--  Confrim Password---->
<div class="form-group">
<label for="text">Confirm Password</label>
 <input class="form-control " id="confirmpassword" type="password" name="confirmpassword"  required="true">
                  </div>

      
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="change" id="change">Change</button>
                </div>
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
<script>
  function checkpass() {
    var newPassword = document.changepassword.newpassword.value;
    var confirmPassword = document.changepassword.confirmpassword.value;
    
    if(newPassword.length < 8) {
        alert('New password must be at least 8 characters long');
        return false;
    }
    
    if(newPassword != confirmPassword) {
        alert('New Password and Confirm Password do not match');
        document.changepassword.confirmpassword.focus();
        return false;
    }
    return true;
}   
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>

