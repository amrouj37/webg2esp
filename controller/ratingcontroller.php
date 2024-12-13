<?php
require_once 'C:\xampp\htdocs\QQQQQ\connection.php';

class RatingController {
    // Function to add a rating to the "ratings" table
    public function addRating($id_plat, $rating) {
        if ($rating >= 1 && $rating <= 5) {
            $conn = config::getConnexion(); // Assuming you're using a connection method
            $sql = "INSERT INTO ratings (id_plat, rating) VALUES (:id_plat, :rating)";
            
            try {
                $query = $conn->prepare($sql);
                $query->execute([
                    ':id_plat' => $id_plat,
                    ':rating' => $rating
                ]);
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
        }
    }

    // Function to calculate the average rating for a specific plat
    public function getAverageRatingForPlat($id_plat) {
        $conn = config::getConnexion();
        $sql = "SELECT AVG(rating) FROM ratings WHERE id_plat = :id_plat";
        
        try {
            $query = $conn->prepare($sql);
            $query->execute([':id_plat' => $id_plat]);
            $average = $query->fetchColumn();
            return $average ? round($average, 2) : 0; // Return 0 if there are no ratings
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Function to get the latest added rating
    public function getLatestRating($id_plat) {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM ratings WHERE id_plat = :id_plat ORDER BY id_rating DESC LIMIT 1";
        
        try {
            $query = $conn->prepare($sql);
            $query->execute([':id_plat' => $id_plat]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    

    // Function to calculate the average rating across all plats
    public function getAverageRating($id_plat) {
        $conn = config::getConnexion();
    $sql = "SELECT SUM(rating) AS total_rating, COUNT(id_rating) AS total_entries FROM ratings WHERE id_plat = :id_plat";
    
    try {
        $query = $conn->prepare($sql);
        $query->execute([':id_plat' => $id_plat]);
        $result = $query->fetch();

        if ($result['total_entries'] > 0) {
            $average = ($result['total_rating'] / $result['total_entries']);
            return number_format($average, 2);
        } else {
            return "No ratings available.";
        }
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}
public function getSortedPlatsByRating() {
    // Get the database connection
    $conn = config::getConnexion();

    // SQL query to select plats and their average ratings, ordered from highest to lowest
    $sql = "SELECT plats.*, AVG(ratings.rating) AS average_rating 
            FROM plats
            LEFT JOIN ratings ON plats.id_plat = ratings.id_plat
            GROUP BY plats.id_plat
            ORDER BY average_rating DESC"; // Sort by average rating in descending order

    try {
        // Prepare and execute the query
        $query = $conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(); // Return the plats sorted by average rating
    } catch (Exception $e) {
        // Handle exceptions
        die('Erreur: ' . $e->getMessage());
    }
}
}
