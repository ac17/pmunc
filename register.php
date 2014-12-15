<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
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
				<h1 class="text-center">Registration</h1>
				<div class="horbar">
				</div><br>
				<div class="alert alert-danger" role="alert">Please note that PMUNC has already reached its capacity and is only accepting registrations now for the waitlist. We apologize for the inconvenience!</div>
					<form name="registerForm" class="form-addAccount" role="form" action="enterRegistration.php" method="post">
						<h2><i>School Information</i></h2>
						<h3><b>School Name:</b> <input type="text" name="schoolName" class="form-control" required autofocus></h3>
						<h3><b>Street Address:</b> <input type="text" name="schoolAddress" class="form-control" required></h3>
						<h3><b>City:</b> <input type="text" name="schoolCity" class="form-control" required></h3>
						<h3><b>State:</b> <input type="text" name="schoolState" class="form-control"></h3>
						<h3><b>Zip Code:</b> <input type="text" name="schoolZip" class="form-control" required></h3>
						<h3><b>Country:</b> <input type="text" name="schoolCountry" class="form-control" required></h3>
						<h3><b>Phone Number:</b> <input type="tel" name="schoolTel" class="form-control" required></h3>
						<h3><b>Fax:</b> <input type="tel" name="schoolFax" class="form-control"></h3><br>

						<h2><i>Adviser/Head Delegate Information</i></h2>
						<h3><b>Head Delegate:</b> <input type="text" name="HDName" class="form-control" required></h3>
						<h3><b>Head Delegate's Email:</b></h3> 
						<p><i>Please DO NOT enter more than one email address.</i></p>
						<h3><input type="email" name="HDEmail" class="form-control" required></h3>
						<h3><b>Faculty Advisor:</b> <input type="text" name="FAName" class="form-control" required></h3>
						<h3><b>Faculty Advisor's Email:</b></h3>
						<p><i>Please DO NOT enter more than one email address.</i></p>
						<h3><input type="email" name="FAEmail" class="form-control" required></h3>
						<h3><b>Faculty Advisor's Phone Number:</b> <input type="tel" name="FATel" class="form-control" required></h3>
						<h3><b>Preferred Contact:</b><br><select name="preferred" required>
							<option value="TRUE">Head Delegate</option>
							<option value="FALSE">Faculty Advisor</option>
						</select>
						</h3>

						<h2><i>Delegation Information</i></h2>
						<h3><b>Number of delegates:</b> <input type="number" name="numDel" class="form-control" required></h3>
						<h3><b>Number of advisors:</b> <input type="number" name="numAdv" class="form-control" required></h3>

						<h2><i>Travel Information</i></h2>
						<h3><b>Method of Travel:</b></h3>
						<p>Please check all that apply.</p>
						<input type="checkbox" name="hotel" value="TRUE"> We will be staying at the hotel.<br>
						<input type="checkbox" name="flying" value="TRUE"> We will be flying to the conference.<br>
						<input type="checkbox" name="share" value="TRUE"> Please share our info with other schools to discuss travel arrangements, etc.
						<h3><b>Method of Payment:</b></h3>
						<p><i>If you're paying online, please pay <a href="https://odusapps.princeton.edu/conferences/index.php"><font color="#F58025">here</font></a>.</i></p>
						<select name="payment" required>
						<option value="TRUE">Online</option>
						<option value="FALSE">Check</option>
						</select>

						<h2><i>Other</i></h2>
						<input type="checkbox" name="first" value="first"> Please check if this is the first time your school is attending PMUNC.<br><br>
<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
<input type="text" name="captcha_code" size="10" maxlength="6" />
<a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a><br>
						<input type="hidden" name="registerSubmit" id="registerSubmit" value="true">
						<input class="btn btn-lg btn-primary btn-block" type="submit" value="Create Account">
					</form>
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
