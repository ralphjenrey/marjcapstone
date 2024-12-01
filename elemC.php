<?php include_once('includes/config.php');
if(isset($_POST['submit'])){
    $gname=$_POST['gname'];
    $emailid=$_POST['emailid'];
    $cname=$_POST['cname'];
    $cage=$_POST['agegroup'];
    $vtime=$_POST['visittime'];
    $message=$_POST['message'];

    $query=mysqli_query($con,"insert into tblvisitor(gurdianName,gurdianEmail,childName,childAge,message,visitTime) values('$gname','$emailid','$cname','$cage','$message','$vtime')");
    if($query){
        echo "<script>alert('Details sent successfully.');</script>";
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Heebo', sans-serif;
            background-color: white;
        }
        .container {
            margin-top: 20px;
        }
        .logo {
            text-align: left;
            padding-left: 15px;
        }
        .college-info {
            padding-left: 15px;
            padding-top: 10px;
        }
        .enroll-button {
            margin-top: 10px;
        }
        .btn-primary {
            padding: 5px 10px;
            font-size: 1rem;
            background-color: #007bff; /* Button background color */
            color: white; /* Button text color */
            border: 0 solid;
        }
        .btn-secondary {
            padding: 1px 5px;
            font-family: 'Heebo', sans-serif;
            border: 0 solid;
            font-size: .75rem;
            background-color: #007bff; /* New button background color */
            color: white; /* New button text color */
        }
        .custom-container {
            background-color: #007bff; /* Dark background for the container */
            color: white; /* Font color inside the container */
            padding-top: 2rem;
            padding-bottom: 0rem;
            border-radius: 10px; /* Rounded corners */
        }
        .custom-container p {
            padding: 5px 0; /* Add padding to paragraphs inside the custom container */
        }
        /* Adding font-size to h5 and p */
        h5 {
            font-size: .90rem; /* Adjust the size of the <h5> elements */
            font-family: 'Heebo', sans-serif;        
        }
        h6 {
            font-size: 1.5rem; /* Adjust the size of the <h6> elements */
            font-family: 'Heebo', sans-serif;
            font-weight: 550;
            color: orange;        
        }
        h2 {
            font-size: 1rem; /* Adjust the size of the <h2> elements */
            font-family: 'Heebo', sans-serif;
            color: navy;        
        }
        p {
            font-size: 1rem; /* Adjust the size of the <p> elements */
            font-family: 'Heebo', sans-serif;
        }
        /* Mobile responsiveness */
        @media (max-width: 576px) {
            .logo img {
                width: 100px;
            }
            .college-info h2 {
                font-size: 1.5rem;
            }
            .college-info h5, .college-info p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="enroll-button">
        <a href="college.php" class="btn btn-secondary btn-lg">Back</a> <!-- New button -->
    </div>
</div>

<!-- College Info Section -->
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2 logo">
            <img src="img/12.png" alt="College Logo" class="img-fluid">
        </div>
        <div class="col-md-10 text-start college-info">
            <h2>Cebu Eastern College</h2>
            <h6>Bachelor of Elementary Education</h6>
            <p>Leon Kilat St., Cebu City</p>
            <div class="enroll-button">
                <a href="enrollment.php" class="btn btn-primary btn-lg">Apply Requirments</a>
            </div>
        </div>
    </div>
</div>

<!-- Cost Calculation Section with Background Color -->
<div class="container mt-5 custom-container">
    <div class="row">
        <div class="col-md-4 text-center mb-4">
            <h5>Cost Calculation</h5>
            <p>₱472,500 with 3 Years</p>
        </div>

        <div class="col-md-4 text-center mb-4">
            <h5>ROI Calculator</h5>
            <p>12 Years Return, 1M savings in 16 Years</p>
        </div>

        <div class="col-md-4 text-center mb-4">
            <h5>Duration</h5>
            <p>3-4 years</p>
        </div>
    </div>
</div>

<div class="container">
<p>The Bachelor of Elementary Education is a four-year degree program that combines theory and practice designed to prepare students for teaching in primary schools.</p>
            <p><strong>Majors offered in this college:</strong></p>
            <ul>
                <li>General Education</li>
                <li>Pre-school Education</li>
                <li>Special Education</li>
            </ul>

<!-- Contact Us Section -->
<div class="container py-3">
    <div class="row g-5 align-items-center">
        <div class="col-lg-12" style="width: 100%;">
            <?php 
            $sql = mysqli_query($con, "SELECT * FROM tblpage WHERE PageType='contactus'");
            if ($sql && mysqli_num_rows($sql) > 0) {
                $data = mysqli_fetch_array($sql);
            } else {
                $data = ['PageTitle' => 'Contact Us', 'PageDescription' => 'Default contact us description.'];
            }
            ?>
            <h1 class="mb-4" style="width: 100%;"><?php echo htmlspecialchars($data['PageTitle']); ?></h1>
            <p style="white-space: pre-wrap; width: 100%;"><?php echo htmlspecialchars($data['PageDescription']); ?></p>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
</body>
</html>
