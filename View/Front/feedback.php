


<?php
require_once 'C:\xampp\htdocs\projet_adam_final\Model\feedbackModel.php';
require_once 'C:/xampp/htdocs/projet_adam_final/Controller/feedbackController.php';
//feedback
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $feedback_type = $_POST['feedback_type'];
    $message = $_POST['message'];
    $created_at = date('Y-m-d H:i:s');
  
    // Create a new Feedback object without 'status'
    $feedback = new Feedback($user_name, $user_email, $feedback_type, $message, $created_at);
  
    $controller = new FeedbackController();
    try {
        $controller->addFeedback($feedback);
        echo "Feedback submitted successfully.";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <title>SAHA PREP</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="format-detection" content="telephone=no">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="author" content="">
      <meta name="keywords" content="">
      <meta name="description" content="">
  
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="css/vendor.css">
      <link rel="stylesheet" type="text/css" href="style.css">
      <link rel="stylesheet" href="css/stars.css">
  
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  
    </head>
    <body>
  <section class="py-3 text-center" >
  <h2 class="my-4" >Your Feedback</h2>
  <form  onsubmit="return validForm();" action="" method="POST">
          <div class="form-group">
              <label for="user_name">Your Name</label>
              <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter your name" required>
          </div>
          <div class="form-group">
              <label for="user_email">Your Email</label>
              <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter your email" required>
          </div>
          <div class="form-group">
              <label for="feedback_type">Feedback Type</label>
              <select class="form-control" id="feedback_type" name="feedback_type" required>
                  <option value="General">General</option>
                  <option value="Complaint">Complaint</option>
                  <option value="Suggestion">Suggestion</option>
              </select>
          </div>
          <div class="form-group">
              <label for="message">Your Message</label>
              <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit Feedback</button>
      </form>
</section>

</body>
</html>
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






