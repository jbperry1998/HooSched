<?php
session_start();

$email = $_SESSION['email'];
$product = $_SESSION['product'];

$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
 port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
");

$sales_query = "SELECT* FROM sales WHERE email='$email'";
$result = pg_query($db_connection, $sales_query);
$in = pg_fetch_assoc($result);
// fill in location of bitwallet and do correct things based on state (product)

if(strcmp( $product, "book" ) == 0){
    if($in){
     $query_1 = "UPDATE sales SET cookbook = 1 WHERE email='$email'";
     }else{
     $query_1 = "INSERT INTO sales VALUES ('$email',1,0)";
     }
     $result1 = pg_query($db_connection,$query_1);
     
     
    header('Location: confirm_email.php'); //change
}else if(strcmp( $product, "subscription" ) == 0){
    if($in){
     $query_1 = "UPDATE sales SET subscription = 1 WHERE email='$email'";
     }else{
     $query_1 = "INSERT INTO sales VALUES ('$email',0,1)";
     }
     $result1 = pg_query($db_connection,$query_1);
     
     
    header('Location: confirm_email.php'); //change
}else{
    //some sort of error for a non-existant product
    header('Location: index.html');
}

?>