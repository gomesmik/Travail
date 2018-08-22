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
<table>
  <tr>
    <td>Taille</td>
    <td>Descritpion</td>
    <td>Quantité</td>
    <td>Prix</td>
</tr>

<tr>

</tr>
<tr>
  <td>
<?php
$prixhyper = 0;
$prixmagista = 0;
$prixtiempo = 0;
if(isset($_SESSION['magprice'])){
$prixmagista = $_SESSION['magprice'] * $_SESSION["magquantite"];
$prixmagista = number_format($prixmagista, 2 );}
if(isset($_SESSION['price'])){
$prixtiempo = $_SESSION['price'] * $_SESSION['quantite'];
$prixtiempo = number_format($prixtiempo, 2 );}
if(isset($_SESSION['hypprice'])){
$prixhyper = $_SESSION['hypprice'] * $_SESSION['hypquantite'];
$prixhyper = number_format($prixhyper, 2 );}
$totalmagtiemp = $prixmagista + $prixtiempo;
$totalmagtiemp = number_format($totalmagtiemp, 2 );
$totalmagistahyp = $prixmagista + $prixhyper;
$totalmagistahyp = number_format($totalmagistahyp, 2 );
$totaltiemphyp = $prixtiempo + $prixhyper;
$totaltiemphyp = number_format($totaltiemphyp, 2 );
$totaltiempo = $prixtiempo;
$totaltiempo = number_format($totaltiempo, 2 );
$totalhypervenom = $prixhyper;
$totalhypervenom = number_format($totalhypervenom, 2);
$totalmagista = $prixmagista;
$totalmagista = number_format($totalmagista, 2);
$total = $prixhyper + $prixtiempo + $prixmagista;
$total = number_format($total, 2 );


if(isset($_SESSION['magtaille'], $_SESSION['magquantite'], $_SESSION['hyptaille'], $_SESSION['hypquantite'], $_SESSION['taille'], $_SESSION['quantite'])){
  echo $_SESSION['magtaille'] ."</td>" . "<td>" . $_SESSION['magdescr'] ."</td>". "<td>" . $_SESSION['magquantite'] . "</td>" . "<td>" . $prixmagista . "<td>" ." CHF" ."</td></tr>";
  echo "<tr>" . "<td>" . $_SESSION['taille'] ."</td>" . "<td>" . $_SESSION['tiempodescr'] ."</td>" ."<td>" .$_SESSION['quantite'] . "</td> " . "<td>" .$prixtiempo . "<td>" ." CHF" ."</td></tr>";
  echo "<tr>" . "<td>" . $_SESSION['hyptaille'] ."</td>" . "<td>" . $_SESSION['hypdescr'] ."</td>" ."<td>" .$_SESSION['hypquantite'] . "</td> " . "<td>" .$prixhyper. "<td>" ." CHF" ."</td></tr>";
  echo "<tr>" . "<td>" ."</td>" . "<td>" . "TOTAL" . "</td>" . "<td>" . "</td>" . "<td>" . $total ."</td>" . "<td>" ." CHF" ."</td>" . "</tr>";
  }
  /*s'il achete magista et tiempo*/
elseif(isset($_SESSION['magtaille'], $_SESSION['magquantite'], $_SESSION['taille'], $_SESSION['quantite'])){
  echo $_SESSION['magtaille'] ."</td>" . "<td>" . $_SESSION['magdescr'] ."</td>". "<td>" . $_SESSION['magquantite'] . "</td>" . "<td>" . $prixmagista. "<td>" ." CHF" ."</td></tr>";
  echo "<tr>" . "<td>" . $_SESSION['taille'] ."</td>" . "<td>" . $_SESSION['tiempodescr'] ."</td>" ."<td>" .$_SESSION['quantite'] . "</td> " . "<td>" .$prixtiempo . "<td>" ." CHF" ."</td></tr>";
  echo "<tr>" . "<td>" ."</td>" . "<td>" . "TOTAL" . "</td>" . "<td>" . "</td>" . "<td>" . $totalmagtiemp ."</td>" . "<td>" ." CHF" ."</td>" . "</tr>";
  }
  /*s'il achete magista et hypervenom*/
