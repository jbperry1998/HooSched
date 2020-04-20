<?php
session_start();

$db_connection = pg_connect("ec2-52-71-231-180.compute-1.amazonaws.com
port=5432 dbname=d5g84sufgsvitc user=elybocxzzsvtjp password=7611f8ff31e698d42a0571c4a27b74f3bc83034ce58321bd5291711b7516aca7
");
$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM site_users WHERE username='$username'";
$result = pg_query($db_connection, $query);

if (! $result) {
    header('Location: index.html');
}

$row = pg_fetch_row($result);
$hp = $row[8];
if (password_verify($password, $hp)) {
    $_SESSION['username'] = $username;
    $_SESSION['logged_in'] = "logged_in";

    // change to homepage for members
    header('Location: calendar.html');
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