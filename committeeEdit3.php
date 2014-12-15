<!DOCTYPE html>
<?php 
include_once('config3.php');
$errors=array();
$success=array();

if (isset($_POST['editSubmit']) && $_POST['editSubmit'] == 'true') {
	$newBio = mysql_real_escape_string(trim($_POST['bio']));
	$newDesc = mysql_real_escape_string(trim($_POST['topic']));
	$tempDir = sys_get_temp_dir();
	
	$query0 = "SELECT * FROM COMMITTEE_INFO WHERE Email=\"" . $_SESSION['user']['email'] . "\";";
	$result=mysql_query($query0);
	if (!$result) echo "Could not perform query. " . mysql_error();
	$row = mysql_fetch_assoc($result);
	$oldEmail = $row['Email'];
	$oldProfPic = $row['P_Filename'];
	$oldBG = $row['BG_Filename'];
	$oldCA = $row['A_Filename'];
		
	if (strlen($newBio) > 4000)
		$errors['newBio'] = 'Your bio cannot be longer than 4000 characters.';

	if (strlen($newDesc) > 20000)
		$errors['newDesc'] = 'Your topic description cannot be longer than 8000 characters.';
	
	$ppAllowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["profilePhoto"]["name"]);
	$extension = end($temp);

	$BGAllowedExts = array("doc", "docx", "pdf");
	$BGtemp = explode(".", $_FILES["backgroundGuide"]["name"]);
	$BGextension = end($BGtemp);

	$CAAllowedExts = array("doc","docx", "pdf");
	$CAtemp = explode(".", $_FILES["committeeApp"]["name"]);
	$CAextension = end($CAtemp);

if (empty($_FILES["profilePhoto"]["name"])) {
	$profFile = $oldProfPic;
	if ($profFile == "img/") $profFile = NULL;
}
else {
	if ((($_FILES["profilePhoto"]["type"] == "image/gif")
|| ($_FILES["profilePhoto"]["type"] == "image/jpeg")
|| ($_FILES["profilePhoto"]["type"] == "image/jpg")
|| ($_FILES["profilePhoto"]["type"] == "image/pjpeg")
|| ($_FILES["profilePhoto"]["type"] == "image/x-png")
|| ($_FILES["profilePhoto"]["type"] == "image/png"))
&& ($_FILES["profilePhoto"]["size"] < 20000000)
&& in_array($extension, $ppAllowedExts)) {
  if ($_FILES["profilePhoto"]["error"] > 0) {
    $errors['newProfilePhoto'] = $_FILES["profilePhoto"]["error"];
  } else {
    if (file_exists(sys_get_temp_dir() . "/" . $_FILES["profilePhoto"]["name"])) {
      $errors['newProfilePhoto'] = $_FILES["profilePhoto"]["name"] . " already exists. ";
    } else {
      move_uploaded_file($_FILES["profilePhoto"]["tmp_name"],
      "img/" . $_FILES["profilePhoto"]["name"]);
      $profFile = "img/" . $_FILES["profilePhoto"]["name"];
    }
  }
} else {
  $errors['newProfilePhoto'] = 'Invalid file type.';
} }

if (empty($_FILES["backgroundGuide"]["name"])) {
	$BG = $oldBG;
}
else {
	if (in_array($BGextension, $BGAllowedExts)) {
		if ($_FILES["backgroundGuide"]["error"] > 0) {
			$errors['newBackgroundGuide'] = $_FILES["backgroundGuide"]["error"];
		}
		else {
			move_uploaded_file($_FILES["backgroundGuide"]["tmp_name"], "docs/"
				. $_FILES["backgroundGuide"]["name"]);
			$BG = "docs/" . $_FILES["backgroundGuide"]["name"];
		}
	}
	else
		$errors['newBackgroundGuide'] = 'Invalid file type.';
}

