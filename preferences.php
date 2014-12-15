<?php
include_once('config2.php');
$errors=array();
$success=array();


$query = 'SELECT email FROM users WHERE session_id = "' . session_id() . '" LIMIT 1';
$userResult = mysql_fetch_assoc(mysql_query($query));


if (isset($_POST['editSubmit']) && $_POST['editSubmit'] == 'true') {
	$pref1 = trim($_POST['p1']);
	$pref2 = trim($_POST['p2']);
	$pref3 = trim($_POST['p3']);
	$pref4 = trim($_POST['p4']);
	$pref5 = trim($_POST['p5']);

	$query0 = 'DELETE FROM COMMITTEE_PREFERENCES WHERE email = "' . $userResult["email"].'"';
	mysql_query($query0);

	$query1 = 'INSERT INTO COMMITTEE_PREFERENCES (email, pref1, pref2, pref3, pref4, pref5) VALUES ("'
			. $userResult["email"] . '", "'
			. $pref1 . '", "'
			. $pref2 . '", "'
			. $pref3 . '", "'
			. $pref4 . '", "'
			. $pref5 . '")';
	$result = mysql_query($query1);
	if (!$result) echo "Could not perform query. " . mysql_error();
	$row0 = mysql_fetch_assoc($result);
}
?>
<html>
<body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

var masterlist= [
"No preference",
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
	];

	function update() {
		var cpref1 = $('select[name="p1"]').val();
		var cpref2 = $('select[name="p2"]').val();
		var cpref3 = $('select[name="p3"]').val();
		var cpref4 = $('select[name="p4"]').val();
		var cpref5 = $('select[name="p5"]').val();



		$('select[name="p1"] option').each(function() {$(this).prop('disabled', $(this).val() === cpref2 ||$(this).val() === cpref3 ||$(this).val() === cpref4 ||$(this).val() === cpref5)});
		$('select[name="p2"] option').each(function() { $(this).prop('disabled', $(this).val() === cpref1 ||$(this).val() === cpref3 ||$(this).val() === cpref4 ||$(this).val() === cpref5)});
		$('select[name="p3"] option').each(function() { $(this).prop('disabled', $(this).val() === cpref2 ||$(this).val() === cpref1 ||$(this).val() === cpref4 ||$(this).val() === cpref5)});
		$('select[name="p4"] option').each(function() { $(this).prop('disabled', $(this).val() === cpref2 ||$(this).val() === cpref3 ||$(this).val() === cpref1 ||$(this).val() === cpref5)});
		$('select[name="p5"] option').each(function() { $(this).prop('disabled', $(this).val() === cpref2 ||$(this).val() === cpref3 ||$(this).val() === cpref4 ||$(this).val() === cpref1)});
	}

$(document).ready( function() {
		$.each(masterlist, function (i , value){
			$('select[name="p1"]').append('<option value="'+masterlist[i]+'">'+masterlist[i]+'</option>');
			$('select[name="p2"]').append('<option value="'+masterlist[i]+'">'+masterlist[i]+'</option>');
			$('select[name="p3"]').append('<option value="'+masterlist[i]+'">'+masterlist[i]+'</option>');
			$('select[name="p4"]').append('<option value="'+masterlist[i]+'">'+masterlist[i]+'</option>');
			$('select[name="p5"]').append('<option value="'+masterlist[i]+'">'+masterlist[i]+'</option>');
			});
		$('select[name="p1"]').val(masterlist[0]);
		$('select[name="p2"]').val(masterlist[1]);
		$('select[name="p3"]').val(masterlist[2]);
		$('select[name="p4"]').val(masterlist[3]);
		$('select[name="p5"]').val(masterlist[4]);
		update();
		$('select').change(function(event) { update();});
		});
</script>
you are: <?php echo $userResult["email"];?><br>
preferences:<br>
<form name="editForm"  id="editForm" action="preferences.php" method="post" >
<input type="hidden" name="editSubmit" id="editSubmit" value="true">
<input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit">
</form>
pref1<select form="editForm" name="p1"></select><br> 
pref2<select form="editForm" name="p2"></select><br> 
pref3<select form="editForm" name="p3"></select><br> 
pref4<select form="editForm" name="p4"></select><br> 
pref5<select form="editForm" name="p5"></select><br> 
</body>
</html>
