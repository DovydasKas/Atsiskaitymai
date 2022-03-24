<?php
include_once 'navigacija.php';
include_once 'includes/functions-inc.php';
?>

<?php

if(isset($_GET["error"])){
    if($_GET["error"] == "pakeistasNick"){
        echo"<br><div class='alert alert-success' role='alert'>Slapyvardis sėkmingai pakeistas!</div>";
    }
    else if($_GET["error"] == "netinkamasNick"){
        echo"<br><div class='alert alert-danger' role='alert'>Įvedėte netinkama slapyvardi!</div>";
    }
    else if($_GET["error"] == "neivestasNick"){
        echo"<br><div class='alert alert-danger' role='alert'>Pirmiausia įveskite naują slapyvardi!</div>";
    }
    else if($_GET["error"] == "klaida"){
        echo "<br><div class='alert alert-danger' role='alert'>Ivyko nenumatyta klaida. Bandykite iš naujo</div>";
    }
    else if($_GET["error"] == "nesutampaNaujiPass"){
        echo "<br><div class='alert alert-danger' role='alert'>Naujas slaptažodis nesutampa su slaptažodžio patvirtinimu!</div>";
    }
    else if($_GET["error"] == "netinkamasDabartinisPass"){
        echo "<br><div class='alert alert-danger' role='alert'>Blogas dabartinis slaptažodis!</div>";
    }
    else if($_GET["error"] == "SlaptazodisPakeistas"){
        echo"<br><div class='alert alert-success' role='alert'>Slaptažodis sėkmingai pakeistas!</div>";
    }
    else if($_GET["error"] == "Klaida"){
        echo "<br><div class='alert alert-danger' role='alert'>Ivyko nenumatyta klaida! Bandykite iš naujo</div>";
    }
    else if($_GET["error"] == "pakeistasEmail"){
        echo"<br><div class='alert alert-success' role='alert'>El.Paštas sėkmingai pakeistas!</div>";
    }
    else if($_GET["error"] == "netinkamasEmail"){
        echo "<br><div class='alert alert-danger' role='alert'>Ivedėte netinkama el.pašto adresą!</div>";
    }
    else if($_GET["error"] == "neivestasEmail"){
        echo "<br><div class='alert alert-danger' role='alert'>Pirmiausia įveskite naują el.pašto adresą!</div>";
    }
}

        if(isset($_SESSION["username"])){
            $slapyvardis = $_SESSION["username"];
            $takenUid = takenUid($conn, $slapyvardis, $slapyvardis);
            $vardas = $takenUid["Vardas"];
            $pavarde = $takenUid["Pavarde"];
            $email = $takenUid["Email"];
            $role = $takenUid["Role"];
            

          echo "<div style='margin-bottom:25px;border-radius: 1%' class='container fonas'>";
          
          echo "<div class= 'row' style='margin-bottom:25px'>";
          echo "<div class='col-sm-12' style='text-align:center'>";
          echo "<p style='text-align:center'><h3>Profilio informacija</h3></p>";
          echo "</div>";
          echo "</div>";

          echo "<div class= 'row' style='margin-bottom:25px'>";
          echo "<div class='col-sm-12'>";
          
          echo "Slapyvardis: <h6>". $_SESSION["username"]. "</h6>";
          echo "Vardas: <h6>". $vardas. "</h6>";
          echo "Pavardė: <h6>". $pavarde. "</h6>";
          echo "Elektroninis paštas: <h6>". $email. "</h6>";

          echo "<a href='redaguoti.php' style='border: 1px solid; border-radius: 16px; padding: 0.2em 16px'>Redaguoti Informacija</a>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
        }
        else{
          echo "<h3 style='color:red; text-align: center'>Pirmiausia prisijunkite!</h3>";
        }
      
    
?>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>