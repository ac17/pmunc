<?php
include_once('config2.php');

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
				<h1 class="text-center">Your Committee Assignments</h1>
				<div class="horbar"></div><br>
				<h2 class="text-center"><i>Non-Application Committees</i></h2>
				<?php
				/* get school info */
				$schoolInfo = mysql_fetch_assoc(mysql_query('SELECT * FROM SCHOOL_INFO WHERE Preferred_Email="' . $_SESSION['user']['email'] . '";'));
				/* check if participants have been assigned */
				$assignedRequest = mysql_query('SELECT * FROM PARTICIPANT_INFO WHERE School="' . $schoolInfo['Name'] . '" AND ISNULL(Position);');
				if (mysql_num_rows($assignedRequest) == 0)
					echo "<p class=\"text-center\"><i>No delegates from your school have been assigned to a non-application committee yet.</i></p>";
				else {
					echo "<table class=\"table\"><thead><tr><th>Committee</th><th>Country Representing</th><th>Number of Delegates</th></tr></thead><tbody>";
					/* loop through committees */
					for ($x=0;$x<count($nonAppCommittees);$x++) {
						/* keep track of which countries have been displayed already */
						$countries = array();
						$committeeRequest = mysql_query('SELECT * FROM PARTICIPANT_INFO WHERE School="' . $schoolInfo['Name']
							. '" AND Committee="' . $nonAppCommittees[$x] . '" ORDER BY Committee ASC;');
						for ($y=0; $y<mysql_num_rows($committeeRequest); $y++) {
							$row = mysql_fetch_assoc($committeeRequest);
							if (!in_array($row['Name'], $countries)) {
								$countries[] = $row['Name'];
								/* count number of delegates representing the country */
								$numDelegates = mysql_num_rows(mysql_query('SELECT * FROM PARTICIPANT_INFO WHERE School="' . $schoolInfo['Name']
									. '" AND Committee="' . $nonAppCommittees[$x] . '" AND Name="' . $row['Name'] . '";'));
								echo "<tr><td>" . $nonAppCommittees[$x] . "</td><td>" . $row['Name']
								. "</td><td>" . $numDelegates . "</td></tr>";
							}
						}
					}
					echo "</tbody></table>";
				}
				?>
				<h2 class="text-center"><i>By-Application Committees</i></h2>
				<?php
				/* check if participants have been assigned */
				$assignedRequest = mysql_query('SELECT * FROM PARTICIPANT_INFO WHERE School="' . $schoolInfo['Name'] . '" AND Position IS NOT NULL;');
				if (mysql_num_rows($assignedRequest) == 0)
					echo "<p class=\"text-center\"><i>No delegates from your school have been assigned to a by-application committee yet.</i></p>";
				else {
					echo "<table class=\"table\"><thead><tr><th>Committee</th><th>Delegate</th><th>Position</th></tr></thead><tbody>";
					/* loop through committees */
					for ($x=0; $x<count($appCommittees); $x++) {
						$committeeRequest = mysql_query('SELECT * FROM PARTICIPANT_INFO WHERE School="' . $schoolInfo['Name'] . '" AND Committee="'
							. $appCommittees[$x] . '";');
						/* loop through positions */
						for ($y=0; $y<mysql_num_rows($committeeRequest); $y++) {
							$delegateInfo = mysql_fetch_assoc($committeeRequest);
							echo "<tr><td>" . $delegateInfo['School'] . "</td><td>" . $delegateInfo['Name']
							. "</td><td>" . $delegateInfo['Position'] . "</td></tr>";
						}
					}
					echo "</tbody></table>";
				}
				?>
				
				<center><a href="dashboard.php"><button type="button" class="btn btn-link">Back to Dashboard</button></a></center>
			</div>
		</div>
		<style>
			.container-footer {
				position: fixed;
				bottom: 0%;
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