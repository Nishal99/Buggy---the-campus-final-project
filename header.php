<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
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

</head>

<body class="animsition" style="background-color:#ffffff;">
<div class="page-wrapper" style="background-color:#ffffff;">
    <!-- HEADER MOBILE-->
    
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block" style="z-index: 4;">

        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="images/icon/user.png" alt="John Doe">
                            </div><br/>
                            <div class="content">
                                <a class="js-acc-btn"> <?php
            if(isset($_SESSION["username"])){
                echo $_SESSION["username"] . '!';
            } else {
                echo 'User!';
            }
            ?></a>
                            </div>

                        </div>
                    </div>
                    <li>
                        <a href="buggy-search.php">
                            <i class="fas fa-desktop"></i>Buggy search</a>
                    </li>
                    <li class="active has-sub">
                        <a class="js-arrow" href="dashboard.php">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="feedback.php">
                            <i class="fas fa-chart-bar"></i>Feedback</a>
                    </li>
                    <li>
                        <a href="about.php">
                            <i class="fas fa-table"></i>About</a>
                    </li>
                    <li>
                        <a href="includes/logout.inc.php">
                        <i class="zmdi zmdi-power"></i>Logout</a>
                            
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container" style="background-color:#ffffff !important;">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop" style="background-color:#ffffff;">
            <div class="header-mobile-inner">
                <a class="logo" href="index.php">
                <h1 class="buggy">Buggy</h1><img class="bug-img" src="images/bug.png"/>
                </a>

            </div>
        </header>
