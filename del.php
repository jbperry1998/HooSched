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
		$user_table = $_SESSSION['user_table'];
		// $name = $_SESSION['name'];
		$event_ID = $_POST['event_ID'];
		$q = "DELETE FROM events WHERE  event_id ='$event_ID' AND user_id = '$user_ID'";
		$r = pg_query($db_connection, $q);
		$q1 = "DELETE FROM community WHERE  event_id ='$event_ID' AND user_id = '$user_ID'";
		$r1 = pg_query($db_connection, $q);
		$q2 = "DELETE FROM extracurricular WHERE  event_id ='$event_ID' AND user_id = '$user_ID'";
		$r2 = pg_query($db_connection, $q);
		pg_close($db_connection);

		header('Location: rescalendar.html');
?>