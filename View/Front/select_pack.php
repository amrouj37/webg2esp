<?php
// Include required files
require_once 'C:/xampp/htdocs/projet_adam_final/Controller/packC.php';
require_once 'C:/xampp/htdocs/projet_adam_final/Model/pack.php';
require_once 'C:/xampp/htdocs/projet_adam_final/Controller/platcontroller.php';
require_once 'C:/xampp/htdocs/projet_adam_final/Controller/quizC.php';
$but = isset($_GET['goal']) ? htmlspecialchars($_GET['goal']) : 'Weight Loss';
// Create an instance of QuizC
$quizC = new QuizC();

// Fetch the latest 'but' value
$latestBut = $quizC->getLatestBut();

// Create an instance of PlatController
$platController = new PlatController();

// Fetch plats based on the latest goal ('but')
if ($latestBut === 'Weight Loss') {
    // Fetch healthy plats (is_healthy = 1)
    $plats = $platController->getIsHealthy(1);
} elseif ($latestBut === 'Weight Gain') {
    // Fetch unhealthy plats (is_healthy = 0)
    $plats = $platController->getIsHealthy(0);
} else {
    // Fallback if 'but' is neither 'Weight Loss' nor 'Weight Gain'
    $plats = []; // No plats available if goal is undefined
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plats Disponibles</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #e8f5e9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #4CAF50;
        }

        .goal-links {
            margin: 20px;
            font-size: 18px;
        }

        .goal-links a {
            text-decoration: none;
            color: #FFEB3B;
            font-weight: bold;
            padding: 5px 15px;
            border-radius: 20px;
            transition: background-color 0.3s ease;
        }

        .goal-links a:hover {
            background-color: #388E3C;
            color: white;
        }

        .plats-container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
            margin-top: 30px;
        }

        .plats-container h2 {
            color: #388E3C;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .plat-item {
            background-color: #fff;
            padding: 15px;
            margin: 10px 0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .plat-item:hover {
            transform: scale(1.05);
        }

        .plat-item img {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 10px;
        }

        .plat-item h3 {
            color: #388E3C;
            margin: 10px 0;
        }

        .plat-item p {
            font-size: 16px;
            color: #FFEB3B;
        }

        .plat-item .price {
            color: #388E3C;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Goal Selection Links -->
    <div class="goal-links">
        <a href="?goal=Weight+Loss">Weight Loss</a> | 
        <a href="?goal=Weight+Gain">Weight Gain</a>
    </div>

    <div class="plats-container">
        <h2>Plats Disponibles pour: <?php echo htmlspecialchars($latestBut); ?></h2>
        <?php
        // Display the fetched plats
        if (!empty($plats)) {
            foreach ($plats as $plat) {
                echo "<div class='plat-item'>";
                echo "<h3>" . htmlspecialchars($plat['nom_plat']) . "</h3>";
                echo "<p class='price'>Prix: " . htmlspecialchars($plat['prix_plat']) . "€</p>";
                echo "<img src='img/" . htmlspecialchars($plat['url_img']) . "' alt='" . htmlspecialchars($plat['nom_plat']) . "' />";

                echo "</div>";
            }
        } else {
            echo "<p>Aucun plat disponible pour cet objectif.</p>";
        }
        ?>
    </div>
</body>
</html>
