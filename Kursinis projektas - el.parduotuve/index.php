<?php
include_once 'navigacija.php';
include_once 'sarasas.php';
include_once 'includes/functions-inc.php';
?>




<div>
        <div class="container fonas" style="border-radius: 1%;">
        <div class="row" style="padding-top: 10px;">
   
  <?php
  //Prekių sarašas iš duomenų bazės
  $result = getData();
  while($row = mysqli_fetch_assoc($result)){
    sarasas($row["pavadinimas"], $row["kaina"],$row["paveikslelis"],$row["id"]);
    

    
  }
  //Prekiu šalinimas
  if(isset($_POST['del'])){
    $id = $_POST['product_id'];
    istrintiPreke($conn, $id);
  }

//Prekių pridėjimas į krepšelį
  if(isset($_POST['add'])){
    //Patikrina ar klientas dėjo kažką į krepšeli
    if(isset($_SESSION['cart'])){
      $item_array_id = array_column($_SESSION['cart'], 'product_id');
      
//Jeigu prekė jau yra krepšelyj išmesti pranešima kad jau yra ir redirectintint atgal i index.php
      if(in_array($_POST['product_id'], $item_array_id)){
        echo "<script>alert('Ši prekė jau yra jūsų krepšelyje')</script>";
        echo "<script>window.location = 'index.php'</script>";
      }else{
        $count = count($_SESSION['cart']); //Suskaičiuoti kiek prekiu krepšelyj
        $item_array = array('product_id' => $_POST['product_id']);
        $_SESSION['cart'][$count] = $item_array;
        
      }
    
  }else{
    $item_array = array('product_id' => $_POST['product_id']);

    $_SESSION['cart'][0] = $item_array;
   // print_r($_SESSION['cart']);
  }
}
  ?>



   </div>

   </div>

</div>
        
  
    


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</center>



</html>