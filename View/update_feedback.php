<?php
require_once 'C:\xampp\htdocs\projet_adam_final\Controller\feedbackController.php';
require_once 'C:\xampp\htdocs\projet_adam_final\Model\feedbackModel.php';
$feedbackController = new FeedbackController();


   

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET['id'])) {
        $id = $_GET['id'];
    $newUserName = $_POST['user_name'];
    $newUserEmail = $_POST['user_email'];
    $newFeedbackType = $_POST['feedback_type'];
    $newMessage = $_POST['message'];

    $feedbackObj = new Feedback($newUserName, $newUserEmail, $newFeedbackType, $newMessage, date('Y-m-d H:i:s'));

    $feedbackController->updateFeedback($feedbackObj, $id);

    header("Location: index.php");
    exit;
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .feedback-form-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .feedback-form-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .feedback-form-container label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        .feedback-form-container input,
        .feedback-form-container select,
        .feedback-form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .feedback-form-container button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .feedback-form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="feedback-form-container">
        <h1>Update Feedback</h1>
        <form onsubmit="return validForm();" action="" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($feedback['id']); ?>">

            <label for="user_name">Your Name</label>
            <input type="text" id="user_name" name="user_name" value="<?= htmlspecialchars($feedback['user_name']); ?>" required>

            <label for="user_email">Your Email</label>
            <input type="email" id="user_email" name="user_email" value="<?= htmlspecialchars($feedback['user_email']); ?>" required>

            <label for="feedback_type">Feedback Type</label>
            <select id="feedback_type" name="feedback_type" required>
                <option value="General" <?= $feedback['feedback_type'] === "General" ? "selected" : ""; ?>>General</option>
                <option value="Complaint" <?= $feedback['feedback_type'] === "Complaint" ? "selected" : ""; ?>>Complaint</option>
                <option value="Suggestion" <?= $feedback['feedback_type'] === "Suggestion" ? "selected" : ""; ?>>Suggestion</option>
            </select>

            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="5" required><?= htmlspecialchars($feedback['message']); ?></textarea>

            <button type="submit">Update Feedback</button>
        </form>
    </div>
    <script>
         function validForm() {
    // Récupérer les valeurs des champs
    const userName = document.getElementById('user_name').value.trim();
    const userEmail = document.getElementById('user_email').value.trim();
    const feedbackType = document.getElementById('feedback_type').value.trim();
    const message = document.getElementById('message').value.trim();

    // Validation pour le nom d'utilisateur
    if (!userName || userName.length < 3) {
        alert("Le nom doit contenir au moins 3 caractères.");
        return false;
    }

    // Validation pour l'email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(userEmail)) {
        alert("Veuillez entrer une adresse e-mail valide.");
        return false;
    }

    // Validation pour le type de feedback
    if (!feedbackType) {
        alert("Veuillez sélectionner un type de feedback.");
        return false;
    }

    // Validation pour le message
    if (!message || message.length < 10) {
        alert("Le message doit contenir au moins 10 caractères.");
        return false;
    }

    // Si tout est valide
    return true;
}

    </script>
</body>
</html>
