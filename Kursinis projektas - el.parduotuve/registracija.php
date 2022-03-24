<?php
include_once 'navigacija.php';
?>

<?php
    if(isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo "<div class='alert alert-danger' role='alert'>Užpildykite visus langus!</div>";
        }
        else if($_GET["error"] == "invalidUid"){
            echo "<div class='alert alert-danger' role='alert'>Netinkamas prisijungimo vardas!</div>";
        }
        else if($_GET["error"] == "invalidEmail"){
            echo "<div class='alert alert-danger' role='alert'>Netinkamas el.paštas!</div>";
        }
        else if($_GET["error"] == "passwordmatch"){
            echo "<div class='alert alert-danger' role='alert'>Nesutampa įvesti slaptažodžiai!</div>";
        }
        else if($_GET["error"] == "takenuid"){
            echo "<div class='alert alert-danger' role='alert'>Toks vartotojo vardas ir/arba elektroninis paštas jau užregistruotas!</div>";
        }
        else if($_GET["error"] == "stmtfail"){
            echo "<div class='alert alert-danger' role='alert'>Ivyko nenumatyta klaida. Bandykit iš naujo</div>";
        }
        else if($_GET["error"] == "none"){
            echo"<div class='alert alert-success' role='alert'>Registracija sėkminga! Galite prisijungti</div>";
  

        }
    }
?>


<div class="container fonas">
    <div class="row">
        <div class="col-md-12">
            <h2>Registracija</h2>
                <form action="includes/registracija-inc.php" method="post">
                    <div class="form-group">
                      <label for="slapyvardis">Prisijungimo Vardas</label>
                      <input type="text" class="form-control" name="slapyvardis" placeholder="Prisijungimo vardas">
                      <small id="emailHelp" class="form-text text-muted">Prisijungimo vardas naudojamas prisijungiant į puslapį</small>
                    </div>

                    <div class="form-group">
                        <label for="vardas">Vardas</label>
                        <input type="text" class="form-control" name="vardas" placeholder="Vardas">
                    </div>

                    <div class="form-group">
                        <label for="pavarde">Pavardė</label>
                        <input type="text" class="form-control" name="pavarde" placeholder="Pavardė">
                    </div>

                    <div class="form-group">
                        <label for="email">El.Paštas</label>
                        <input type="email" class="form-control" name="email" placeholder="Elektroninis paštas">
                    </div>

                    <div class="form-group">
                        <label for="slaptazodis">Slaptažodis</label>
                        <input type="password" class="form-control" name="slaptazodis" placeholder="Slaptažodis">
                    </div>

                    <div class="form-group">
                        <label for="repslaptazodis">Pakartoti Slaptažodį</label>
                        <input type="password" class="form-control" name="repslaptazodis" placeholder="Pakartokite slaptažodį">
                    </div>
                        <button type="submit" name="registruotis" class="btn btn-primary">Registruotis</button>
</form>


<br><br>
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>




</html>