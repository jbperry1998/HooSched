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
    $query = "SELECT * FROM class WHERE class_ID IN (SELECT class_ID FROM takes WHERE user_ID = '$user_ID')";
	$statement = pg_query($db_connection, $query);
	
	// fetch all rows from statement as an array 
	$result = pg_fetch_all($statement);
	
	foreach($result as $row) {
		$eventArray[] = array(
			'id'    => $row["class_id"],
			'title' => $row["classname"],
			'start' => $row["start_time"],
			'end' => $row["end_time"],
			'dow' => $row["days"]
			#'startRecur' => $row["start_date"],
			#'endRecur' => $row["end_date"]
		);
    }

    echo json_encode($eventArray);
	
	// pg_free_result($statement);
?>