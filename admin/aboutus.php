<?php 
session_start();
// Database Connection
include('includes/config.php');

// Validating Session
if (strlen($_SESSION['aid']) == 0) { 
    header('location:index.php');
} else {
    // Code for updating content
    if (isset($_POST['submit_about'])) {
        $pagetitle = $_POST['pagetitle'];
        $pagedes = $con->real_escape_string($_POST['pagedes']);
        $query = mysqli_query($con, "UPDATE tblpage SET PageTitle='$pagetitle', PageDescription='$pagedes' WHERE PageType='aboutus'");
        if ($query) {
            echo '<script>alert("About Us has been updated.")</script>';
        } else {
            echo '<script>alert("Something Went Wrong. Please try again.")</script>';
        }
    }

    if (isset($_POST['submit_contact'])) {
        $contact_title = $_POST['contact_title'];
        $contact_info = $con->real_escape_string($_POST['contact_info']);
        $query = mysqli_query($con, "UPDATE tblpage SET PageTitle='$contact_title', PageDescription='$contact_info' WHERE PageType='contactus'");
        if ($query) {
            echo '<script>alert("Contact Us has been updated.")</script>';
        } else {
            echo '<script>alert("Something Went Wrong. Please try again.")</script>';
        }
    }

    if (isset($_POST['submit_services'])) {
        $service_title = $_POST['service_title'];
        $service_info = $con->real_escape_string($_POST['service_info']);
        $query = mysqli_query($con, "UPDATE tblpage SET PageTitle='$service_title', PageDescription='$service_info' WHERE PageType='services'");
        if ($query) {
            echo '<script>alert("Services has been updated.")</script>';
        } else {
            echo '<script>alert("Something Went Wrong. Please try again.")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <script src="nic.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <?php include_once("includes/navbar.php");?>
    <!-- Main Sidebar Container -->
    <?php include_once("includes/sidebar.php");?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-8">
                        <!-- About Us Form -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">BASIC EDUCATION REQUIREMENTS</h3>
                            </div>
                            <form method="post">
                                <div class="card-body">
                                    <?php
                                    $ret = mysqli_query($con, "SELECT * FROM tblpage WHERE PageType='aboutus'");
                                    $row = mysqli_fetch_array($ret);
                                    ?>
                                    <div class="form-group">
                                        <label for="about_title">Title</label>
                                        <input type="text" class="form-control" name="pagetitle" value="<?php echo isset($row['PageTitle']) ? htmlspecialchars($row['PageTitle']) : ''; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="about_description">Details</label>
                                        <textarea name="pagedes" class="form-control" required cols="140" rows="10"><?php echo isset($row['PageDescription']) ? htmlspecialchars($row['PageDescription']) : ''; ?></textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" name="submit_about">Submit</button>
                                </div>
                            </form>
                        </div>

                       
                        

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="nic.js"></script>
</body>
</html>
<?php } ?>
