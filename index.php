<?php
require './assets/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$conn = new mysqli('localhost', 'root', '', 'test1');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $YourName = $_POST['name'];
        $YourEmail = $_POST['email'];
        $Subject = $_POST['subject'];
        $Message = $_POST['message'];

        if (!empty($YourName) && !empty($YourEmail) && !empty($Subject) && !empty($Message)) {
            $sql = "INSERT INTO registration (name, email, subject, message) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $YourName, $YourEmail, $Subject, $Message);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Message sent successfully.";

                // Send an email using PHPMailer
                $mail = new PHPMailer(true);
                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Specify your SMTP server
                    $mail->SMTPAuth = true;
                    $mail->Username = 'tibeallianz@gmail.com'; // SMTP username
                    $mail->Password = 'yaha xnvw pbqt cyem'; // SMTP password
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    // Recipients
                    $mail->setFrom('tibeallianz@gmail.com', 'Tibe Allianz');
                    $mail->addAddress('tibeallianz@gmail.com', 'Tibe Allianz'); // Add a recipient

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = $Subject;
                    $mail->Body    = "Name: " . $YourName . "<br>Email: " . $YourEmail . "<br>Message: " . nl2br($Message);
                    $mail->AltBody = "Name: " . $YourName . "\nEmail: " . $YourEmail . "\nMessage: " . $Message;


                    $mail->send();
                    $_SESSION['message'] .= " Email sent successfully.";
                } catch (Exception $e) {
                    $_SESSION['message'] .= " Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                $_SESSION['message'] = "Error sending message: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $_SESSION['message'] = "All fields are required.";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tibe Allianz</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon1.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">    
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
   
  <!-- CDN -->
  <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div id="head" class="container-fluid container-xl-2 position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <img src="assets/img/sitelogo.png"
       width="150px"
        <span></span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#career">Career</a></li>
          <li><a href="#team">Team</a></li>
          
          </li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
 
      <a class="btn-getstarted" href="index.html#about">Get Started</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <img src="assets/img/hero1bg.png.jpg">

      <div class="container">

        <div class="row justify-content-center text-center" >
          <div class="col-xl-9 col-lg-11">
            <h2>We're the storytellers, the image makers, the tech wizards We're the ones who make your brand shine 
              <span>.</span></h2>
            <p>Advertising, Trainings & IT</p>
          </div>
        </div>

        

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" >

        <div class="row gy-4">
          <div class="col-lg-6 order-1 order-lg-2">
            <img src="assets/img/about.jpg" class="img-fluid" alt>
          </div>
          <div class="col-lg-6 order-2 order-lg-1 content">
            <h3>About Us</h3>
            <p class="fst-italic">
              We are start up recognized organization committed to providing our clients with the highest quality services and solutions. We believe that our success is due to our focus on innovation, customer service, and quality.
              <br>
              
              Our team of experienced and qualified professionals is passionate about helping businesses succeed. We work closely with our clients to understand their needs and develop solutions that meet their specific requirements.
              <br>
            
               We are proud to be a leading provider of advertising, skilling, and information technology services. We are committed to helping our clients achieve their goals and grow their businesses.


            </p>
            <p class="fst-italic">
              Industries we serve:-
            </p>
            <ul>
              <li><i class="bi bi-check2-all"></i> <span>Government.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Education.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Corporate.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Politics.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Manufacturing.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Real Estate.</span></li>
            </ul>
            
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section">

      <div class="container" >

        <div class="swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/client1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client81.png" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
       </div>

    </section><!-- /Clients Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

          </div>
        </div>

      </div>

    </section><!-- /Features Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>Services</h2>
        <p>Check our Services</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" >
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-activity"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Advertising And PR</h3>
              </a>
              <p>We help you build your brand, market your products and services, and connect with your target audience. Our advertising services include branding, marketing, and public relations.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" ="fade-up" -delay="200">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-broadcast"></i>
              </div>
              <a href="service-details1.html" class="stretched-link">
                <h3>Training And Workshop</h3>
              </a>
              <p>We help you develop your workforce and prepare them for the challenges of the future. We offer a wide range of training programs in areas such as business skills, technical skills, and soft skills.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" ="fade-up" -delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-easel"></i>
              </div>
              <a href="service-details2.html" class="stretched-link">
                <h3>Information Technology</h3>
              </a>
              <p>We help you create and maintain a strong online presence, develop innovative software solutions, and improve your IT infrastructure. Our information technology services include web design and development, software development, and IT consulting.</p>
            </div>
          </div><!-- End Service Item -->


        </div>

      </div>

    </section><!-- /Services Section -->
    <!-- Portfolio Section -->
    <section id="career" class="about section">

      <div class="container" >

        <div class="row gy-4">
          <div class="col-lg-6 order-1 order-lg-2">
            <img src="assets/img/career.png" class="img-fluid" alt>
          </div>
          <div class="col-lg-6 order-2 order-lg-1 content">
            <h3>Career</h3>
            <p class="fst-italic">
              Tibe Allianz Is A Diverse And Inclusive Workplace Where People Of All Backgrounds Are Welcome. We Are Looking For Passionate And Purpose-Driven Individuals Who Want To Make A Difference In The World. We Are Committed To Helping You Develop Your Skills And Capabilities, And We Offer A Culture That Fosters Success For Both Our Employees And Our Organization.
              <br>
              <ul>
              <li><i class="bi bi-check2-all"></i> <span>Graphic Designer & Video Editor: 2-3 Years Of Experience.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Business Development Executive: 1-2 Years Of Experience.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>MSW Intern: 0-2 Years Of Experience.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>IT Executive: 0-2 Years Of Experience.</span></li>
              </ul>
            </p>
            <p class="fst-italic">
              
            </p>
            
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section">

      <div class="container" >

        <div class="swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
      
          <div class="swiper-pagination"></div>
        </div>
       </div>
    
    <!-- Testimonials Section -->
    <div class="container section-title" ="fade-up">
      <h2>Customer's</h2>
      <p>Review</p>
    </div>
    <section id="testimonials" class="testimonials section dark-background">

      <img src="assets/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">

            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>

          <div class="swiper review-slider">
              <div class="swiper-wrapper">
                <div class="swiper-slide box">
                  <div style="text-align: center">
                  
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <span> Have Been Doing Business With Tibe Allianz Pvt Ltd For Around Three Decades. Ganesh Tibe Is Such A Trustworthy And Amazing Person. He Has Good Knowledge, Friendly And Problem-Solving People. We Are Glad To Do Business With Such An Amazing Company</span>
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                  <h5> UJWAL GANSHLEYAM INGO</h5>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
              </div>

                <div class="swiper-slide box">
                  <div style="text-align: center">
                    
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <span> Initially, We Thought Our Website Was Going To Be Just To Validate Us As A Company. But What It Did Actually Saved A Bunch Of Time By Implementing Different Tools That We Didn't Even Know We Could Use A Website For</span>
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                  <h5> ANIL CHANDRAKANT PATIL</h5>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
              </div>
                
                <div class="swiper-slide box">
                  <div style="text-align: center">
                   
                  <p>
                  <i class="bi bi-quote quote-icon-left"></i>  
                  <span> G.K.Tibe Hardware Store Is The Most Magical Place I Have Ever Been To! They Have Everything. Have Been Quite A Few Times Over The Years While Fixing Up My Place. Everyone Is Super Helpful And Friendly. Glad To Support A Local Joint Instead Of The Big Box Stores Around!</span>
                  <i class="bi bi-quote quote-icon-Right"></i>
                  </p>
                  <h5> SHIVAJI KAWADE</h5>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
              </div>

                <div class="swiper-slide box">
                  <div style="text-align: center">
                    
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <span> मागील वर्षात संपुर्ण जगात कोरोनाने हाहाकार पसरवला होतो. वाढत्या संसर्गाचा भीतीने माणूस एकमेकांपासून दूर जाऊ लागला होता. मदतीसाठी अनेक अडचणी येत होत्या. अशाच वेळेस विजेता ICEMS या कठीण काळात आमच्यासाठी कोरोना कॉल सेंटर सुरू केले. एका फोनद्वारे सर्व सामान्य जनतेला मदत सुलभरित्या मिळाली. तुमच्या संपूर्ण टीम चे धन्यवाद. तसेच तुम्हाला पुढील वाटचालीसाठी शुभेच्छा.</span>
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                  <h5>  मा. श्री. धनंजय मुंडे</h5>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
              </div>

              </section>

              </div>

          </div>


          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" ="fade-up">
        <h2>Team</h2>
        <p>our Team</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" >
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team1.png" class="img-fluid" alt="">
                
              </div>
              <div class="member-info">
                <div style="text-align: center">
                <h4>Gaurav Tibe</h4>
                <span>CEO & Managing Director</span>
                <span>Start-ups & eGovernance</span>
              </div>
            </div>
           </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" ="fade-up" -delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team2.png" class="img-fluid" alt="">
                
              </div>
              <div class="member-info">
                <div style="text-align: center">
                <h4>Falgun Mistry</h4>
                <span>Director</span>
                <span>15+ Years In Digital</span>
              </div>
            </div>
           </div>
          </div><!-- End Team Member -->
           
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" >
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team4.png" class="img-fluid" alt="">
                
              </div>
              <div class="member-info">
                <div style="text-align: center">
                <h4>Bhushan Phani</h4>
                <span>Management Reform Advisor</span>
                <span>IIT Kharagpur</span>
              </div>
            </div>
           </div>
          </div><!-- End Team Member -->


          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" ="fade-up" -delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team5.png" class="img-fluid" alt="">
                
              </div>
              <div class="member-info">
                <div style="text-align: center">
                <h4>Farida Thakur</h4>
                <span>Event Manager</span>
                <span>15+ Years In Skill Development</span>
              </div>
            </div>
           </div>
          </div><!-- End Team Member -->


          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" ="fade-up" -delay="300">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team3.png" class="img-fluid" alt="">
                
              </div>
              <div class="member-info">
                <div style="text-align: center">
                <h4>Capt Parag patkar</h4>
                <span>Business Strategist</span>
                <span>7+ Years In Corporate & Government Sector</span>
              </div>
            </div>
           </div>
          </div><!-- End Team Member -->

          
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" ="fade-up" -delay="300">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team6.png" class="img-fluid" alt="">
                
              </div>
              <div class="member-info">
                <div style="text-align: center">
                <h4>Omkar Potdar</h4>
                <span>Event Manager</span>
                <span>8+ Years In Government & PR</span>
              </div>
            </div>
           </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" ="fade-up" -delay="400">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team7.png" class="img-fluid" alt="">
                
              </div>
              <div class="member-info">
                <div style="text-align: center">
                <h4>Shraddha Nijai</h4>
                <span>Creative Manager</span>
                <span>4+ Years Of Experience In The Industry</span>
              </div>
            </div>
           </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" >
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team8.png" class="img-fluid" alt="">
                
              </div>
              <div class="member-info">
                <div style="text-align: center">
                <h4>Neha Vanarse</h4>
                <span>HR Manager</span>
                <span>5 Years Of Experience </span>
              </div>
            </div>
           </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" ="fade-up">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div><!-- End Section Title -->

      <div class="container" >

        <div class="mb-5" ="fade-up" -delay="200">
          <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1192.7587218772715!2d72.920488866394!3d19.102328914600662!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c768533b9297%3A0xf00a1d69f7d0fe4c!2sGodrej%20%26%20Boyce%20industry%20gate%20no.%202%20plant%20no%206!5e0!3m2!1sen!2sus!4v1719826018368!5m2!1sen!2sus" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div><!-- End Google Maps -->

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" ="fade-up" -delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>1st address:- Godrej & Boyce, Gate No 2, Plant No. 5, LBS Marg,Opposite Vikhroli Bus Depot,  Vikhroli West, Mumbai, Maharashtra 400079.</p>
              <p>2nd address:- Tibe House, Opp Panchayat, Samiti, Murbad, Thane, Maharashtra 421 401.</p>
              </div>

            </div><!-- End Info Item -->

            <div class="info-item d-flex" ="fade-up" -delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p> +91 96658 58463 / +91 81690 98231
                </p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" ="fade-up" -delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>connect@tibeallianz.com / tibeallianz@gmail.com </p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="index.php" method="post" class="email_form">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" id="message" placeholder="Message" required=""></textarea>
                </div>

                  <button type="submit">Submit</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->
</main>

  <footer id="footer" class="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6 footer-about">
            <a href="index.html" class="logo d-flex align-items-center">
              <span class="sitename">Tibe Allianz PVT LTD</span>
            </a>
            <div class="footer-contact pt-3">
              <p>1st address:-
                Godrej & Boyce, Gate No 2, Plant No. 5, LBS Marg,Opposite Vikhroli Bus Depot,Vikhroli West, Mumbai, Maharashtra 400079.</p>
              <p>2nd address:- 
                Tibe House, Opp Panchayat, Samiti, Murbad, Thane, Maharashtra 421 401.</p>
              <p class="mt-3"><strong>Phone:</strong> <span> +91 81690 98231</span></p>
              <p><strong>Email:</strong> <span>tibeallianz@gmail.com</span></p>
            </div>  
            <div class="social-links d-flex mt-4">
              <a href="https://www.facebook.com/tibeallianz?mibextid=ZbWKwL"><i class="bi bi-facebook"></i></a>
              <a href="https://www.instagram.com/tibeallianz/"><i class="bi bi-instagram"></i></a>
              <a href="https://www.linkedin.com/company/tibe-allianz-pvt-ltd/"><i class="bi bi-linkedin"></i></a>
              <a href="https://youtube.com/@tibeallianz?si=_7vhEPJ-1PKLyaAQ"><i class="bi bi-youtube"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Advertising And PR</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Training And Workshop</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Information Technology</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Services Provided industries</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Government</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Education</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Corporate</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Manufacturing</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Real Estate</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="copyright">
      <div class="container text-center">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Tibe Allianz PVT LTD</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
        Designed by <a href="https://tibeallianz.com/">Tibe Allianz</a>
        </div>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>