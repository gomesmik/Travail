<?php
session_start();
unset($_SESSION['hyptaille']);
unset($_SESSION['hyperid']);
echo "<meta http-equiv='refresh' content='0;url=panier.php'>";
?>
