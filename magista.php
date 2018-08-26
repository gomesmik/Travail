<?php session_start();
/*$_SESSION['hyptaille'] = $_POST;
$_SESSION['hypquantite'] = $_POST;*/
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

$dx = 2;
$bdd = new PDO("mysql:host=hhva.myd.infomaniak.com;dbname=hhva_michaelgms", "hhva_michaelgms", "yxt7TjYiLK");  // Create DB connection
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Duplace entry management
$reponseDeClients = $bdd->query("SELECT * FROM produit WHERE id =  $dx");
$reponseDeClients->setFetchMode(PDO::FETCH_BOTH);

while ($donneesDeClients = $reponseDeClients->fetch() ) {
$_SESSION["magid"] = $donneesDeClients['id'];
$_SESSION["magdescr"] = $donneesDeClients['description'];
$_SESSION["magmarque"] = $donneesDeClients['marque'];
$_SESSION["magprice"] = $donneesDeClients['prix'];
}

?>

<div class="bgauche">
  <img src="images/crampons3.png" alt="Orange_nike" class="Yellow_nike">
</div>
<div class="bdroite">
</br>
  <fieldset>
    <legend>Magista Obra FG</legend>

    <FORM method="POST" action="panier.php">
      Taille :
    <SELECT name="magtaille" size="1" required>
        <OPTION value="39">39</option>
        <OPTION value="40">40</option>
        <OPTION value="41">41</option>
        <OPTION value="42">42</option>
        <OPTION value="43">43</option>
    </SELECT>
    Quantité :
    <SELECT name="magquantite" size="1" required>
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

  echo $_SESSION['magprice'] . " CHF";
    ?>
  </span>



</div>
</html>
