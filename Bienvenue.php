<?php session_start();
	$nam = $_SESSION['login'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="stylebienvenue.css"/>
  <meta charset="UTF-8">
</head>

<body>
<header>

  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="produit.php">Produit</a></li>
    <li><a href="contact.php">Contact</a></li>
		<li class="pan"><a href="panier.php" style="float:right"><img src="images/panier.png" alt="panier" height="15" width="20"></a></li>
    <li style="float:right"><a href="bienvenue.php">
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
			$bdd = new PDO("mysql:host=hhva.myd.infomaniak.com;dbname=hhva_michaelgms", "hhva_michaelgms", "yxt7TjYiLK"); // Create DB connection
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
						echo "<img src='images/Femme.png' alt='Femme' title = 'Madame' style='width:200px;height:200px;''>";
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

	</section>
	<aside>
</br>
		<a href="desabonner.php"><div class="desabo">Se désabonner</div> </a></br>
		<a href="consulter.php"><div class="desabo">Mes commandes</div> </a></br>
		<a href="modification.php"><div class="desabo">Modifier mes données personnelles</div></a></br>
</br>
</br>
</br>
		<span>
			<a href="deconnexion.php">Déconnexion</a>
		</span>
	</aside>




</main>



</body>
</html>
