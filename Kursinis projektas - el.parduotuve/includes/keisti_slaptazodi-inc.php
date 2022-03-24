<?php
    include_once 'dbh-inc.php';
    include_once 'functions-inc.php';
    session_start();

if(isset($_POST["keistipass"])){

    $senaspass = $_POST["dabartinispass"];
    $naujaspass = $_POST["naujaspass"];
    $pakartoti = $_POST["pakartotinaujapass"];

    if(nesutampaPass($naujaspass, $pakartoti) !== false){
        header("location: ../profilis.php?error=nesutampaNaujiPass");
        exit();
    }
    if(netinkaDabartinisPass($conn, $senaspass)!== true){
        header ("location: ../profilis.php?error=netinkamasDabartinisPass");
        exit();
    }

    keistiPass($conn, $naujaspass);
}

else{
    header("location: profilis.php?error=Klaida");
    exit();
}
