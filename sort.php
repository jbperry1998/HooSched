<?php

$connect = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
    port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
    ");

if(isset($_POST['valueToSort']))
{
    $valueToSearch = $_POST['valueToSort'];
}
 #if valueToSort == Event Type
$query = "SELECT * FROM events ORDER BY event_ID";
//if($result = mysqli_query($link, $sql)){
$result = pg_query($connect,$query);
echo "<table border='1'>
								<tr>
								<th>Event ID</th>
								<th>User ID</th>
                                </tr>";
    while ($row = pg_fetch_row($result)) {
        echo "<tr>";
        echo "<td>" . $row[1] . "</td>";
        echo "<td>" . $row[2] . "</td>";
        echo "</tr>";
    }
header('Location: rescalendar.html');

?>