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

  $req = $bdd->prepare('SELECT commande.ID_Commande, commande.ID_Client, commande.ID_Produit, client.ID, client.Nom, client.Prenom, produit.id, produit.marque, produit.description
    From commande
    INNER JOIN client on commande.ID_Client = client.ID
    INNER JOIN produit on commande.ID_Produit = produit.id
    WHERE  client.ID = :IDCli');
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

  $req = $bdd->prepare("DELETE FROM commande WHERE ID_Client = :idcli");
  $req->bindParam(':idcli', $_SESSION['ID'], PDO::PARAM_INT);
  $req->execute();

  echo "<meta http-equiv='refresh' content='0;url=consulter.php'>";

  unset($_SESSION['login']);
  ?>
  <script>alert('Vos données ont bien été suprimée')</script>
  <?php


}
catch(PDOException $e)
{
  echo "Erreur";
}

 ?>


</body>
</html>
