<?php
include_once('config1.php');

if (isset($_POST['deleteSchool']) && $_POST['deleteSchool'] == 'true') {
	$ID = trim($_POST['ID']);
	$row = mysql_fetch_assoc(mysql_query('SELECT * FROM SCHOOL_INFO WHERE ID="' . $ID . '";'));
	$result1 = mysql_query('DELETE FROM SCHOOL_INFO WHERE ID="' . $ID . '";');
	$result2 = mysql_query('DELETE FROM users WHERE email="' . $row['Preferred_Email'] . '";');
	if ($result1 && $result2) {}
	else {
		die('Can\'t establish a connection to the database: ' . mysql_error());
	}
}

if (isset($_POST['acceptSchool']) && $_POST['acceptSchool'] == 'true') {
	$ID = trim($_POST['ID']);
	$row = mysql_fetch_assoc(mysql_query('SELECT * FROM SCHOOL_INFO WHERE ID="' . $ID . '";'));
	$result1 = mysql_query('UPDATE SCHOOL_INFO set WAITLIST_STATUS="FALSE" WHERE ID="' . $ID . '";');
	if ($result1) {}
	else {
		die('Can\'t establish a connection to the database: ' . mysql_error());
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
				<h1 class="text-center">Delegation Management</h1>
				<div class="horbar">
				</div><br>
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Number of Delegates</th>
							<th>Head Delegate</th>
							<th>Faculty Advisor</th>
							<th>View/Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
				<?php
				$query="SELECT * FROM SCHOOL_INFO ORDER BY Name ASC;";
				$result = mysql_query($query);
				if (!$result) echo "Could not complete query." . mysql_error();
				else {
					for ($i=0; $i<mysql_num_rows($result); $i++) {
						$row = mysql_fetch_assoc($result);
						if ($row['WAITLIST_STATUS'] != 'TRUE') {
							echo "<tr>
							<td>" . $row['Name'] . "</td>
							<td>" . $row['Num_Del'] . "</td>
							<td>" . $row['HD'] . "</td>
							<td>" . $row['FA'] . "</td>
							<td><a href=\"schoolInfo1.php?schoolNum=" . $row['ID'] . "\">View/Edit</a></td>
							<td>
								<form role=\"form\" action=\"schoolManagement.php\" method=\"post\">
								<input type=\"hidden\" name=\"deleteSchool\" id=\"deleteSchool\" value=\"true\">
								<input type=\"hidden\" name=\"ID\" id=\"ID\" value=\"" . $row['ID'] . "\">
								<input class=\"btn btn-link\" type=\"submit\" value=\"Delete\">
								</form>
							</td>
							</tr>";
						}
					}
				}
				?>
				</table>
				<h1 class="text-center">Waitlisted Schools</h1>
				<div class="horbar"></div><br>
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Number of Delegates</th>
							<th>Head Delegate</th>
							<th>Faculty Advisor</th>
							<th>View/Edit</th>
							<th>Delete</th>
							<th>Accept</th>
						</tr>
					</thead>
				<?php
				$query="SELECT * FROM SCHOOL_INFO WHERE WAITLIST_STATUS='TRUE' ORDER BY Name ASC;";
				$result = mysql_query($query);
				if (!$result) echo "Could not complete query." . mysql_error();
				else {
					for ($i=0; $i<mysql_num_rows($result); $i++) {
						$row = mysql_fetch_assoc($result);
						echo "<tr>
						<td>" . $row['Name'] . "</td>
						<td>" . $row['Num_Del'] . "</td>
						<td>" . $row['HD'] . "</td>
						<td>" . $row['FA'] . "</td>
						<td><a href=\"schoolInfo1.php?schoolNum=" . $row['ID'] . "\">View/Edit</a></td>
						<td>
							<form role=\"form\" action=\"schoolManagement.php\" method=\"post\">
							<input type=\"hidden\" name=\"deleteSchool\" id=\"deleteSchool\" value=\"true\">
							<input type=\"hidden\" name=\"ID\" id=\"ID\" value=\"" . $row['ID'] . "\">
							<input class=\"btn btn-link\" type=\"submit\" value=\"Delete\">
							</form>
						</td>
						<td>
							<form role=\"form\" action=\"schoolManagement.php\" method=\"post\">
							<input type=\"hidden\" name=\"acceptSchool\" id=\"acceptSchool\" value=\"true\">
							<input type=\"hidden\" name=\"ID\" id=\"ID\" value=\"" . $row['ID'] . "\">
							<input class=\"btn btn-link\" type=\"submit\" value=\"Accept\">
						</td>
						</tr>";
					}
				}
				?>
				</table>

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