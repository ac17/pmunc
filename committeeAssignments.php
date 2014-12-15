<?php
include_once('config1.php');

$committees = array("Mao's Yan'An Red Base",
					"Cabinet of the Republic of Liberia",
					"Ukraine in Turmoil",
					"2050 National Security Council",
					"Israel-Hamas-Fatah Joint Crisis Committee");

/* delete participant assignment */
if (isset($_POST['deleteParticipant']) && $_POST['deleteParticipant'] == 'true') {
	$partID = $_POST['partID'];
	mysql_query('DELETE FROM PARTICIPANT_INFO WHERE ID="' . $partID . '";');
}

/* assign participant to committee */
if (isset($_POST['assignParticipant']) && $_POST['assignParticipant'] == 'true') {
	$partEmail = htmlspecialchars(trim($_POST['assign']));
	$committee = trim($_POST['committee']);
	$position = trim($_POST['position']);
	/* extract school and name from application */
	$appRow = mysql_fetch_assoc(mysql_query('SELECT * FROM APPLICATIONS WHERE Email="' . $partEmail . '";'));
	/* insert applicant into table of participants */
	mysql_query('INSERT INTO PARTICIPANT_INFO set Name="' . $appRow['Name'] . '", School="' . $appRow['School']
		. '", Committee="' . $committee . '", Position="' . $position . '", Email="' . $partEmail . '";');
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
				<h1 class="text-center">By-Application Committee Assignments</h1>
				<div class="horbar">
				</div><br>
				<br>
				<?php
				for ($i=0; $i < count($committees); $i++) {
					echo "<table class=\"table\">";
					/* committee info */
					$query = 'SELECT * FROM COMMITTEE_INFO WHERE Name="' . $committees[$i] . '";';
					$result = mysql_query($query);
					/* submitted applications */
					$query2 = 'SELECT * FROM APPLICATIONS WHERE Committee="' . $committees[$i] . '";';
					$result2 = mysql_query($query2);
					/* currently assigned participants */
					$query3 = 'SELECT * FROM PARTICIPANT_INFO WHERE Committee="' . $committees[$i] . '";';
					$result3 = mysql_query($query3);
					if ($result) {
						echo "<thead><tr><th>" . $committees[$i] . "</th><th></th><th></th><th></th></tr></thead>";
						if (mysql_num_rows($result3)>0) {
							echo "<tbody>
							<tr><td><i>Position</i></td>
							<td><i>Name</i></td>
							<td><i>School</i></td>
							<td><i>Delete</i></td>
							</tr>";
							for ($x=0; $x < mysql_num_rows($result3); $x++) {
								/* fetch participant info */
								$row = mysql_fetch_assoc($result3);
								echo "<tr>
								<td>" . $row['Position'] . "</td>
								<td>" . $row['Name'] . "</td>
								<td>" . $row['School'] . "</td>
								<td><form role=\"form\" action=\"committeeAssignments.php\" method=\"post\">
								<input type=\"hidden\" name=\"partID\" id=\"partID\" value=\"" . $row['ID'] . "\">
								<input type=\"hidden\" name=\"deleteParticipant\" id=\"deleteParticipant\" value=\"true\">
								<input class=\"btn btn-link\" type=\"submit\" value=\"Delete\">
								</form></td>
								</tr>";
							}
							echo "</tbody>";
						}
					}
					echo "</table>
					<p>Assign more participants to this committee:</p><br>
					<form role=\"form\" action=\"committeeAssignments.php\" method=\"post\">
					<select name=\"assign\">";
					/* fetch applicants */
					for ($x=0; $x<mysql_num_rows($result2); $x++) {
						$row = mysql_fetch_assoc($result2);
						/* check if applicant has been assigned already */
						$searchResults = mysql_query('SELECT * FROM PARTICIPANT_INFO WHERE Email="' . $row['Email'] . '";');
						if (mysql_num_rows($searchResults) == 0) {
							echo "<option value=\"" . $row['Email'] . "\">" . $row['Name'] . "</option>";
						}
					}
					echo "</select>&nbsp;&nbsp;&nbsp;
					<input type=\"text\" name=\"position\" id=\"position\" placeholder=\"Position\"><br><br>
					<input type=\"hidden\" name=\"committee\" id=\"committee\" value=\"" . $committees[$i] . "\">
					<input type=\"hidden\" name=\"assignParticipant\" id=\"assignParticipant\" value=\"true\">
					<input class=\"btn btn-lg btn-primary btn-block\" type=\"submit\" value=\"Submit\"><br>
					</form>";
				}
				?>
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