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
echo $_SESSION["hyperid"];

echo $_SESSION["IdClient"];/*PROBLEMMEE*/

try {
$conn = new PDO("mysql:host=localhost;dbname=travail", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$hyperid= "";
$idClient = "";
$_SESSION["hyperid"] = $hyperid;
$_SESSION["IdClient"] = $idClient;
     $stmt = $conn->prepare("INSERT INTO commande (ID_Commande, ID_Client, ID_Produit) VALUES (:IdClient, :Id_prod)");
     $stmt->bindParam(':IdClient', $idClient, PDO::PARAM_INT);
     $stmt->bindParam(':Id_prod', $hyperid, PDO::PARAM_INT);
     $insertion = $stmt->execute(); /*OBLIGATOIRE AVEC LE BINDPARAM */
      if ($insertion)
        {
          echo "<p>L  Id est inséré </p>";
        }
      else
        {
          echo "probleme d'insertion";
        }
      }
catch (PDOException $e)
 {
    echo "erreur connexion";
 }
?>


</body>
</html>
