<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="StyleConsulter.css"/>
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
<div>
<?php
$cpt = 0;
try {
  $bdd = new PDO("mysql:host=localhost;dbname=travail", "root", "");
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $req = $bdd->prepare('SELECT commande.ID_Commande, commande.ID_Client, commande.ID_Produit, client.ID, produit.id, produit.id, produit.marque, produit.description
    From commande
    INNER JOIN client on commande.ID_Client = client.ID
    INNER JOIN produit on commande.ID_Produit = produit.id
    WHERE commande.ID_Client = :IDClient');
  $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
  $req->execute(); /*OBLIGATOIRE AVEC LE BINDPARAM */
  while($user = $req->fetch(PDO::FETCH_ASSOC)){
    echo $user['ID_Commande'] . " ". $user['marque'] . " ". $user['description'];
    echo "</br>";
    $cpt = $cpt + 1;
  }

echo "Vous avez effectué " . $cpt . " commande !";


}
catch (PDOException $e)
 {
  echo "Erreur";
 }

?>
</div>



</body>
</html>
