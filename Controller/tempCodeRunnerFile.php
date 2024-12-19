<?php
require_once 'C:\xampp\htdocs\projet_adam_final\Controller\feedbackController.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id']; // Fetch the feedback ID from the form


    $feedbackController = new FeedbackController();

    try {
        // Call the delete method
        $feedbackController->deleteFeedback($id);

        // Redirect back to the feedback list after deletion
        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        // Handle errors gracefully
        echo "Error deleting feedback: " . $e->getMessage();
    }
}
?>