<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="StyleConnexionApresCommande.css"/>
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
           echo "<meta http-equiv='refresh' content='0;url=ValidationCommande.php'>";
  	    }
	    else
	    {
        ?>
        <li style="float:right"><a href="connexion.php">Connexion</a></li>
		</li>
  </ul>

</header>
<div id="left">
  <h3>Déjà client sur Mik'Shop ? Connectez-vous ! </h3>
  <FORM METHOD='POST' ACTION='ConnexionApresCommande.php'>
      <table>
        <tr>
         <td> Login :<input name="login" type="text" required></td>
         <td>Mot de passe : <input name="mdp" type="password" required></td>
       </tr>
      </table>
    </br>
       <input type="submit" value="Se connecter" style="width:200px; height:30px">
  </FORM>
  <?php
  if (!empty($_POST)) { // Data exist
    $messg = "Username";
  	$uname = !empty(htmlentities($_POST['login']))?filter_var($_POST['login'],FILTER_SANITIZE_STRING):""; // htmlentities to prevent code injection + sanitize existing values
  	$pswrd = !empty(htmlentities($_POST['mdp']))?filter_var($_POST['mdp'],FILTER_SANITIZE_STRING):""; // htmlentities to prevent code injection + sanitize existing values
  	$submt = "Login";
    $login = "";




		try {
			$bdd = new PDO("mysql:host=localhost;dbname=travail", "root", ""); // Create DB connection
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Duplace entry management
			$sql = $bdd->prepare("SELECT Login, MotDePasse FROM client WHERE Login = :uname");
			$sql->bindParam(':uname', $uname, PDO::PARAM_STR);
			$sql->execute();


			$user = $sql->fetch(PDO::FETCH_ASSOC);
			if (password_verify($pswrd,$user['MotDePasse'])) { // Check strong encoded password

        $nam = $_POST['login'];
        $_SESSION['login'] = $nam;

				echo "<meta http-equiv='refresh' content='1;url=ValidationCommande.php'>";
				$submt = "Logging in progres...";
			}
			else {
        ?>

			<script> alert("Login ou Mot de passe erroné !")</script>

      <?php
			}
    }
    catch (PDOException $e) {
			die("Erreur	" . $e->getMessage());
		}}
    ?>
</div>
<div id="right">
    <h3 style="text-align:center">Nouveau sur Mik'Shop ? Bienvenue !</h3>
  </br>

    <div class="bouton">
       <a href="NouveauMembre.php">continuer</a>
    </div>
</div>
<div class="annuler">
  <a href="produit.php">Annuler</a>
</div>
<?php
}
?>
</body>
</html>
