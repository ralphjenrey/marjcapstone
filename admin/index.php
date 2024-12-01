<?php
session_start();
include('../includes/config.php');

if(isset($_POST['login']))
  {
    $uname=$_POST['username'];
    $Password=md5($_POST['inputpwd']);
    $query=mysqli_query($con,"select ID,AdminuserName,UserType from tbladmin where  AdminuserName='$uname' && Password='$Password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['aid']=$ret['ID'];
      $_SESSION['uname']=$ret['AdminuserName'];
      $_SESSION['utype']=$ret['UserType'];
     header('location:dashboard.php');
    }
    else{
    echo "<script>alert('Invalid Details.');</script>";          
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* You can edit the padding here */
        .login-box {
            width: 400px;
            padding: 30px; /* Modify this value to change the padding */
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin-right: 150px;
        }

        .login-header {
            margin-bottom: 0px;
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
            color: white;
        }

        .btn-secondary {
            border-color: #00A400;
            height: 40px;
            width: 90px;
            background-color: #00A400;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Heebo', sans-serif;
            border-radius: 5px;
            text-decoration: none;
            font-size: 15px;
        }

        .btn-secondary:hover {
            background-color: gray;
            color: white;
        }

        .login-box-msg {
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 24px; /* Increase font size */
            font-family: 'Arial', sans-serif; /* Change font family */
            letter-spacing: 1px; /* Add spacing between letters */
            color: #007bff; /* Change font color */
        }

        .input-group-text {
            background-color: gray;
        }

        a {
            color: #1877f2;
        }

        .left-text {
            max-width: 500px;
            padding: 20px;
            color: #555;
            margin-left: 150px;
        }

        .left-text h1 {
            font-size: 50px;
            color: #007bff;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .left-text p {
            font-size: 20px;
            color: black;
            line-height: 1.5;
        }

    </style>
</head>
<body>
    <div class="left-text">
        <h1><b>Registrar</b> | CEC</h1>
        <p>Engage with your page and the world around you on Cebu Eastern College in a meaningful way.</p>
    </div>

    <div class="login-box">
        <div class="login-header">
            <div class="card-body">
                <!-- <p class="login-box-msg">Sign-In</p> --> <!-- The text you want to style -->
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="inputpwd" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                    <a href="password-recovery.php">Forgot password?</a>
                </p>
                <hr>
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="../index.html" class="btn btn-secondary btn-lg">Back</a>
                    </div>
                </div>          
            </div>
        </div>
    </div>

    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
