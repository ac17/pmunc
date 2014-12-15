<!DOCTYPE html>
<?php 
include_once('config2.php');
$errors=array();
$success=array();

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

function isDuplicate($schoolName, $committeeName, $preferenceNumber) {
	$result = mysql_query('SELECT * FROM countryPreferences WHERE school="' . $schoolName . '" AND committee="' . $committeeName 
		. '" AND preference="' . $preferenceNumber . '";');
	if (mysql_num_rows($result) > 0)
		return TRUE;
	else return FALSE;
}

if (isset($_POST['editSubmit']) && $_POST['editSubmit'] == 'true') {
	$prefCommittee = trim($_POST['com']);

	$row0 = mysql_fetch_assoc(mysql_query('SELECT * FROM SCHOOL_INFO WHERE Preferred_Email="' . $_SESSION['user']['email'] . '";'));

	$school = $row0['Name'];

	$submittedCountries = array();

	for ($i = 0; $i < 5; $i++) {
		if ($_POST['noPref']) {
			if (!isDuplicate($school,$prefCommittee,($i+1))) {
				$result = mysql_query('INSERT INTO countryPreferences set school="' . $school . '", committee="' . $prefCommittee . '", preference="' . ($i + 1) . '", country="NULL";');
				if ($result) $success['prefSubmit'] = 'Your preferences were successfully updated.';
				else $errors['prefSubmit'] = 'There was a problem updating your preferences. Please try again.';
			}
			else {
				$result = mysql_query('UPDATE countryPreferences set country="NULL" WHERE school="' . $school . '" AND committee="' . $prefCommittee . '" AND preference="' . ($i + 1) . '";');
				if ($result) $success['prefSubmit'] = 'Your preferences were successfully updated.';
				else $errors['prefSubmit'] = 'There was a problem updating your preferences. Please try again.';
			}
		} else {
			$varName = "prefCountry" . $i;
			$prefCountry = trim($_POST[$varName]);
			if (in_array($prefCountry, $submittedCountries)) { 
				$errors['prefSubmit'] = 'You cannot select the same country for more than one choice.';
				$numRepCountry = $i;
				break;
			}
			else {
				$submittedCountries[] = $prefCountry;
			}
			if (!isDuplicate($school,$prefCommittee,($i+1))) {
				$query = 'INSERT INTO countryPreferences set school="' . $school . '", committee="' . $prefCommittee . '", preference="' . ($i + 1) . '", country="' . $prefCountry . '";';
				$result = mysql_query($query);
			}
			else {
				$result = mysql_query('UPDATE countryPreferences set country="' . $prefCountry . '" WHERE school="' . $school . '" AND committee="' . $prefCommittee . '" AND preference="' . ($i + 1) . '";');
			}
		}
	}
	if (!$errors && $result) $success['prefSubmit'] = 'Your preferences were successfully updated.';
		else if (!$errors) 
			$errors['prefSubmit'] = 'There was a problem updating your preferences. Please try again.';
}

?>
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
				<h1 class="text-center">Submit Country Preferences</h1>
				<div class="horbar"></div><br>
				<p><b>Please keep in mind that although you are submitting a separate set of preferences for every committee, you will likely be assigned to only a few countries/positions across all committees.</b></p>
				<p class="invalid">Do not select a country more than once per committee.</p>
				<?php
				$prefOrder = array("1st", "2nd", "3rd", "4th", "5th");
				$query0 = 'SELECT * FROM SCHOOL_INFO WHERE Preferred_Email="' . $_SESSION['user']['email'] . '";';
				$row0 = mysql_fetch_assoc(mysql_query($query0));
				$school = $row0['Name'];
				for ($x = 0; $x < sizeof($committees); $x++) {
					echo "<h3>" . $committees[$x] . "</h3>";
                    if ($success['prefSubmit']) {
                    	if ($committees[$x] == $prefCommittee)
                        	print "<div class=\"valid\">" . $success['prefSubmit'] . "</div>";
                    }
                    if ($errors['prefSubmit']) {
                    	if ($committees[$x] == $prefCommittee)
                        	print "<div class=\"invalid\">" . $errors['prefSubmit'] . "</div>";
                    }
					echo "<form role=\"form\" action=\"submitCountryPreferences.php\" method=\"post\">
					<input type=\"checkbox\" name=\"noPref\" value=\"TRUE\"";
					$result3 = mysql_query('SELECT * FROM countryPreferences WHERE committee="' . $committees[$x] . '" AND school="'
						. $school . '" AND country="NULL";');
					if (mysql_num_rows($result3) > 0) echo " checked";
					echo "> Please check if you have no preference.<br>";
					for ($i = 0; $i < 5; $i++) {
						echo "<h4>" . $prefOrder[$i] . " Choice: ";
						$query = 'SELECT * FROM countries WHERE committee="' . $committees[$x] . '" ORDER BY country ASC;';
						$result = mysql_query($query);
						if ($result) {
							echo "<select name=\"prefCountry" . $i . "\" required>";
							while ($row = mysql_fetch_assoc($result)) {
								$query2 = 'SELECT * FROM countryPreferences WHERE committee="' . $committees[$x]
								. '" AND school="' . $school . '" AND preference="' . ($i+1) . '" AND country="' . $row['country'] . '";';
								$result2 = mysql_query($query2);
								echo "<option value=\"" . $row['country'] . "\"";
								if (mysql_num_rows($result2) > 0) {
									echo " selected";
								}
								echo ">" . $row['country'] . "</option>";
							}
							echo "</select></h4>";
						}
					}
					echo "<input type=\"hidden\" name=\"com\" value=\"" . $committees[$x] . "\">
					<input type=\"hidden\" name=\"editSubmit\" id=\"editSubmit\" value=\"true\">
					<br><input class=\"btn btn-lg btn-primary btn-block\" type=\"submit\" value=\"Submit\"><br></form>";
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
