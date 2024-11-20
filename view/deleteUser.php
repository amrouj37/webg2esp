<?php
include '../controller/userC.php';
$userC = new userC();
$userC->deleteUser($_GET["id_user"]);
header('Location:listUser.php');
?>