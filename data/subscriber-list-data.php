<?php

require("config.php");

if ($_GET['groupName']) {
	$groupName = $_GET['groupName'];
}

$link = mysql_connect(DBSERV, DBUSER, DBPASS);
mysql_select_db(DBNAME, $link);
if ($groupName) {
	$query = "SELECT s.subscriber_name, s.phone_number, s.subscribed, s.unsubscribed 
	FROM subscribers s, group_membership m, group_names g 
	WHERE m.subscriber_id = s.subscriber_id AND m.group_id = g.group_id 
	AND g.group_name = '$groupName'";
} else {
	$query = "SELECT * FROM subscribers";
}
$result = mysql_query($query) or die(mysql_error());
$json = "[";
while($row = mysql_fetch_array($result)) {
	if (preg_match('/[1-9]/', $row['unsubscribed']) === 1) {
		continue;
	}
	$date = date("M j, Y g:i A", strtotime($row['subscribed']));
	$json .= "{";
	$json .= "\"name\": \"" . $row['subscriber_name'] . "\", ";
	$json .= "\"phone\": \"" . $row['phone_number'] . "\", ";
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