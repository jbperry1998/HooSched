<?php
session_start();

$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
 port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
");
$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM site_users WHERE username='$username'";
$result = pg_query($db_connection, $query);

if (! $result) {
    header('Location: index.html');
}

$row = pg_fetch_row($result);
$hp = $row[3];
if (password_verify($password, $hp)) {
    $_SESSION['username'] = $username;
	$_SESSION['logged_in'] = "logged_in";
	$_SESSION['user_table'] = $username;

    // change to homepage for members
    header('Location: rescalendar.html');
} else {
    echo $hp;
    echo "\n";
    echo $password;
    header('Location: index.html');
}

// if(!$user) {

// header('Location: bad_login.html');

// }else{

// $_SESSION['username'] = "";
// $_SESSION['email'] = $email;
// $_SESSION['logged_in'] = "logged_in";

// //change to homepage for members
// header('Location: Member_Home_Page.php');
// }

?>