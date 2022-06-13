<?php
include 'configs.php';

function execute_query($query) {
	global $db_servername, $db_username, $db_password, $db_name;
	
	if (empty($query)) {
		// nothing to do
		return;
	}
	
	// Create connection
	$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	// Check connection
	if ($conn->connect_error) {
		//couldn't update counter but let's not die()
		return;
	}

	//printf("Initial character set: %s\n", $conn->character_set_name());

	/* change character set to utf8 */
	if (!$conn->set_charset("utf8")) {
		printf("Error loading character set utf8: %s\n", $conn->error);
		exit();
	}

	$result = $conn->query($query);
	$conn->close();
	
	return $result;

}


?>