<?php
session_start();
include('includes/config.php');

if (strlen($_SESSION['sauth']) == 0) {
    header('location:index.php');
    exit();
}

// Handle Profile Update
if (isset($_POST['update'])) {
    try {
        $studentId = $_SESSION['student_id'];
        $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
        $email = mysqli_real_escape_string($con, $_POST['email']);

        // Validate inputs
        if (empty($firstName) || empty($lastName) || empty($email)) {
            throw new Exception("All fields are required");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        // Update profile using prepared statement
        $stmt = mysqli_prepare(
            $con,
            "UPDATE tblstudents SET 
            firstName = ?, 
            lastName = ?, 
            email = ?,
            updated_at = CURRENT_TIMESTAMP 
            WHERE id = ?"
        );

        mysqli_stmt_bind_param($stmt, "sssi", $firstName, $lastName, $email, $studentId);

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Database error: " . mysqli_error($con));
        }

        $_SESSION['success'] = "Profile updated successfully";
        header("Location: profile.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
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
            $studentId = $_SESSION['student_id'];
            $query = mysqli_prepare($con, "SELECT * FROM tblstudents WHERE id = ?");
            mysqli_stmt_bind_param($query, "i", $studentId);
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query)->fetch_assoc();

            if ($result) {
            ?>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Update Profile Information</h3>
                                    </div>
                                    <form name="student" method="post">
                                        <div class="card-body">
                                            <!-- Student Number -->
                                            <div class="form-group">
                                                <label>Student Number</label>
                                                <input type="text" name="studentNumber" class="form-control"
                                                    value="<?php echo htmlspecialchars($result['studentNumber']); ?>" readonly>
                                            </div>

                                            <!-- First Name -->
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="firstName"
                                                    value="<?php echo htmlspecialchars($result['firstName']); ?>" required>
                                            </div>

                                            <!-- Last Name -->
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="lastName"
                                                    value="<?php echo htmlspecialchars($result['lastName']); ?>" required>
                                            </div>

                                            <!-- Email -->
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="<?php echo htmlspecialchars($result['email']); ?>" required>
                                            </div>

                                        </div>
                                        <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible">
        <?= htmlspecialchars($_SESSION['success']) ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible">
        <?= htmlspecialchars($_SESSION['error']) ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" name="update">Update Profile</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php
            } else {
                echo "<div class='alert alert-danger'>Student not found</div>";
            }
            ?>
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