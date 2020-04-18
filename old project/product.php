<?php
session_start();

$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
 port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
");

$login_status = $_SESSION['logged_in'];

if(strcmp( $login_status, "logged_in" ) == 0) {
    
    $_SESSION['product'] = $_POST['product'];
    $product = $_SESSION['product'];
    
    if(strcmp( $product, "book" ) == 0){
        header('Location: cookbook.html');
    }else if(strcmp( $product, "subscription" ) == 0){
        header('Location: subscription.html');
    }else{
        //some sort of error for a non-existant product
        header('Location: index.html');
    }
    
    
}else{
    header('Location: user_not_found.html');
}



?>