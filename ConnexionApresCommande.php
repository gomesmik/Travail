<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="StyleConnexionApresCommande.css"/>
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
         echo "<meta http-equiv='refresh' content='0;url=connexion.php'>";
	    }
	    else
	    {
        ?>
        <li style="float:right"><a href="connexion.php">Connexion</a></li>
		</li>
  </ul>

</header>
<div id="left">
</div>
<div id="right">
</div>
<?php
}
?>
</body>
</html>
