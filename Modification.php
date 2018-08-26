<?php
session_start();
$nam = $_SESSION['login'];
try
{
	$bdd = new PDO("mysql:host=hhva.myd.infomaniak.com;dbname=hhva_michaelgms", "hhva_michaelgms", "yxt7TjYiLK");  // Create DB connection
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Duplace entry management

  if (!empty($_POST)) { // Data exist
  	$uname = !empty(htmlentities($_POST['nom']))?filter_var($_POST['nom'],FILTER_SANITIZE_STRING):""; // htmlentities to prevent code injection + sanitize existing values
  	$prenom = !empty(htmlentities($_POST['prenom']))?filter_var($_POST['prenom'],FILTER_SANITIZE_STRING):""; // htmlentities to prevent code injection + sanitize existing values
    $adresse = !empty(htmlentities($_POST['adresse']))?filter_var($_POST['adresse'],FILTER_SANITIZE_STRING):"";
    $telephone = !empty(htmlentities($_POST['telephone']))?filter_var($_POST['telephone'],FILTER_SANITIZE_STRING):"";
    $email = !empty(htmlentities($_POST['email']))?filter_var($_POST['email'],FILTER_SANITIZE_STRING):"";
    $sexe = !empty(htmlentities($_POST['sexe']))?filter_var($_POST['sexe'],FILTER_SANITIZE_STRING):"";

$req = $bdd->prepare("UPDATE client SET Nom = :nam, Prenom = :prenom, Adresse = :adresse, Telephone = :telephone, Email = :email, Sexe = :sexe WHERE Login = '$nam'");
  $req->bindParam(':nam', $uname, PDO::PARAM_STR);
  $req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
  $req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
  $req->bindParam(':telephone', $telephone, PDO::PARAM_INT);
  $req->bindParam(':email', $email, PDO::PARAM_STR);
  $req->bindParam(':sexe', $sexe, PDO::PARAM_STR);
  $req->execute();

  $nEnregistrements = $req->rowCount();
  if ($nEnregistrements == 0) {
  ?>
  <script>alert("il n'y a pas eu de modification !")</script>
  <?php
  echo "<meta http-equiv='refresh' content='0;url=bienvenue.php'>";
}
  else{
    ?>
    <script>alert('Vos données ont bien été modifiée')</script>
    <?php
    echo "<meta http-equiv='refresh' content='0;url=bienvenue.php'>";
  }}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Modification de données</title>
  <link rel="stylesheet" href="stylemodification.css"/>
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
<h1><u>Modification</u></h1>

<?php

    $reponseDeClients = $bdd->query("SELECT * FROM client WHERE Login = '$nam'");
    $reponseDeClients->setFetchMode(PDO::FETCH_BOTH);
    while ($donneesDeClients = $reponseDeClients->fetch() )
    {
      ?>
      <table>
        <form method="post" action="modification.php">
         <tr>
             <td>Nom :</td>
             <td><input name="nom" type="text"  required value="<?php echo $donneesDeClients['Nom']?>"></td>
             <td></td>
             <td></td>
             <td></td>
             <td>Prenom :</td>
             <td><input name="prenom" type="text" required value="<?php echo $donneesDeClients['Prenom']?>"></td>
         </tr>
         <tr>
           <td>Adresse :</td>
           <td><input name="adresse" type="text" required value="<?php echo $donneesDeClients['Adresse']?>"></td>
           <td></td>
           <td></td>
           <td></td>
           <td>Téléphone :</td>
           <td><input name="telephone" type="tel"  placeholder="123-456-7890"
                 pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                 required value="<?php echo $donneesDeClients['Telephone']?>"/></td>
         </tr>
         <tr>
           <td>Email :</td>
           <td><input name="email" type="text" required value="<?php echo $donneesDeClients['Email']?>"> </td>
           <td></td>
           <td></td>
           <td></td>
           <td>Sexe :</td>
           <td>
             <select name="sexe">
               <?php
                  if($donneesDeClients['Sexe'] == "Homme"){?>
                    <option value="Homme" style="width:115px; height:20px"> Homme </option>
                    <option value="Femme"> Femme </option>
              <?php
                  }
                  else {?>
                    <option value="Femme" style="width:115px; height:20px"> Femme </option>
                    <option value="Homme" > Homme </option>
              <?php
                  }
                ?>

            </select>
          </td>
         </tr>

         <tr>
         </tr>
         <tr>
         </tr>
         <tr>
           <td> <a href="connexion.php" title="annulation">
                  <input type="submit" value="Anuuler" style="width:145px; height:30px"></td>
                </a>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td><input type="submit" value="Modifier" style="width:145px; height:30px"></td>
         </tr>

       </form>
      </table>
      <?php
    }
  }
  	catch (PDOException $e)
  	{
  		die("Erreur	" . $e->getMessage());
  	}
 ?>




</body>
</html>
