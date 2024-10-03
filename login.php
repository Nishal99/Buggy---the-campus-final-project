<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
	<link rel="icon" type="image/x-icon" href="images/bug.png">
</head>
<body>
<div id="container" class="container">
		<!-- FORM SECTION -->
		<div class="row">
			<!-- SIGN UP -->
			<div class="col">
			</div>
			<!-- END SIGN UP -->
			<!-- SIGN IN -->
			<div class="col align-items-center flex-col sign-in">
				<div class="form-wrapper align-items-center">
                
					<form class="form sign-in" action="includes/login.inc.php" method="post" autocomplete="off">
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" id="lname" name="uid" placeholder="Email / Username">
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" id="lname" name="pwd" placeholder="Password">
						</div>
						<button name="submit" type="submit">
							Sign in
						</button>
                        <?php
if(isset($_GET["error"])){
    if ($_GET["error"] == "emptyinput"){
        echo '<div class="error">Fill in the all fields!</div>';
    } else if ($_GET["error"] == "wronglogin"){
        echo '<div class="error">Invalid Username or Password!</div>';
    } else if ($_GET["error"] == "stmtfailed"){
        echo '<div class="error">Something went wrong!</div>';
    }else if ($_GET["error"] == "emptyinputlogin"){
        echo '<div class="error">Fill in the all fields!</div>';
    }else if ($_GET["error"] == "none"){
        echo '<div class="error">Account Created!</div>';
    }
}
?>
						
						<p>
							<span>
								Don't have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								<a href="signup.php" style="color: inherit; text-decoration:none;">Sign up here</a>
							</b>
						</p>
						<p>
							<b>
                            <a href="index.php" style="color: inherit; text-decoration:none;">Home</a>
							</b>
						</p>
</form>

				</div>
				<div class="form-wrapper">
		
				</div>
			</div>
			<!-- END SIGN IN -->
		</div>
		<!-- END FORM SECTION -->
		<!-- CONTENT SECTION -->
		<div class="row content-row">
			<!-- SIGN IN CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="text sign-in">
					<h2>
						Welcome
					</h2>
	
				</div>
				<div class="img sign-in">
		
				</div>
			</div>
			<!-- END SIGN IN CONTENT -->
			<!-- SIGN UP CONTENT -->
			<!-- END SIGN UP CONTENT -->
		</div>
		<!-- END CONTENT SECTION -->
</div
>
    <script src="js/login.js"></script>
</body>
</html>
