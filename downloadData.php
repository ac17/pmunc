<?php
include_once('config1.php');
include_once('encodeCSV.php');
$success = array();

if (isset($_POST['school']) && $_POST['school'] == 'true') {
	$output = encodeCSV("SCHOOL_INFO","Name");
	file_put_contents('temp1.csv',$output);
	$success['file'] = 'File successfully generated. Please download <a href="temp1.csv">here</a>.';
}

if (isset($_POST['countryPreferencesBySchool']) && $_POST['countryPreferencesBySchool'] == 'true') {
	$output = encodeCSV("countryPreferences","school");
	file_put_contents('temp2.csv',$output);
	$success['file'] = 'File successfully generated. Please download <a href="temp2.csv">here</a>.';
}

if (isset($_POST['countryPreferencesByCommittee']) && $_POST['countryPreferencesByCommittee'] == 'true') {
	$output = encodeCSV("countryPreferences","committee");
	file_put_contents('temp3.csv',$output);
	$success['file'] = 'File successfully generated. Please download <a href="temp3.csv">here</a>.';
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
				<h1 class="text-center">Download Data</h1>
				<div class="horbar">
				</div><br>
				<center>
					<p><i>All tables will be downloaded as CSV files, which can be opened in Microsoft Excel.</i></p>
					<?php if ($success['file']) print "<div class=\"alert alert-success\" role=\"alert\">" . $success['file'] . "</div>"; ?>
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<input type="hidden" name="school" id="school" value="true">
						<style>
						.download-link { font-size: 20px; }
						</style>
						<input class="download-link btn btn-link" type="submit" value="Download School Delegation Information">
					</form>
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<input type="hidden" name="countryPreferencesBySchool" id="countryPreferencesBySchool" value="true">
						<input class="download-link btn btn-link" type="submit" value="Download Submitted Country Preferences (Ordered By School)">
					</form>
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<input type="hidden" name="countryPreferencesByCommittee" id="countryPreferencesByCommittee" value="true">
						<input class="download-link btn btn-link" type="submit" value="Download Submitted Country Preferences (Ordered By Committee)">
					</form>
					<a href="dashboard.php"><button type="button" class="btn btn-link">Back to Dashboard</button></a>
				</center>
			</div>
		</div>
		<style>
		.container-footer {
			position: absolute;
			bottom: 0px;
		}
		</style>
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