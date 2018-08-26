<?php session_start();
/*$_SESSION['taille'] = $_POST;
$_SESSION['quantite'] = $_POST;*/
?>

<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="stylehypervenom.css"/>
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
<?php

$trx = 3;
$bdd = new PDO("mysql:host=hhva.myd.infomaniak.com;dbname=hhva_michaelgms", "hhva_michaelgms", "yxt7TjYiLK");  // Create DB connection
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Duplace entry management
$reponseDeClients = $bdd->query("SELECT * FROM produit WHERE id =  $trx");
$reponseDeClients->setFetchMode(PDO::FETCH_BOTH);

while ($donneesDeClients = $reponseDeClients->fetch() ) {
$_SESSION["tiempoid"] = $donneesDeClients['id'];
$_SESSION["tiempodescr"] = $donneesDeClients['description'];
$_SESSION["marque"] = $donneesDeClients['marque'];
$_SESSION["price"] = $donneesDeClients['prix'];
}

?>

<div class="bgauche">
  <img src="images/crampons2.png" alt="Yellow_nike" class="Yellow_nike">
</div>
<div class="bdroite">
</br>
  <fieldset>
    <legend>Nike Tiempo Genio Leather II FG</legend>

    <FORM method="post" action="panier.php">
      Taille :
    <SELECT name="taille" size="1" required>
        <OPTION value="39">39</option>
        <OPTION value="40">40</option>
        <OPTION value="41">41</option>
        <OPTION value="42">42</option>
        <OPTION value="43">43</option>
    </SELECT>
    Quantité :
    <SELECT name="quantite" size="1" required>
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
  <span>
    </br>

    <?php

  echo $_SESSION['price'] . " CHF";
    ?>
  </span>



</div>
</html>
