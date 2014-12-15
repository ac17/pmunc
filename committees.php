<!DOCTYPE html>
<?php
	$mysqli = new mysqli("localhost", "modelun", "flp5WxQGTJgk", "modelun_pmunc2014");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
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

	<!-- SMOOTH SCROLL -->
	<script src="js/smooth-scroll.js"></script>

	<!-- GOOGLE FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Quicksand:400,300,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Neuton:300,400,700,400italic' rel='stylesheet' type='text/css'>

	<!-- Custom CSS -->
	<link href="css/index.css" rel="stylesheet">
	<link href="css/committees.css" rel="stylesheet">

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
					<li class = "active"><a href="committees.php">Committees</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="https://www.facebook.com/PrincetonModelUnitedNationsConference2014"><i class="fa fa-facebook"></i></a></li>
					<li><a href="http://irc.princeton.edu/"><i class="fa fa-globe"></i></a></li>
					<li><a href="mailto:pmunc@princeton.edu?Subject=PMUNC"><i class="fa fa-envelope"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- JUMBOTRON -->
	<div class="jumbotron committees">
		<div class="container">
			<h1 class="banner-inverted"><font color="white">Committees</font></h1>
		</div>
	</div>
	<!--
	================================================== -->
	<!-- Body of page (centered). -->

	<div class="container marketing" id="committees-container">
		<div class="container">
			<center><div class="btn-group">
				<button type="button" class="btn btn-default"><a data-scroll data-options="easing: easeInOutQuad" href="#ga">General Assembly</a></button>
				<button type="button" class="btn btn-default"><a data-scroll data-options="easing: easeInOutQuad" href="#specialized">Specialized</a></button>
				<button type="button" class="btn btn-default"><a data-scroll data-options="easing: easeInOutQuad" href="#crisis">Crisis</a></button>
			</div><br><br>
			Click on each committee's image for more information!</center><br>
			<a id="ga"></a>
			<h1 class="text-center">General Assembly</h1>
			<div class="horbar">
			</div><br>
			<div class="row">
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/SPECPOL.jpg" data-toggle="modal" data-target="#nathanInfo">
						<div class="modal fade" id="nathanInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">Special Political and Decolonization Committee</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='nathanle@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Nathan Eckstein</h1>
							<h4 class="text-center">Special Political and Decolonization Committee</h4>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/DISEC.png" data-toggle="modal" data-target="#harveyInfo">
						<div class="modal fade" id="harveyInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">Disarmament and International Security</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
										<?php
										$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='hcren@princeton.edu';";
										$result = $mysqli->query($query);
										if (!$result) echo "Could not perform query. " . mysql_error();
										$row = $result->fetch_row();
										if ($row[7] != NULL)
											echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
										else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
										echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
										<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
										<h4><b>Bio:</b> " . $row[6] . "</h4>";
										if ($row[8] != NULL) echo
										"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
										if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
										else
											echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
										if ($row[5] != NULL)
											echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
										$result->close();
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Harvey Ren</h1>
							<h4 class="text-center">Disarmament and International Security</h4>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/SC.png" data-toggle="modal" data-target="#hammadInfo">
						<div class="modal fade" id="hammadInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">Security Council</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='maslam@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Hammad Aslam</h1>
							<h4 class="text-center">Security Council</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/WHO.png" data-toggle="modal" data-target="#joyceInfo">
						<div class="modal fade" id="joyceInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">World Health Organization</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='jclee@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Joyce Lee</h1>
							<h4 class="text-center">World Health Organization</h4>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/UNHCR.jpg" data-toggle="modal" data-target="#marniInfo">
						<div class="modal fade" id="marniInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">High Commissioner for Refugees</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='mlmorse@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Marni Morse</h1>
							<h4 class="text-center">High Commissioner for Refugees</h4>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/UNODC.jpg" data-toggle="modal" data-target="#jonathanInfo">
						<div class="modal fade" id="jonathanInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">Office on Drugs and Crime</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='liebmanj@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Jonathan Liebman</h1>
							<h4 class="text-center">Office on Drugs and Crime</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/HRC.jpg" data-toggle="modal" data-target="#hannaInfo">
						<div class="modal fade" id="hannaInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">Human Rights Council</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='bjd5@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Benjamin Dinovelli</h1>
							<h4 class="text-center">Human Rights Council</h4>
						</div>
					</div>
				</div>
			</div>
			<a id="specialized"></a>
			<h1 class="text-center">Specialized</h1>
			<div class="horbar">
			</div><br>
			<div class="row">
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/WB.jpg" data-toggle="modal" data-target="#adamInfo">
						<div class="modal fade" id="adamInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">World Bank</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='atcharni@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Adam Tcharni</h1>
							<h4 class="text-center">World Bank</h4>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/PPC.jpg" data-toggle="modal" data-target="#neilInfo">
						<div class="modal fade" id="neilInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">Paris Peace Conference</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='rangwani@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Neil Rangwani</h1>
							<h4 class="text-center">Paris Peace Conference</h4>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/AL.png" data-toggle="modal" data-target="#danInfo">
						<div class="modal fade" id="danInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">Arab League</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='dwkang@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Daniel Kang</h1>
							<h4 class="text-center">Arab League</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/OAS.jpg" data-toggle="modal" data-target="#jonwuInfo">
						<div class="modal fade" id="jonwuInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">Organization of American States</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='jw21@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Jonathan Wu</h1>
							<h4 class="text-center">Organization of American States</h4>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/ICC.png" data-toggle="modal" data-target="#aaronInfo">
						<div class="modal fade" id="aaronInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">International Criminal Court</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='adhauptm@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Aaron Hauptman</h1>
							<h4 class="text-center">International Criminal Court</h4>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/ASEAN.jpg" data-toggle="modal" data-target="#erikInfo">
						<div class="modal fade" id="erikInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">Association of Southeast Asian Nations</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='emaritz@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Erik Maritz</h1>
							<h4 class="text-center">Association of Southeast Asian Nations</h4>
						</div>
					</div>
				</div>
			</div>
			<a id="crisis"></a>
			<h1 class="text-center">Crisis</h1>
			<div class="horbar">
			</div><br>
			<div class="row">
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/Yanan.jpg" data-toggle="modal" data-target="#dantaubInfo">
						<div class="modal fade" id="dantaubInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">Mao's Yan'An Red Base</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='dtaub@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Daniel Taub</h1>
							<h4 class="text-center">Mao's Yan'An Red Base</h4>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/Liberia.png" data-toggle="modal" data-target="#estherInfo">
						<div class="modal fade" id="estherInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">Cabinet of the Republic of Liberia</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='emaddox@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Esther Maddox</h1>
							<h4 class="text-center">Cabinet of the Republic of Liberia</h4>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/Ukraine.jpg" data-toggle="modal" data-target="#jacobInfo">
						<div class="modal fade" id="jacobInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">Ukraine in Turmoil</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='jsackett@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Jacob Sackett-Sanders</h1>
							<h4 class="text-center">Ukraine in Turmoil</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/NSC.jpg" data-toggle="modal" data-target="#TJInfo">
						<div class="modal fade" id="TJInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">2050 National Security Council</h1>
									<div class="horbar">
									</div><br>
									<div class="container">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='tjs7@princeton.edu';";
									$result = $mysqli->query($query);
									if (!$result) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" width=\"25%\" class=\"chair\">";
									else echo "<img src=\"img/default.jpg\" width=\"25%\" class=\"chair\">";
									echo "<h4><b>Committee Chair:</b> " . $row[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a></h4>
									<h4><b>Bio:</b> " . $row[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">TJ Smith</h1>
							<h4 class="text-center">2050 National Security Council</h4>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="img/IHF.jpg" data-toggle="modal" data-target="#jointInfo">
						<div class="modal fade" id="jointInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<h1 class="text-center">Israel-Hamas-Fatah Joint Crisis Committee</h1>
									<div class="horbar">
									</div><br>
									<div class="container" id="multiple">
									<?php
									$query = "SELECT * FROM COMMITTEE_INFO WHERE Email='ebackman@princeton.edu';";
									$query2 = "SELECT * FROM COMMITTEE_INFO WHERE Email='lsaud@princeton.edu';";
									$query3 = "SELECT * FROM COMMITTEE_INFO WHERE Email='naomilee@princeton.edu';";
									$result = $mysqli->query($query);
									$result2 = $mysqli->query($query2);
									$result3 = $mysqli->query($query3);
									if (!$result) echo "Could not perform query. " . mysql_error();
									if (!$result2) echo "Could not perform query. " . mysql_error();
									if (!$result3) echo "Could not perform query. " . mysql_error();
									$row = $result->fetch_row();
									$row2 = $result2->fetch_row();
									$row3 = $result3->fetch_row();
									echo "<table width=50%><tr><td width=100% height=150px>";
									if ($row[7] != NULL)
										echo "<img src=\"" . $row[7] . "\" height=100%></td>";
									else echo "<img src=\"img/default.jpg\" height=100%></td>";
									if ($row2[7] != NULL)
										echo "<td width=100% height=150px><img src=\"" . $row2[7] . "\" height=100%></td>";
									else echo "<td width=100% height=150px><img src=\"img/default.jpg\" height=100%></td>";
									if ($row3[7] != NULL)
										echo "<td width=100% height=150px><img src=\"" . $row3[7] . "\" height=100%></td></tr></table>";
									else echo "<td width=100% height=150px><img src=\"img/default.jpg\" height=100%></td></tr></table>";
									echo "<h4><b>Committee Chairs:</b> " . $row[1] . ", " . $row2[1] . ", and " . $row3[1] . "</h4>
									<h4><b>Email:</b> <a href=\"mailto:" . $row[2] . "\">" . $row[2] . "</a>, <a href=\"mailto:" . 
									$row2[2] . "\">" . $row2[2] . "</a>, <a href=\"mailto:" . $row3[2] . "\">" . $row3[2] . "</a></h4>
									<h4><b>Elise's Bio:</b> " . $row[6] . "</h4>
									<h4><b>Lina's Bio:</b> " . $row2[6] . "</h4>
									<h4><b>Naomi's Bio:</b> " . $row3[6] . "</h4>";
									if ($row[8] != NULL) echo
									"<h4><b>Topic Description:</b> " . $row[8] . "</h4>";
									if ($row[4] == NULL) echo "<b>The background guide is not yet available.</b>";
									else
										echo "<h4><b>Background Guide:</b> <a href=\"" . $row[4] . "\"> Download Here</a></h4>";
									if ($row[5] != NULL)
										echo "<h4><b>Committee Application:</b> <a href=\"" . $row[5] . "\"> Download Here</a></h4>";
									$result->close();
									
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="caption">
							<h1 class="text-center">Elise Backman, Lina Saud, and Naomi Lee</h1>
							<h4 class="text-center">Israel-Hamas-Fatah Joint Crisis Committee</h4>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- FOOTER -->
	<div class="container container-footer">
		<div class="container">
			<footer>
				<p class="pull-right">Designed by Angelica Chen &amp; Clement Lee &middot; <a href="#">Back to top</a></p>
				<p class="pull-left">&copy; 2014 Princeton Model United Nations Conference </p>
			</footer>
		</div>
	</div>


	<!-- INITIALIZE Bootstrap -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<!-- INITIALIZE SMOOTH SCROLL -->
	<script>
		smoothScroll.init();
	</script>
</body>
</html>

