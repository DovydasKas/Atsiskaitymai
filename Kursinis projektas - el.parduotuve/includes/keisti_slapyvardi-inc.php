<?php
    include_once 'dbh-inc.php';
    include_once 'functions-inc.php';
    session_start();
if(isset($_POST["keistinick"])){

    $slapyvardisnew = $_POST["naujass"];

    if(netinkamasNick($slapyvardisnew) !== false){
        header("location: ../profilis.php?error=netinkamasNick");
        exit();
    }
    if(neivestasNick($slapyvardisnew) !== false){
        header("location: ../profilis.php?error=neivestasNick");
        exit();
    }
  
    keistinicka($conn, $slapyvardisnew);
}
else{
    header("location: profilis.php?error=klaida");
    exit();
}