if (empty($_FILES["committeeApp"]["name"])) {
	$CA = $oldCA;
}
else {
	if (in_array($CAextension, $CAAllowedExts)) {
		if ($_FILES["committeeApp"]["error"] > 0) {
			$errors['newCommitteeApp'] = $_FILES["committeeApp"]["error"];
		}
		else {
			move_uploaded_file($_FILES["committeeApp"]["tmp_name"], "docs/"
				. $_FILES["committeeApp"]["name"]);
			$CA = "docs/" . $_FILES["committeeApp"]["name"];
		}
	}
	else
		$errors['newCommitteeApp'] = 'Invalid file type.';
}

	$query1 = 'UPDATE COMMITTEE_INFO SET bio="' . $newBio . '", P_Filename="' . $profFile . '", A_Filename="' . $CA . '"  WHERE Email="' . $oldEmail . '";';
	$query2 = 'UPDATE COMMITTEE_INFO SET description="' . $newDesc . '", BG_Filename="' . $BG . '" WHERE Name="' . mysql_real_escape_string($row['Name']) . '";';
	if (!$errors) {
        if (mysql_query($query1) && mysql_query($query2)) {
            $success['editCommitteeInfo'] = 'Your committee information was updated.';
        }
        else {
            $errors['editCommitteeInfo'] = 'There was a problem updating the information. Please try again.';
        }
    }
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
				<?php
				$query = "SELECT * FROM COMMITTEE_INFO WHERE Email=\"" . $_SESSION['user']['email'] . "\";";
				$result=mysql_query($query);
				if (!$result) echo "Could not perform query. " . mysql_error();
				$row = mysql_fetch_assoc($result);
				?>
				<h1 class="text-center"><?php echo $row['Name']; ?></h1>
				<div class="horbar">
				</div><br>
				<h3><b>Your Email</b>: <?php echo $row['Email']; ?></h3>
				<h3><b>Your Bio</b>:</h3> <p><?php echo $row['bio']; ?></p>
				<h3><b>Your Topic Description</b>:</h3> <p><?php echo $row['description']; ?></p>
				<h3><b>Your Photo</b>:</h3>
				<?php
				if ($row['P_Filename'] == NULL) echo "<p><i>No image has been uploaded.</i></p><br>"; 
				else echo "<img src=\"" . $row['P_Filename'] . "\" width=\"25%\"><br>";
				?>
				<h3><b>Your Background Guide</b>:</h3>
					<?php
					if ($row['BG_Filename'] == NULL) echo "<p><i>No background guide has been uploaded.</i></p>";
					else echo "<a href=\"" . $row['BG_Filename'] . "\">Download Here</a>";
					?>
				</h3>
				<h3><b>Your Committee Application</b>:</h3>
				<?php
				if ($row['A_Filename'] == NULL) echo "<p><i>No committee application has been uploaded.</i></p>";
				else echo "<a href=\"" . $row['A_Filename'] . "\">Download Here</a>";
				?>
				<h1 class="text-center">Edit Your Committee Info</h1>
				<div class="horbar"></div><br>
				<form name="editForm" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post">
                    <?php
                    if ($success['editCommitteeInfo'])
                        print "<div class=\"valid\">" . $success['editCommitteeInfo'] . "</div>";
                    if ($errors['editCommitteeInfo'])
                        print "<div class=\"invalid\">" . $errors['editCommitteeInfo'] . "</div>";
                    ?>
					<h3><b>New bio</b>:</h3><p>Maximum length of 4000 characters.</p>
					<?php if ($errors['newBio']) print "<div class=\"invalid\">" . $errors['newBio'] . "</div>"; ?>
					<textarea width=100% name="bio" class="form-control" maxlength=4000><?php echo $row['bio']; ?></textarea>
					<h3><b>New topic description</b>:</h3>
					<?php if ($errors['newDesc']) print "<div class=\"invalid\">" . $errors['newDesc'] . "</div>"; ?>
					<textarea width=100% name="topic" class="form-control" maxlength=20000><?php echo $row['description']; ?></textarea>
					<h3><b>New photo</b>:</h3><p>The photo must be either a GIF, JPG, or PNG. Maximum file size is 20 MB.</p>
					<?php if ($errors['newProfilePhoto']) print "<div class=\"invalid\">" . $errors['newProfilePhoto'] . "</div>";?>
					<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
					<input type="file" name="profilePhoto" id="profilePhoto"><br>
					<h3><b>New background guide</b>:</h3><p>The document must be either a DOC, DOCX, or PDF. Maximum file size is 20 MB.</p>
					<?php if ($errors['newBackgroundGuide']) print "<div class=\"invalid\">" . $errors['newBackgroundGuide'] . "</div>";?>
					<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
					<input type="file" name="backgroundGuide" id="backgroundGuide"><br>
					<h3><b>New committee application</b>:</h3><p>The document must be either a DOC, DOCX, or PDF. Maximum file size is 20 MB.</p>
					<?php if ($errors['newCommitteeApp']) print "<div class=\"invalid\">" . $errors['newCommitteeApp'] . "</div>";?>
					<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
					<input type="file" name="committeeApp" id="committeeApp"><br>

                    <input type="hidden" name="editSubmit" id="editSubmit" value="true">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit">
                </form><br>
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
