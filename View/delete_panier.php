<?php
// Include database connection
require_once 'C:\xampp\htdocs\projet_adam_final\config.php';
$connection = conn::getConnexion();

// Check if we have an id parameter in the URL
if (isset($_GET['id'])) {
    $id_panier = $_GET['id'];

    // Debugging: output the raw ID received from the URL
    var_dump($id_panier);

    // Sanitize and validate the id (optional but recommended)
    $id_panier = filter_var($id_panier, FILTER_SANITIZE_NUMBER_INT);

    // Debugging: output the sanitized ID
    var_dump($id_panier);

    // Check if the id is a valid number
    if (is_numeric($id_panier) && $id_panier > 0) {
        try {
            // Prepare the delete query
            $query = "DELETE FROM panier WHERE idpanier = :idpanier";
            $stmt = $connection->prepare($query);

            // Bind the id to the parameter
            $stmt->bindParam(':idpanier', $id_panier, PDO::PARAM_INT);

            // Execute the delete query
            $stmt->execute();

            // Check if a row was deleted
            if ($stmt->rowCount() > 0) {
                // Redirect to the panier list or success page
                header("Location: ../View/index.php");
                exit();
            } else {
                // If no rows were deleted, show a message
                echo "No record found with ID: $id_panier";
            }
        } catch (Exception $e) {
            // Display any errors if the query fails
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid ID.";
    }
} else {
    echo "Invalid request! No ID provided.";
}
?>
