<?php
session_start();
ini_set('display_errors', 1);
/*$servername = "ec2-174-129-227-80.compute-1.amazonaws.com";
$name = "zdlwovjrekrdar";
$password = "ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5";
$dbname = "dbvs140f5cqkp1";
$username = $_POST['username'];*/
/*try {
	$conn = new PDO("pgsql:host=$servername;port=5432;dbname=$dbname", $name, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// sql to create table
	$sql = "CREATE TABLE IF NOT EXISTS $username(
		event_id character varying(50) NOT NULL,
		name character varying(50) NOT NULL,
		date date NOT NULL,
		description character varying(100) NOT NULL,
		frequency character varying(20) NOT NULL,
		start_time timestamp without time zone,
		end_time timestamp without time zone
		)";
	// use exec() because no results are returned
	$conn->exec($sql);
	//echo "Table employees created successfully";
	
	}
catch(PDOException $e)
	{
	echo $sql . "<br>" . $e->getMessage();
	}
	//$conn = null;
*/
$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
 port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
");
//$db = new PDO("host=ec2-174-129-227-80.compute-1.amazonaws.com
//port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
//");
$username = $_POST['username'];
//$email = $_POST['email'];
//$address = $_POST['address'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
//$city = $_POST['city'];
//$zip = $_POST['zip'];
//$state = $_POST['state'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

$query = "SELECT* FROM site_users WHERE username='$username'";
$result = pg_query($db_connection,$query);
$user = pg_fetch_assoc($result);


if(!$user) {

    $query_1 = "INSERT INTO site_users VALUES('$first_name','$last_name','$username','$hashed_password','$username')";
	$result_1 = pg_query($db_connection,$query_1);
	 $_SESSION['username'] = $username;
		#$_SESSION['user_table'] = pq_escape_string($_POST['username']);
		//$_SESSION['email'] = $email;
		$_SESSION['logged_in'] = "logged_in";
		#$_SESSION['user_type'] = "";
		/*
		if(isset($school)){
			//insert username and school into students table
			$query_3 = "INSERT INTO student VALUES('$username','$school')";
			$result_3 = pg_query($db_connection,$query_3);
			#$_SESSION['user_type'] = "student";
			#if(result_3){
			#	header('Location: calendar.html');
			#}
		}
		if(isset($org_ID)){
			echo 'org id exists';
			$query_2 = "INSERT INTO admin VALUES('$org_ID','$username')";
			$result_2 = pg_query($db_connection,$query_2);
			#$_SESSION['user_type'] = "admin";
			#$_SESSION['org_id'] = $org_ID;
			#if(result_2){
			#	header('Location: rescalendar.html');
			#}
		}   
		else {
			echo $org_ID;
		}*/
    //change to homepage for members
    header('Location: settings.html');
}else{
    header('Location: index.html');
}



?>