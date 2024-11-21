<?php
require_once 'C:/xamppp/htdocs/projet_sarra/Model/Quiz.php';

// Création d'une instance du quiz avec les paramètres
$quiz1 = new Quiz(1, "General Knowledge Quiz", "General", "A quiz about general knowledge with various topics.", "2024-11-20");

// Afficher les informations du quiz
$quiz1->show();
?>
