<?php

if(isset($_POST["prisijungti"])){


    $slapyvardis = $_POST["slapyvardis"];
    $slaptazodis = $_POST["slaptazodis"];

    require_once 'dbh-inc.php';
    require_once 'functions-inc.php';

    if(emptyInputLogin($slapyvardis, $slaptazodis) !== false){
        header("location: ../prisijungimas.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $slapyvardis, $slaptazodis);
}
else{
    header("location: ../prisijungimas.php");
        exit();
}