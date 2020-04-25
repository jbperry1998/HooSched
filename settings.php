<?php
		session_start();
		$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
 port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
");
		$login_status = $_SESSION['logged_in'];
		if (! strcmp($login_status, "logged_in") == 0) {
			header('Location: index.html');
		}
		$user_ID = $_SESSION['username'];
		// $name = $_SESSION['name'];

		$school = $_POST['school'];
		$org_ID = $_POST['org_ID'];

		if(isset($school)){
			//insert username and school into students table
			$query_1 = "INSERT INTO student VALUES('$user_ID','$school')";
			$result_1 = pg_query($db_connection,$query_1);
			if(result_1){
				header('Location: rescalendar.html');
			}
			

		}
		if(isset($org_ID)){
			$query_2 = "INSERT INTO admin VALUES('$org_ID','$user_ID')";
			$result_2 = pg_query($db_connection,$query_2);
			$_SESSION['user_type'] = "admin";
			$_SESSION['org_id'] = $org_ID;
			if(result_2){
				header('Location: rescalendar.html');
			}
		}
		else{
			header('Location: index.html');
		}
		
?>