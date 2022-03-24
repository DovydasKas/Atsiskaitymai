<?php
include_once 'navigacija.php';
include_once 'includes/functions-inc.php';




if(isset($_SESSION["username"])){
    
    echo "<div class='container' style='border-radius: 1%;'>";
    echo "<div class= 'row' style='margin-bottom:25px'>";
    echo "<div class='col-sm-12' style='text-align:center'>";
    echo "</div>";
    echo "</div>";

    echo "<div class='row d-flex justify-content-center'>";
    echo "<div class='col-sm-6'>";

    echo "<div class='col-sm-6' style='margin-bottom:25px'>";
    echo "<form action='includes/susisiekimas-inc.php' method='post'>";
    echo "<input type='text' class='form-control' name='tema' placeholder='Tema'>";
    echo "<textarea name='zinute' placeholder='Jūsų žinutė...' style='height:250px; width:500px'></textarea>";
    echo "<button style='margin-top:5px' class='btn btn-primary' type='submit' name='siusti'>Siūsti laišką</button><br> <br>";
    echo "</form>";
    echo "</div>";
    echo "<a href='index.php' style='border: 1px solid; border-radius: 16px; padding: 0.2em 16px'>Atgal į pagrindini puslapi.</a>";
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