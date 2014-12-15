<?php
include_once('config.php');

$appCommittees = array("Mao's Yan'An Red Base",
					"Cabinet of the Republic of Liberia",
					"Ukraine in Turmoil",
					"2050 National Security Council",
					"Israel-Hamas-Fatah Joint Crisis Committee");

$nonAppCommittees = array(
					"Special Political and Decolonization Committee",
					"Disarmament and International Security",
					"Security Council",
					"World Health Organization",
					"High Commissioner for Refugees",
					"Office on Drugs and Crime",
					"Human Rights Council",
					"World Bank",
					"Paris Peace Conference",
					"Arab League",
					"Organization of American States",
					"International Criminal Court",
					"Association of Southeast Asian Nations"
);

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
		<link href="css/dashboard.css" rel="stylesheet">

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
				<h1 class="text-center">Welcome, <?php echo $_SESSION['user']['first_name']; ?>!</h1>
				<div class="horbar">
				</div><br>
					<?php
					if ($_SESSION['user']['user_type'] == 1) {
						echo "<h2><i class=\"fa fa-gear\"></i>  <a href=\"editAccountInfo1.php\">Edit Account Information</a></h2>
						<p><i>Change your email or password.</i></p>
						<h2><i class=\"fa fa-user\"></i>  <a href=\"userManagement.php\">User Management</a></h2>
						<p><i>Manage all user accounts - change usernames/passwords, or add/delete accounts.</i></p>
						<h2><span class=\"glyphicon glyphicon-home\"></span>  <a href=\"schoolManagement.php\">School Delegation Management</a></h2>
						<p><i>Edit school delegation information.</i></p>
						<h2><i class=\"fa fa-users\"></i>  <a href=\"committeeManagement1.php\">Committee Management</a></h2>
						<p><i>Edit committee information, upload committee-related documents, add positions, and download submitted committee applications.</i></p>
						<h2><i class=\"fa fa-edit\"></i>  <a href=\"committeeAssignments.php\">By-Application Committee Assignments</a></h2>
						<p><i>Assign delegates to committees requiring applications.</i></p>
						<h2><i class=\"fa fa-clipboard\"></i>  <a href=\"NonAppCommitteeManagement.php\">Non-Application Committee Assignments</a></h2>
						<p><i>Submit lists of countries represented in each committee, and assign delegates from each country to non-application committees.</i></p>
						<h2><i class=\"fa fa-download\"></i>  <a href=\"downloadData.php\">Download Data</a></h2>
						<p><i>Download spreadsheets of data stored in the system.</i></p>";
					}
					else if ($_SESSION['user']['user_type'] == 2) {
						/* extract delegation info */
						$delegationInfo = mysql_fetch_assoc(mysql_query('SELECT * FROM SCHOOL_INFO WHERE Preferred_Email="' . $_SESSION['user']['email'] . '";'));
						if ($delegationInfo['WAITLIST_STATUS'] == 'TRUE')
							echo "<div class=\"alert alert-danger\" role=\"alert\">Your school's delegation is currently on the PMUNC waitlist, 
						but feel free to edit your information here, just in case we have extra spots and are able to accept you! If a spot becomes 
						available, we will personally contact you to let you know. Sorry about the inconvenience, and thanks for your patience!</div>";
						echo "<h2><i class=\"fa fa-user\"></i>  <a href=\"accountInfo2.php\">Account Management</a></h2>
						<p><i>Edit your account and school delegation information.</i></p>
						<h2><span class=\"glyphicon glyphicon-cloud-upload\"></span>  <a href=\"submitApp.php\">Committee Application Submission</a></h2>
						<p><i>Submit committee applications for participants from your delegation.</i></p>
						<h2><span class=\"glyphicon glyphicon-globe\"></span>  <a href=\"submitCountryPreferences.php\">Country Preference Submission</a></h2>
						<p><i>Submit your preferences for country assignments.</i></p>
						<h2><i class=\"fa fa-envelope\"></i>  <a href=\"emailSecretariat.php\">Contact the PMUNC Secretariat</a></h2>
						<p><i>Send a private message to the PMUNC Secretariat.</i></p>
						<h2><i class=\"fa fa-users\"></i>  <a href=\"viewAssignments.php\">Committee Assignments</a></h2>
						<p><i>View which committees your delegates have been assigned to.</i></p>";
					}
					else if ($_SESSION['user']['user_type'] == 3) {
						echo "<h2><i class=\"fa fa-user\"></i>  <a href=\"accountInfo3.php\">Account Management</a></h2>
						<p><i>Edit your account information.</i></p>
						<h2><i class=\"fa fa-users\"></i>  <a href=\"committeeEdit3.php\">Committee Management</a></h2>
						<p><i>Edit your committee information and upload relevant documents.</i></p>
						<h2><i class=\"fa fa-list\"></i>  &nbsp;<a href=\"viewDelegates.php\">Delegate List</a></h2>
						<p><i>View the list of which delegates have been assigned to your committee.</i></p>";
						/* extract committee info */
						$committeeInfo = mysql_fetch_assoc(mysql_query('SELECT * FROM COMMITTEE_INFO WHERE Email="' . $_SESSION['user']['email'] . '";'));
						if (in_array($committeeInfo['Name'], $appCommittees)) {
							echo "<h2><i class=\"fa fa-download\"></i>  <a href=\"viewApplications3.php\">Download Submitted Applications</a></h2>
							<p><i>Download applications that delegates have submitted to your committee.</i></p>";
						}
					}
					?>
					<h2><span class="glyphicon glyphicon-log-out"></span>  <a href="logout.php">Log Out</a></h2><br>
			</div>
		</div>
		<?php
		if ($_SESSION['user']['user_type'] == 3) {
			echo "<style>
			.container-footer {
				position: absolute;
				bottom: 0px;
			}
			</style>";
		}
		?>
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

