<?php

if(isset($_POST['valueToSearch']))
{
    $valueToSearch = $_POST['valueToSearch'];
    #$firstCharacter = $string[0]
    // search in all table columns
    // using concat mysql function
    $query="";
    if(strcmp($valueToSearch, "Community") == 0) {
        $query = "SELECT * FROM `event` WHERE `event_ID` LIKE '%c'";
    }
    else if(strcmp($valueToSearch, "Extracurricular") == 0) {
        $query = "SELECT * FROM events WHERE event_ID LIKE '%e'";
    }
    else if(strcmp($valueToSearch, "Reminder") == 0) {
        $query = "SELECT * FROM events WHERE event_ID LIKE '%r'";
    }
    #$query = "SELECT * FROM `Event` WHERE CONCAT(`event_ID`, `user_ID`, `name`, `date`, `description`, `frequency`, `start_time`, `end_time`) LIKE '%c'";
   //vals from table that need to put together
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM events";
	//need to have static table or find a way for any table to be chosen
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
    port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
    ");
    $filter_Result = pg_query($connect, $query);
    // Printing results in HTML
    echo "<table>\n";
    while ($line = pg_fetch_array($filter_Result, NULL, PGSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";
    return $filter_Result;
}
header('Location: rescalendar.html');
?>