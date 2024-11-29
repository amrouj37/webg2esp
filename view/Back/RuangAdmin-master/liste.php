<?php
include 'C:\xamppp\htdocs\projetsarra\controller\ControllerQuizz.php';

include 'courses.php';
$ControllerQuiz = new ControllerQuizz();
$list = $ControllerQuiz->getAllquiz();
?>