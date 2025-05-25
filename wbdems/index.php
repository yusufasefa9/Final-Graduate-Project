





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->




</head>

<body id="login">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php">Great Vision College</a></h1>
  

      <nav id="navbar" class="navbar order-last order-lg-0">
      <ul class="navigation-menu">
    <li><a class="active">Home</a></li>
    <li><a href="aboutt.php">About</a></li>
    <li><a href="courses.php">Courses</a></li>
    <li><a href="contact.html">Contact</a></li>
    <li><a href="register.php">Register</a></li>
            <!-- Changed "signup" to "Signup" for consistency -->
   <li><a href="login.php">Login</a></li>

  </ul>
     
    </div>
    </div>
  </header><!-- End Header -->


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
      <h1>Learning Today,<br>Leading Tomorrow</h1>
      <h2>Web Based Distance <br> Education Management System</h2>
           
    </div>
   
		
			
    </div>

  </section><!-- End Hero -->


  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/house.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>Great Vision College, situated in the vibrant city of Wolkite, is a distinguished institution committed to providing a transformative educational experience.</h3>
            <p class="fst-italic">
              
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> Great Vision College stands as a beacon of educational excellence and community engagement. With a rich tapestry of academic programs, cutting-edge facilities, .</li>
              <li><i class="bi bi-check-circle"></i> Wolkite City's vibrant culture and the college's unwavering commitment to holistic education create a unique synergy, allowing students to explore their passions and unlock their full potential. .</li>
              <li><i class="bi bi-check-circle"></i>fostering innovation, and shaping well-rounded individuals. With a focus on academic excellence, our faculty, comprised of seasoned educators and industry experts, strives to empower students with the knowledge and skills needed to thrive in their chosen fields. </li>
            </ul>
            <p>
              Great Vision College takes pride in creating a supportive and inclusive community that encourages personal growth and leadership development.
            </p>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    
  

    <?php
// Step 1: Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wbdems";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Execute SQL queries to count the number of rows in each table
$sql_student = "SELECT COUNT(*) as total_students FROM student";
$sql_teacher = "SELECT COUNT(*) as total_teachers FROM teacher";
$sql_subject = "SELECT COUNT(*) as total_subjects FROM subject";

$result_student = $conn->query($sql_student);
$result_teacher = $conn->query($sql_teacher);
$result_subject = $conn->query($sql_subject);

// Step 3: Fetch the counts
$row_student = $result_student->fetch_assoc();
$row_teacher = $result_teacher->fetch_assoc();
$row_subject = $result_subject->fetch_assoc();

// Step 4: Replace the hardcoded values in the HTML code with the fetched counts
?>

<section id="counts" class="counts section-bg">
    <div class="container">
        <div class="row counters">
            <div class="col-lg-3 col-6 text-center">
                <span data-purecounter-start="0" data-purecounter-end="<?php echo $row_student['total_students']; ?>" data-purecounter-duration="1" class="purecounter"></span>
                <p class="category">Students</p>
            </div>

            <div class="col-lg-3 col-6 text-center">
                <span data-purecounter-start="0" data-purecounter-end="<?php echo $row_subject['total_subjects']; ?>" data-purecounter-duration="1" class="purecounter"></span>
                <p class="category">Courses</p>
            </div>

            <div class="col-lg-3 col-6 text-center">
                <span data-purecounter-start="0" data-purecounter-end="<?php echo $row_teacher['total_teachers']; ?>" data-purecounter-duration="1" class="purecounter"></span>
                <p class="category">Instructors</p>
            </div>
        </div>
    </div>
</section>

<?php
// Close database connection
$conn->close();
?>
<!-- End Counts Section -->
<!-- End Features Section -->

    <!-- ======= Popular Courses Section ======= -->
    <section id="popular-courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Departments</h2>
          <p>Popular Departments</p>
        </div>

        <div class="row" data-aos="zoom-in" data-aos-delay="100">

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
              <img src="assets/img/course-1.jpg" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                 
                 
                </div>

                <h3><a href="course-details.html">Economics</a></h3>
                <p> Economics is the study of scarcity and its implications for the use of resources, production of goods and services, growth of production and welfare over time.</p>
                
              </div>
            </div>
          </div> <!-- End Course Item-->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="course-item">
              <img src="assets/img/course-2.avif" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                 
                  
                </div>

                <h3><a href="course-details.html">Marketing</a></h3>
                <p> Marketing refers to activities a company undertakes to promote the buying or selling of a product or service.</p>


               
              </div>
            </div>
          </div> <!-- End Course Item-->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="course-item">
              <img src="assets/img/course-3.jpg" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                 
                  
                </div>

                <h3><a href="course-details.html">Acounting</a></h3>
                <p>Accounting is the process of recording, classifying and summarizing financial transactions.</p>
                
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="course-item">
              <img src="assets/img/mng.jpg" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                 
                  
                </div>

                <h3><a href="course-details.html">Management</a></h3>
                <p>
Management, in essence, is the process of organizing and directing
 resources to achieve specific goals.</p>
                
              </div>
            </div>
          </div>
           <!-- End Course Item-->
           <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="course-item">
              <img src="assets/img/HRMM.jpeg" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                 
                  
                </div>

                <h3><a href="course-details.html">Human Resource Managment</a></h3>
                <p>
         Human resource management (HRM), often abbreviated as HR, is the strategic approach to managing an 
         organization's workforce.</p>


               
              </div>
            </div>
          </div>

        </div>

      </div>
    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Great Vision</h3>
            <p>
             Addis Abeba , <br>
              Wolkite<br>
              <br><br>
              <strong>Phone:</strong> +0979-77-77-70/0979-77-77-72<br>
              <strong>Email:</strong> info@greatcollege.net<br>
            </p>
          </div>

          

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Economics</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Acounting</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#"> Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Great Vision</span></strong>. All Rights Reserved
        </div>
       
      </div>
     <div class="social-links text-center text-md-right pt-3 pt-md-0">
       
        <a href="https://www.facebook.com/profile.php?id=100063699746961" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://t.me/Alllikjoin" class="telegram"><i class="bx bxl-telegram"></i></a>
       
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  

</body>

</html>