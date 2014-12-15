<?php
include_once('config1.php');

$committees = array(
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

/* delete participant assignments */
if (isset($_POST['deleteParticipant']) && $_POST['deleteParticipant'] == 'true') {
	$partCountry = mysql_real_escape_string($_POST['partCountry']);
	$partCommittee = mysql_real_escape_string($_POST['partCommittee']);
	$partSchool = mysql_real_escape_string($_POST['partSchool']);
	mysql_query('DELETE FROM PARTICIPANT_INFO WHERE Name="' . $partCountry . '" AND School="'
		. $partSchool . '" AND Committee="' . $partCommittee . '";');
}

/* assign participant to committee */
if (isset($_POST['assignParticipant']) && $_POST['assignParticipant'] == 'true') {
	$partSchool = mysql_real_escape_string(trim($_POST['assignSchool']));
	$partCountry = htmlspecialchars(trim($_POST['assign']));
	$committee = trim($_POST['committee']);
	$numPositions = (int) trim($_POST['numPositions']);
	/* insert number of positions into database */
	for ($x = 0; $x < $numPositions; $x++) {
		mysql_query('INSERT INTO PARTICIPANT_INFO set Name="' . $partCountry . '", Committee="' . $committee
			. '", School="' . $partSchool . '";');
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
				<h1 class="text-center">Non-Application Committee Assignments</h1>
				<div class="horbar">
				</div><br>
				<p><i><b>Important Tip:</b> When using a dropdown selector, type the first few letters of your desired option rapidly in succession to move down faster.</i></p>
				
				<?php
				for ($i=0; $i < count($committees); $i++) {
					echo "<table class=\"table\">";
					/* committee info */
					$query = 'SELECT * FROM COMMITTEE_INFO WHERE Name="' . $committees[$i] . '";';
					$result = mysql_query($query);
					/* country list */
					$query2 = 'SELECT * FROM countries WHERE committee="' . $committees[$i] . '" ORDER BY country ASC;';
					$result2 = mysql_query($query2);
					/* check if participants have been assigned to this committee */
					$participantRequest = mysql_query('SELECT * FROM PARTICIPANT_INFO WHERE Committee="' . $committees[$i] . '";');
					if ($result) {
						echo "<thead><tr><th>" . $committees[$i] . "</th><th></th><th></th><th></th></tr></thead>";
						if (mysql_num_rows($participantRequest) > 0) {
							echo "<tbody>
							<tr><td><i>School</i></td>
							<td><i>Country</i></td>
							<td><i>Number of Delegates</i></td>
							<td><i>Delete</i></td>
							</tr>";
							for ($x=0; $x < mysql_num_rows($result2); $x++) {
								/* country info */
								$row2 = mysql_fetch_assoc($result2);
								/* fetch participant info for this country*/
								$query3 = 'SELECT * FROM PARTICIPANT_INFO WHERE Committee="' . $committees[$i] . '" AND Name="' . $row2['country'] . '";';
								$result3 = mysql_query($query3);
								if (mysql_num_rows($result3) > 0) {
									$row3 = mysql_fetch_assoc($result3);
									echo "<tr>
									<td>" . $row3['School'] . "</td>
									<td>" . $row2['country'] . "</td>
									<td>" . mysql_num_rows($result3) . "</td>
									<td><form role=\"form\" action=\"nonAppCommitteeAssignments.php\" method=\"post\">
									<input type=\"hidden\" name=\"partSchool\" id=\"partSchool\" value=\"" . $row3['School'] . "\">
									<input type=\"hidden\" name=\"partCountry\" id=\"partCountry\" value=\"" . $row2['country'] . "\">
									<input type=\"hidden\" name=\"partCommittee\" id=\"partCommittee\" value=\"" . $committees[$i] . "\">
									<input type=\"hidden\" name=\"deleteParticipant\" id=\"deleteParticipant\" value=\"true\">
									<input class=\"btn btn-link\" type=\"submit\" value=\"Delete\">
									</form></td>
									</tr>";
								}
							}
							echo "</tbody>";
						}
					}
					echo "</table>
					<h4>Assign more participants to this committee:</h4>
					<form role=\"form\" action=\"nonAppCommitteeAssignments.php\" method=\"post\">
					<select name=\"assignSchool\"><option value='' disabled selected style='display:none;'>Select a school</option>";
					/* fetch schools */
					$schoolRequest = mysql_query('SELECT * FROM SCHOOL_INFO ORDER BY Name ASC;');
					for ($x=0; $x<mysql_num_rows($schoolRequest); $x++) {
						$row = mysql_fetch_assoc($schoolRequest);
						echo "<option value=\"" . $row['Name'] . "\">" . $row['Name'] . "</option>";
					}
					echo "</select><br>
					<select name=\"assign\"><option value='' disabled selected style='display:none;'>Select a country</option>";
					/* fetch countries */
					$countryRequest = mysql_query('SELECT * FROM countries WHERE committee="' . $committees[$i] . '" ORDER BY country ASC;');
					for ($x=0; $x<mysql_num_rows($countryRequest); $x++) {
						$row = mysql_fetch_assoc($countryRequest);
						/* check if country has been assigned already */
						$searchResults = mysql_query('SELECT * FROM PARTICIPANT_INFO WHERE Name="' . $row['country'] . '" AND Committee="' . $committees[$i] . '";');
						if (mysql_num_rows($searchResults) == 0) {
							echo "<option value=\"" . $row['country'] . "\">" . $row['country'] . "</option>";
						}
					}
					echo "</select><br><br>
					<input type=\"number\" name=\"numPositions\" id=\"numPositions\" placeholder=\"Number of positions\"><br><br>
					<input type=\"hidden\" name=\"committee\" id=\"committee\" value=\"" . $committees[$i] . "\">
					<input type=\"hidden\" name=\"assignParticipant\" id=\"assignParticipant\" value=\"true\">
					<input class=\"btn btn-lg btn-primary btn-block\" type=\"submit\" value=\"Submit\"><br>
					</form>";
				}
				?>
				<center><a href="NonAppCommitteeManagement.php"><button type="button" class="btn btn-link">Back to Non-Application Committee Management</button></a><a href="dashboard.php"><button type="button" class="btn btn-link">Back to Dashboard</button></a></center>
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