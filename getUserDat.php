
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
$id = $_POST['id'];
$query = "select * from COMMITTEE_INFO where Email='$id';";
$result = mysql_query($query);
$data = mysql_fetch_array($result);

echo json_encode($data);
?>
