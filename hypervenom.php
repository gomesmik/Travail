<?php session_start();
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
<div class="bgauche">
  <img src="images/crampons3.png" alt="Yellow_nike" class="Yellow_nike">
</div>
<div class="bdroite">

  <fieldset>
    <legend>Cool</legend>

    <FORM>
      Taille :
    <SELECT name="nom" size="1">
        <OPTION>39
        <OPTION>40
        <OPTION>41
        <OPTION>42
        <OPTION>43
    </SELECT>

    </FORM>
    </br>

    <label for="height">Quantité :</label>
    <input type="number" name="quantite"
           placeholder="Quantité" step="1" />
    </br>
    <img src="images/camion.png" alt="ship" class="ship" height="125" width="150">
    </br>
    Livraison offerte
  </fieldset>
  </br>
  </br>
  <div class="bouton">
     <a href="https://www.w3schools.com">Ajouter au panier</a>
  </div>

</div>
</html>
