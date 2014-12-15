<?php
include_once('config1.php');
$errors=array();
$success=array();
$ID = $_GET['schoolNum'];

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

if (isset($_POST['registerSubmit']) && $_POST['registerSubmit'] == 'true') {
	$result = mysql_query('SELECT * FROM SCHOOL_INFO WHERE ID=' . $ID . ';');
	$row = mysql_fetch_assoc($result);
	$schoolName = mysql_real_escape_string(trim($_POST['schoolName']));
	$schoolAddress = mysql_real_escape_string(trim($_POST['schoolAddress']));
	$schoolCity = mysql_real_escape_string(trim($_POST['schoolCity']));
	$schoolState = mysql_real_escape_string(trim($_POST['schoolState']));
	$schoolZip = mysql_real_escape_string(trim($_POST['schoolZip']));
	$schoolCountry = mysql_real_escape_string(trim($_POST['schoolCountry']));
	$schoolTel = mysql_real_escape_string(trim($_POST['schoolTel']));
	$schoolFax = mysql_real_escape_string(trim($_POST['schoolFax']));
	$FAName = mysql_real_escape_string(trim($_POST['FAName']));
	$FAEmail = mysql_real_escape_string(trim($_POST['FAEmail']));
	$HDName = mysql_real_escape_string(trim($_POST['HDName']));
	$HDEmail = mysql_real_escape_string(trim($_POST['HDEmail']));
	$FATel = mysql_real_escape_string(trim($_POST['FATel']));
	
	if (trim($_POST['preferred']) == 'TRUE')
			$preferred = '1';
		else
			$preferred = '0';
		$numDel = (int) trim($_POST['numDel']);
		$numAdv = (int) trim($_POST['numAdv']);
		if (trim($_POST['hotel']) == 'TRUE')
			$hotel = '1';
		else
			$hotel = '0';
		if (trim($_POST['flying']) == 'TRUE')
			$flying = '1';
		else
			$flying = '0';
		if (trim($_POST['share']) == 'TRUE')
			$share = '1';
		else
			$share = '0';
		$payment = trim($_POST['payment']);
		if (trim($_POST['first']) == 'TRUE')
			$first = '1';
		else
			$first = '0';
		
		if ($preferred) {
			$preferredEmail = $HDEmail;
			$preferredContact = $HDName;
		}
		else {
			$preferredEmail = $FAEmail;
			$preferredContact = $FAName;
		}

	$query1 = 'UPDATE SCHOOL_INFO set Name="' . $schoolName . '", Address="' . $schoolAddress
	. '", City="' . $schoolCity . '", State="' . $schoolState . '", Zip="' . $schoolZip
	. '", Country="' . $schoolCountry . '", Phone="' . $schoolTel . '", Fax="' . $schoolFax
	. '", HD="' . $HDName . '", HD_Email="' . $HDEmail . '", FA="' . $FAName . '", FA_Email="'
	. $FAEmail . '", FA_Cell="' . $FATel . '", PC="' . $preferred . '", Num_Del="'
	. $numDel . '", Num_Adv="' . $numAdv . '", Hotel="' . $hotel . '", Flying="' . $flying
	. '", Payment="' . $payment . '", firstTime="' . $first . '", Preferred_Email="' . $preferredEmail 
	. '", Share="' . $share . '" WHERE ID="' . $ID . '";';

	$query2 = 'UPDATE users set email="' . $preferredEmail . '", first_name="' . $preferredContact
	. '" WHERE email="' . $row['Preferred_Email'] . '";';

	if(mysql_query($query1) && mysql_query($query2)) {
		$success['register'] = 'The delegation\'s information has been updated.';
	}
	else {
		$errors['register'] = 'There was a problem updating the information. Please check your details and try again.';
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
				<h1 class="text-center">Edit Delegation Information</h1>
				<div class="horbar"></div><br>
				<form role="form" action="<?php echo 'schoolInfo1.php?schoolNum=' . $ID; ?>" method="post">
					<?php
					$query0 = 'SELECT * FROM SCHOOL_INFO WHERE ID="' . $ID . '";';
					$row = mysql_fetch_assoc(mysql_query($query0));
					$query2 = 'SELECT * FROM countryPreferences WHERE school="' . $row['Name'] . '";';
					$result2 = mysql_query($query2);
					if (mysql_num_rows($result2) > 0) {
						echo "<h2><i>Submitted Country Preferences</i></h2>";
						for ($x = 0; $x < count($committees); $x++) {
							echo "<h4>" . $committees[$x] . "</h4>";
							$ranks = array('1st','2nd','3rd','4th','5th');
							for ($y = 1; $y <= 5; $y++) {
								$result3 = mysql_query('SELECT * FROM countryPreferences WHERE school="'
									. $row['Name'] . '" AND committee="' . $committees[$x] . '" AND preference=' . $y . ';');
								if (mysql_num_rows($result3) == 0) {
									echo "<p>No preferences have been submitted for this committee.</p>";
									break;
								}
								else {
									$row3 = mysql_fetch_assoc($result3);
									if ($row3['country'] == 'NULL') {
										echo "<p>No preference.</p>";
										break;
									}
									else {
										if ($y == 1) echo "<ol>";
										echo "<li>" . $row3['country'] . "</li>";
										if ($y == 5) echo "</ol>";
									}
								}
							}
						}
					}
					?>
					<h2><i>School Information</i></h2>
					<?php
					if ($success['register'])
						print "<div class=\"valid\">" . $success['register'] . "</div>";
					if ($errors['register'])
						print "<div class=\"invalid\">" . $errors['register'] . "</div>";
					if ($row['Registration_Date'] != NULL)
						echo "<h3><b>Registration Date/Time:</b> " . $row['Registration_Date'] . "</h3>";
					?>
						<h3><b>School Name:</b> <input type="text" name="schoolName" class="form-control" value="<?php echo $row['Name']; ?>" required autofocus></h3>
						<h3><b>Street Address:</b> <input type="text" name="schoolAddress" class="form-control" value="<?php echo $row['Address']; ?>" required></h3>
						<h3><b>City:</b> <input type="text" name="schoolCity" class="form-control" value="<?php echo $row['City']; ?>" required></h3>
						<h3><b>State:</b> <input type="text" name="schoolState" value="<?php echo $row['State']; ?>" class="form-control"></h3>
						<h3><b>Zip Code:</b> <input type="text" name="schoolZip" class="form-control" value="<?php echo $row['Zip']; ?>" required></h3>
						<h3><b>Country:</b> <input type="text" name="schoolCountry" class="form-control" value="<?php echo $row['Country']; ?>" required></h3>
						<h3><b>Phone Number:</b> <input type="tel" name="schoolTel" class="form-control" value="<?php echo $row['Phone']; ?>" required></h3>
						<h3><b>Fax:</b> <input type="tel" name="schoolFax" class="form-control" value="<?php echo $row['Fax']; ?>"></h3><br>

						<h2><i>Adviser/Head Delegate Information</i></h2>
						<h3><b>Head Delegate:</b> <input type="text" name="HDName" class="form-control" value="<?php echo $row['HD']; ?>" required></h3>
						<h3><b>Head Delegate's Email:</b> <input type="email" name="HDEmail" class="form-control" value="<?php echo $row['HD_Email']; ?>" required></h3>
						<h3><b>Faculty Advisor:</b> <input type="text" name="FAName" class="form-control" value="<?php echo $row['FA']; ?>" required></h3>
						<h3><b>Faculty Advisor's Email:</b> <input type="email" name="FAEmail" class="form-control" value="<?php echo $row['FA_Email']; ?>" required></h3>
						<h3><b>Faculty Advisor's Phone Number:</b> <input type="tel" name="FATel" class="form-control" value="<?php echo $row['FA_Cell']; ?>" required></h3>
						<h3><b>Preferred Contact:</b><br><select name="preferred" required>
							<option value="TRUE" <?php if ($row['PC']) echo "selected";?> >Head Delegate</option>
							<option value="FALSE" <?php if (!$row['PC']) echo "selected";?> >Faculty Advisor</option>
						</select>
						</h3>

						<h2><i>Delegation Information</i></h2>
						<h3><b>Number of delegates:</b> <input type="number" name="numDel" class="form-control" value="<?php echo $row['Num_Del']; ?>" required></h3>
						<h3><b>Number of advisors:</b> <input type="number" name="numAdv" class="form-control" value="<?php echo $row['Num_Adv']; ?>" required></h3>

						<h2><i>Travel Information</i></h2>
						<h3><b>Method of Travel:</b></h3>
						<p>Please check all that apply.</p>
						<input type="checkbox" name="hotel" value="TRUE" <?php if ($row['Hotel']) echo "checked"; ?> > We will be staying at the hotel.<br>
						<input type="checkbox" name="flying" value="TRUE" <?php if ($row['Flying']) echo "checked"; ?> > We will be flying to the conference.<br>
						<input type="checkbox" name="share" value="TRUE" <?php if ($row['Share']) echo "checked"; ?> > Please share our info with other schools to discuss travel arrangements, etc.
						<h3><b>Method of Payment:</b></h3><select name="payment" required>
						<option value="TRUE" <?php if ($row['Payment']) echo "selected"; ?> >Online</option>
						<option value="FALSE" <?php if (!$row['Payment']) echo "selected"; ?> >Check</option>
						</select>

						<h2><i>Other</i></h2>
						<input type="checkbox" name="first" value="TRUE" <?php if ($row['firstTime']) echo "checked"; ?> > Please check if this is the first time your school is attending PMUNC.<br><br>

						<input type="hidden" name="registerSubmit" id="registerSubmit" value="true">
						<input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit">
				</form><br>
				<center>
					<a href="schoolManagement.php"><button type="button" class="btn btn-link">Back to School Management</button></a><br>
					<a href="dashboard.php"><button type="button" class="btn btn-link">Back to Dashboard</button></a>
				</center>
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