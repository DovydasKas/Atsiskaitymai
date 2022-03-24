<?php
session_start();
include_once 'includes/dbh-inc.php';

?>

<!DOCTYPE html>
<html lang="lt">
<head>

<title>Internetinė Parduotuvė</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Varela&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/body.css">
<link rel="stylesheet" href="css/navigacija.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://unpkg.com/cart-localstorage@1.1.4/dist/cart-localstorage.min.js" type="text/javascript"></script>
<script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>


<link rel="stylesheet" type="text/css" href="css/body.css">

</head>
<center>
<body>

<a class="navbar-brand" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
<path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
</svg> Parduotuvė</a>

<nav class="navbar navbar-expand-lg  bg-light">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav ml-auto">

      <?php
      echo "<a class='nav-item nav-link' href='prideti_preke.php'>Pridėti prekę</a>";
      ?>

      <a class="nav-item nav-link active" href="index.php">Pagrindinis puslapis <span class="sr-only">(current)</span></a>

      <a class="nav-item nav-link" href="susisiekimas.php">Susisiekimas</a>
      <?php
        if(isset($_SESSION["username"])){
          echo "<a class='nav-item nav-link' href='profilis.php'>Profilis</a>";
          echo "<a class='nav-item nav-link' href='includes/atsijungimas-inc.php'>Atsijungti</a>";
          echo "<a class='nav-item nav-link' href='krepselis.php' ><i class='fas fa-shopping-basket'></i><span class='iconify' data-icon='typcn:shopping-cart'></span>Krepšelis ";
          if(isset($_SESSION['cart'])){
            $count = count($_SESSION['cart']);
            echo"<span id='cart_count' class='text-light bg-primary'>($count)</span></a>";
          }else{
            echo "<span id='cart_count' class='text-light bg-primary'>(0)</span></a>";
          }
        
        }
        else{
          echo "<a class='nav-item nav-link' href='registracija.php'>Registracija</a>";
          echo "<a class='nav-item nav-link' href='prisijungimas.php'>Prisijungimas</a>";
        }
      ?>
    </div>
  </div>
  
</nav>
