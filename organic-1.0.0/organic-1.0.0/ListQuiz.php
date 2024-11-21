<?php
require_once 'C:/xampp/htdocs/projet_sarra/Controller/QuizController.php';  

// Créer une instance de QuizController
$quizController = new QuizController();

// Récupérer tous les quiz
$quizzes = $quizController->getQuizzes();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 20px auto;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td a {
            padding: 8px 12px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .update-btn {
            background-color: #4CAF50;
        }
        .update-btn:hover {
            background-color: #45a049;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .delete-btn:hover {
            background-color: #e53935;
        }
        @media (max-width: 768px) {
            table {
                width: 100%;
            }
            th, td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div>
        <h1>Liste des Quiz</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Quiz</th>
                    <th>Categorie</th>
                    <th>Date de création</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($quizzes as $quiz): ?>
                    <tr>
                        <td><?php echo $quiz['id_quiz']; ?></td>
                        <td><?php echo $quiz['categorie']; ?></td>
                        <td><?php echo $quiz['date_creation']; ?></td>
                        <td><?php echo htmlspecialchars($quiz['titre']); ?></td>
                        <td><?php echo htmlspecialchars($quiz['description']); ?></td>
                        <td>
                            <a class="delete-btn" href="DeleteQuiz.php?id=<?php echo $quiz['id_quiz']; ?>">DELETE</a>
                            <a class="update-btn" href="UpdateQuiz.php?id=<?php echo $quiz['id_quiz']; ?>">Update</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
