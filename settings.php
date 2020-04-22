<?php
		session_start();
		$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
		port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
		");
		$login_status = $_SESSION['logged_in'];
		if (! strcmp($login_status, "logged_in") == 0) {
			header('Location: elements.html');
		}
		$username = $_SESSION['username'];
		// $name = $_SESSION['name'];

		$school = $_POST['school'];
		$org_ID = $_POST['org_ID'];

		if(isset($school)){
			//insert username and school into students table
			$query_1 = "INSERT INTO Student VALUES('$username','$school')";
			$result_1 = pg_query($db_connection,$query_1);
			header('Location: calendar.html');

		}
		if(isset($org_ID)){
			$query_2 = "INSERT INTO Admin VALUES('$org_ID','$username')";
			$result_2 = pg_query($db_connection,$query_2);
			header('Location: calendar.html');
		}
		else{
			header('Location: index.html');
		}
		
?>