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
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="doom.css">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
<?php include_once('includes/header.php');?>
    <!-- Page Header End -->
    <div class="container-xxl py-5 page-header position-relative mb-5">
        <div class="container py-5">
            <h1 class="display-2 text-white">Requirements</h1>
        </div>
    </div>
    <!-- Page Header End -->

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

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6">
            <h2>Undergraduate Requirements</h2>
            <ul class="list-group">
                <li class="list-group-item">Form 138 / Report Card</li>
                <li class="list-group-item">Certificate of Good Moral</li>
                <li class="list-group-item">Birth Certificate</li>
                <li class="list-group-item">NSAT or NCAE Result</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <h2>Transferees Requirements</h2>
            <ul class="list-group">
                <li class="list-group-item">Transcript of Records (TOR) for evaluation</li>
                <li class="list-group-item">Certificate of Good Moral</li>
                <li class="list-group-item">Birth Certificate</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <h2>Senior High Requirements</h2>
            <ul class="list-group">
                <li class="list-group-item">Form 138 / Report Card (Original and Photocopy)</li>
                <li class="list-group-item">Certificate of Good Moral Character</li>
                <li class="list-group-item">Birth Certificate (Original NSO and Photocopy)</li>
                <li class="list-group-item">Entrance Examination Result from the Guidance Office</li>
                <li class="list-group-item">Recent 2x2 colored picture</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <h2>Cebu City Scholars Requirements</h2>
            <ul class="list-group">
                <li class="list-group-item">Form 138 / Report Card</li>
                <li class="list-group-item">Certificate of Good Moral</li>
                <li class="list-group-item">Birth Certificate</li>
                <li class="list-group-item">Intelliprime Result</li>
                <li class="list-group-item">Voucher from the government</li>
            </ul>
        </div>
    </div>
</div>



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>