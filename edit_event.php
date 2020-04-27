<?php
require_once "db.php";
session_start();
$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
");
$login_status = $_SESSION['logged_in'];
if (! strcmp($login_status, "logged_in") == 0) {
  header('Location: elements.html');
}
$user_ID = $_SESSION['username'];

$event_id = $_POST['event_ID'];
$name = $_POST['name'];
$date = $_POST['date'];
$start_date = date('Y-m-d', strtotime($date));
$date_stime = $_POST['date'] + $_POST['start_time'];
		
$start = $_POST['start_time'];
$start = date('Y-m-d H:i:s', strtotime($start));
#$start = TO_TIMESTAMP($date_stime, 'YYYY-MM-DD HH24:MI:SS');
$end = $_POST['end_time'];
$end = date('Y-m-d H:i:s', strtotime($end));
$description = $_POST['description'];

if(isset($name)) {
  $sqlUpdate = "UPDATE events SET name='$name' WHERE event_id='$event_id' AND user_id='$user_ID'";
  $r = pg_query($db_connection, $sqlUpdate);
}

if(isset($start)) {
  $sqlUpdate = "UPDATE events SET start_time='$start' WHERE event_id='$event_id' AND user_id='$user_ID'";
  $r = pg_query($db_connection, $sqlUpdate);
}

if(isset($end)) {
  $sqlUpdate = "UPDATE events SET end_time='$end' WHERE event_id='$event_id' AND user_id='$user_ID'";
  $r = pg_query($db_connection, $sqlUpdate);
}

if(isset($start_date)) {
  $sqlUpdate = "UPDATE events SET date='$start_date' WHERE event_id='$event_id' AND user_id='$user_ID'";
  $r = pg_query($db_connection, $sqlUpdate);
}

if(isset($description)) {
  $sqlUpdate = "UPDATE events SET description='$description' WHERE event_id='$event_id' AND user_id='$user_ID'";
  $r = pg_query($db_connection, $sqlUpdate);
}
pg_close($db_connection);
header('Location: rescalendar.html');
// mysqli_query($conn, $sqlUpdate)
// mysqli_close($conn);

?>