elseif(isset($_SESSION['magtaille'], $_SESSION['magquantite'], $_SESSION['hyptaille'], $_SESSION['hypquantite'])){
  echo $_SESSION['magtaille'] ."</td>" . "<td>" . $_SESSION['magdescr'] ."</td>". "<td>" . $_SESSION['magquantite'] . "</td>" . "<td>" . $prixmagista. "<td>" ." CHF" ."</td></tr>";
  echo "<tr>" . "<td>" . $_SESSION['hyptaille'] ."</td>" . "<td>" . $_SESSION['hypdescr'] ."</td>" ."<td>" .$_SESSION['hypquantite'] . "</td> " . "<td>" .$prixhyper. "<td>" ." CHF" ."</td></tr>";
  echo "<tr>" . "<td>" ."</td>" . "<td>" . "TOTAL" . "</td>" . "<td>" . "</td>" . "<td>" . $totalmagistahyp ."</td>" . "<td>" ." CHF" ."</td>" . "</tr>";
  }
  /*s'il achete tiempo et hypervenom*/
elseif(isset($_SESSION['taille'], $_SESSION['quantite'], $_SESSION['hyptaille'], $_SESSION['hypquantite'])){
  echo "<tr>" . "<td>" . $_SESSION['taille'] ."</td>" . "<td>" . $_SESSION['tiempodescr'] ."</td>" ."<td>" .$_SESSION['quantite'] . "</td> " . "<td>" .$prixtiempo . "<td>" ." CHF" ."</td></tr>";
  echo "<tr>" . "<td>" . $_SESSION['hyptaille'] ."</td>" . "<td>" . $_SESSION['hypdescr'] ."</td>" ."<td>" .$_SESSION['hypquantite'] . "</td> " . "<td>" .$prixhyper. "<td>" ." CHF" ."</td></tr>";
  echo "<tr>" . "<td>" ."</td>" . "<td>" . "TOTAL" . "</td>" . "<td>" . "</td>" . "<td>" . $totaltiemphyp ."</td>" . "<td>" ." CHF" ."</td>" . "</tr>";
  }
  /*s'il achete tiempo*/
elseif(isset($_SESSION['taille'], $_SESSION['quantite'])){
  echo "<tr>" . "<td>" . $_SESSION['taille'] ."</td>" . "<td>" . $_SESSION['tiempodescr'] ."</td>" ."<td>" .$_SESSION['quantite'] . "</td> " . "<td>" .$prixtiempo . "<td>" ." CHF" ."</td></tr>";
  echo "<tr>" . "<td>" ."</td>" . "<td>" . "TOTAL" . "</td>" . "<td>" . "</td>" . "<td>" . $totaltiempo ."</td>" . "<td>" ." CHF" ."</td>" . "</tr>";
    }
/*s'il achete hypervenom*/
elseif(isset($_SESSION['hyptaille'], $_SESSION['hypquantite'])){
  echo "<tr>" . "<td>" . $_SESSION['hyptaille'] ."</td>" . "<td>" . $_SESSION['hypdescr'] ."</td>" ."<td>" .$_SESSION['hypquantite'] . "</td> " . "<td>" .$prixhyper. "<td>" ." CHF" ."</td></tr>";
  echo "<tr>" . "<td>" ."</td>" . "<td>" . "TOTAL" . "</td>" . "<td>" . "</td>" . "<td>" . $totalhypervenom ."</td>" . "<td>" ." CHF" ."</td>" . "</tr>";
    }
/*s'il achete magista*/
elseif(isset($_SESSION['magtaille'], $_SESSION['magquantite'])){
  echo $_SESSION['magtaille'] ."</td>" . "<td>" . $_SESSION['magdescr'] ."</td>". "<td>" . $_SESSION['magquantite'] . "</td>" . "<td>" . $prixmagista . "<td>" ." CHF" ."</td></tr>";
  echo "<tr>" . "<td>" ."</td>" . "<td>" . "TOTAL" . "</td>" . "<td>" . "</td>" . "<td>" . $totalmagista ."</td>" . "<td>" ." CHF" ."</td>" . "</tr>";
        }


?>
</table>
</div>

<div class="valider">
    <a href="ConfirmationCommande.php">Valider la commande</a>
</div>
<div class="retour">
  <a href="panier.php">Retour au panier</a>
</div>

</body>
</html>
