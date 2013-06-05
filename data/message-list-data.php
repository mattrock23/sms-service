<?php

require("config.php");

if ($_GET['type']) {
	$type = $_GET['type'];
}
function pending($date) {
	if (strtotime($date) <= time()) {
		return true;
	}
}
function sent($date) {
	if (strtotime($date) > time()) {
		return true;
	}
}
$link = mysql_connect(DBSERV, DBUSER, DBPASS);
mysql_select_db(DBNAME, $link);
$query = "SELECT * FROM messages";
$result = mysql_query($query) or die(mysql_error());
$json = "[";
while($row = mysql_fetch_array($result)) {
	if ($type && $type($row['date'])) {
		continue;
	}
	$date = date("M j, Y g:i A", strtotime($row['date']));
	$json .= "{";
	$json .= "\"recipients\": \"" . $row['recipients'] . "\", ";
	$json .= "\"content\": \"" . $row['content'] . "\", ";
	$json .= "\"date\": \"" . $date . "\"";
	$json .= "},";
}
$json = rtrim($json, ',');
$json .= "]";
echo $json;

/*example output
[
	{
		"recipients": "Everyone",
		"content": "Come by on the 23rd for our annual sidewalk sale!!",
		"date": "1288323623006",
		"type": "sent"
	},
	{
		"recipients": "Premium Members",
		"content": "We sent you this text so you can show it to the cashier to get 10% off at the sidewalk sale on the 23rd.",
		"date": "",
		"type": "pending"
	}

]
*/

?>