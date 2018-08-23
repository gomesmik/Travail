<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="StyleConsulterMsg.css"/>
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
<body>
  <h2>Voici vos messages envoyé depuis le formulaire "Contact"</h2>
<?php
  try
  {
    $bdd = new PDO("mysql:host=localhost;dbname=travail", "root", ""); // Create DB connection
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Duplace entry management
    $reponseDeClients = $bdd->query("SELECT message.Nom, message.Prenom, message.objet,  message.Message, client.Email, client.Nom, client.Login, client.Prenom FROM message, client WHERE Login = '$nam' AND message.Nom = client.Nom");
    $reponseDeClients->setFetchMode(PDO::FETCH_BOTH);

    while ($donneesDeClients = $reponseDeClients->fetch() )
    {
        echo $donneesDeClients['messsage.message'] . "</br>";
    }
}
catch (PDOException $e)
{
  die("Erreur	" . $e->getMessage());
}
?>
</body>
</html>
