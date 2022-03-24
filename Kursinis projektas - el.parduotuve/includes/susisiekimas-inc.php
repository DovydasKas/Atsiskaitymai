<?php
include_once '../navigacija.php';
include_once 'functions-inc.php';
if(isset($_POST["siusti"])){

    $slapyvardis = $_SESSION["username"];
    $takenUid = takenUid($conn, $slapyvardis, $slapyvardis);
    $vardas = $takenUid["Vardas"];
    $pavarde = $takenUid["Pavarde"];
    $email = $takenUid["Email"];
    $tema = $_POST["tema"];
    $zinute = $_POST["zinute"];

    require_once 'dbh-inc.php';
    require_once 'functions-inc.php';

    if(emptyInputSusisiekimas($tema, $zinute) !== false){
        header("location: ../susisiekti.php?error=emptyinput");
        exit();
    }

    susisiekti($conn, $vardas, $pavarde, $email, $tema, $zinute);
}
else{
    header("location: ../susisiekti.php");
        exit();
}