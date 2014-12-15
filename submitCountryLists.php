<!DOCTYPE html>
<?php 
include_once('config1.php');
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

if (isset($_POST['editSubmit']) && $_POST['editSubmit'] == 'true') {
	$rawCountries = trim($_POST['newCountries']);
	$newCountries = explode(",", $rawCountries);
	$index = (int) trim($_POST['comIndex']);
	for ($x = 0; $x < sizeof($newCountries); $x++) {
		$query = 'INSERT INTO countries set country="' . trim($newCountries[$x])
		. '", committee="' . $committees[$index] . '";';
		$result = mysql_query($query);
		if ($result) $success['addCountry'] = 'The countries were successfully added.';
		else $errors['addCountry'] = 'There was a problem adding those countries. Please try again.';
	}
}

if (isset($_POST['deleteRep']) && $_POST['deleteRep'] == 'true') {
	$ctry = trim($_POST['deleteCountry']);
	$com = trim($_POST['deleteCommittee']);
	$query = 'DELETE FROM countries WHERE country="' . $ctry . '" AND committee="' . $com . '";';
	$result = mysql_query($query);
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
				<h1 class="text-center">Submit Country Lists</h1>
				<div class="horbar"></div><br>
				<center><p><i>Click the name of a committee to see its list of countries.</i></p></center>
				<?php
				for ($x = 0; $x < sizeof($committees); $x++) {
					echo "<h3><a data-toggle=\"collapse\" data-target=\"#" . $x . "\">" . $committees[$x] . "</a></h3>
					<div id=\"" . $x . "\" class=\"collapse\">";
					if ($success['addCountry'] && $index == $x)
					    print "<div class=\"valid\">" . $success['addCountry'] . "</div>";
					if ($errors['addCountry'] && $index == $x)
					    print "<div class=\"invalid\">" . $errors['addCountry'] . "</div>";
					$query = 'SELECT * FROM countries WHERE committee="' . $committees[$x] . '" ORDER BY country ASC;';
					$result = mysql_query($query);
					if ($result) {
						if (mysql_num_rows($result) == 0) echo "No countries have been added to this committee yet.<br>";
						else {
							echo "<table class=\"table\"><thead><tr><th>Country</th><th>Delete from List</th></tr></thead>";
							while ($row = mysql_fetch_assoc($result)) {
								echo "<tr><td>" . $row['country'] . "</td><td><form role=\"form\" action=\"submitCountryLists.php\" method=\"post\">
								<input type=\"hidden\" name=\"deleteCountry\" value=\"" . $row['country'] . "\">
								<input type=\"hidden\" name=\"deleteCommittee\" value=\"" . $committees[$x] . "\">
								<input type=\"hidden\" name=\"deleteRep\" id=\"deleteRep\" value=\"true\">
								<input class=\"btn btn-link\" type=\"submit\" value=\"Delete\">
								</form></td></tr>";
							}
							echo "</table>";
						}
					}
					echo "<form name=\"editForm\" role=\"form\" action=\"submitCountryLists.php\" method=\"post\">";
                    echo <<<addCountry
					<p><i>If you'd like to add more countries to this committee, please list them in the text box below, using commas to separate the countries (e.g. "Australia, US").</i></p>
					<textarea name="newCountries" width="100%" class="form-control" maxlength="5000" required></textarea><br>
					<input type="hidden" name="comIndex" value="$x">
					<input type="hidden" name="editSubmit" id="editSubmit" value="true">
					<input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit"><br>
					</form></div>
addCountry;
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
