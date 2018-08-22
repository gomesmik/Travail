<!DOCTYPE html>
<html>
  <head>
    <title>Mik'Shop</title>
    <link rel="stylesheet" href="StyleConnexion.css"/>
    <meta charset="UTF-8">
  </head>

    <body>
      <header>
        <ul>
            <li><a href="Index.php">Home</a></li>
            <li><a href="produit.php">Produit</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li class="pan"><a href="panier.php" style="float:right"><img src="images/panier.png" alt="panier" height="15" width="20"></a></li>
            <li style="float:right"><a class="active" href="Connexion.php">Connexion</a></li>
        </ul>
      </header>
          <main>
          		<section>
                <center>
                <h2>Connectez-vous ! </h2>
                <p>
                  <FORM METHOD='POST' ACTION='Connexion.php'>
                      <table>
                        <tr>
          					     <td> Login :<input name="login" type="text" required></td>
                  			 <td>Mot de passe : <input name="mdp" type="password" required></td>
                       </tr>
                      </table>
                    </br>
                       <input type="submit" value="Se connecter" style="width:200px; height:30px">
          				</FORM>
              </p>
              <a href="MotDePasseOublie.php"><u>Mot de passe ou login oublié</u></a>
            </center>
          		</section>
              <br>
              <br>
              <article>
                  <h2>Nouveau client </h2>
                  <p>
                    <a href="NouveauMembre.php" title="newCompte">
                    <input type="submit" value="Créer un compte" style="width:200px; height:50px;"></a>
                  </p>
              </article>
          </main>
      </body>
</html>

<?php
	session_start();


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
        echo "<meta http-equiv='refresh' content='1;url=Bienvenue.php'>";
				$submt = "Logging in progres...";
			}
			else {
        ?>

			<script> alert("mot de passe ou login erroné")</script>

      <?php
			}
		}
		catch (PDOException $e) {
			die("Erreur	" . $e->getMessage());
		}
		$bdd = NULL; // Close connection
	} else {
		if (!empty($_SESSION['uname'])) { // Disconnect previous user
			session_unset();
			session_destroy();
		}
	}

?>
