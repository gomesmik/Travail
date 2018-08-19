<?php session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <title>Mik'Shop</title>
  <link rel="stylesheet" href="Style.css"/>
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





<footer>
   <center><a href="http://www.instagram.com/" title="instagram">
     <img alt="Instagram" src="images/Instagram.png" width="20" height="20"/>
   </a>
   <a href="http://www.facebook.com/" title="facebook">
     <img alt="facebook" src="images/facebook.png" width="20" height="20"/>
   </a>
   <a href="http://www.twitter.com/" title="twitter">
     <img alt="twitter" src="images/twitter.png" width="20" height="20"/>
   </a>
 </center>
<p>
  <i>Created by Michael Gomes</i>
</p>
</footer>
</body>
</html>
