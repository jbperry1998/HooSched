<?php
require_once "db.php";

$title = isset($_POST['title']) ? $_POST['title'] : "";
$sqlDelete = "DELETE from tbl_events WHERE title=".$title;

mysqli_query($conn, $sqlDelete);
echo mysqli_affected_rows($conn);

mysqli_close($conn);
?>