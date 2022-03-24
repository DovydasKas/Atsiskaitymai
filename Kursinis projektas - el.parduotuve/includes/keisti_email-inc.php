<?php
    include_once 'dbh-inc.php';
    include_once 'functions-inc.php';
    session_start();
if(isset($_POST["keistiemail"])){
    $emailnew = $_POST["naujasemail"];

    if(neteisingasEmail($emailnew) !== false){
        header("location: ../profilis.php?error=netinkamasEmail");
        exit();
    }
    if(NeivestasEmail($emailnew) !== false){
        header("location: ../profilis.php?error=neivestasEmail");
        exit();
    }

    keistiEmail($conn, $emailnew);
}
else{
    header("location: profilis.php?error=klaida");
    exit();
}

