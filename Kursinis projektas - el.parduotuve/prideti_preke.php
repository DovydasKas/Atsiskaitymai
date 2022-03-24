<?php
include_once 'navigacija.php';
?>




<form action="includes/prideti_preke-inc.php" method="post" enctype="multipart/form-data">

  <div class="form-group col-sm-4">
    <label for="pavadinimas">Pavadinimas</label>
    <input type="text" class="form-control" name="pavadinimas">
  </div>

  <div class="form-group col-sm-4">
    <label for="rusis">Rūšis</label>
    <select class="form-control" name="rusis">
      <option>Džinsai</option>
      <option>Kelnės</option>
      <option>Džemperiai</option>
      <option>Marškinėliai</option>
      <option>Striukės</option>
      <option>Megztiniai</option>
      <option>Švarkai</option>
    </select>
  </div>


  <div class="form-group col-sm-4">
    <label for="kaina">Kaina</label>
    <input type="text" class="form-control" name="kaina">
  </div>

  <div class="form-group col-sm-4">
    <label for="aprasymas">Aprašymas</label>
    <textarea class="form-control" name="aprasymas" rows="5"></textarea>
  </div>

  <div class="form-group col-sm-4">
    <label for="nuotrauka">Nuotrauka</label>
    <input type="file" class="form-control" name="nuotrauka">
  </div>

  <button type="submit" name="prideti" class="btn btn-primary">Išsaugoti</button>

</form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>




</html>