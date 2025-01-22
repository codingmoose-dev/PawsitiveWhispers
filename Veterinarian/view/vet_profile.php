<?php 
session_ start(); -->
if (!isset ($_SESSION['uname'] )) {
header ('Location: /reg/vet_reg.php');
}
?>

<!DOCTYPE html> 
<html lang-"en">
 <head> 
    <meta charset-"UTF-8">
    <meta name-"viewport" content="width-device-width, initial-scale-1.0"
     <title>vet profile‹/title›
< /head>
 <body> <p>welcome, <?php echo ($_ SESSION['uname']);
  ?>/p>
   <a href-"../control/vet_session_destroy-php">Logout</a>
</body> </html>
