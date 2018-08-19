<!DOCTYPE html>
<html>
  <head>
    <title>Félicitation</title>
    <link rel="stylesheet" href="StyleDonnee.css"/>
    <meta charset="UTF-8">
  </head>

    <body>

      </body>
</html>

 <?php

if (!empty($_POST['nom'])) {
  if(!empty($_POST['prenom'])){
    if( !empty($_POST['adresse'])){
       if(!empty($_POST['telephone'])){
         if(!empty($_POST['email'])){
           if(!empty($_POST['login'])){
             if(!empty($_POST['motdep'])) {

                   try {
               	     $conn = new PDO("mysql:host=localhost;dbname=travail", "root", "");
               	     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                     /*Creation du compte*/

                 		$nom = (htmlentities($_POST['nom']))?filter_var($_POST['nom'],FILTER_SANITIZE_STRING):"";
                 		$prenom = (htmlentities($_POST['prenom']))?filter_var($_POST['prenom'],FILTER_SANITIZE_STRING):"";
                    $adresse = (htmlentities($_POST['adresse']))?filter_var($_POST['adresse'],FILTER_SANITIZE_STRING):"";
                 		$telephone = (htmlentities($_POST['telephone']))?filter_var($_POST['telephone'],FILTER_SANITIZE_NUMBER_INT):"";
                    $email = (htmlentities($_POST['email']))?filter_var($_POST['email'],FILTER_SANITIZE_STRING):"";
                    $sex = (htmlentities($_POST['sexe']))?filter_var($_POST['sexe'],FILTER_SANITIZE_STRING):"";
                 		$login = (htmlentities($_POST['login']))?filter_var($_POST['login'],FILTER_SANITIZE_STRING):"";
                    $MotDePasse = (htmlentities($_POST['motdep']))?filter_var($_POST['motdep'],FILTER_SANITIZE_STRING):"";

                    $phash = password_hash($MotDePasse, PASSWORD_DEFAULT);


                			   $req = $conn->prepare("Select Login from client WHERE Login = :log");
                         $req->bindParam(':log', $login, PDO::PARAM_STR);
                         $req->execute();
                         $req = $req->rowcount();
                					if ($req == 1){
                            ?>
                            <script>alert('Ce login existe déjà, veuillez en trouver un autre !')</script>
                            <?php
                              echo "<meta http-equiv='refresh' content='0;url=NouveauMembre.php'>";
                          }
                          else {

                 		$stmt = $conn->prepare("INSERT INTO client (Nom, Prenom, Adresse, Telephone, Email, Sexe, Login, MotDePasse) VALUES (:Nom, :Prenom, :Adresse, :Telephone, :Email, :Sexe, :Login, :MotDePasse)");
                 		$stmt->bindParam(':Nom', $nom, PDO::PARAM_STR);
                 		$stmt->bindParam(':Prenom', $prenom, PDO::PARAM_STR);
                    $stmt->bindParam(':Adresse', $adresse, PDO::PARAM_STR);
                    $stmt->bindParam(':Telephone', $telephone, PDO::PARAM_INT);
                    $stmt->bindParam(':Email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':Sexe', $sex, PDO::PARAM_STR);
                    $stmt->bindParam(':Login', $login, PDO::PARAM_STR);
                    $stmt->bindParam(':MotDePasse', $phash, PDO::PARAM_STR);

                 		$insertion = $stmt->execute(); /*OBLIGATOIRE AVEC LE BINDPARAM */

                 		if ($insertion)
                      {
                         echo "<p>Votre compte à été créer avec succès !</p>";
                   		   echo "<meta http-equiv='refresh' content='4;url=connexion.php'>";
                 		      $submt = "Registering in progres...";
                 		  }
                   	else
                   		{
                 			     echo "Une erreur empèche votre compte d'être créer ! ";
                 		  }

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
         }
       }
       else
       {
         echo "Error";
       }
?>
