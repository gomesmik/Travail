<?php session_start();
if(isset($_POST['taille'], $_POST['quantite'])){
$_SESSION['taille'] = $_POST['taille'];
$_SESSION['quantite'] = $_POST['quantite'];
}
elseif (isset($_POST['hyptaille'], $_POST['hypquantite'])){
$_SESSION['hyptaille'] = $_POST['hyptaille'];
$_SESSION['hypquantite'] = $_POST['hypquantite'];
}
elseif (isset($_POST['magtaille'], $_POST['quantite'])){
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
   <tr>
              <td>Taille</td>
              <td>Article</td>
              <td>Quantité </td>
              <td>Prix </td>
    </tr>
      <tr>
             <?php
               if(isset($_SESSION['taille'], $_SESSION['quantite'])){
                 ?>
                 <td><?php echo $_SESSION['taille']; ?> </td>
                 <td><?php echo $_SESSION['tiempodescr']; ?> </td>
                 <td><?php echo $_SESSION['quantite']; ?> </td>
                 <td><?php echo $_SESSION['price']; ?> </td>
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
       if(isset($_SESSION['hyptaille'], $_SESSION['hypquantite'])){
         ?>
         <td><?php echo $_SESSION['hyptaille']; ?> </td>
         <td><?php echo $_SESSION['hypdescr']; ?> </td>
         <td><?php echo $_SESSION['hypquantite']; ?> </td>
         <td><?php echo $_SESSION['hypprice']; ?> </td>
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
       if(isset($_SESSION['magtaille'], $_SESSION['magquantite'])){
         ?>
         <td><?php echo $_SESSION['magtaille']; ?> </td>
         <td><?php echo $_SESSION['magdescr']; ?> </td>
         <td><?php echo $_SESSION['magquantite']; ?> </td>
         <td><?php echo $_SESSION['magprice']; ?> </td>
         <td><a href="supressionPanier2.php"><img src="images/poubelle.png" alt="delete" height="15" width="20"></a></td>
         <?php
         }
       else {
         echo"";
       }
       ?>
   </tr>

</table>
</body>
</html>
