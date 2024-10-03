<?php
session_start();
require_once 'includes/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating = $_POST['rating'];
    $comment = $_POST['opinion'];
    $userId = isset($_SESSION['potId']) ? $_SESSION['potId'] : null;

    $sql = "INSERT INTO feedback (user_id, rating, comment) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "iis", $userId, $rating, $comment);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location:test/thank.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Buggy</title>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Nishal Pamuditha">

    <!-- Title Page-->
    <title>Buggy</title>
    <link rel="icon" type="image/x-icon" href="images/bug.png">
    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- Vendor CSS-->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="icon" type="image/x-icon" href="images/bug.png">
<link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <link href="css/bug-search.css" rel="stylesheet" media="all">

<style>
  div#About {
    padding-top: 100px !important;
}
  h2.title-1.m-b-25.testimonals {
    color: #ffffff;
    background: #ffffff57;
    width: 1030px;
    text-align: center !important;
    margin: 0px auto 0 !important;
    border-radius: 10px !important;
}

.txt-main-head{
  color: #ffffff;
    background: #ffffff57;
    width: 800px;
    text-align: center !important;
    margin: 0 auto !important;
    border-radius: 25px !important;
    padding:10px 20px;
  }

  h1.buggy{padding-top:0px;}

body,h1 {font-family: "Poppins", sans-serif; text-decoration: none;}

body, html {height: 100%}

.bgimg {
  background-image: url('images/icon/robo4.jpg');
  background-position: center;
  background-size: cover;
  background-attachment: fixed;
  min-height: 100vh;
}
video {
    display: inline-block;
    width: 100vw;
    height: auto;
}
.bgimg.w3-display-container.w3-animate-opacity.w3-text-white {
    position: static;
}
a.logo {
    width: 100%;
    display: flex;
    justify-content: center;
}
img.bug-img {
    width: 40px;
    height: 42px;
    margin-top: 0px;
}
button.search-button {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    background-color: #4272d7;
    color: #fff;
    border: none;
    width: 500px;
    border-radius: 0.5rem !important;
    margin: 0 auto;
    display: block;
}
.w3-padding-large {
    padding: 12px 24px !important;
    display: flex;
    margin: 0 auto;
    width: 100%;
    justify-content: space-evenly;
}

/******************************/
.testimonials-container {
    height: auto;
}
.wrap {
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 50px 0 0;
}

.button {
  min-width: 300px;
  min-height: 60px;
  font-family: 'Nunito', sans-serif;
  font-size: 22px;
  text-transform: uppercase;
  letter-spacing: 1.3px;
  font-weight: 700;
  color: #000000;
  background: #4272d7;
background: linear-gradient(90deg, rgb(25, 156, 212) 0%, #4272d7 100%);
  border: none;
  border-radius: 1000px;
  box-shadow: 12px 12px 24px rgb(66 26 194 / 64%);
  transition: all 0.3s ease-in-out 0s;
  cursor: pointer;
  outline: none;
  position: relative;
  padding: 10px;
  }

button::before {
content: '';
  border-radius: 1000px;
  min-width: calc(300px + 12px);
  min-height: calc(60px + 12px);
  border: 6px solid #4272d7;
  box-shadow: 0 0 60px #4272d7;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  opacity: 0;
  transition: all .3s ease-in-out 0s;
}

.button:hover, .button:focus {
  color: #313133;
  transform: translateY(-6px);
}

button:hover::before, button:focus::before {
  opacity: 1;
}

button::after {
  content: '';
  width: 30px; height: 30px;
  border-radius: 100%;
  border: 6px solid #4272d7;
  position: absolute;
  z-index: -1;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: ring 1.5s infinite;
}

button:hover::after, button:focus::after {
  animation: none;
  display: none;
}

@keyframes ring {
  0% {
    width: 30px;
    height: 30px;
    opacity: 1;
  }
  100% {
    width: 300px;
    height: 300px;
    opacity: 0;
  }
}
#testimonials {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 100%;
}

