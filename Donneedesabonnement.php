<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="Style.css"/>
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


<?php
try
{
  $bdd = new PDO("mysql:host=localhost;dbname=travail", "root", ""); // Create DB connection
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Duplace entry management

  $req = $bdd->prepare("DELETE FROM client WHERE Login = '$nam'");
  $req->execute();

  echo "<meta http-equiv='refresh' content='0;url=index.php'>";

  unset($_SESSION['login']);
  ?>
  <script>alert('Vos données ont bien été suprimée')</script>
  <?php


}
catch(PDOException $e)
{
  echo "FAUX";
}

 ?>


</body>
</html>
