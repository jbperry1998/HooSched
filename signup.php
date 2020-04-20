<?php
session_start();

$db_connection = pg_connect("ec2-52-71-231-180.compute-1.amazonaws.com
 port=5432 dbname=d5g84sufgsvitc user=elybocxzzsvtjp password=7611f8ff31e698d42a0571c4a27b74f3bc83034ce58321bd5291711b7516aca7
");
if(!$db_connection){
	echo "<p>Could not connect to the server '" . $hostname . "'</p>\n";
	header('Location: index.html');
}
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
    $query_1 = "INSERT INTO site_users VALUES('$first_name','$last_name','$username','$hashed_password')";
    $result_1 = pg_query($db_connection,$query_1);
    
    $_SESSION['username'] = $username;
   // $_SESSION['email'] = $email;
    $_SESSION['logged_in'] = "logged_in";
    
    //change to homepage for members
    header('Location: calendar.html');
}else{
    header('Location: index.html');
}



?>