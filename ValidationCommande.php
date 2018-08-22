<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="StyleValidationCommande.css"/>
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

<div id="left">
  <h3>Données du client</h3>
  <table>
    <tr>
      <td>Prenom :</td>

  <?php
  try
  {
    $bdd = new PDO("mysql:host=localhost;dbname=travail", "root", ""); // Create DB connection
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Duplace entry management
    $reponseDeClients = $bdd->query("SELECT * FROM client WHERE Login = '$nam'");
    $reponseDeClients->setFetchMode(PDO::FETCH_BOTH);
    while ($donneesDeClients = $reponseDeClients->fetch() ){
      ?>
      <td><?php
      echo  $donneesDeClients['Prenom'] . "</br>";
      ?> </td></tr><tr><td>Nom :</td>
        <td>
      <?php echo  $donneesDeClients['Nom']. "</br>";
      ?> </td></tr><tr><td>Adresse :</td>
        <td>
      <?php echo  $donneesDeClients['Adresse']. "</br>";
      ?> </td></tr><tr><td>Telephone :</td>
        <td>
      <?php echo $donneesDeClients['Telephone']. "</br>";
      ?></td></tr>
    </table><?php
    }
  }
    catch (PDOException $e) {
      die("Erreur	" . $e->getMessage());
    }
  ?>
</br>
</br>
</br>
</br>
</br>
  <a href="Modification.php"><i>Si des données sont fausses cliqué ici !</i></a>
</div>

<div id="right">
  <h3>Detail de la commande</h3>
</div>
<?php
if(isset($_SESSION['magtaille']) || isset($_SESSION['hyptaille']) || isset($_SESSION['taille'])){
echo $_SESSION['magtaille'] . $_SESSION['hyptaille'] . $_SESSION['taille'];
}

?>

</body>
</html>
