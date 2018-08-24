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

  $rep = $bdd -> lastInsertId();

  $stmt = $bdd->prepare('INSERT INTO ligne_commande (ID_Commande, Quantite, QuantiteHyp, QuantiteMag) VALUES (:ID_Commande, :quantite, :QuantiteHyp, :QuantiteMag)');
  $stmt->bindParam(':ID_Commande', $rep, PDO::PARAM_INT);
  $stmt->bindParam(':quantite', $_SESSION['quantite'], PDO::PARAM_INT);
  $stmt->bindParam(':QuantiteHyp', $_SESSION['hypquantite'], PDO::PARAM_INT);
  $stmt->bindParam(':QuantiteMag', $_SESSION['magquantite'], PDO::PARAM_INT);
  $stmt->execute();

  unset($_SESSION['hyptaille']);
  unset($_SESSION['magtaille']);
  unset($_SESSION['taille']);
  unset($_SESSION['hyperid']);
  unset($_SESSION['magid']);
  unset($_SESSION['tiempoid']);
  }
  elseif (isset($_SESSION['hyperid'], $_SESSION['magid'])){
    $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_Produit, ID_ProduitMag) VALUES (:IDClient, :IDProduit, :IDProduitMag)');
    $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
    $req->bindParam(':IDProduit', $_SESSION['hyperid'], PDO::PARAM_INT);
    $req->bindParam(':IDProduitMag', $_SESSION['magid'], PDO::PARAM_INT);
    $req->execute();

    $rep = $bdd -> lastInsertId();

    $stmt = $bdd->prepare('INSERT INTO ligne_commande (ID_Commande, QuantiteHyp, QuantiteMag) VALUES (:ID_Commande, :QuantiteHyp, :QuantiteMag)');
    $stmt->bindParam(':ID_Commande', $rep, PDO::PARAM_INT);
    $stmt->bindParam(':QuantiteHyp', $_SESSION['hypquantite'], PDO::PARAM_INT);
    $stmt->bindParam(':QuantiteMag', $_SESSION['magquantite'], PDO::PARAM_INT);
    $stmt->execute();

    unset($_SESSION['hyptaille']);
    unset($_SESSION['magtaille']);
    unset($_SESSION['hyperid']);
    unset($_SESSION['magid']);
  }
  elseif (isset($_SESSION['hyperid'], $_SESSION['tiempoid'])){
    $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_Produit, ID_ProduitTiemp) VALUES (:IDClient, :IDProduit, :ID_ProduitTiemp)');
    $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
    $req->bindParam(':IDProduit', $_SESSION['hyperid'], PDO::PARAM_INT);
    $req->bindParam(':ID_ProduitTiemp', $_SESSION['tiempoid'], PDO::PARAM_INT);
    $req->execute();

    $rep = $bdd -> lastInsertId();

    $stmt = $bdd->prepare('INSERT INTO ligne_commande (ID_Commande, Quantite, QuantiteHyp) VALUES (:ID_Commande, :Quantite, :QuantiteHyp)');
    $stmt->bindParam(':ID_Commande', $rep, PDO::PARAM_INT);
    $stmt->bindParam(':Quantite', $_SESSION['quantite'], PDO::PARAM_INT);
    $stmt->bindParam(':QuantiteHyp', $_SESSION['hypquantite'], PDO::PARAM_INT);
    $stmt->execute();


    unset($_SESSION['hyptaille']);
    unset($_SESSION['taille']);
    unset($_SESSION['hyperid']);
    unset($_SESSION['tiempoid']);
  }
  elseif (isset($_SESSION['tiempoid'], $_SESSION['magid'])){
    $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_ProduitMag, ID_ProduitTiemp) VALUES (:IDClient, :IDProduitMag, :IDProduitTiemp)');
    $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
    $req->bindParam(':IDProduitMag', $_SESSION['magid'], PDO::PARAM_INT);
    $req->bindParam(':IDProduitTiemp', $_SESSION['tiempoid'], PDO::PARAM_INT);
    $req->execute();

    $rep = $bdd -> lastInsertId();

    $stmt = $bdd->prepare('INSERT INTO ligne_commande (ID_Commande, Quantite, QuantiteMag) VALUES (:ID_Commande, :Quantite, :QuantiteMag)');
    $stmt->bindParam(':ID_Commande', $rep, PDO::PARAM_INT);
    $stmt->bindParam(':Quantite', $_SESSION['quantite'], PDO::PARAM_INT);
    $stmt->bindParam(':QuantiteMag', $_SESSION['magquantite'], PDO::PARAM_INT);
    $stmt->execute();

    unset($_SESSION['magtaille']);
    unset($_SESSION['taille']);
    unset($_SESSION['magid']);
    unset($_SESSION['tiempoid']);
  }
  elseif (isset($_SESSION['hyperid'])){
    $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_Produit) VALUES (:IDClient, :IDProduit)');
    $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
    $req->bindParam(':IDProduit', $_SESSION['hyperid'], PDO::PARAM_INT);
    $req->execute();

    $rep = $bdd -> lastInsertId();
    $hyp = 1;
    $stmt = $bdd->prepare('INSERT INTO ligne_commande (ID_Commande, ID_Produit, QuantiteHyp) VALUES (:ID_Commande,:ID_Produit, :QuantiteHyp)');
    $stmt->bindParam(':ID_Commande', $rep, PDO::PARAM_INT);
    $stmt->bindParam(':ID_Produit', $hyp, PDO::PARAM_INT);
    $stmt->bindParam(':QuantiteHyp', $_SESSION['hypquantite'], PDO::PARAM_INT);
    $stmt->execute();

    unset($_SESSION['hyptaille']);
    unset($_SESSION['hyperid']);
  }
  elseif (isset($_SESSION['magid'])){
    $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_ProduitMag) VALUES (:IDClient, :IDProduitMag)');
    $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
    $req->bindParam(':IDProduitMag', $_SESSION['magid'], PDO::PARAM_INT);
    $req->execute();

    $rep = $bdd -> lastInsertId();
    $mag = 2;
    $stmt = $bdd->prepare('INSERT INTO ligne_commande (ID_Commande, ID_Produit, QuantiteMag) VALUES (:ID_Commande,:ID_Produit, :QuantiteMag)');
    $stmt->bindParam(':ID_Commande', $rep, PDO::PARAM_INT);
    $stmt->bindParam(':ID_Produit', $mag, PDO::PARAM_INT);
    $stmt->bindParam(':QuantiteMag', $_SESSION['magquantite'], PDO::PARAM_INT);
    $stmt->execute();

    unset($_SESSION['magtaille']);
    unset($_SESSION['magid']);


  }
  elseif (isset($_SESSION['tiempoid'])){
    $req = $bdd->prepare('INSERT INTO commande (ID_Client, ID_ProduitTiemp) VALUES (:IDClient, :ID_ProduitTiemp)');
    $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
    $req->bindParam(':ID_ProduitTiemp', $_SESSION['tiempoid'], PDO::PARAM_INT);
    $req->execute();

    $rep = $bdd -> lastInsertId();
    $tiempo = 3;
    $stmt = $bdd->prepare('INSERT INTO ligne_commande (ID_Commande, ID_Produit, Quantite) VALUES (:ID_Commande,:ID_Produit, :Quantite)');
    $stmt->bindParam(':ID_Commande', $rep, PDO::PARAM_INT);
    $stmt->bindParam(':ID_Produit', $tiempo, PDO::PARAM_INT);
    $stmt->bindParam(':Quantite', $_SESSION['quantite'], PDO::PARAM_INT);
    $stmt->execute();

    unset($_SESSION['taille']);
    unset($_SESSION['tiempoid']);
  }
  ?>
  <div>
    <?php


  ?>


    <?php



  echo 'Merci pour votre commande !' . "</br>";
  echo 'Vous pouvez maintenant avoir accès au détail de la commande sur votre compte';
?>
  </div>
<?php
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
