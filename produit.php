<?php
session_start();

 ?>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="StyleProduit.css"/>
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
    <div class="heure">
    <?php
    $heure = date("H:i");
    echo $heure;
    ?>
    </div>
    l'heure est venu de choisir ton arme !
  </header>



  <?php

  $prm = 1;
  $dxm = 2;
  $txm = 3;

    try {
      $bdd = new PDO("mysql:host=localhost;dbname=travail", "root", ""); // Create DB connection
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Duplace entry management
      $reponseDeClients = $bdd->query("SELECT * FROM produit WHERE id =  $prm");
      $reponseDeClients->setFetchMode(PDO::FETCH_BOTH);


      ?>
      <div id="left"> </br><img src="images/crampons.png" alt="Yellow_nike" height="125" width="200"></br>
      <?php
      while ($donneesDeClients = $reponseDeClients->fetch() ) {
      echo $donneesDeClients['marque'] . " " ;
      echo $donneesDeClients['description'] . "<br />";
      echo $donneesDeClients['prix'] . " CHF";
      }
      ?>
    </br>
      <div class="bouton">
         <a href="hypervenom.php">shop now</a>

      </div>
    </br>
      </div>
      <?php

      $reponseDeClients = $bdd->query("SELECT * FROM produit WHERE id =  $dxm");
      $reponseDeClients->setFetchMode(PDO::FETCH_BOTH);

      ?>

    <div id="center"> </br> <img src="images/crampons3.png" alt="Yellow_nike" height="125" width="200"></br>
      <?php
      while ($donneesDeClients = $reponseDeClients->fetch() ) {
      echo $donneesDeClients['marque'] . " " ;
      echo $donneesDeClients['description'] . "<br />";
      echo $donneesDeClients['prix'] . " CHF";
      }
      ?>
    </br>
      <div class="bouton">
         <a href="magista.php">shop now</a>

      </div>
    </br>

      </div>

      <?php
      $reponseDeClients = $bdd->query("SELECT * FROM produit WHERE id =  $txm");
      $reponseDeClients->setFetchMode(PDO::FETCH_BOTH);

      ?>
        <div id="right"> </br><img src="images/crampons2.png" alt="Yellow_nike" height="125" width="200"></br>
      <?php
      while ($donneesDeClients = $reponseDeClients->fetch() ) {
      echo $donneesDeClients['marque'] . " " ;
      echo $donneesDeClients['description'] . "<br />";
      echo $donneesDeClients['prix'] . " CHF";
      }
      ?>
    </br>
      <div class="bouton">
         <a href="tiempo.php">shop now</a>

      </div>
    </br>
      </div>
      <?php
  }
  catch (PDOException $e) {
    die("Erreur	" . $e->getMessage());
  }
  $bdd = NULL; // Close connection
  ?>

  </div>
</body>
</html>
