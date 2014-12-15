<?php
// start session
session_start();

// link to database
$dbLink = mysql_connect('localhost', 'modelun', 'flp5WxQGTJgk');
if (!$dbLink)
        die('Can\'t establish a connection to the database: ' . mysql_error());

$dbSelected = mysql_select_db('modelun_pmunc2014', $dbLink);
if (!$dbSelected)
        die('Connected, but table is inaccessible: ' . mysql_error());
$query = 'UPDATE users SET session_id = NULL WHERE id= ' . $_SESSION['user']['id'] . ' LIMIT 1';
mysql_query($query);
unset($_SESSION['user']);
header('Location: signin.php');
exit;
?>
