<?php
		session_start();
		$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
		port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
		");
		$login_status = $_SESSION['logged_in'];
		if (! strcmp($login_status, "logged_in") == 0) {
			header('Location: elements.html');
		}
		$user_ID = $_SESSION['username'];
		// $name = $_SESSION['name'];

		$event_ID = $_POST['event_ID'];
		$name = $_POST['name'];
		$start_time = $_POST['start_time'];
		$end_time = $_POST['end_time'];
		$date = $_POSt['date'];
		$description = $_POST['description'];
		$frequency = $_POST['frequency'];

		//extracurricular
		$school_name = $_POST['school'];
		$location = $_POST['location'];

		//comunity
		$size = $_POST['size'];
		$venue = $_POST['venue'];
		$owner_ID = $_POST['owner_ID'];

		

		if(isset($school)){
			//insert username and school into students table
			$query_1 = "INSERT INTO Extracurricular VALUES('$event_ID','$user_ID','$school_name','$location')";
    		$result_1 = pg_query($db_connection,$query_1);
		}
		if(isset($size)){
			$query_2 = "INSERT INTO Community VALUES('$event_ID','$user_ID','$owner_ID','$size','$venue')";
    		$result_2 = pg_query($db_connection,$query_2);
		}
		$query = "INSERT INTO Event VALUES('$event_ID','$user_ID','$name','$date','$description','$frequency','$start_time','$end_time')";
		$result = pg_query($db_connection, $query);
		$query_3 = "INSERT INTO Makes VALUES('$user_ID','$event_ID')";
		$result_3 = pg_query($db_connection, $query_3);
		header('Location: calendar.html');

?>