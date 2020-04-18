<?php
session_start();

$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
 port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
");
$username = $_POST['username'];
$email = $_POST['email'];
$address = $_POST['address'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$city = $_POST['city'];
$zip = $_POST['zip'];
$state = $_POST['state'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

$query = "SELECT* FROM site_users WHERE username='$username' OR email='$email'";
$result = pg_query($db_connection,$query);
$user = pg_fetch_assoc($result);


if(!$user) {
    $query_1 = "INSERT INTO site_users VALUES('$first_name','$last_name','$email','$address','$city','$state','$zip','$username','$hashed_password')";
    $result_1 = pg_query($db_connection,$query_1);
    
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['logged_in'] = "logged_in";
    
    //change to homepage for members
    header('Location: Member_Home_Page.php');
}else{
    header('Location: user_exists.html');
}



?>