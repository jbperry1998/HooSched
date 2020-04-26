<?php
session_start();
ini_set('display_errors', 1);
/*$servername = "ec2-174-129-227-80.compute-1.amazonaws.com";
$name = "zdlwovjrekrdar";
$password = "ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5";
$dbname = "dbvs140f5cqkp1";
$username = $_SESSION['username'];
$fileExport = $_POST['fileToExport'];

if(isset($fileExport)) {
    if(strcmp($fileExport, "csv") == 0) {
        $conn = new PDO("pgsql:host=$servername;port=5432;dbname=$dbname", $name, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM events WHERE user_id ='$username'");
        $stmt->execute();

        $filename = 'test_postgres.csv';

        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        header("Content-Transfer-Encoding: UTF-8");

        $head = fopen($filename, 'w');

        $headers = $stmt->fetch(PDO::FETCH_ASSOC);
        fputcsv($head, array_keys($headers));

        fclose($head);

        $data = fopen($filename, 'a');
        fputcsv($data, $headers);  // This adds the data from the header row

        echo "					<tr>
								<th>event_ID</th>
								<th>user_ID</th>
								<th>name</th>
								<th>date</th>
								<th>description</th>
								<th>frequency</th>
								<th>start_time</th>
								<th>end_time</th>

								</tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['event_id'] . "</td>";
				echo "<td>" . $row['user_id'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['date'] . "</td>";
				echo "<td>" . $row['description'] . "</td>";
				echo "<td>" . $row['frequency'] . "</td>";
				echo "<td>" . $row['start_time'] . "</td>";
                echo "<td>" . $row['end_time'] . "</td>";
                echo "<td>" . $row['org_id'] . "</td>";
                echo "</tr>";
                echo "<br>";
                fputcsv($data, $row);
            }

        fclose($data);
    }
}*/

$conn = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
 port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
");

$username = $_SESSION['username'];
$fileExport = $_POST['fileToExport'];

if(isset($fileExport)) {
    if(strcmp($fileExport, "csv") == 0) {
        $filename = "test_postgres.csv";
        $fp = fopen('php://output', 'w');

        $query = "select column_name from information_schema.columns where table_name = 'events'";
        $result = pg_query($conn,$query);
        while ($row = pg_fetch_row($result)) {
            $header[] = $row[0];
        }	

        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename='.$filename);
        fputcsv($fp, $header);

        $query = "SELECT * FROM events WHERE user_id ='$username'";
        $result = pg_query($conn, $query);
        while($row = pg_fetch_row($result)) {
            fputcsv($fp, $row);
        }
    }
    /*else if(strcmp($fileExport, "json") == 0) {

        $query="SELECT row_to_json(row) FROM (SELECT * FROM events WHERE user_id ='$username') row";
        $result = pg_query($conn, $query);
*/
        /*$filename = "test_postgres.json";
        $query = "SELECT * FROM events WHERE user_id ='$username'"; 
        $result = pg_query($conn, $query);
        $json_array = array();  
        while($row = pg_fetch_assoc($result)) {
            $json_array[] = $row;  
        }  
        echo '<pre>';  
        print_r(json_encode($json_array));  
        echo '</pre>';
        ob_start();
        //echo "<div>";
        //echo "Foobar";
        //echo "</div>";
        echo json_encode($json_array);
        //  Return the contents of the output buffer
        $htmlStr = ob_get_contents();
        // Clean (erase) the output buffer and turn off output buffering
        ob_end_clean(); 
        // Write final string to file
        file_put_contents($filename, $htmlStr);
        */
   // }
}

?>