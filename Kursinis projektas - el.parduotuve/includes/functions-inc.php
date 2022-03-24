<?php

function emptyInputSignup($slapyvardis, $vardas, $pavarde, $email, $slaptazodis, $repslaptazodis){
//$result;
if(empty($vardas) || empty($pavarde) || empty($slapyvardis) || empty($email) || empty($slaptazodis) || empty($repslaptazodis)){
    $result = true;
}
else{
    $result= false;
}
return $result;
}

function invalidUid($slapyvardis){
  //  $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $slapyvardis)){
        $result = true;
    }
    else{
        $result= false;
    }
    return $result;
    }

    function invalidEmail($email){
     //   $result;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = true;
        }
        else{
            $result= false;
        }
        return $result;
        }

        function pwdMatch($slaptazodis, $repslaptazodis){
         //   $result;
            if($slaptazodis !== $repslaptazodis){
                $result = true;
            }
            else{
                $result= false;
            }
            return $result;
            }

            function takenUid($conn, $slapyvardis, $email){
                $sql = "SELECT * FROM users WHERE Slapyvardis = ? OR Email = ?;";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../registracija.php?error=stmtfail");
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "ss", $slapyvardis, $email);
                mysqli_stmt_execute($stmt);

                $resultData = mysqli_stmt_get_result($stmt);

                if($row = mysqli_fetch_assoc($resultData)){
                    return $row;
                }
                else{
                    $result = false;
                    return $result;
                }

                mysqli_stmt_close($stmt);
                }

                function createUser($conn, $slapyvardis, $vardas, $pavarde, $email, $slaptazodis){
                    $sql = "INSERT INTO users (Slapyvardis, Vardas, Pavarde, Email, Slaptazodis) VALUES (?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_query($conn, $sql);



                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("location: ../registracija.php?error=stmtfail");
                        exit();
                    }
                   
                    $hashedPwd = password_hash($slaptazodis, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sssss", $slapyvardis, $vardas, $pavarde, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
    
                    header("location: ../registracija.php?error=none");
                    exit();
                    }

                    function emptyInputLogin($slapyvardis, $slaptazodis){
                     //   $result;
                        if(empty($slapyvardis) || empty($slaptazodis)){
                            $result = true;
                        }
                        else{
                            $result= false;
                        }
                        return $result;
                        }

                        function loginUser($conn, $slapyvardis, $slaptazodis){
                            $takenUid = takenUid($conn, $slapyvardis, $slapyvardis);

                            if($takenUid == false){
                                header("location: ../prisijungimas.php?error=netinkamasprisijungimas");
                                exit();
                            }

                            $pwdHashed = $takenUid["Slaptazodis"];
                            $checkpwd = password_verify($slaptazodis, $pwdHashed);

                            if($checkpwd === false){
                                header("location: ../prisijungimas.php?error=netinkamasprisijungimas");
                                exit();

                            }
                            else if($checkpwd === true){
                                session_start();
                                $_SESSION["userid"] = $takenUid["id"];
                                $_SESSION["username"] = $takenUid["Slapyvardis"];
                                header("location: ../index.php");
                                exit();
                            }
                        }

                        function neivestasNick($slapyvardisnew){
                          //  $result;
                            if(empty($slapyvardisnew)){
                                $result = true;
                            }
                            else{
                                $result= false;
                            }
                            return $result;
                            
                        }

                        function netinkamasNick($slapyvardisnew){
                          //  $result;
                            if(!preg_match("/^[a-zA-Z0-9]*$/", $slapyvardisnew)){
                                $result = true;
                            }
                            else{
                                $result= false;
                            }
                            return $result;
                            
                        }

                        function keistinicka($conn, $slapyvardisnew){
                            $id = $_SESSION["userid"];
                            $sql = "UPDATE users SET Slapyvardis='$slapyvardisnew' WHERE id='$id'";
                            $_SESSION["username"] = $slapyvardisnew;
                            mysqli_query($conn, $sql);

                            header("location: ../profilis.php?error=pakeistasNick");

                            exit();

                        }

                        function nesutampaPass($naujaspass, $pakartoti){
                            
                            if($naujaspass !== $pakartoti){
                                $result = true;
                            }
                            else{
                                $result= false;
                            }
                            return $result;
                            }

                           function netinkaDabartinisPass($conn, $senaspass){
                            $slapyvardis = $_SESSION["username"];
                            $takenUid = takenUid($conn, $slapyvardis, $slapyvardis);
                            $pwdHashed = $takenUid["Slaptazodis"];
                            $checkpwd = password_verify($senaspass, $pwdHashed);

                            if($checkpwd === false){
                                $result = false;
                            }
                            else{
                                $result= true;
                            }
                            return $result;
                            }

                        function keistiPass($conn, $naujaspass){
                            $id = $_SESSION["userid"];
                            $hashPw = password_hash($naujaspass, PASSWORD_DEFAULT);
                            $sql = "UPDATE users SET Slaptazodis='$hashPw' WHERE id='$id'";
                            mysqli_query($conn, $sql);
                            header("location: ../profilis.php?error=SlaptazodisPakeistas");
                            exit();
                        }

                        function neteisingasEmail ($emailnew){
                            if(!filter_var($emailnew, FILTER_VALIDATE_EMAIL)){
                                $result = true;
                            }
                            else{
                                $result= false;
                            }
                            return $result;

                        }

                        function NeivestasEmail($emailew){
                        //    $result;
                            if(empty($emailew)){
                                $result = true;
                            }
                            else{
                                $result= false;
                            }
                            return $result;
                            }

                            function keistiEmail($conn, $emailnew){
                             //   $result;
                                $id = $_SESSION["userid"];

                                $sql = "UPDATE users SET Email='$emailnew' WHERE id='$id'";
                                mysqli_query($conn, $sql);
                                header("location: ../profilis.php?error=pakeistasEmail");
                                exit();
                            }

                            function pridetiPreke($conn, $pavadinimas, $rusis, $kaina, $aprasymas, $nuotrauka){
                                $sql = "INSERT INTO prekes (pavadinimas, rusis, kaina, aprasymas, paveikslelis) VALUES ('".$pavadinimas."', '".$rusis."', '".$kaina."', '".$aprasymas."', '".$nuotrauka."')";
                                $stmt = mysqli_stmt_init($conn);
                                mysqli_query($conn, $sql);


                                
            
                                if(!mysqli_stmt_prepare($stmt, $sql)){
                                    header("location: ../prideti_preke.php?error=stmtfail");
                                    exit();
                                }
                                header("location: ../prideti_preke.php?error=prideta");
                                exit();
                                }

                                function sarasas($pavadinimas, $kaina, $paveikslelis, $productid){
                                    
                                    $preke = "
                                    
                                    <div class=\"col-sm-3\">
                                    <form action=\"index.php\" method=\"post\">
                                    <div class=\"card korteles\" style=\"width:255px\">
                                      <img class=\"card-img-top\" src=\"./prekes/$paveikslelis\" alt=\"Card image\" style=\"width:100%\">
                                      <div class=\"card-body\">
                                      <hr>
                                        <h6 class=\"card-title\"  style='width:10rem; height:75px'>$pavadinimas</h6>
                                        
                                        <p class=\"card-text\">$kaina €</p>
                                        <button type=\"submit\" class=\"btn btn-block btn-outline-primary\" name=\"add\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-cart-plus-fill\" viewBox=\"0 0 16 16\">
                                    <path d=\"M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z\"/>
                                  </svg>Į krepšelį</button>
                                  <input type='hidden' name='product_id' value='$productid'>
                                    <br>
                                  
                                  <button type=\"submit\" class=\"btn btn-block btn-outline-danger\" name=\"del\">
                                  Ištrinti</button>
                                    

                                      </div>
                                    </div>
                                    </form>
                                    <br><br>
                                     </div>
                                    
                                    ";
                                    echo $preke;
                                }


                                function prekeKrepselyje($pavadinimas, $kaina, $paveikslelis, $productid){
                                    $preke = "
                                    <form action=\"krepselis.php?action=remove&id=$productid\" method=\"post\">
                                    <div class='row'>
                                                  <div class='row main align-items-center'>
                                                      <div class='col-2'><img class='img-fluid' src='./prekes/$paveikslelis'></div>
                                                      <div class='col'>
                                                          <div class='row text-muted'></div>
                                                          <div class='row'>$pavadinimas</div>
                                                      </div>
                                                      
                                                      <div class='col'>&euro; $kaina <span class='close'><button class='btn-danger' name='pasalinti'>Pašalinti</button></span></div>
                                                  </div>
                                              </div>
                                    
                                    ";
                                    echo $preke;
                                  }

function emptyInputSusisiekimas($tema, $zinute){

    if(empty($tema) || empty($zinute)){
        $result = true;
    }
    else{
        $result= false;
    }
    return $result;
    }

function susisiekti($conn, $vardas, $pavarde, $email, $tema, $zinute){
    $sql = "INSERT INTO susisiekimas (Vardas, Pavarde, Email, Tema, Zinute) VALUES ('".$vardas."', '".$pavarde."', '".$email."', '".$tema."', '".$zinute."')";
    $stmt = mysqli_stmt_init($conn);
    mysqli_query($conn, $sql);  

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../susisiekimas.php?error=stmtfail");
        exit();
    }
    header("location: ../susisiekimas.php?error=prideta");
    exit();

}

function istrintiPreke($conn, $id){
    $sql = "DELETE FROM prekes WHERE id = '$id'";
    $stmt = mysqli_stmt_init($conn);
    mysqli_query($conn, $sql);  

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfail");
        exit();
    }
    header("location: ../index.php?error=pasalinta");
    exit();

}



                        
    