.testimonial-heading {
    letter-spacing: 1px;
    margin: 30px 0px;
    padding: 10px 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.testimonial-heading h1 {
    font-size: 2.2rem;
    font-weight: 500;
    background-color: #202020;
    color: #ffffff;
    padding: 10px 20px;
}

.testimonial-heading span {
    font-size: 1.3rem;
    color: #252525;
    margin-bottom: 10px;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.testimonial-box-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    width: 100%;
}

.testimonial-box {
    width: 500px;
	border-radius: .75rem;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px !important;
    background-color: #ffffff;
    padding: 20px;
    margin: 15px;
    cursor: pointer;
    transition: all ease 0.3s;
}

.testimonial-box:hover {
    transform: translateY(-10px);
}

.box-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.profile {
    display: flex;
    justify-content: center;
    align-items: center;
}

.profile-img img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 15px;
}

.name-user {
    display: flex;
    flex-direction: column;
}

.name-user strong {
    color: #3d3d3d;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
}

.name-user span {
    color: #979797;
    font-size: 0.8rem;
}

.reviews i {
    color: #f9d71c;
}

.client-comment p {
    font-size: 0.9rem;
    color: #4b4b4b;
}
h2.title-1.m-b-25.testimonals {
    text-align: center;
    margin: 20px 0 15px;
    font-size: 50px;
}
.txt-main-head{color:#ffffff!important;font-weight:normal;}
.txt-main{color:#ffffff!important;font-weight:normal;}
/**************************************************/
.container {
    max-width: 1030px;
    margin: 20px auto 20px;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
#about{margin-top:100px}

h1, h2 {
    color: #333;
}

p {
    color: #555;
    line-height: 1.6;
}

ol {
    margin: 20px 0;
    padding-left: 20px;
}

li {
    margin-bottom: 10px;
}

li strong {
    color: #333;
}
/*************************** */
.navbar {
  position: fixed;
    top: 40px;
    left: 20px;
    right: 20px;
    background: #4272d79e;
    border-radius: 50px;
    padding: 10px 20px;
    margin: 0 60px;
    display: flex;
    justify-content: space-between;
    
    font-size: 16px;
    align-items: center;
    transition: background 0.3s, color 0.1s, top 0.3s, left 0.3s, right 0.3s, padding 0.3s, margin 0.3s, box-shadow 0.3s;
    z-index: 1000;
}

.navbar.sticky {
  background: #4272d79e;
  color: #ffffff;
  top: 0;
  left: 0;
  right: 0;
  border-radius:0px;
  margin: 0;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* White shadow */
}

.navbar a {
  color: #ffffff; /* Use inherit to ensure color change on scroll */
  text-decoration: none;
  font-weight: 600;
  margin: 0 15px;
  transition: color 0.3s;
}
</style>
</head>
<body>
<div class="bgimg">
<div class="navbar" id="navbar">
      <div class="logo">
      <a class="logo" href="index.php">
          <h1 class="buggy txt-main">Buggy</h1><img class="bug-img" src="images/bug.png"/>
      </a>
      </div>
      <div class="nav-links">
        <a href="#mainPage">Home</a>
        <a href="#About">About</a>
        <a href="#testimonals">Testimonials</a>
        <a href="login.php">Login</a>
      </div>
    </div>
  <!--<video autoplay muted loop id="myVideo">
    <source src="images/Launching Gimmick Montage DDKOIN.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>-->
<div class="bgimg w3-display-container w3-animate-opacity w3-text-white" id="mainPage">
  
  <div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top txt-main-head">Welcome to the Buggy</h1>
    <hr class="w3-border-grey" style="margin:auto;width:40%">
    <div class="wrap">
    <button id="loginButton" class="button" onclick="window.location.href='login.php'">Proceed</button>

</div>
  </div>
</div>

<!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div id="About">
        <h2 class="title-1 m-b-25 testimonals">About Us</h2>
        <div class="container">
        <p>Welcome to Buggy Search, your one-stop solution for all HTML and CSS issues. Our mission is to help web developers, both beginners and experts, efficiently troubleshoot and resolve their coding problems, making the process of creating stunning web pages smoother and more enjoyable.</p>
        <br/>
        <h2>Our Process</h2>
        <ol>
            <li>
                <strong>Create an Account:</strong> To get started, simply sign up for an account. This will allow us to personalize your experience and keep track of your progress.
            </li>
            <li>
                <strong>Search for Issues:</strong> Once you're logged in, head over to our Buggy Search page. Enter your query related to HTML or CSS bugs in the search bar. Our intelligent search engine will provide you with a list of suggested questions that closely match your query.
            </li>
            <li>
                <strong>Select the Best Match:</strong> Browse through the suggested questions and select the one that best matches your issue. This will display the relevant answer or bug fix right below the question, helping you resolve your problem quickly.
            </li>
            <li>
                <strong>Dashboard:</strong> Your account comes with a personalized dashboard where you can view your search history. This feature helps you track your growth over time, highlighting the areas where you've improved and the ones that need more attention.
            </li>
            <li>
                <strong>Personalized Learning Materials:</strong> Based on your search history, our system analyzes your queries to identify your weak points. We then provide you with targeted learning materials to help you improve in those areas. This ensures continuous learning and skill enhancement.
            </li>
            <li>
                <strong>Feedback:</strong> We value your feedback. After resolving your issue, you can provide us with your feedback on our main page or through the feedback page. Your insights help us improve our services and make Buggy Search more effective for all users.
            </li>
        </ol>
        
        <h2>Our Commitment</h2>
        <br/>
        <p>At Buggy Search, we are committed to providing a supportive community for web developers. Whether you're just starting out or looking to refine your skills, our platform is designed to be your reliable companion in overcoming coding challenges. With personalized assistance, insightful learning materials, and continuous progress tracking, we aim to make your journey in web development as smooth as possible.</p>
        
        <p>From today, start transforming your coding experience with Buggy Search!</p>
        
        <p>If you have any questions or need further assistance, feel free to contact our support team. We're here to help you every step of the way.</p>
    </div>
    </div>
      <!-- Display feedback -->
  <div class="testimonials-container" id="testimonals">
  <h2 class="title-1 m-b-25 testimonals">Testimonials</h2>
  <section id="testimonials">

    <div class="testimonial-box-container">
    
        <?php
        $sql = "SELECT f.rating, f.comment, u.usersName, u.usersEmail FROM feedback f JOIN users_details u ON f.user_id = u.potId ORDER BY f.created_at DESC";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="testimonial-box">';
            echo '<div class="box-top">';
            echo '<div class="profile">';
            echo '<div class="profile-img"><img src="images/icon/user.png" /></div>';
            echo '<div class="name-user"><strong>' . $row['usersName'] . '</strong><span>' . $row['usersEmail'] . '</span></div>';
            echo '</div>';
            echo '<div class="reviews">';
            for ($i = 0; $i < 5; $i++) {
                if ($i < $row['rating']) {
                    echo '<i class="fas fa-star"></i>';
                } else {
                    echo '<i class="far fa-star"></i>';
                }
            }
            echo '</div>';
            echo '</div>';
            echo '<div class="client-comment"><p>' . $row['comment'] . '</p></div>';
            echo '</div>';
        }
        ?>
    </div>
</section>
      </div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const allStar = document.querySelectorAll('.rating .star');
        const ratingValue = document.querySelector('.rating input');

        allStar.forEach((item, idx) => {
            item.addEventListener('click', function() {
                let click = 0;
                ratingValue.value = idx + 1;

                allStar.forEach(i => {
                    i.classList.replace('bxs-star', 'bx-star');
                    i.classList.remove('active');
                });
                for(let i = 0; i < allStar.length; i++) {
                    if(i <= idx) {
                        allStar[i].classList.replace('bx-star', 'bxs-star');
                        allStar[i].classList.add('active');
                    } else {
                        allStar[i].style.setProperty('--i', click);
                        click++;
                    }
                }
            });
        });
    });

    window.onscroll = function() {stickNavbar()};

const navbar = document.getElementById("navbar");
const sticky = navbar.offsetTop;

function stickNavbar() {
  if (window.pageYOffset > sticky) {
    navbar.classList.add("sticky");
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
</div>
<?php include_once 'footer.php'; ?>
<!-- end document-->


</body>
</html>
