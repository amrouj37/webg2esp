<?php
require_once 'C:\xamppp\htdocs\projetsarra\controller\QuizC.php';

$id_quiz = $_GET['id'];
$QuizC = new QuizC();
$quiz = $QuizC->getQuizById($id_quiz);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Quiz</title>
</head>
<body>
    <h1>Modifier un Quiz</h1>
    <form action="" method="POST">
        <input type="hidden" name="id_quiz" value="<?= $quiz['id_quiz'] ?? '' ?>">

        <label for="gender">Genre :</label>
        <select name="gender" id="gender" required>
            <option value="Homme" <?= $quiz['gender'] == 'Homme' ? 'selected' : '' ?>>Homme</option>
            <option value="Femme" <?= $quiz['gender'] == 'Femme' ? 'selected' : '' ?>>Femme</option>
        </select><br><br>

        <label for="age">Âge :</label>
        <input type="number" name="age" id="age" min="1" value="<?= $quiz['age'] ?? '' ?>" required><br><br>

        <label for="weight">Poids (kg) :</label>
        <input type="number" name="weight" id="weight" min="1" value="<?= $quiz['weight'] ?? '' ?>" required><br><br>

        <label for="activitylevel">Niveau d'activité :</label>
        <select name="activitylevel" id="activitylevel" required>
            <option value="Faible" <?= $quiz['activitylevel'] == 'Faible' ? 'selected' : '' ?>>Faible</option>
            <option value="Modéré" <?= $quiz['activitylevel'] == 'Modéré' ? 'selected' : '' ?>>Modéré</option>
            <option value="Intense" <?= $quiz['activitylevel'] == 'Intense' ? 'selected' : '' ?>>Intense</option>
        </select><br><br>

        <label for="goal">Objectif :</label>
        <input type="text" name="goal" id="goal" value="<?= $quiz['goal'] ?? '' ?>" required><br><br>

        <button type="submit">Modifier</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $id_quiz = $_POST['id_quiz'];
            $gender = $_POST['gender'];
            $age = $_POST['age'];
            $weight = $_POST['weight'];
            $activitylevel = $_POST['activitylevel'];
            $goal = $_POST['goal'];

            $QuizC->updateQuiz($id_quiz, $gender, $age, $weight, $activitylevel, $goal);

            echo 'Quiz mis à jour avec succès !';
        } catch (Exception $e) {
            echo 'Erreur lors de la mise à jour du quiz : ' . $e->getMessage();
        }
    }
    ?>
</body>
</html>