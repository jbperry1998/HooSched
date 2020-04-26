<?php
session_start();
ini_set('display_errors', 1);
$servername = "ec2-174-129-227-80.compute-1.amazonaws.com";
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

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo $row['event_id'];
                echo $row['user_id'];
                echo $row['name'];
                echo $row['date'];
                echo $row['descriptio'];
                echo $row['frequency'];
                echo $row['start_time'];
                echo $row['end_time'];
                echo $row['org_id'];
                fputcsv($data, $row);
            }

        fclose($data);
    }
}
?>