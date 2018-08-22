<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="StyleConfirmationCommande.css"/>
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
$IdHypervenom ="";
$IdClient="";
if(isset($_SESSION["hyperid"])){
$_SESSION["hyperid"] = $IdHypervenom;
}
$_SESSION["IdClient"] = $IdClient;/*PROBLEMMEE*/

try {
  $bdd = new PDO("mysql:host=localhost;dbname=travail", "root", "");
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $req = $bdd->prepare('INSERT INTO commande(ID_Client, ID_Produit) VALUES (:IDClient, :IDProduit)');

  $req->execute(array(

      'IDClient' => $idClient,

      'IDProduit' => $IdHypervenom,
      ));


  echo 'Le jeu a bien été ajouté !';
}
catch (PDOException $e)
 {
  echo "COUCOU C EST FAUX";
 }

?>
</body>
</html>
