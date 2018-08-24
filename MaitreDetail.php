<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="StyleMaitreDetail.css"/>
  <meta charset="UTF-8">
</head>

<body>
<header>
  <ul>
    <li><a href="Index.php">Home</a></li>
    <li><a href="produit.php">Produit</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li class="pan"><a href="panier.php" style="float:right"><img src="images/panier.png" alt="panier" height="15" width="20"></a></li>
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
  $stmt = $bdd->prepare('SELECT commande.ID_Client from commande WHERE commande.ID_Client = :cliID');
  $stmt->bindParam(':cliID', $_SESSION['ID'], PDO::PARAM_INT);
  $stmt->execute();
  $requete = $stmt->fetchAll();


  $req = $bdd->prepare('SELECT commande.ID_Commande, commande.ID_Client, commande.ID_Produit, client.ID, client.Nom, client.Prenom, produit.id, produit.marque, produit.description
    From commande
    INNER JOIN client on commande.ID_Client = client.ID
    INNER JOIN produit on commande.ID_Produit = produit.id
    WHERE commande.ID_Commande = :IDCom AND client.ID = :IDCli');

  $req->bindParam(':IDCom', $_POST['com'], PDO::PARAM_INT);
  $req->bindParam(':IDCli', $_SESSION['ID'], PDO::PARAM_INT);
  $req->execute(); /*OBLIGATOIRE AVEC LE BINDPARAM */
  while($user = $req->fetch(PDO::FETCH_ASSOC)){
    echo "Numéro de commande : " . $user['ID_Commande'];
    echo "</br>";
    echo "Marque : " . $user['marque'];
    echo "</br>";
    echo "Descritpion Article : " . $user['description'];
    echo "</br>";
  }
}
  catch (PDOException $e)
   {
    echo "Erreur";
   }
?>
</body>
</html>
