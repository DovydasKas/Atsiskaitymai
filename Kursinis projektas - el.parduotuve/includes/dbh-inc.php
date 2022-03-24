<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "parduotuve";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn){
    die("Connection failed:" . mysqli_connect_error());
}

function getData(){


    $serverName = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "parduotuve";
    
    $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);


    $sql = "SELECT * FROM prekes";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}