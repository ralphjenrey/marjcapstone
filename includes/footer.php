   <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">

<?php $sql=mysqli_query($con,"select * from tblpage where PageType='contactus'");
$cnt=1;
while($data=mysqli_fetch_array($sql)){
?>

                    <div class="col-lg-4 col-md-6">
                        <h3 class="text-white mb-4">Contact Us</h3>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><?php echo $data['PageDescription']?></p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><?php echo $data['MobileNumber']?></p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i><?php echo $data['Email']?></p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                <?php } ?>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Links</h3>
                        <a class="btn btn-link text-white-50" href="index.php">Home Page</a>
                       <a class="btn btn-link text-white-50" href="about.php">Requirements</a>
                    </div>
                
                
                </div>
            </div>
    
        </div>