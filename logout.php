<?php
session_start();


    $_SESSION['username'] = "";
    $_SESSION['logged_in'] = "";
    
    //change to homepage for members
    header('Location: index.html');



?>