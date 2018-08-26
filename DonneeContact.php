<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="stylecontact.css"/>
  <meta charset="UTF-8">
</head>

<body>
<header>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="produit.php">Produit</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li class="pan"><a href="panier.php" style="float:right"><img src="images/panier.png" alt="panier" height="15" width="20"></a></li>
    <li style="float:right"><?php
    if(isset($_SESSION['login']))  {
	     $nam = $_SESSION['login'];
       echo '<a href="bienvenue.php">'. $nam . '</a>';
    }
    else
    {
        echo  '<a href="connexion.php"> Connexion </a>';
    }
    ?></li>
  </ul>
</header>
<body>
<?php


if (!empty($_POST['prenom'])){
  if(!empty($_POST['nom'])){
    if( !empty($_POST['mail'])){
      if(!empty($_POST['objet'])){
        if(!empty($_POST['msg'])){


    try {
			              $bdd = new PDO("mysql:host=hhva.myd.infomaniak.com;dbname=hhva_michaelgms", "hhva_michaelgms", "yxt7TjYiLK");



                    /*Inssertion message*/

                   $prenom = (htmlentities($_POST['prenom']))?filter_var($_POST['prenom'],FILTER_SANITIZE_STRING):"";
                   $nom = (htmlentities($_POST['nom']))?filter_var($_POST['nom'],FILTER_SANITIZE_STRING):"";
                   $mail = (htmlentities($_POST['mail']))?filter_var($_POST['mail'],FILTER_SANITIZE_STRING):"";
                   $objet = (htmlentities($_POST['objet']))?filter_var($_POST['objet'],FILTER_SANITIZE_STRING):"";
                   $msg = (htmlentities($_POST['msg']))?filter_var($_POST['msg'],FILTER_SANITIZE_STRING):"";

                   $stmt = $bdd->prepare("INSERT INTO message (Prenom, Nom, Mail, Objet, Message) VALUES (:Prenom, :Nom, :Mail, :Objet, :Message)");
                   $stmt->bindParam(':Prenom', $prenom, PDO::PARAM_STR);
                   $stmt->bindParam(':Nom', $nom, PDO::PARAM_STR);
                   $stmt->bindParam(':Mail', $mail, PDO::PARAM_STR);
                   $stmt->bindParam(':Objet', $objet, PDO::PARAM_STR);
                   $stmt->bindParam(':Message', $msg, PDO::PARAM_STR);

                   $insertion = $stmt->execute(); /*OBLIGATOIRE AVEC LE BINDPARAM */

                   if ($insertion)
                     {
                        ?>

                      <script> alert("Votre message à été envoyé avec succès ")</script>

                      <?php
                        echo "<meta http-equiv='refresh' content='0;url=contact'>";
                         $submt = "Registering in progres...";
                     }
                   else
                     {
                          echo "Une erreur empèche de modifier vos données ! ";
                          echo "<meta http-equiv='refresh' content='0;url=contact'>";
                           $submt = "Registering in progres...";
                     }
                 }
                 catch (PDOException $e)
                   {
                      if (strpos($e->getMessage(), "Duplicate entry") || (strpos($e->getMessage(), "1062")))
                       {
                         $messg = "User name <em>blem</em> already taken";
                       }
                      else
                      {
                        die("Erreur  " . $e->getMessage());
                      }
                   }
                    $bdd = NULL; // Close connection
                  }
                }
              }
            }
          }
      else
      {
        echo "Error";
      }
?>
</body>
</html>
