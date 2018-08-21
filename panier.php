<?php session_start();


if(isset($_POST['taille'], $_POST['quantite'])){
$_SESSION['taille'] = $_POST['taille'];
$_SESSION['quantite'] = $_POST['quantite'];
}

if (isset($_POST['hyptaille'], $_POST['hypquantite'])){
$_SESSION['hyptaille'] = $_POST['hyptaille'];
$_SESSION['hypquantite'] = $_POST['hypquantite'];
}
else {
  "";
}

if (isset($_POST['magtaille'], $_POST['magquantite'])){
$_SESSION['magtaille'] = $_POST['magtaille'];
$_SESSION['magquantite'] = $_POST['magquantite'];
}
else{
  "";
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="Stylepanier.css"/>
  <meta charset="UTF-8">
</head>

<body>
<header>
  <ul>
    <li><a href="Index.php">Home</a></li>
    <li><a href="produit.php">Produit</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li style="float:right">
			<?php
	    if(isset($_SESSION['login']))
			{
		     $nam = $_SESSION['login'];
	       echo '<a href="Bienvenue.php">'. $nam . '</a>';
	    }
	    else
	    {
	        echo  '<a href="connexion.php"> Connexion </a>';
	    }
	    ?>
		</li>
  </ul>

</header>
<table>
   <tr class="head">
              <td style="border-bottom:1pt solid #FE2EF7";>Taille</td>
              <td style="border-bottom:1pt solid #FE2EF7";>Article</td>
              <td style="border-bottom:1pt solid #FE2EF7";>Quantité </td>
              <td style="border-bottom:1pt solid #FE2EF7";>Prix </td>
    </tr>
      <tr>
             <?php
             $prixtiempo = 0;
               if(isset($_SESSION['taille'], $_SESSION['quantite'])){
                 $prixtiempo = $_SESSION['quantite'] * $_SESSION['price'];
                 $vartiempo = number_format($prixtiempo, 2 );
                 ?>
                 <td><?php echo $_SESSION['taille']; ?> </td>
                 <td><?php echo $_SESSION['tiempodescr']; ?> </td>
                 <td><?php echo $_SESSION['quantite']; ?> </td>
                 <td><?php echo $vartiempo; ?> </td>
                 <td><a href="supressionPanier.php"><img src="images/poubelle.png" alt="delete" height="15" width="20"></a></td>
                 <?php
                 }
               else {
                 echo"";
               }
               ?>
   </tr>

   <tr>
     <?php
        $prixhyper = 0;
       if(isset($_SESSION['hyptaille'], $_SESSION['hypquantite'])){
         $prixhyper = $_SESSION['hypquantite'] * $_SESSION['hypprice'];
         $varhyper = number_format($prixhyper, 2 );
         ?>
         <td><?php echo $_SESSION['hyptaille']; ?> </td>
         <td><?php echo $_SESSION['hypdescr']; ?> </td>
         <td><?php echo $_SESSION['hypquantite']; ?> </td>
         <td><?php echo $varhyper; ?> </td>
         <td><a href="supressionPanier2.php"><img src="images/poubelle.png" alt="delete" height="15" width="20"></a></td>
         <?php
         }
       else {
         echo"";
       }
       ?>
   </tr>
   <tr>
     <?php
     $prixmagista = 0;
       if(isset($_SESSION['magtaille'], $_SESSION['magquantite'])){
         $prixmagista = $_SESSION['magquantite'] * $_SESSION['magprice'];
         $varmagista = number_format($prixmagista, 2 );
         ?>
         <td><?php echo $_SESSION['magtaille']; ?> </td>
         <td><?php echo $_SESSION['magdescr']; ?> </td>
         <td><?php echo $_SESSION['magquantite']; ?> </td>
         <td><?php echo $varmagista; ?> </td>
         <td><a href="supressionPanier3.php"><img src="images/poubelle.png" alt="delete" height="15" width="20"></a></td>
         <?php
         }
       else {
         echo"";
       }
      ?>
   </tr>

   <tr>
         <TD colspan=3 style="border-top:1pt solid #FE2EF7";>TOTAL</TD>
         <td style="border-top:1pt solid #FE2EF7";>
           <?php
              $totalmagtiemp = $prixmagista + $prixtiempo;
              $totalmagtiemp = number_format($totalmagtiemp, 2 );
              $totalmagistahyp = $prixmagista + $prixhyper;
              $totalmagistahyp = number_format($totalmagistahyp, 2 );
              $totaltiemphyp = $prixtiempo + $prixhyper;
              $totaltiemphyp = number_format($totaltiemphyp, 2 );
              $totaltiempo = $prixtiempo;
              $totaltiempo = number_format($totaltiempo, 2 );
              $totalhypervenom = $prixhyper;
              $totalhypervenom = number_format($totalhypervenom, 2);
              $totalmagista = $prixmagista;
              $totalmagista = number_format($totalmagista, 2);
              $total = $prixhyper + $prixtiempo + $prixmagista;

              /*s'il achete tout*/
            if(isset($_SESSION['magtaille'], $_SESSION['magquantite'], $_SESSION['hyptaille'], $_SESSION['hypquantite'], $_SESSION['taille'], $_SESSION['quantite'])){
              echo $total;
              }
              /*s'il achete magista et tiempo*/
            elseif(isset($_SESSION['magtaille'], $_SESSION['magquantite'], $_SESSION['taille'], $_SESSION['quantite'])){
                echo $totalmagtiemp;
              }
              /*s'il achete magista et hypervenom*/
            elseif(isset($_SESSION['magtaille'], $_SESSION['magquantite'], $_SESSION['hyptaille'], $_SESSION['hypquantite'])){
                echo $totalmagistahyp;
              }
              /*s'il achete tiempo et hypervenom*/
            elseif(isset($_SESSION['taille'], $_SESSION['quantite'], $_SESSION['hyptaille'], $_SESSION['hypquantite'])){
                $totalth = ($_SESSION['price'] * $_SESSION['quantite'])  + ($_SESSION['hyptaille']* $_SESSION['hypquantite']);
                echo $totaltiemphyp;
              }
              /*s'il achete tiempo*/
            elseif(isset($_SESSION['taille'], $_SESSION['quantite'])){
                echo $totaltiempo;
                }
            /*s'il achete hypervenom*/
            elseif(isset($_SESSION['hyptaille'], $_SESSION['hypquantite'])){
                echo $totalhypervenom;
                }
          /*s'il achete magista*/
          elseif(isset($_SESSION['magtaille'], $_SESSION['magquantite'])){
                    echo $totalmagista;
                    }
          else{
            echo "Votre panier est vide ..";
          }

         ?></td>

   </tr>
</table>
<div class="bouton">
<a href="ConnexionApresCommande.php">Commander</a>
</div>
</body>
</html>
