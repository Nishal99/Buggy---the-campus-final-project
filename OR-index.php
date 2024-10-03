<?php
?>
<!DOCTYPE html>
<html>
<head>
<title>Buggy</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="icon" type="image/x-icon" href="images/bug.png">
<style>
body,h1 {font-family: "Poppins", sans-serif; text-decoration: none;}
body, html {height: 100%}
.bgimg {
  background-image: url('images/icon/robo4.jpg');
  min-height: 100%;
  background-position: center;
  background-size: cover;
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
    margin-top: 15px;
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
.wrap {
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 20px 0 0;
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
/**************************************************/
</style>
</head>
<body>
  <!--<video autoplay muted loop id="myVideo">
    <source src="images/Launching Gimmick Montage DDKOIN.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>-->
<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
  <div class="w3-display-topleft w3-padding-large w3-xlarge">
    <div class="header-mobile-inner">
      <a class="logo" href="index.php">
          <h1 class="buggy">Buggy</h1><img class="bug-img" src="images/bug.png"/>
      </a>

  </div>
  </div>
  <div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top">Welcome to the Buggy</h1>
    <hr class="w3-border-grey" style="margin:auto;width:40%">
    <div class="wrap">
    <button id="loginButton" class="button" onclick="window.location.href='login.php'">Proceed</button>

</div>
  </div>
</div>

</body>
</html>
