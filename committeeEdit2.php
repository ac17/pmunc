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
		"Association of Southeast Asian Nations",
		"Mao's Yan'An Red Base",
		"Cabinet of the Republic of Liberia",
		"Ukraine in Turmoil",
		"2050 National Security Council",
		"Israel-Hamas-Fatah Joint Crisis Committee"
		);
$index = $_GET["committee"];
if (isset($_POST['editSubmit']) && $_POST['editSubmit'] == 'true') {
	$newChair = trim($_POST['chair']);
	$newEmail = trim($_POST['email']);
	$newBio = trim($_POST['bio']);
	$newDesc = trim($_POST['topic']);
	$tempDir = sys_get_temp_dir();

	$query0 = "SELECT * FROM COMMITTEE_INFO WHERE Name=\"$committees[$index]\";";
	$result=mysql_query($query0);
	if (!$result) echo "Could not perform query. " . mysql_error();
	$row = mysql_fetch_assoc($result);
	$oldEmail = $row['email'];
	$oldProfPic = $row['P_Filename'];

	if (!eregi("^[^@]{1,64}@[^@]{1,255}$", $newEmail))
		$errors['newEmail'] = 'Your email address is invalid.';

	if (strlen($newBio) > 4000)
		$errors['newBio'] = 'Your bio cannot be longer than 4000 characters.';

	if (strlen($newDesc) > 2000)
		$errors['newDesc'] = 'Your topic description cannot be longer than 2000 characters.';

	$ppAllowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["profilePhoto"]["name"]);
	$extension = end($temp);

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
				&& ($_FILES["profilePhoto"]["size"] < 200000)
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
	$query1 = 'UPDATE COMMITTEE_INFO SET Leader="' . $newChair . '", Email="' . $newEmail . '", bio="' . $newBio . '", P_Filename="' . $profFile . '", description="' . $newDesc . '" WHERE Name="' . $committees[$index] . '" AND Email="' . $newEmail .'";';
	$query2 = 'UPDATE users SET email = "' . $newEmail . '" WHERE email="' . $oldEmail . '";';
	if (!$errors) {
		if (mysql_query($query1) && mysql_query($query2)) {
			$success['editCommitteeInfo'] = 'The committee information was updated.';
		}
		else {
			$error['editCommmitteeInfo'] = 'There was a problem updating the information. Please try again.';
		}
	}
}
?>
<html>
<body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$( document ).ready(function() {
		update();
		});
function update() {
	var user = $("#userselect").val();
	$.ajax({
type: "POST",
url: 'getUserDat.php',
dataType: 'json',
data : {
id : user,
},
success : function(data) {
$('input[name="chair"]').val(data.Leader);
$('input[name="email"]').val(data.Email);
$('input[name="bio"]').val(data.bio);
},
error : function(XMLHttpRequest, textStatus, errorThrown) {
alert(XMLHttpRequest + " : " + textStatus + " : " + errorThrown);
}
});
}
 $(document).on('change','#userselect',function(){
update();
});
</script>
Committee: <?php echo $committees[$index]?><br>
<select id="userselect">
<?php
$query = "SELECT Email FROM COMMITTEE_INFO WHERE Name=\"$committees[$index]\";";
$result=mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
	echo "<option value=" . $row["Email"] . ">". $row["Email"] . "</option>";
}
?>
</select><br>

<form name="editForm" role="form" action="<?php echo 'committeeEdit2.php?committee=' . $index; ?>" enctype="multipart/form-data" method="post">
<h3><b>Chair</b>: <?php echo $row['Leader']; ?></h3>
<?php echo $row['Leader']; ?>
New chair(s)<input type="text" name="chair" class="form-control" value="<?php echo $row['Leader']; ?>" required><br>
New chair email<input type="email" name="email" value="<?php echo $row['Email']; ?>" class="form-control" required><br>
New bio <textarea width=100% name="bio" class="form-control" maxlength=4000><?php echo $row['bio']; ?></textarea><br>
New topic description
<textarea width=100% name="topic" class="form-control" maxlength=2000><?php echo $row['description']; ?></textarea><br>
New photo
<input type="hidden" name="MAX_FILE_SIZE" value="200000">
<input type="file" name="profilePhoto" id="profilePhoto"><br>
<input type="hidden" name="editSubmit" id="editSubmit" value="true">
<input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit">
</form>
</body>
</html>
