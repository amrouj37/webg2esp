<?php
require_once 'C:\xampp\htdocs\projet_adam_final\Controller\feedbackController.php';

if ( isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT); // Validate ID as an integer

    if ($id === false) {
        echo "Invalid ID.";
        exit;
    }

    $feedbackController = new FeedbackController();

    try {
        // Call the delete method
        $feedbackController->deleteFeedback($id);

        header('location:../View/index.php');
        exit;
    } catch (Exception $e) {
        // Handle errors gracefully
        echo "Error deleting feedback: " . $e->getMessage();
    }
} else {
    echo "No ID provided.";
}
?>
