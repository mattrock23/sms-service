<?php
require('config.php');

function getGroupNames() {
	$returnArray = array();
	$link = mysql_connect(DBSERV, DBUSER, DBPASS);
	mysql_select_db(DBNAME, $link);
	$query = "SELECT group_name FROM group_names";
	$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result)) {
		$returnArray[] = $row['group_name'];
	}
	return $returnArray;
}
function makeLink($item) {
	echo "<li class=\"subitem\"><a href=\"#/subscribers/" . $item . "\">" . groupNameDisplay($item) . "</a></li>\n";
}
function groupNameDisplay($string) {
	return ucwords(implode(" ", explode("_", $string)));
}
?>