<?php
session_start();


    $_SESSION['username'] = "";
    $_SESSION['email'] = "";
    $_SESSION['logged_in'] = "";
    $_SESSION['product'] = "";
    
    //change to homepage for members
    header('Location: Member_Home_Page.php');



?>