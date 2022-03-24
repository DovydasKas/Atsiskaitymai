<?php

if(isset($_POST["registruotis"])){
    $slapyvardis = $_POST["slapyvardis"];
    $vardas = $_POST["vardas"];
    $pavarde = $_POST["pavarde"];
    $email = $_POST["email"];
    $slaptazodis = $_POST["slaptazodis"];
    $repslaptazodis = $_POST["repslaptazodis"];

    require_once 'dbh-inc.php';
    require_once 'functions-inc.php';

    if(emptyInputSignup($slapyvardis, $vardas, $pavarde, $email, $slaptazodis, $repslaptazodis) !== false){
        header("location: ../registracija.php?error=emptyinput");
        exit();
    }
    if(invalidUid($slapyvardis) !== false){
        header("location: ../registracija.php?error=invalidUid");
        exit();
    }
    if(invalidEmail($email) !== false){
        header("location: ../registracija.php?error=invalidEmail");
        exit();
    }
    if(pwdMatch($slaptazodis, $repslaptazodis) !== false){
        header("location: ../registracija.php?error=passwordmatch");
        exit();
    }
    if(takenUid($conn, $slapyvardis, $email) !== false){
        header("location: ../registracija.php?error=takenuid");
        exit();
    }

    createUser($conn, $slapyvardis, $vardas, $pavarde, $email, $slaptazodis,);
}
else{
    header("location: ../registracija.php");
    exit();
}