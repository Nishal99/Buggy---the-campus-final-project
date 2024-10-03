<?php
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/login.css">
	<link rel="icon" type="image/x-icon" href="images/bug.png">
</head>
<body>
<div id="container" class="container">
		<!-- FORM SECTION -->
		<div class="row">
			<!-- SIGN UP -->
            <div class="col"></div>
			<div class="col align-items-center flex-col sign-in">
				<div class="form-wrapper align-items-center">
           
					<form class="form sign-in" action="includes/signup.inc.php" method="post" autocomplete="off">
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" id="name" name="name" placeholder="Name">
						</div>
						<div class="input-group">
							<i class='bx bx-mail-send'></i>
							<input type="text" id="email" name="email" placeholder="Email">
						</div>
                        <div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" id="uid" name="uid" placeholder="Username">
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" id="pwd" name="pwd" placeholder="Password">
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" id="pwdrepeat" name="pwdrepeat" placeholder="Repeat Password">
						</div>
						<button name="submit" type="submit">
							Sign up
						</button>
                        <?php
if(isset($_GET["error"])){
    if ($_GET["error"] == "emptyinput"){
        echo '<div class="error">Fill in the all fields!</div>';
    } else if ($_GET["error"] == "invaliduid"){
        echo '<div class="error">Invalid User Name!</div>';
    } else if ($_GET["error"] == "invalidemail"){
        echo '<div class="error">Invalid Email!</div>';
    }else if ($_GET["error"] == "passwordsdontmatch"){
        echo '<div class="error">Passwords not matching!</div>';
    }else if ($_GET["error"] == "stmtfailed"){
        echo '<div class="error">Something went wrong!</div>';
    }else if ($_GET["error"] == "none"){
        echo '<div class="error">Account Created!</div>';
    }else if ($_GET["error"] == "usernametaken"){
        echo '<div class="error">Username / Email taken!</div>';
    }
}
?>
						<p>
							<span>
								Already have an account?
							</span>
							<b onclick="toggle()" class="pointer">
                            <a href="login.php" style="color: inherit; text-decoration:none;">Sign in here</a>
							</b>
						</p>
</form>

				</div>
			
			</div>
			<!-- END SIGN UP -->
			<!-- SIGN IN -->
			<!--<div class="col align-items-center flex-col sign-in">
				
				<div class="form-wrapper">
		
				</div>
			</div>-->
			<!-- END SIGN IN -->
		</div>
		<!-- END FORM SECTION -->
		<!-- CONTENT SECTION -->
		<div class="row content-row">
			<!-- SIGN IN CONTENT -->
			<!-- END SIGN IN CONTENT -->
			<!-- SIGN UP CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="img sign-in">
				
				</div>
				<div class="text sign-in">
					<h2>
						Join with us
					</h2>
	
				</div>
			</div>
			<!-- END SIGN UP CONTENT -->
		</div>
		<!-- END CONTENT SECTION -->
</div>
    <script src="js/login.js"></script>
</body>
</html>
