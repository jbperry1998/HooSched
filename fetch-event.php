<?php
	session_start();
	$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
	port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
	");

    require_once "db.php";//idk what this does?

	$user_ID = $_SESSION['username'];
	$json = array();
	
    $query = "SELECT * FROM events WHERE user_ID = '$user_ID'";
	$result = pg_query($db_connection, $query);
	
    $eventArray = array();
    while ($row = pg_fetch_assoc($result)) {
        array_push($eventArray, $row);
    }
    //pg_free_result($result);

    //mysqli_close($conn);
    echo json_encode($eventArray);
?>