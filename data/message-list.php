<?php

require("config.php");

//$type = $_GET['type'];
// Whatever results this gets, it hast to filter based on $type
// type will say pending, sent, or all
// all messages are notification type
$link = mysql_connect(DBSERV, DBUSER, DBPASS);
mysql_select_db(DBNAME, $link);
$query = "SELECT * FROM messages";
$result = mysql_query($query) or die(mysql_error());
$json = "[";
while($row = mysql_fetch_array($result)) {
  $date = date("M j, Y g:i",strtotime($row['date']));
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