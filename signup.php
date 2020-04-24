<?php
session_start();
$servername = "ec2-174-129-227-80.compute-1.amazonaws.com";
$username = "zdlwovjrekrdar";
$password = "ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5";
$dbname = "dbvs140f5cqkp1";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // sql to create table
    $sql = "CREATE TABLE employees (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP
    )";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table employees created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
/*
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
	$quert_2 = "CREATE TABLE IF NOT EXISTS $username(
		event_ID character varying(50) NOT NULL,
		name character varying(50) NOT NULL,
		date date NOT NULL,
		description character varying(100) NOT NULL,
		frequency character varying(20) NOT NULL,
		start_time timestamp without time zone,
		end_time timestamp without time zone
		)";
	//$create_table = $db->exec($query_2);
	$result_2 = pg_query($db_connection,$query_2);
    if(!$result_2){
		header('Location: index.html');
	}
	$_SESSION['username'] = $username;
	$_SESSION['user_table'] = $username;
    //$_SESSION['email'] = $email;
    $_SESSION['logged_in'] = "logged_in";
    
    //change to homepage for members
    header('Location: rescalendar.html');
}else{
    header('Location: index.html');
}

*/

?>