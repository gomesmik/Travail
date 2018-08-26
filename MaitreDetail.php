<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="stylemaitredetail.css"/>
  <meta charset="UTF-8">
</head>

<body>
<header>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="produit.php">Produit</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li class="pan"><a href="panier.php" style="float:right"><img src="images/panier.png" alt="panier" height="15" width="20"></a></li>
    <li style="float:right">
			<?php
	    if(isset($_SESSION['login']))
			{
		     $nam = $_SESSION['login'];
	       echo '<a href="bienvenue.php">'. $nam . '</a>';
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
  <table>
    <tr>
<?php
try {
  $bdd = new PDO("mysql:host=hhva.myd.infomaniak.com;dbname=hhva_michaelgms", "hhva_michaelgms", "yxt7TjYiLK");
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $bdd->prepare('SELECT commande.ID_Client from commande WHERE commande.ID_Client = :cliID');
  $stmt->bindParam(':cliID', $_SESSION['ID'], PDO::PARAM_INT);
  $stmt->execute();
  $requete = $stmt->fetchAll();


  $req = $bdd->prepare('SELECT commande.ID_Commande, commande.ID_Client, commande.ID_Produit, commande.ID_ProduitMag, commande.ID_ProduitTiemp, client.ID, client.Nom, client.Prenom, client.Nom, client.Email, client.Adresse, client.Telephone, ligne_commande.Quantite, ligne_commande.QuantiteHyp, ligne_commande.QuantiteMag
    From commande
    INNER JOIN client on commande.ID_Client = client.ID
    INNER JOIN ligne_commande on ligne_commande.ID_Commande = commande.ID_Commande
    WHERE commande.ID_Commande = :IDCom AND client.ID = :IDCli');

  $req->bindParam(':IDCom', $_POST['com'], PDO::PARAM_INT);
  $req->bindParam(':IDCli', $_SESSION['ID'], PDO::PARAM_INT);
  $req->execute(); /*OBLIGATOIRE AVEC LE BINDPARAM */

  while($user = $req->fetch(PDO::FETCH_ASSOC)){
    echo "Numéro de commande : " . $user['ID_Commande'];
    echo "</br>";
      echo "</br>";
if(isset($user['ID_Produit'])){
        ?>
          <td>
            <img src="images/crampons.png" alt="panier" height="150" width="200"></a>
          </td>
        <?php
}
if(isset($user['ID_ProduitTiemp'])){
  ?>
  <td>
  <img src="images/crampons2.png" alt="magista" height="150" width="200"></a>
  </td>
  <?php
}
if(isset($user['ID_ProduitMag'])){
  ?>
    <td>
  <img src="images/crampons3.png" alt="magista" height="150" width="200"></a>
    </td>
  </tr>

  <?php
}



if(isset($user['ID_Produit'])){
  ?>
    <tr>
      <td>
<?php
        echo "Quantité : " . $user['QuantiteHyp'] . "  ";
?>
      </td>
<?php
}
if(isset($user['ID_ProduitTiemp'])){
?>
  <td>
<?php
  echo "Quantité : " . $user['Quantite'] . "  ";
?>
  </td>
<?php
}
if(isset($user['ID_ProduitMag'])){
?><td><?php
    echo "Quantité : " . $user['QuantiteMag'] . "  " ;
?></td>
</tr>
</table><?php
}

echo "</br>";
echo "_________________________________";
echo "</br>";
echo "Commandé par : " . $user['Prenom'] . " " . $user['Nom'] . "</br>";
echo "Adresse : " . $user['Adresse'] . "</br>";
echo "Email : " . $user['Email'] . "</br>";
echo "Téléphone : " . $user['Telephone'] . "</br>";
echo "_________________________________";
echo "</br>";
echo "</br>";


?>
</div>
<?php
  }
}
  catch (PDOException $e)
   {
    echo "Erreur";
   }
?>
</body>
</html>
