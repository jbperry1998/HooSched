<?php
	session_start();
	// connect to the database
	$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
	port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
	");

	// get username
	$user_ID = $_SESSION['username'];
	
	// array to store the events
    $eventArray = array();
	
	// prepare execute the query
    $query = "SELECT * FROM events WHERE user_ID = '$user_ID'
	          UNION
			  SELECT * FROM events WHERE org_ID IN 
				(SELECT * FROM subscribes WHERE user_ID = '$user_ID'";
	$statement = pg_query($db_connection, $query);
	
	// fetch all rows from statement as an array 
	$result = pg_fetch_all($statement);
	
	foreach($result as $row) {
		if ($row["event_id"][0] == "e") {
			$color = '#3b3342';
		} else if ($row["event_id"][0] == "c") {
			$color = '#566a73';
		} else if ($row["event_id"][0] == "r") {
			$color = '#e5cb95';
		} else {
			$color = '#95ada6';
		}
		$eventArray[] = array(
			'id'    => $row["event_id"],
			'title' => $row["name"],
			'date' => $row["date"],
			'backgroundColor' => $color
		);
    }

    echo json_encode($eventArray);
	
	// pg_free_result($statement);
?>