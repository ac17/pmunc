<?php
include_once('config2.php');
$errors=array();
$success=array();

$committees = array("Mao's Yan'An Red Base",
					"Cabinet of the Republic of Liberia",
					"Ukraine in Turmoil",
					"2050 National Security Council",
					"Israel-Hamas-Fatah Joint Crisis Committee");

if (isset($_POST['fileSubmit']) && $_POST['fileSubmit'] == 'true') {
	$appName=htmlspecialchars(trim($_POST['Name']));
	$appEmail=htmlspecialchars(trim($_POST['email']));
	$appCommittee=htmlspecialchars(trim($_POST['committee']));

	$fileAllowedExts = array("doc","docx", "pdf");
	$fileTemp = explode(".", $_FILES["committeeApp"]["name"]);
	$fileExtension = end($fileTemp);

	// find if applicant has already submitted this application
	$result = mysql_query('SELECT * FROM APPLICATIONS WHERE Email="' . $appEmail 
		. '" AND Committee="' . $appCommittee . '";');

	// identify school of applicant
	$result2 = mysql_query('SELECT * FROM SCHOOL_INFO WHERE Preferred_Email="' . $_SESSION['user']['email']
		. '";');
	$row2 = mysql_fetch_assoc($result2);
	$appSchool = $row2['Name'];

	if (in_array($fileExtension,$fileAllowedExts)) {
		if ($_FILES["committeeApp"]["error"] > 0) {
			$errors['submitApp'] = $_FILES["committeeApp"]["error"];
		}
		else if (mysql_num_rows($result) > 0)
			$errors['submitApp'] = 'A participant with this email address has already submitted an application to this committee.';
		else {
			move_uploaded_file($_FILES["committeeApp"]["tmp_name"], "docs/" . $row2["ID"]
				. $_FILES["committeeApp"]["name"]);
			$appFilePath = "docs/" . $row2["ID"] . $_FILES["committeeApp"]["name"];
			$result3 = mysql_query('INSERT INTO APPLICATIONS set Name="' . $appName . '", Email="'
				. $appEmail . '", Committee="' . $appCommittee . '", Filename="' . $appFilePath
				. '", School="' . $appSchool . '";');
			if ($result3) $success['submitApp'] = 'Your application has been successfully submitted. Thank you!';
		}
	}
	else {
		$errors['submitApp'] = 'File is invalid type. ' . $fileExtension . ' ' . $_FILES["committeeApp"]["name"];
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
				<h1 class="text-center">Application Questions</h1>
				<div class="horbar"></div><br>
				<table class="table">
					<thead>
						<tr>
							<th>Committee</th>
							<th>Application</th>
						</tr>
					</thead>
				<tbody>
				<?php
				for ($i=0;$i<count($committees);$i++) {
					$committeeInfo = mysql_fetch_assoc(mysql_query('SELECT * FROM COMMITTEE_INFO WHERE Name="' . $committees[$i] . '";'));
					echo "<tr><td>" . $committees[$i] . "</td><td>";
					if ($committeeInfo['A_Filename'] == NULL) echo "<i>Not available yet.</i></td></tr>";
					else echo "<a href=\"" . $committeeInfo['A_Filename'] . "\">View Application</a></td></tr>";
				}
				?>
				</tbody>
				</table>
				<h1 class="text-center">Submitted Applications</h1>
				<div class="horbar"></div><br>
				<?php
					/* find all applications selected by this school */
					$schoolInfo = mysql_fetch_assoc(mysql_query('SELECT * FROM SCHOOL_INFO WHERE Preferred_Email="' . $_SESSION['user']['email'] . '";'));
					$schoolApps = mysql_query('SELECT * FROM APPLICATIONS WHERE School="' . $schoolInfo['Name'] . '";');
					if (mysql_num_rows($schoolApps) == 0)
						echo "<p><i>Your delegation has not submitted any applications yet.</i></p>";
					else {
						echo "<table class=\"table\"><thead><tr><th>Applicant</th><th>Committee Applied For</th>
						<th>View</th></tr></thead><tbody>";
						for ($i=0; $i<mysql_num_rows($schoolApps); $i++) {
							$rowApp = mysql_fetch_assoc($schoolApps);
							echo "<tr><td>" . $rowApp['Name'] . "</td><td>" . $rowApp['Committee'] 
							. "</td><td><a href=\"" . $rowApp['Filename'] . "\">View</a></td></tr>";
						}
						echo "</tbody></table>";
					}
				?>
				<h1 class="text-center">Submit Committee Applications</h1>
				<div class="horbar"></div><br>
				<center>Application submission is closed!</center>
				<!--
				<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post">
					<?php if ($success['submitApp']) print "<div class=\"valid\">" . $success['submitApp'] . "</div>";?>
					<h3><b>Name of applicant:</b><br><input type="text" name="Name" id="Name" required></h3>
					<h3><b>Email address of applicant:</b><br><input type="email" name="email" id="email" required></h3>
					<h3><b>Committee:</b></h3> <select name="committee" required>
						<?php
						for ($i=0;$i<count($committees);$i++)
							echo "<option value=\"" . $committees[$i] . "\">" . $committees[$i] . "</option>";
						?>
					</select>
					<h3><b>File:</b></h3><p><i>Must be either PDF, DOC, or DOCX. Cannot exceed 20 MB.</i></p>
					<?php if ($errors['submitApp']) print "<div class=\"invalid\">" . $errors['submitApp'] . "</div>";?>
					<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
					<input type="file" name="committeeApp" id="committeeApp" required><br>

                    <input type="hidden" name="fileSubmit" id="fileSubmit" value="true">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit">
				</form>
			-->
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