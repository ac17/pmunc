<?php
session_start();
$errors=array();
$success=array();
$dbLink = mysql_connect('localhost', 'modelun', 'flp5WxQGTJgk');
if(!$dbLink)
die('Database connection not established.' . mysql_error());
$dbSelected = mysql_select_db('modelun_pmunc2014', $dbLink);

if (isset($_POST['forgotPasswordSubmit']) && $_POST['forgotPasswordSubmit'] == 'true') {
	$email = trim($_POST['email']);
	$query = 'SELECT * FROM users WHERE email = "' . mysql_real_escape_string($email) . '" LIMIT 1';
	$result = mysql_query($query);
	if ($result) {
		if (mysql_num_rows($result) == 0) $errors['generateNewPassword'] = "This email address is not in our databases.";
		else {
			$newPassword = substr(md5(rand()), 0, 10);
			$query = 'UPDATE users SET password=MD5("' . $newPassword . '") WHERE email="'. mysql_real_escape_string($email) . '";';
			if (mysql_query($query)) {
				$success['generateNewPassword'] = "Your new password has been sent to you.";
				$message = "Hello,\n\n
				Your new PMUNC password is: " . $newPassword . "\n
				Please log in and reset your password.\n\n
				Regards,\n
				Your PMUNC Webmasters";
				mail($email,"Your PMUNC Account", $message);
			}
		}
	}
	else {
		$errors['generateNewPassword'] = "Our database could not be reached. Please try again.";
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
		<link href="css/signin.css" rel="stylesheet">

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
		<div class="container" id="signin-container">
			<div class="container">
				<h1 class="text-center">Forgot your password?</h1>
				<center>No worries! Enter your email below and we'll send you a new password.</center>
				<form name="forgotPasswordForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-signin" role="form">
					<?php if ($success['generateNewPassword']) print "<div class=\"valid\">" . $success['generateNewPassword'] . "</div>";
					if ($errors['generateNewPassword']) print "<div class=\"invalid\">" . $errors['generateNewPassword'] . "</div>";
					?>
					<input type="email" class="form-control" placeholder="mail@mail.com" value="" name="email" required autofocus><br>
					<input type="hidden" name="forgotPasswordSubmit" id="forgotPasswordSubmit" value="true">
					<input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit"></button>
				</form>
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