<?php
session_start();

 ?>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="StyleContact.css"/>
  <meta charset="UTF-8">
</head>

<body>
<header>
  <ul>
    <li><a href="Index.php">Home</a></li>
    <li><a href="produit.php">Produit</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li class="pan"><a href="panier.php" style="float:right"><img src="images/panier.png" alt="panier" height="15" width="20"></a></li>
    <li style="float:right"><?php
    if(isset($_SESSION['login']))  {
	     $nam = $_SESSION['login'];
       echo '<a href="Bienvenue.php">'. $nam . '</a>';
    }
    else
    {
        echo  '<a href="connexion.php"> Connexion </a>';
    }
    ?></li>
  </ul>
</header>

<main>
		<aside>
			<center><h2>Contactez-nous !</h2></center>
      <p>
        <FORM METHOD='POST' ACTION='DonneeContact.php'>
          <center>
					      Prenom : <br>  <input name="prenom" type="text" required>  <br><br><br>
        				Nom :    <br>  <input name="nom" type "text" required>     <br><br><br>
      					Mail :   <br>  <input name="mail" type="text" required>   <br><br><br>
					      Objet du message : <br>  <input name="objet" type="text" required><br><br><br>
                Message : <br> <TEXTAREA name="msg" rows=4 COLS=40 required ></TEXTAREA> <br><br>
				                        <input type="submit" value="Enregistrer">
          </center>
				</FORM>

      <p>
          <i>*Tout les champs sont obligatoires </i>
      </p>
		</aside>
		<section>
			<center><h2>Nos coordonnées </h2></center>
			<article>
        <center>
        <p>
				<h3>Mik'Shop Store</h3>
          Chemin du Domaine-Patry 1<br>
          1224 Chêne-Bougeries<br>
        </p>

        <p>
          <h3>Coordonnées</h3>
          078 000 00 00<br>
          mikshop@gmail.ch<br>
        </p>

        <p>
        <h3>  Horaire service Client </h3>
              Lundi - Vendredi: <br>
              9 AM - 12 PM <br>
              1 PM - 5 PM <br>

        </p>
        <div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1380.6309931484693!2d6.179172614535514!3d46.20524307546631!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c6550a85391ed%3A0xb53c47fb472f5d7!2sEcole+de+Commerce+Raymond-Uldry!5e0!3m2!1sfr!2sch!4v1531754020718" width="400" height="200" frameborder="0" style="border:0" allowfullscreen></iframe></div>
        </center>


			</article>
		</section>
	</main>


</body>
</html>
