<?php
require('config.php');
require('functions.php');

$recipients = $_GET['recipients'];
$content = $_GET['content'];
$datetime = groupNameDisplay($_GET['datetime'] . ":00");

//add row to database
$link = mysql_connect(DBSERV, DBUSER, DBPASS);
mysql_select_db(DBNAME, $link);
$query = "INSERT INTO messages (recipients, content, date) VALUES ('$recipients', '$content', '$datetime')";
$result = mysql_query($query) or die(mysql_error());
?>