<?php 
// error_reporting(0);
include('includes/config.php');

if (isset($_POST['resetpwd'])) {
    $uname = $_POST['username'];
    $mobile = $_POST['mobileno'];
    $newpassword = md5($_POST['newpassword']);
    $sql = mysqli_query($con, "SELECT ID FROM tbladmin WHERE AdminuserName='$uname' and MobileNumber='$mobile'");
    $rowcount = mysqli_num_rows($sql);

    if ($rowcount > 0) {
        $query = mysqli_query($con, "UPDATE tbladmin SET Password='$newpassword' WHERE AdminuserName='$uname' and MobileNumber='$mobile'");
        if ($query) {
            echo "<script>alert('Your Password successfully changed');</script>";
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        } else {
            echo "<script>alert('Username or Mobile number is invalid');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Bootstrap 4.5 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <style>
        /* Ensure the body and html take full height */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: white !important; /* Solid clear white background */
        }

        /* Centering the login-box */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            
        }

        .login-box {
            width: 400px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border: 0 solid;
            font-family: 'Heebo', sans-serif;
            margin-bottom: 10px;
            height: 50px;
            line-height: 1.5; 
        }

        .btn-primary:hover {
            background-color: gray;
            border-color: gray;
        }

        .input-group-text {
            background-color: white;
        }

        .login-box-msg {
            font-size: 20px;
            color: #333;
            font-weight: bold;
        }

        a {
            color: #1877f2;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>

    <script type="text/javascript">
        function valid() {
            if (document.passwordrecovery.newpassword.value != document.passwordrecovery.confirmpassword.value) {
                alert("New Password and Confirm Password do not match!");
                document.passwordrecovery.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="login-box">
        <div class="card-body">
            <form name="passwordrecovery" method="post" onSubmit="return valid();">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobileno" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="newpassword" id="newpassword" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirmpassword" id="confirmpassword" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" name="resetpwd">Reset</button>
                    </div>
                </div>
            </form>
            <hr>
            <p class="mt-3 mb-1">
                <a href="index.php">Sign in</a>
            </p>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
