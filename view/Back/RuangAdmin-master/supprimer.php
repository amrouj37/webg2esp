<?php
require_once  'C:\xamppp\htdocs\projetsarra\Config.php';
require_once  'C:\xamppp\htdocs\projetsarra\controller\ControllerQuiz.php';


$ControllerQuiz = new ControllerQuiz();
$ControllerQuiz->supprimer($_GET["id_quiz"]);
header('Location: liste.php');
?>