<?php
require_once 'C:\xampp\htdocs\projet_adam_final\config.php'; 
class FeedbackController {
    public function getAllFeedbacks() {
        $sql = "SELECT * FROM feedback";
        $conn = conn::getConnexion();
        try {
            $listfeed = $conn->query($sql);
            return $listfeed;
        } catch (Exception $e) {
            error_log("Error fetching feedbacks: " . $e->getMessage());
            throw new Exception("Error fetching feedbacks.");
        }
    }

    public function addFeedback($feedback) {
        $conn = conn::getConnexion();

        $sql = "INSERT INTO feedback (user_name, user_email, feedback_type, message, created_at)
                VALUES (:user_name, :user_email, :feedback_type, :message, :created_at )";
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':user_name' => $feedback->getUserName(),
                ':user_email' => $feedback->getUserEmail(),
                ':feedback_type' => $feedback->getFeedbackType(),
                ':message' => $feedback->getMessage(),
                ':created_at' => $feedback->getCreatedAt(),
                
            ]);
            return true;
        } catch (Exception $e) {
            error_log("Error adding feedback: " . $e->getMessage());
            throw new Exception("Error adding the feedback.");
        }
    }

    public function deleteFeedback($id) {
        $conn = conn::getConnexion();

        $sql = "DELETE FROM feedback WHERE id = :id";
        try {
            $query = $conn->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            return true;
        } catch (Exception $e) {
            error_log("Error deleting feedback with ID $id: " . $e->getMessage());
            throw new Exception("Error deleting the feedback.");
        }
    }

    public function updateFeedback($feedback, $id) {
        $conn = conn::getConnexion();
        $sql = "UPDATE feedback SET 
                    user_name = :user_name, 
                    user_email = :user_email, 
                    feedback_type = :feedback_type, 
                    message = :message, 
                    created_at = :created_at 
                WHERE id = :id";
    
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':user_name' => $feedback->getUserName(),
                ':user_email' => $feedback->getUserEmail(),
                ':feedback_type' => $feedback->getFeedbackType(),
                ':message' => $feedback->getMessage(),
                ':created_at' => $feedback->getCreatedAt(),
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            error_log("Error updating feedback: " . $e->getMessage());
            throw new Exception("Error updating the feedback.");
        }
    }
    

   
}
?>
