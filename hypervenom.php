<?php session_start();
/*$_SESSION['hyptaille'] = $_POST;
$_SESSION['hypquantite'] = $_POST;*/
?>

<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="StyleHypervenom.css"/>
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

$un = 1;
$bdd = new PDO("mysql:host=localhost;dbname=travail", "root", ""); // Create DB connection
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Duplace entry management
$reponseDeClients = $bdd->query("SELECT * FROM produit WHERE id =  $un");
$reponseDeClients->setFetchMode(PDO::FETCH_BOTH);

while ($donneesDeClients = $reponseDeClients->fetch() ) {
$_SESSION["hypdescr"] = $donneesDeClients['description'];
$_SESSION["hypmarque"] = $donneesDeClients['marque'];
$_SESSION["hypprice"] = $donneesDeClients['prix'];
}

?>

<div class="bgauche">
  <img src="images/crampons.png" alt="Yellow_nike" class="Yellow_nike">
</div>
<div class="bdroite">
</br>
  <fieldset>
    <legend>Hypervenom Phantom II FG</legend>

    <FORM method="POST" action="panier.php">
      Taille :
    <SELECT name="hyptaille" size="1" required>
        <OPTION value="39">39</option>
        <OPTION value="40">40</option>
        <OPTION value="41">41</option>
        <OPTION value="42">42</option>
        <OPTION value="43">43</option>
    </SELECT>
    Quantité :
    <SELECT name="hypquantite" size="1" required>
        <OPTION>1</option>
        <OPTION>2</option>
        <OPTION>3</option>
        <OPTION>4</option>
        <OPTION>5</option>
    </SELECT>
  </br>
  </br>
  <input class"bouton" type="submit" value="Ajouter au panier"/>
    </FORM>

    </br>

    <img src="images/camion.png" alt="ship" class="ship" height="125" width="150">
    </br>
    Livraison offerte
  </fieldset>
  </br>
  </br>


</div>
</html>
