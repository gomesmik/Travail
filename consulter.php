<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="styleconsulter.css"/>
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
<div class="right">
<?php
$cpt = 0;
try {
	$bdd = new PDO("mysql:host=hhva.myd.infomaniak.com;dbname=hhva_michaelgms", "hhva_michaelgms", "yxt7TjYiLK");
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $req = $bdd->prepare('SELECT * from commande WHERE commande.ID_Client = :IDClient');
  $req->bindParam(':IDClient', $_SESSION['ID'], PDO::PARAM_INT);
  $req->execute(); /*OBLIGATOIRE AVEC LE BINDPARAM */
  while($user = $req->fetch(PDO::FETCH_ASSOC)){
    ?>
    <table>
      <tr>
    <?php
    echo "<td>" . "Numéro de commande : " . $user['ID_Commande']  . "</td>";
    echo "</br>";
    ?>
  </tr>
</table>
    <?php
    $cpt = $cpt + 1;
  }


}
catch (PDOException $e)
 {
  echo "Erreur";
 }

?>
</div>

<div class="left">
  <?php
echo "Vous avez effectué " . $cpt . " commande(s) !";

if($cpt == 0) {
  "";
}
else{
  ?>
  </br>
  </br>
  </br>
  <?php
  echo "Afficher le détail de la commande n° ";
}
  ?>
  </br>
  <FORM METHOD='POST' ACTION='maitredetail.php'>
      </br>
         <input name="com" type="number" min="0" step="1" required>
    </br>
    </br>
       <input type="submit" value="Afficher" style="width:200px; height:30px">
  </FORM>
</div>



</body>
</html>
