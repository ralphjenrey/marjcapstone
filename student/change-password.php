<?php
session_start();
include('./includes/config.php');

// Validate student session
if (strlen($_SESSION['sauth']) == 0) {
    header('location:index.php');
    exit();
} else {
    if (isset($_POST['change'])) {
        try {
            $studentId = $_SESSION['student_id'];
            $currentPassword = $_POST['currentpassword'];
            $newPassword = $_POST['newpassword'];

            // Validate password length
            if (strlen($newPassword) < 6) {
                throw new Exception("Password must be at least 6 characters");
            }

            // Get current password hash
            $stmt = mysqli_prepare(
                $con,
                "SELECT password FROM tblstudents WHERE id = ?"
            );
            mysqli_stmt_bind_param($stmt, "i", $studentId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $student = mysqli_fetch_assoc($result);

            // Verify current password
            if (!$student || !password_verify($currentPassword, $student['password'])) {
                throw new Exception("Current password is incorrect");
            }

            // Hash new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update password
            $stmt = mysqli_prepare(
                $con,
                "UPDATE tblstudents SET password = ?, updated_at = CURRENT_TIMESTAMP 
                 WHERE id = ?"
            );
            mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $studentId);

            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error updating password");
            }

            $_SESSION['success'] = "Password changed successfully";
            header("Location: change-password.php");
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    }
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
        function checkpass() {
            if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
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
                                <form method="post" name="changepassword" onsubmit="return checkpass();">
                                    <div class="card-body">

                                        <!-- Current Password--->
                                        <div class="form-group">
                                            <label for="exampleInputFullname">Current Password</label>
                                            <input class="form-control" id="currentpassword" name="currentpassword" type="password" required="true">
                                        </div>
                                        <!---New Password---->
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">New Password</label>
                                            <input class="form-control " id="newpassword" type="password" name="newpassword" required="true">
                                        </div>

                                        <!--  Confrim Password---->
                                        <div class="form-group">
                                            <label for="text">Confirm Password</label>
                                            <input class="form-control " id="confirmpassword" type="password" name="confirmpassword" required="true">
                                        </div>


                                    </div>
                                    <div class="container">
                                        <?php if (isset($_SESSION['success'])): ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="fas fa-check-circle"></i>
                                                <?= htmlspecialchars($_SESSION['success']) ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?php unset($_SESSION['success']); ?>
                                        <?php endif; ?>

                                        <?php if (isset($_SESSION['error'])): ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="fas fa-exclamation-circle"></i>
                                                <?= htmlspecialchars($_SESSION['error']) ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?php unset($_SESSION['error']); ?>
                                        <?php endif; ?>
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
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>