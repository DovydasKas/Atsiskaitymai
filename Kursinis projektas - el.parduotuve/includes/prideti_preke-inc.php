<?php
require_once 'dbh-inc.php';
require_once 'functions-inc.php';


if(isset($_POST["prideti"])){

  $nuotrauka = $_FILES["nuotrauka"]["name"];
  $tmpnuotrauka = $_FILES["nuotrauka"]["tmp_name"];
  $nuotraukosdir = "./prekes/".$nuotrauka;
  move_uploaded_file($tmpnuotrauka, $nuotraukosdir);

    $pavadinimas = $_POST["pavadinimas"];
    $rusis = $_POST["rusis"];
    $kaina = $_POST["kaina"];
    $aprasymas = $_POST["aprasymas"];

    $nuotrauka = time() . '_' . $_FILES["nuotrauka"]["name"];
    $uploaddir = 'D:\\Program files\\xampp\\htdocs\\prekes\\';
    $uploadfile = $uploaddir . $nuotrauka;
    move_uploaded_file($_FILES['nuotrauka']['tmp_name'], $uploadfile);
    //move_uploaded_file($tmpnuotrauka, $nuotraukosdir);
    





  //  if(emptyInput($pavadinimas, $rusis, $kaina, $aprasymas, $nuotrauka) !== false){
  //      header("location: ../prideti_preke.php?error=emptyinput");
  //      exit();
  //  }
  //  if(invalidUid($slapyvardis) !== false){
  //      header("location: ../registracija.php?error=invalidUid");
  //      exit();
  //  }
   // if(invalidEmail($email) !== false){
   //     header("location: ../registracija.php?error=invalidEmail");
   //     exit();
  //  }
  //  if(pwdMatch($slaptazodis, $repslaptazodis) !== false){
  //      header("location: ../registracija.php?error=passwordmatch");
  //      exit();
  //  }
  //  if(takenUid($conn, $slapyvardis, $email) !== false){
  //      header("location: ../registracija.php?error=takenuid");
  //      exit();
  //  }


  pridetiPreke($conn, $pavadinimas, $rusis, $kaina, $aprasymas, $nuotrauka);
}
else{
    header("location: ../index.php");
    exit();
}