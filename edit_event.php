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
$user_table = $_SESSION['user_table'];

$id = $_POST['event_ID'];
$title = $_POST['name'];
$start = $_POST['start_time'];
$end = $_POST['end_time'];
$date = $_POST['date'];
$description = $_POST['description'];

$sqlUpdate = "UPDATE tbl_events SET title='" . $title . "',start='" . $start . "',end='" . $end . "',description='" . $description . "' WHERE id=" . $id;
$r = pg_query($db_connection, $sqlUpdate);

header('Location: rescalendar.html');
// mysqli_query($conn, $sqlUpdate)
// mysqli_close($conn);

?>
