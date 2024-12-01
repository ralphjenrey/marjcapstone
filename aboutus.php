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

    <style>
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
<?php include_once('includes/header.php');?>
    <!-- Page Header End -->
    <div class="container-xxl py-5 page-header position-relative mb-5">
        <div class="container py-5">
            <h1 class="display-2 text-white">About Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">About Us</li>
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

    <!--  -->  
    <section class="about top">
    <div class="container flex">
      <div class="left">
        <div class="heading">
          <h1>OVERVIEW</h1>
          <h2>Cebu Eastern College</h2>
        </div>
        <p>Cebu Eastern College (CEC) is a private, co-educational Chinese-Filipino school in Cebu City. 
            Its roots can be traced to the Cebu Chinese School, founded in 1915, and the Cebu Sun Yat Sen 
            High School, founded in 1925. The school was born as the Cebu Chinese High School out of the merging 
            of the two said schools in 1938. In 1950, the high school earned government recognition as a non-sectarian school, 
            opening its doors to students of all nationalities. </p>

            <p>Currently, CEC provides basic and higher education programs. It is a K-12 recognized institution, offering the ABM, HUMSS, and STEM strands for interested Senior High School (SHS) students. For college students, the school provides degree courses in Teacher Education, Hotel and Tourism Management, Development Communication, and Information Technology. </p>

            <p>Cebu Eastern College is one of the oldest Chinese schools in the Philippines and continues to have Chinese classes in its program curricula. Since its establishment, CEC has also been committed to providing the right environment to develop its students holistically in terms of their skills and values. Graduates of Cebu Eastern College become professionals who reflect competence and concern for the community.</p>

        <p>Source: cebueasterncollege.edu.ph</p>    
      </div>
      <div class="right">
      <img src="img/14.jpg" alt="" width="550" height="400">
      </div>
    </div>
  </section>

   <!--
  <section class="counter top">
    <div class="container grid">
      <div class="box">
        <h1>Private</h1>
        <hr>
        <span>SCHOOL TYPE</span>
      </div>
      <div class="box">
        <h1>9 Courses</h1>
        <hr>
        <span>PROGRAMS</span>
      </div>
      <div class="box">
        <h1>₱22,000</h1>
        <hr>
        <span>TUITION FEES</span>
      </div>
      <div class="box">
        <h1>Semestral</h1>
        <hr>
        <span>ACADEMIC CALENDAR</span>
      </div>
    </div>
  </section>
      -->  

    <!--  
  <section class="rooms">
    <div class="container top">
      <div class="heading">
        <h1>EXPOLRE</h1>
        <h2>Our Programs</h2>
        </p>
      </div>

      <div class="content mtop">
        <div class="owl-carousel owl-carousel1 owl-theme">
          <div class="items">
            <div class="image">
              <img src="img/el.jpg" alt="">
            </div>
            <div class="text">
              <h2 class="center-text">Kindergarden</h2>
              <p></p>
              <div class="button flex">
                 <a href="your-page.html" class="primary-btn">VIEW NOW</a>
                </div>
            </div>
          </div>

          <div class="items">
          <div class="image">
              <img src="img/elemss.jpg" alt="">
            </div>
            <div class="text">
              <h2 class="center-text">Elementary</h2>
              <p></p>
              <div class="button flex">
                 <a href="your-page.html" class="primary-btn">VIEW NOW</a>
                </div>
            </div>
          </div>

          <div class="items">
          <div class="image">
              <img src="img/ele.jpg" alt="">
            </div>
            <div class="text">
            <h2 class="center-text">Junior High</h2>
            <p></p>
              <div class="button flex">
                 <a href="your-page.html" class="primary-btn">VIEW NOW</a>
                </div>
            </div>
          </div>

          <div class="items">
          <div class="image">
              <img src="img/abms.png" alt="">
            </div>
            <div class="text">
            <h2 class="center-text">ABM</h2>
            <p></p>
              <div class="button flex">
                 <a href="your-page.html" class="primary-btn">VIEW NOW</a>
                </div>
            </div>
          </div>

          <div class="items">
          <div class="image">
              <img src="img/stem.jpg" alt="">
            </div>
            <div class="text">
            <h2 class="center-text">STEM</h2>
            <p></p>
              <div class="button flex">
                 <a href="your-page.html" class="primary-btn">VIEW NOW</a>
                </div>
            </div>
          </div>

          <div class="items">
          <div class="image">
              <img src="img/hum.jpg" alt="">
            </div>
            <div class="text">
            <h2 class="center-text">HUMSS</h2>
            <p></p>
              <div class="button flex">
                 <a href="your-page.html" class="primary-btn">VIEW NOW</a>
                </div>
            </div>
          </div>

          <div class="items">
          <div class="image">
              <img src="img/beed.jpg" alt="">
            </div>
            <div class="text">
            <h2 class="center-text">BEEd</h2>
            <p></p>
              <div class="button flex">
                 <a href="elemC.php" class="primary-btn">VIEW NOW</a>
                </div>
            </div>
          </div>

          <div class="items">
          <div class="image">
              <img src="img/bee.jpg" alt="">
            </div>
            <div class="text">
            <h2 class="center-text">BSEd</h2>
            <p></p>
              <div class="button flex">
                 <a href="your-page.html" class="primary-btn">VIEW NOW</a>
                </div>
            </div>
          </div>

          <div class="items">
          <div class="image">
              <img src="img/be.jpg" alt="">
            </div>
            <div class="text">
            <h2 class="center-text">BSHRM</h2>
            <p></p>
              <div class="button flex">
                 <a href="your-page.html" class="primary-btn">VIEW NOW</a>
                </div>
            </div>
          </div>

          <div class="items">
          <div class="image">
              <img src="img/bst.jpg" alt="">
            </div>
            <div class="text">
            <h2 class="center-text">BSTM</h2>
            <p></p>
              <div class="button flex">
                 <a href="your-page.html" class="primary-btn">VIEW NOW</a>
                </div>
            </div>
          </div>

          <div class="items">
          <div class="image">
              <img src="img/bsit.jpg" alt="">
            </div>
            <div class="text">
            <h2 class="center-text">BSIT</h2>
            <p></p>
              <div class="button flex">
                 <a href="your-page.html" class="primary-btn">VIEW NOW</a>
                </div>
            </div>
          </div>


          <div class="items">
          <div class="image">
              <img src="img/bss.jpg" alt="">
            </div>
            <div class="text">
            <h2 class="center-text">BS DevCom</h2>
            <p></p>
              <div class="button flex">
                 <a href="your-page.html" class="primary-btn">VIEW NOW</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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
    -->

    <!-- 


  <section class="Customer top">
    <div class="container">
      <div class="owl-carousel owl-carousel2 owl-theme">
        <div class="item">
          <p>The Cebu Eastern College believes that the best education is eclectic education inscribed in a culture of excellence, freedom, and relevance.</p>
          <label>PHILOSOPHY</label>
        </div>
        <div class="item">
          <p>
          The Cebu Eastern College is a non-stock and non-profit private institutions with quality graduates committed to serve the local, national, and global communities along business, scientific and technological pursuits.</p>
          <label>VISION</label>
        </div>
        <div class="item">
          <p>The Cebu Eastern College is a Filipino-Chinese school designed to deliver integrated and quality education interfaced with Confucian teaching and pragmatic concepts and processes to train and prepare the youth to be active and useful participants and leaders in the world of work.</p>
          <label>MISSION</label>
        </div>
        <div class="item">
          <p>The Cebu Eastern College aims to produce graduates who are physically, mentally, morally prepared to assume their roles and responsibilities in the different vocational and professional fields where they aspire to achieve.</p>
          <label>GOAL</label>
        </div>
      </div>
    </div>
  </section>
  <script>
    $('.owl-carousel2').owlCarousel({
      loop: true,
      margin: 0,
      nav: false,
      dots: true,
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 1,
        },
        1000: {
          items: 1
        }
      }
    })
  </script>



  <section class="news top rooms">
    <div class="container">
      <div class="heading">
        <h1>NEWS</h1>
        <h2>Our News</h2>
      </div>


      <div class="content flex">
        <div class="left grid2">
          <div class="items">
            <div class="image">
              <img src="img/hire.jpg" alt="">
            </div>
            <div class="text">
              <h2>Cebu Eastern College 1915</h2>
              <div class="admin flex">
                <i class="fa fa-user"></i>
                <label>Registrar</label>
                <i class="fa fa-heart"></i>
                <label>57</label>
                <i class="fa fa-comments"></i>
              </div>
              <p>CEC, Inc. is Hiring!<br>
              For interested applicants, please send your CV, TOR, and Application Letter to ceccollege.alumniassociation@gmail.com</p>
            </div>
          </div>
        </div>

        <div class="right">
          <div class="box flex">
            <div class="img">
              <img src="images/blog-s1.png" alt="">
            </div>
            <div class="stext">
              <h2>Etiam Vel Nequ</h2>
              <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
              </p>
            </div>
          </div>
          <div class="box flex">
            <div class="img">
              <img src="images/blog-s2.png" alt="">
            </div>
            <div class="stext">
              <h2>Etiam Vel Nequ</h2>
              <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
              </p>
            </div>
          </div>
          <div class="box flex">
            <div class="img">
              <img src="images/blog-s3.png" alt="">
            </div>
            <div class="stext">
              <h2>Etiam Vel Nequ</h2>
              <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

-->
        <!--  -->


        <!-- Back to Top -->
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