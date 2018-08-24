
<?php
session_start();
unset($_SESSION['taille']);
unset($_SESSION['tiempoid']);
echo "<meta http-equiv='refresh' content='0;url=panier.php'>";
?>
