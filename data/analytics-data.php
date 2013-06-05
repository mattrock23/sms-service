<?php
require('config.php');

$monthToDisplay = "05-2013";//possibility to add ability to lookup any month through $_GET
$firstOfTheMonth = strtotime("01-" . $monthToDisplay);
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, substr($monthToDisplay, 0, 2), substr($monthToDisplay, 3, 4));
$link = mysql_connect(DBSERV, DBUSER, DBPASS);
mysql_select_db(DBNAME, $link);
$query = "SELECT s.subscribed, s.unsubscribed FROM subscribers s ORDER BY subscribed";
$result = mysql_query($query) or die(mysql_error());
$return = array(
	'daysInMonth' => $daysInMonth,
	'subscriptions' => array(),
	'unsubscriptions' => array()
);
while($row = mysql_fetch_array($result)) {
	$time = strtotime($row['subscribed']) - $firstOfTheMonth;
	$day = ceil($time/86400);
	if ($day > $daysInMonth) {
		continue;
	}
	$return['subscriptions'][$day]++;
	$time = strtotime($row['unsubscribed']) - $firstOfTheMonth;
	if ($time < 0) {
		continue;
	}
	$day = ceil($time/86400);
	if ($day > $daysInMonth) {
		continue;
	}
	$return['unsubscriptions'][$day]++;
}
echo json_encode($return);
?>