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
		#$user_table = $_SESSSION['user_table'];
		// $name = $_SESSION['name'];

		$event_ID = $_POST['event_ID'];
		$name = $_POST['name'];
		$start_time = $_POST['start_time'];
		#$start = date("H:i:s",$start_time);
		#$end_time = $_POST['end_time'];
		#$end = date("H:i:s",$start_time);
		$date = $_POST['date'];
		$start_date = date('Y-m-d', strtotime($date));
		$date_stime = $_POST['date'] + $_POST['start_time'];
		
		$start = $_POST['start_time'];
		$start = date('Y-m-d H:i:s', strtotime($start));
		#$start = TO_TIMESTAMP($date_stime, 'YYYY-MM-DD HH24:MI:SS');
		$end = $_POST['end_time'];
		$end = date('Y-m-d H:i:s', strtotime($end));
		#$start_date = $_POST['date'];
		#$start_date = date('Y-m-d H:i:s', strtotime($date));
		$description = $_POST['description'];
		$frequency = $_POST['frequency'];

		//extracurricular
		$school_name = $_POST['school'];
		$location = $_POST['location'];

		//comunity
		$size = $_POST['size'];
		$venue = $_POST['venue'];
		$owner_ID = $_POST['owner_ID'];
		$tabe = 'xx12xx';

		if(isset($school_name)){
			//insert username and school into students table
			$query_1 = "INSERT INTO extracurricular VALUES('$event_ID','$user_ID','$school_name','$location')";
    		$result_1 = pg_query($db_connection,$query_1);
		}
		if(isset($size)){
			$query_2 = "INSERT INTO community VALUES('$event_ID','$user_ID','$owner_ID','$size','$venue')";
    		$result_2 = pg_query($db_connection,$query_2);
		}
		
		#$user_status = $_SESSION['user_type'];
		#$org_id = $_SESSION['org_id'];
		#if (strcmp($user_status, "admin") == 0) {
		$query_4 = "SELECT org_id FROM admin WHERE username='$user_ID'";
		$result_4 = pg_query($db_connection, $query_4);
		if($result_4) {
			$query = "INSERT INTO events VALUES('$event_ID','$user_ID','$name','$start_date','$description','$frequency','$start','$end')";
			$query_5 = "UPDATE events SET org_id=(SELECT org_id FROM admin WHERE username='$user_ID') WHERE user_id='$user_ID'";
		}
		else {
			$query = "INSERT INTO events VALUES('$event_ID','$user_ID','$name','$start_date','$description','$frequency','$start','$end')";
		}
		$result = pg_query($db_connection, $query);
		$result_5 = pg_query($db_connection, $query_5);
		
		$query_3 = "INSERT INTO makes VALUES('$user_ID','$event_ID')";
		$result_3 = pg_query($db_connection, $query_3);
		header('Location: rescalendar.html');

		pg_close($db_connection);

?>