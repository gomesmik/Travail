
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="stylenew.css"/>
  <meta charset="UTF-8">
</head>


<body>
<header>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="produit.php">Produit</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li class="pan"><a href="panier.php" style="float:right"><img src="images/panier.png" alt="panier" height="15" width="20"></a></li>
    <li style="float:right"><a class="active" href="connexion.php">Connexion</a></li>
  </ul>

</header>
<h1><u>Nouveau sur Mik'Shop ? Bienvenue !</u></h1>
<table>
  <form method="POST" action="donneenouveaumembre.php">
   <tr>
       <td>Nom :</td>
       <td><input name="nom" type="text" required></td>
       <td></td>
       <td></td>
       <td></td>
       <td>Prenom :</td>
       <td><input name="prenom" type="text" required></td>
   </tr>
   <tr>
     <td>Adresse :</td>
     <td><input name="adresse" type="text" required></td>
     <td></td>
     <td></td>
     <td></td>
     <td>Téléphone :</td>
     <td><input name="telephone" type="tel"  placeholder="123-456-7890"
           pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
           required /></td>
   </tr>
   <tr>
     <td>Email :</td>
     <td><input name="email" type="text" required></td>
     <td></td>
     <td></td>
     <td></td>
     <td>Sexe :</td>
     <td>
       <select name="sexe">
            <option value="Homme" style="width:115px; height:20px"> Homme </option>
            <option value="Femme"> Femme </option>
      </select>
    </td>
   </tr>
   <tr>
     <td>Login :</td>
     <td><input name="login" type="text" required></td>
     <td></td>
     <td></td>
     <td></td>
     <td>Mot de passe :</td>
     <td><input type="password" name="motdep" required></td>
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
     <td><input type="submit" value="S'inscrire" style="width:145px; height:30px"></td>
   </tr>

 </form>
</table>

</body>
</html>
