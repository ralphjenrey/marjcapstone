<?php include_once('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
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

    
    
    <style>
        /* Styling for the box, circle image, and text */
        .circle-frame-box {
            text-align: center;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            transition: transform 0.3s ease;
        }

        .circle-frame-box:hover {
            transform: translateY(-10px);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        .circle-frame {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #f0f0f0;
            margin: 0 auto;
            overflow: hidden;
        }

        .circle-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .text-below {
          text-align: center;
            margin-top: 15px;
        }

        .text-below a {
            text-decoration: none;
            font-size: 18px;
            color: #007bff; /* Color for clickable text */
            
        }

        .text-below a:hover {
            color: gray;
        }

        /* Styling for breadcrumb links */
        .breadcrumb-item a {
            color: #007bff; /* Set breadcrumb link color */
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: gray; /* Change color on hover */
        }
    </style>
</head>

<body>
    <?php include_once('includes/header.php'); ?>
    

    <!-- Page Header End -->
    <div class="container-xxl py-5 page-header position-relative mb-5">
        <div class="container py-5">
            <h1 class="display-2 text-white">Programs</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Programs</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!--  -->      
    <script>
    var menulist = document.getElementById('menulist');
    menulist.style.maxHeight = "0px";

    function menutoggle() {
      if (menulist.style.maxHeight == "0px") {
        menulist.style.maxHeight = "100vh";
      } else {
        menulist.style.maxHeight = "0px";
      }
    }
  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
  <script>
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 0,
      nav: true,
      dots: false,
      navText: ["<i class = 'fa fa-chevron-left'></i>", "<i class = 'fa fa-chevron-right'></i>"],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 1
        },
        1000: {
          items: 1
        }
      }
    })
  </script>
    <!--  -->  


    <!-- -->
    <script>
    $('.owl-carousel1').owlCarousel({
      loop: true,
      margin: 40,
      nav: true,
      dots: false,
      navText: ["<i class = 'fa fa-chevron-left'></i>", "<i class = 'fa fa-chevron-right'></i>"],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 2,
          margin: 10,
        },
        1000: {
          items: 3
        }
      }
    })
  </script>

  
<section class="gallery">
    <div class="container top">
      <div class="heading">
        <h1>EXPLORE</h1>
        <h2>Our Programs</h2>
      </div>
    </div>

   


<div class="content mtop">
      <div class="owl-carousel owl-carousel1 owl-theme">
        <div class="items">
          <div class="img">
            <img src="img/el.jpg" alt="">
          </div>
          <div class="overlay">
          </div>
        </div>
        
        <div class="items">
          <div class="img">
            <img src="img/elemss.jpg" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
          </div>
        </div>

        <div class="items">
          <div class="img">
            <img src="img/ele.jpg" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
          </div>
        </div>

        <div class="items">
          <div class="img">
            <img src="img/abms.png" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
          </div>
        </div>

        <div class="items">
          <div class="img">
            <img src="img/stem.jpg" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
          </div>
        </div>

        <div class="items">
          <div class="img">
            <img src="img/hum.jpg" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
          </div>
        </div>

        <div class="items">
          <div class="img">
            <img src="img/beed.jpg" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
          </div>
        </div>

        <div class="items">
          <div class="img">
            <img src="img/bee.jpg" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
          </div>
        </div>

        <div class="items">
          <div class="img">
            <img src="img/be.jpg" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
          </div>
        </div>
        
        <div class="items">
          <div class="img">
            <img src="img/bsit.jpg" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
          </div>
        </div>

        <div class="items">
          <div class="img">
            <img src="img/bss.jpg" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
          </div>
        </div>
      </div>
    </div>
  </section>


  <script>
    $('.owl-carousel1').owlCarousel({
      loop: true,
      margin: 0,
      nav: false, // Change this to false
      dots: false,
      autoplay: true,
      autoplayTimeout: 1000,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 4,
        },
        1000: {
          items: 6
        }
      }
    })
</script>

    <!-- -->


    <!-- Box with Circle Frame and Clickable Text Start -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="circle-frame-box">
                    <!-- Circle Frame for Image -->
                    <div class="circle-frame">
                        <img src="img/4.jpg" alt="Course Image">
                    </div>
                    <!-- Clickable Text Below -->
                    <div class="text-below">
                        <a href="basic.php">BASIC EDUCATION</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="circle-frame-box">
                    <!-- Circle Frame for Image -->
                    <div class="circle-frame">
                        <img src="img/2.jpg" alt="Course Image">
                    </div>
                    <!-- Clickable Text Below -->
                    <div class="text-below">
                        <a href="senior.php">SENIOR HIGH</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="circle-frame-box">
                    <!-- Circle Frame for Image -->
                    <div class="circle-frame">
                        <img src="img/3.jpg" alt="Course Image">
                    </div>
                    <!-- Clickable Text Below -->
                    <div class="text-below">
                        <a href="college.php">COLLEGE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Box with Circle Frame and Clickable Text End -->

    

    <!-- Footer Start -->
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
