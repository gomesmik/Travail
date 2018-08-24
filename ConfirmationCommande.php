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

  if(isset($_SESSION['hyperid'], $_SESSION['magid'], $_SESSION['tiempoid'])){
  $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_Produit, ID_ProduitMag, ID_ProduitTiemp) VALUES (:IDClient, :IDProduit, :IDProduitMag, :IDProduitTiemp)');
  $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
  $req->bindParam(':IDProduit', $_SESSION['hyperid'], PDO::PARAM_INT);
  $req->bindParam(':IDProduitMag', $_SESSION['magid'], PDO::PARAM_INT);
  $req->bindParam(':IDProduitTiemp', $_SESSION['tiempoid'], PDO::PARAM_INT);
  $req->execute();
  }
  elseif (isset($_SESSION['hyperid'], $_SESSION['magid'])){
    $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_Produit, ID_ProduitMag) VALUES (:IDClient, :IDProduit, :IDProduitMag)');
    $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
    $req->bindParam(':IDProduit', $_SESSION['hyperid'], PDO::PARAM_INT);
    $req->bindParam(':IDProduitMag', $_SESSION['magid'], PDO::PARAM_INT);
    $req->execute();
  }
  elseif (isset($_SESSION['hyperid'], $_SESSION['tiempoid'])){
    $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_Produit, ID_ProduitTiemp) VALUES (:IDClient, :IDProduit, :ID_ProduitTiemp)');
    $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
    $req->bindParam(':IDProduit', $_SESSION['hyperid'], PDO::PARAM_INT);
    $req->bindParam(':ID_ProduitTiemp', $_SESSION['tiempoid'], PDO::PARAM_INT);
    $req->execute();
  }
  elseif (isset($_SESSION['tiempoid'], $_SESSION['magid'])){
    $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_ProduitMag, ID_ProduitTiemp) VALUES (:IDClient, :IDProduitMag, :IDProduitTiemp)');
    $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
    $req->bindParam(':IDProduitMag', $_SESSION['magid'], PDO::PARAM_INT);
    $req->bindParam(':IDProduitTiemp', $_SESSION['tiempoid'], PDO::PARAM_INT);
    $req->execute();
  }
  elseif (isset($_SESSION['hyperid'])){
    $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_Produit) VALUES (:IDClient, :IDProduit)');
    $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
    $req->bindParam(':IDProduit', $_SESSION['hyperid'], PDO::PARAM_INT);
    $req->execute();
  }
  elseif (isset($_SESSION['magid'])){
    $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_ProduitMag) VALUES (:IDClient, :IDProduitMag)');
    $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
    $req->bindParam(':IDProduitMag', $_SESSION['magid'], PDO::PARAM_INT);
    $req->execute();

  }
  elseif (isset($_SESSION['tiempoid'])){
    $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_ProduitTiemp) VALUES (:IDClient, :ID_ProduitTiemp)');
    $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
    $req->bindParam(':ID_ProduitTiemp', $_SESSION['tiempoid'], PDO::PARAM_INT);
    $req->execute();
  }
  ?>
  <div>
    <?php
  echo 'Merci pour votre commande !' . "</br>";
  echo 'Vous pouvez maintenant avoir accès au détail de la commande sur votre compte';

  ?>

</div>
    <?php

  $stmt = $bdd->prepare('INSERT INTO ligne_commande (ID_Commande, ID_Produit, quantite) VALUES (:quantite, :ID_Commande, :ID_Produit)');
  $stmt->bindParam(':quantite', $_SESSION['hypquantite'], PDO::PARAM_INT);
  $stmt->bindParam(':ID_Commande', $_SESSION['hypquantite'], PDO::PARAM_INT);
  $stmt->bindParam(':ID_Produit', $_SESSION['hypquantite'], PDO::PARAM_INT);
  $stmt->execute();
}
catch (PDOException $e)
 {
  echo "Erreur";
 }


?>
<p>
  <img src="images/merci.png" alt="panier" height="300" width="300" class="merci">
</p>
</body>
</html>
