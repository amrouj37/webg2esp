<?php
require_once 'C:\xampp\htdocs\projet_adam_final\Controller\feedbackController.php';
require_once 'C:\xampp\htdocs\projet_adam_final\Model\feedbackModel.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $feedback_type = $_POST['feedback_type'];
    $message = $_POST['message'];

    $feedback = new Feedback($user_name, $user_email, $feedback_type, $message, date('Y-m-d H:i:s'));

    $feedbackController = new FeedbackController();

    $feedbackController->updateFeedback($feedback, $id);

    header("Location: index.php");
    exit;
} else {
    echo "Invalid request.";
    exit;
}
?>
