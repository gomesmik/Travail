<?php


if (!empty($_POST['prenom'])){
  if(!empty($_POST['nom'])){
    if( !empty($_POST['mail'])){
      if(!empty($_POST['objet'])){
        if(!empty($_POST['msg'])){


echo "Salut";
                  try {
                    $conn = new PDO("mysql:host=localhost;dbname=travail", "root", "");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    /*Inssertion message*/

                   $prenom = (htmlentities($_POST['prenom']))?filter_var($_POST['prenom'],FILTER_SANITIZE_STRING):"";
                   $nom = (htmlentities($_POST['nom']))?filter_var($_POST['nom'],FILTER_SANITIZE_STRING):"";
                   $mail = (htmlentities($_POST['mail']))?filter_var($_POST['mail'],FILTER_SANITIZE_STRING):"";
                   $objet = (htmlentities($_POST['objet']))?filter_var($_POST['objet'],FILTER_SANITIZE_STRING):"";
                   $msg = (htmlentities($_POST['msg']))?filter_var($_POST['msg'],FILTER_SANITIZE_STRING):"";

                   $stmt = $conn->prepare("INSERT INTO message (Prenom, Nom, Mail, Objet, Message) VALUES (:Prenom, :Nom, :Mail, :Objet, :Message)");
                   $stmt->bindParam(':Prenom', $prenom, PDO::PARAM_STR);
                   $stmt->bindParam(':Nom', $nom, PDO::PARAM_STR);
                   $stmt->bindParam(':Mail', $mail, PDO::PARAM_STR);
                   $stmt->bindParam(':Objet', $objet, PDO::PARAM_STR);
                   $stmt->bindParam(':Message', $msg, PDO::PARAM_STR);

                   $insertion = $stmt->execute(); /*OBLIGATOIRE AVEC LE BINDPARAM */

                   if ($insertion)
                     {
                        echo "<p>Votre message à été envoyé avec succès !</p>";
                        echo "<meta http-equiv='refresh' content='6;url=index.html'>";
                         $submt = "Registering in progres...";
                     }
                   else
                     {
                          echo "Une erreur empèche votre compte d'être créer ! ";
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
