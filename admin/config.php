<?php
    $siteurl="http://localhost/training/Task13-OnlineTestPlatform/index.php"; 
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="varnika";
    $dbname="onlinetest";

    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);

    if($conn -> connect_error){
        die("connection failed: ".$conn -> connect_error);
    }
    //echo "connected successfully";
?>