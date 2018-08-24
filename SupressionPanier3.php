<?php
session_start();
unset($_SESSION['magtaille']);
unset($_SESSION['magid']);
echo "<meta http-equiv='refresh' content='0;url=panier.php'>";
?>
