<?php
include_once('config1.php');

if(isset($_POST['registerSubmit']) && $_POST['registerSubmit'] == 'true') {
	$fName = trim($_POST['fName']);
	$lName = trim($_POST['lName']);
	$registerEmail = trim($_POST['email']);
	$registerPassword = trim($_POST['password']);
	$registerConfirmPassword = trim($_POST['confirmPassword']);
	$userType = (int) $_POST['user_type'];

	if (!eregi("^[^@]{1,64}@[^@]{1,255}$", $registerEmail))
		$errors['registerEmail'] = 'Your email address is invalid.';

	if(strlen($registerPassword) < 6 || strlen($registerPassword) > 12)
		$errors['registerPassword'] = 'Your password must be between 6-12 characters.';

	if($registerPassword != $registerConfirmPassword)
		$errors['registerConfirmPassword'] = 'Your passwords did not match.';

	$query = 'SELECT * FROM users WHERE email = "' . mysql_real_escape_string($registerEmail) . '" LIMIT 1';
	$result = mysql_query($query);
	if(mysql_num_rows($result) == 1)
		$errors['registerEmail'] = 'This email address already exists.';

	if(!$errors) {
		$query = 'INSERT INTO users SET first_name="' . $fName . '", last_name="' . $lName . '", email = "' . $registerEmail . '", password=MD5("' . $registerPassword . '"), user_type = ' . $userType . ';';

	if(mysql_query($query)) {
		$success['register'] = 'Thank you for adding a new account. You can now log in.';
	}
	else {
		$errors['register'] = 'There was a problem registering you. Please check your details and try again.';
	}
}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!-- PACE LOADING BAR DEPENDENCIES -->
		<script src="js/pace.min.js"></script>
		<link href="css/pace-minimal.css" rel="stylesheet">

		<!-- BOOTSTRAP -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

		<!-- GOOGLE FONTS -->
		<link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Quicksand:400,300,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Neuton:300,400,700,400italic' rel='stylesheet' type='text/css'>

		<!-- CUSTOM CSS -->
		<link href="css/index.css" rel="stylesheet">
		<link href="css/accountManagement.css" rel="stylesheet">

		<title>PMUNC</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Princeton Model United Nations Conference">
		<meta name="keywords" content="PMUNC, MUN">
		<meta name="author" content="Clement Lee and Angelica Chen">

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- GOOGLE ANALYTICS -->
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51958755-1', 'princeton.edu');
  ga('send', 'pageview');

</script>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">Princeton Model United Nations Conference</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="index.html">Home</a></li>
						<li><a href="register.php">Register</a></li>
						<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Information <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="logistics.html">Logistics</a></li>
							<li><a href="schedule.html">Schedule</a></li>
							<li><a href="preparation.html">Preparation</a></li>
							<li><a href="faq.html">FAQ</a></li>
						</ul>
						</li>
						<li><a href="committees.php">Committees</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="https://www.facebook.com/PrincetonModelUnitedNationsConference2014"><i class="fa fa-facebook"></i></a></li>
						<li><a href="http://irc.princeton.edu/"><i class="fa fa-globe"></i></a></li>
						<li><a href="mailto:pmunc@princeton.edu?Subject=PMUNC"><i class="fa fa-envelope"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container" id="addAccount-container">
			<div class="container">
				<h1 class="text-center">Add Account</h1>
				<div class="horbar">
				</div><br>
					<form name="registerForm" class="form-addAccount" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<?php if($success['register'])
							print '<div class="valid">' . $success['register'] . '</div>';
							if($errors['register']) print '<div class="invalid">' . $errors['register'] . '</div>';
						?>
						<h3><b>First Name</b>: <input type="text" name="fName" class="form-control" placeholder="John" required autofocus></h3>

						<h3><b>Last Name</b>: <input type="text" name="lName" class="form-control" placeholder="Smith" required autofocus></h3>

						<h3><b>Email Address</b>: <input type="email" name="email" class="form-control" placeholder="Email address" value="<?php echo htmlspecialchars($registerEmail); ?>" required>
						<?php if($errors['registerEmail'])
							print '<div class="invalid">' . $errors['registerEmail'] . '</div>';
						?>
						</h3>

						<h3><b>Password</b>: <input type="password" name="password" value="" class="form-control" placeholder="Password" required>
						<?php
							if($errors['registerPassword'])
								print '<div class="invalid">' . $errors['registerPassword'] . '</div>';
						?></h3>

						<h3><b>Confirm Password</b>: <input type="password" name="confirmPassword" value="" class="form-control" placeholder="Password" required>
						<?php
						if ($errors['registerConfirmPassword']) print '<div class="invalid">' . $errors['registerConfirmPassword'] . '</div>';
						?>
						</h3>

						<h3><b>Type of Account</b>: <select name="user_type">
						<option value="1">Charg&eacute; d'Affaires</option>
						<option value="2">Head Delegate or Faculty Advisor</option>
						<option value="3">Committee Chair</option>
						</select></h3><br>

						<input type="hidden" name="registerSubmit" id="registerSubmit" value="true">
						<input class="btn btn-lg btn-primary btn-block" type="submit" value="Create Account">
					</form>
					<center><a href="dashboard.php"><button type="button" class="btn btn-link">Back to Dashboard</button></a></center>
			</div>
		</div>
		<div class="container container-footer">
			<div class="container">
				<footer>
					<p class="pull-right">Designed by Angelica Chen &amp; Clement Lee &middot; <a href="#">Back to top</a></p>
					<p class="pull-left">&copy; 2014 Princeton Model United Nations Conference </p>
				</footer>
			</div>
		</div>


		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</body>
</html>