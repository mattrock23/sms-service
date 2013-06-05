<?php
require('../data/functions.php');
?>
<span>Message List : {{ type }}</span>

<table>
	<tr><td></td><td>Recipients</td><td>Content</td><td>Delivery Date</td></tr>
	<tr ng-repeat="message in messageList | orderBy:dateSorter">
		<td class="checkbox"><input type="checkbox"></td>
		<td>{{message.recipients}}</td>
		<td>{{message.content}}</td>
		<td>{{message.date}}</td>
	</tr>
</table>

<span>New Message</span>
<table>
	<tr>
		<td class="inputbox"><select ng-model="recipients">
			<option value="">--Select Recipients--</option>
			<option value="everyone">Everyone</option>
			<?php
			$groupNames = getGroupNames();
			foreach ($groupNames as $group) {
				echo "<option value=\"" . $group . "\">" . groupNameDisplay($group) . "</option>\n";
			}
			?>
		</select></td>
		<td><textarea ng-model="content"></textarea></td>
		<td class="inputbox">YYYY-MM-DD HH:MM<br><input type="text" name="datetime" value="" ng-model="datetime"></td>
		<td class="buttonbox"><input type="button" value="Schedule" ng-click="formSubmit()"></td>
	</tr>
</table>