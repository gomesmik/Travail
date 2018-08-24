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
try {
  $bdd = new PDO("mysql:host=localhost;dbname=travail", "root", "");
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_Produit) VALUES (:IDClient, :IDProduit)');
  $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
  $req->bindParam(':IDProduit', $_SESSION['hyperid'], PDO::PARAM_INT);
  $req->execute(); /*OBLIGATOIRE AVEC LE BINDPARAM */

  echo 'Merci pour votre commande !';

  $stmt = $bdd->prepare('INSERT INTO ligne_commande (quantite) VALUES (:quantite)');
  $stmt->bindParam(':quantite', $_SESSION['hypquantite'], PDO::PARAM_INT);
  $stmt->execute();
}
catch (PDOException $e)
 {
  echo "Erreur";
 }


?>
</body>
</html>
