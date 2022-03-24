<?php
include_once 'navigacija.php';
?>



<div class="container fonas">
    <div class="row">
        <div class="col-md-12">
            <h2>Prisijungimas</h2>
                <form action="includes/prisijungimas-inc.php" method="post">
                    <div class="form-group">
                      <label for="slapyvardis">Prisijungimo Vardas arba El.Paštas</label>
                      <input type="text" class="form-control" name="slapyvardis" placeholder="Įveskite Prisijungimo Vardą arba El.Paštą">
                    </div>
                    <div class="form-group">
                        <label for="slaptazodis">Slaptažodis</label>
                        <input type="password" class="form-control" name="slaptazodis" placeholder="Slaptažodis">
                    </div>
                        <button type="submit" name="prisijungti" class="btn btn-primary">Prisijungti</button>
</form>

<?php
    if(isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo "<p>Užpildykite visus laukelius!</p>";
        }
        else if($_GET["error"] == "netinkamasprisijungimas"){
            echo "<p>Netinkama prisijungimo informacija!</p>";
        }
    }
?>
<br><br>
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>




</html>