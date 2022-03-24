<?php
include_once 'navigacija.php';
include_once 'includes/functions-inc.php';

if (isset($_POST['pasalinti'])){

   
   if($_GET['action'] == 'remove'){
       foreach($_SESSION['cart'] as $kr => $prek){
           if($prek['product_id'] == $_GET['id']){
               unset($_SESSION['cart'][$kr]);
               echo"<script>alert('Produktas pašalintas iš krepšelio!')</script>";
               echo"<script>window.location = 'krepselis.php'</script>";
           }
       }
   }
}
?>
<link rel="stylesheet" href="css/krepselis.css">
<?php
$suma = 0;
if(isset($_SESSION['cart'])){
           $product_id = array_column($_SESSION['cart'], 'product_id');

           $result = getData();
           while($row = mysqli_fetch_assoc($result)){
             foreach($product_id as $id)
                if($row['id'] == $id){
                    prekeKrepselyje($row["pavadinimas"], $row["kaina"],$row["paveikslelis"],$row["id"]);
                    $suma = $suma + (int)$row['kaina'];
                    echo "</form>";
                }
             
           }
        }else{
            echo"<h6>Krepšelyje nieko nėra!</h6>";
        }
     ?>
     <center>
           <div class="back-to-shop"><a href="index.php">&leftarrow;</a><span class="text-muted">Eiti į pagrindini puslapį</span></div>

        <div class="col-md-4 summary">
            <div>
                <h5><b>Apmokėjimas</b></h5>
            </div>
            <hr>
            <form>
                <p>Pristatymas</p> <select>
                    <option class="text-muted">DPD kurjeris &euro;5.00</option>
                </select>
               
            </form>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
            <?php 
            if(isset($_SESSION['cart'])){
              
                echo "<div class='col'>Suma:</div>";
                echo "<div class='col text-right'>&euro; $suma + Pristatymo mokestis</div>";
            }
            ?>
            </div> <button class="btn" name='pirkti'>Pirkti</button>
        </div>
        </form>
        </center>