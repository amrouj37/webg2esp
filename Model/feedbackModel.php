<?php
class Feedback {
    private $user_name;
    private $user_email;
    private $feedback_type;
    private $message;
    private $created_at;

    public function __construct($user_name, $user_email, $feedback_type, $message, $created_at) {
        $this->user_name = $user_name;
        $this->user_email = $user_email;
        $this->feedback_type = $feedback_type;
        $this->message = $message;
        $this->created_at = $created_at;
    }

    // Getters
    

    public function getUserName() {
        return $this->user_name;
    }

    public function getUserEmail() {
        return $this->user_email;
    }

    public function getFeedbackType() {
        return $this->feedback_type;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setUserName($user_name) {
        $this->user_name = $user_name;
    }

    public function setUserEmail($user_email) {
        $this->user_email = $user_email;
    }

    public function setFeedbackType($feedback_type) {
        $this->feedback_type = $feedback_type;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
}
?>
