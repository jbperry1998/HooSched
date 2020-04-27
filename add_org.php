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

		$org_ID = $_SESSION['organization'];
		$name = $_POST['name'];
        $field = $_POST['field'];	
        
		$query = "INSERT INTO organization VALUES('$org_ID','$name','$field')";
		$result = pg_query($db_connection, $query);
		$query_3 = "INSERT INTO organization_members VALUES('$org_ID','$user_ID')";
		$result_3 = pg_query($db_connection, $query_3);
		$query_2 = "INSERT INTO admin VALUES('$org_ID','$user_ID')";
		$result_2 = pg_query($db_connection,$query_2);
		pg_close($db_connection);
		header('Location: rescalendar.html');

?>