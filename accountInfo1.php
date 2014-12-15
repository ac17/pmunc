<?php
include_once('config1.php');
$errors=array();
$success=array();

$index = $_GET["userNum"];
$query="SELECT * FROM users ORDER BY user_type, first_name, last_name ASC LIMIT " . $index . ",1;";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);

if (isset($_POST['editSubmit']) && $_POST['editSubmit'] == 'true') {
	$newEmail = trim($_POST['email']);
	$newFName = trim($_POST['first']);
	$newLName = trim($_POST['last']);

	if (!eregi("^[^@]{1,64}@[^@]{1,255}$", $newEmail))
		$errors['newEmail'] = 'Your email address is invalid.';

	$query1 = 'UPDATE users SET email="' . $newEmail . '", first_name="' . $newFName . '", last_name="' . $newLName . '" WHERE email="' . $row["email"] . '";';
	$query2 = 'UPDATE COMMITTEE_INFO SET email="' . $newEmail . '" WHERE email="' . $row["email"] . '";';
	if (!$errors) {
		if (mysql_query($query1)) {
			if ($row["user_type"] != 3) {
				header('Location: userRequestSuccess.php');
				exit;
			}
			else if (mysql_query($query2)) {
				header('Location: userRequestSuccess.php');
				exit;
			}
		}
		else {
			$error['editAccountInfo'] = 'There was a problem updating the user\'s information. Please try again.';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
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
		<link href="css/Template.css" rel="stylesheet">

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
		<div class="container" id="template-container">
			<div class="container">
				<h1 class="text-center">Account Information</h1>
				<div class="horbar">
				</div><br>
				<?php
				$query="SELECT * FROM users ORDER BY user_type, first_name, last_name ASC LIMIT " . $index . ",1;";
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result);
				?>
				<h3><b>First Name</b>: <?php echo $row["first_name"]; ?></h3>
				<h3><b>Last Name</b>: <?php echo $row["last_name"]; ?></h3>
				<h3><b>Email</b>: <?php echo $row["email"]; ?></h3>
				<h1 class="text-center">Edit Information</h1>
				<div class="horbar">
				</div><br>
				<div id="editInfo">
					<form name="editForm" role="form" action="<?php echo 'accountInfo1.php?userNum=' . $index; ?>" method="post">
						<?php
						if ($success['editAccountInfo'])
							print "<div class=\"valid\">" . $success['editAccountInfo'] . "</div>";
						if ($errors['editAccountInfo'])
							print "<div class=\"invalid\">" . $errors['editAccountInfo'] . "</div>";
						?>
						<h3><b>New first name</b>:</h3> <input type="text" name="first" class="form-control" value="<?php echo $row['first_name']; ?>" required><br>
						<h3><b>New last name</b>:</h3> <input type="text" name="last" class="form-control" value="<?php echo $row['last_name']; ?>"><br>
						<h3><b>New email</b>:</h3> <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required><br>
						<?php if ($errors['newEmail']) print "<div class=\"invalid\">" . $errors['newEmail'] . "</div>"; ?>
						<input type="hidden" name="editSubmit" id="editSubmit" value="true">
						<input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit">
					</form><br>
					<center><a href="dashboard.php"><button type="button" class="btn btn-link">Back to Dashboard</button></a></center>
				</div>
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
