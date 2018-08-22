<?php session_start();
	$nam = $_SESSION['login'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="StyleBienvenue.css"/>
  <meta charset="UTF-8">
</head>

<body>
<header>
  <ul>
    <li><a href="Index.php">Home</a></li>
    <li><a href="produit.php">Produit</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li style="float:right"><a href="Bienvenue.php">
			<?php
			if(isset($_SESSION['login']))  {
	            echo $nam;
	      }
	      else {
	             echo "Connexion";
	      }
			?>
    </a></li>
  </ul>

</header>

<h1>Bienvenue sur votre compte <?php echo $nam ?>, nous sommes ravi de vous revoir !</h1>
<p>
<?php
$men = "Homme";
$women = "Femme";
?>

<main>
	<section>
		<?php
		$nome = "";
		try
		{
			$bdd = new PDO("mysql:host=localhost;dbname=travail", "root", ""); // Create DB connection
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Duplace entry management
			$reponseDeClients = $bdd->query("SELECT * FROM client WHERE Login = '$nam'");
			$reponseDeClients->setFetchMode(PDO::FETCH_BOTH);

			while ($donneesDeClients = $reponseDeClients->fetch() )
			{
				$_SESSION["IdClient"] = $donneesDeClients['ID'];
					if ($men == $donneesDeClients['Sexe']){
						echo "</br>";
						echo "<img src='images/Man.png' alt='Homme' title = 'Homme' style='width:200px;height:200px;''>";
						?>
						<p>
							<table>
								 <tr>
										 <td>Login : </td>
										 <td><?php echo $nam; ?></td>
								 </tr>
								 <tr>
										 <td>Prenom : </td>
										 <td><?php echo $donneesDeClients['Prenom'] . "</br>";?></td>
								 </tr>
								 <tr>
										 <td>Nom : </td>
										 <td><?php echo $donneesDeClients['Nom'] . "</br>";?></td>
								 </tr>
								 <tr>
										 <td>Adresse : </td>
										 <td><?php echo $donneesDeClients['Adresse'] . "</br>";?></td>
								 </tr>
								 <tr>
										 <td>Telephone : </td>
										 <td><?php echo $donneesDeClients['Telephone'] . "</br>";?></td>
								 </tr>
								 <tr>
										 <td>Email : </td>
										 <td><?php echo $donneesDeClients['Email'] . "</br>";?></td>
								 </tr>
						</table>
					</p>
					<?php
					}
					else {
						echo "</br>";
						echo "<img src='images/femme.png' alt='Femme' title = 'Madame' style='width:200px;height:200px;''>";
						?>

							<p>
								<table>
								   <tr>
								       <td>Login : </td>
											 <td><?php echo $nam; ?></td>
								   </tr>
								   <tr>
								       <td>Prenom :</td>
								       <td><?php echo $donneesDeClients['Prenom'] . "</br>";?></td>
								   </tr>
									 <tr>
											 <td>Nom : </td>
											 <td><?php echo $donneesDeClients['Nom'] . "</br>";?></td>
									 </tr>
									 <tr>
								       <td>Adresse :</td>
								       <td><?php echo $donneesDeClients['Adresse'] . "</br>";?></td>
								   </tr>
									 <tr>
											 <td>Telephone :</td>
											 <td><?php echo $donneesDeClients['Telephone'] . "</br>";?></td>
									 </tr>
									 <tr>
								       <td>Email :</td>
								       <td><?php echo $donneesDeClients['Email'] . "</br>";?></td>
								   </tr>
							</table>
						</p>
						<?php
					}
			}
	}
	catch (PDOException $e)
	{
		die("Erreur	" . $e->getMessage());
	}
	?>
	<a href="Modification.php"><div>Modifier mes données</div></a>
	</section>
	<aside>

	</aside>




</main>

<span>

<a href="deconnexion.php">Déconnexion</a></span>

</body>
</html>
