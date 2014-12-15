<?php
// start session
session_start();

include_once('securimage/securimage.php');
$securimage = new Securimage();


// link to database
$dbLink = mysql_connect('localhost', 'modelun', 'flp5WxQGTJgk');
if (!$dbLink)
        die('Can\'t establish a connection to the database: ' . mysql_error());

$dbSelected = mysql_select_db('modelun_pmunc2014', $dbLink);
if (!$dbSelected)
        die('Connected, but table is inaccessible: ' . mysql_error());

function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min;
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
}

function getToken($length){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    for($i=0;$i<$length;$i++){
        $token .= $codeAlphabet[crypto_rand_secure(0,strlen($codeAlphabet))];
    }
    return $token;
}

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
	if (trim($_POST['preferred']) == 'TRUE') {
		$preferred = '1';
		$preferredEmail = $HDEmail;
		$preferredContact = $HDName;
	}
	else {
		$preferred = '0';
		$preferredEmail = $FAEmail;
		$preferredContact = $FAName;
	}
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

if ($securimage->check($_POST['captcha_code']) == false) {
echo "The security code entered was incorrect.<br /><br />";
  echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
  exit;
}


	$result0 = mysql_query('SELECT * FROM users WHERE email="' . $preferredEmail . '";');
	if (mysql_num_rows($result0) > 0) 
		$errors['duplicate'] = 'A registration and user account with this email address already exists in our database.';
	else {
		$query1 = 'INSERT INTO SCHOOL_INFO set Name="' . $schoolName . '", Address="' . $schoolAddress
		. '", City="' . $schoolCity . '", State="' . $schoolState . '", Zip="' . $schoolZip
		. '", Country="' . $schoolCountry . '", Phone="' . $schoolTel . '", Fax="' . $schoolFax
		. '", HD="' . $HDName . '", HD_Email="' . $HDEmail . '", FA="' . $FAName . '", FA_Email="'
		. $FAEmail . '", FA_Cell="' . $FATel . '", PC="' . $preferred . '", Num_Del="'
		. $numDel . '", Num_Adv="' . $numAdv . '", Hotel="' . $hotel . '", Flying="' . $flying
		. '", Payment="' . $payment . '", firstTime="' . $first . '", Preferred_Email="' . $preferredEmail . '", Share="' . $share . '"
		, WAITLIST_STATUS="TRUE", Registration_Date=NOW();';

		$pw = getToken(8);

		$query2 = 'INSERT INTO users set email="' . $preferredEmail . '", first_name="' . $preferredContact
		. '", password=MD5("' . $pw . '"), user_type=2;';

		$message = "Hello,\n\n Thanks for registering for PMUNC 2014! Unfortunately our conference is already full, so your delegation has been placed on our waitlist. However, you can still access your account  on the Princeton Model United Nations Website (irc.princeton.edu/pmunc/signin.php) and edit your information. Your username is your email address and your password is " . $pw . ". You may login at irc.princeton.edu/pmunc/signin.php. If your waitlist status changes, we will contact you again. Until such time, please do not worry about paying delegation fees.\n\n Sincerely,\n Your PMUNC Webmasters";

		$mail = mail($preferredEmail,"Your PMUNC Account",$message);

		if(mysql_query($query1) && mysql_query($query2) && $mail) {
			$success['register'] = 'Thank you for registering for PMUNC 2014. Your account info has been emailed to the preferred contact.';
		}
		else {
			$errors['register'] = 'There was a problem registering you. Please check your details and try again.';
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
				<h1 class="text-center">Thank You!</h1>
				<div class="horbar">
				</div><br>
				<center>
					<?php
					if ($errors['duplicate']) 
						print "<div class=\"invalid\">" . $errors['duplicate'] . "</div>";
					else if ($success['register'])
						print "<div class=\"valid\">" .  $success['register'] . "</div>";
					else
						print "<div class=\"invalid\">" . $errors['register'] . "</div>";
					?>
				</center>
			</div>
		</div>
		<style>
			.container-footer {
				position: absolute;
				bottom: 0px;
			}
		</style>
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
