
<?php


require_once 'C:\xampp\htdocs\projectA\config.php'; 
require_once 'C:\xampp\htdocs\projectA\model\user.php';
class userC{
    public function getUser() {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM user";
        try {
            $query = $conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); // Récupère tous les utilisateurs sous forme de tableau associatif
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
    public function getAllUsers() {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM user";
        try {
            $query = $conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); // Récupérer tous les utilisateurs
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    


    public function addUser($user) {
        $conn = config::getConnexion(); // Connexion à la base de données
        $sql = "INSERT INTO user(cin_user, nom_user, prenom_user, email_user, adress_user, num_user, pwd_user, role_user) 
                VALUES (:cin_user, :nom_user, :prenom_user, :email_user, :adress_user, :num_user, :pwd_user, :role_user)";
    
        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            // On accède aux propriétés de l'objet User et on les passe à la requête SQL
            $query->execute([
                ':cin_user' => $user->getCin(),
                ':nom_user' => $user->getNom(),
                ':prenom_user' => $user->getPrenom(),
                ':email_user' => $user->getEmail(),
                ':adress_user' => $user->getAdress(),
                ':num_user' => $user->getNum(),
                ':pwd_user' => $user->getPwd(),
                ':role_user' => $user->getRole()
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }
    
    

    public function updateUser($id_user, $cin_user, $nom_user, $prenom_user, $email_user, $adress_user, $num_user, $pwd_user, $role_user) {
        $sql = "UPDATE users SET 
                 cin_user = :cin_user, 
                 nom_user = :nom_user, 
                 prenom_user = :prenom_user, 
                 email_user = :email_user, 
                 adress_user = :adress_user, 
                 num_user = :num_user, 
                 pwd_user = :pwd_user, 
                 role_user = :role_user 
                WHERE id_user = :id_user";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->execute([
            'cin_user' => $cin_user,
            'nom_user' => $nom_user,
            'prenom_user' => $prenom_user,
            'email_user' => $email_user,
            'adress_user' => $adress_user,
            'num_user' => $num_user,
            'pwd_user' => $pwd_user, // Mot de passe crypté
            'role_user' => $role_user,
            'id_user' => $id_user,
        ]);
    }
    
    
public function deleteUser($cin_user){
    $conn = config::getConnexion();
    $sql="DELETE FROM user WHERE cin_user = :cin_user";
    try{
        $query=$conn->prepare($sql);
        $query->execute([':cin_user'=>$cin_user]);
    }
    catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

// Dans le fichier userC.php, assurez-vous que la méthode getUserById fonctionne correctement.



public function getUserById($cin_user) {
    $sql = "SELECT * FROM user WHERE cin_user = :cin_user";
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->execute(['cin_user' => $cin_user]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Débogage
        if ($result === false) {
            echo "Aucun utilisateur trouvé avec l'ID : " . $cin_user;
        } 

        return $result;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

public function getUserByEmail($email_user) {
    $conn = config::getConnexion();  // Utilisation de la classe config pour obtenir la connexion
    $query = "SELECT * FROM user WHERE email_user = :email_user";  // Requête SQL pour récupérer l'utilisateur
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email_user', $email_user);  // Liaison du paramètre
    $stmt->execute();
    $user = $stmt->fetch();  // Récupérer l'utilisateur
    return $user;
}

// Fonction pour connecter un utilisateur et créer un cookie
function loginUser($userId, $prenom, $email, $role) {
    // Générer un token unique pour la session
    $sessionToken = bin2hex(random_bytes(16));

    try {
        // Mettre à jour la base de données avec le token de session
        $sql = "UPDATE user SET session_token = :session_token WHERE id_user = :id_user";
        $stmt = config::getConnexion()->prepare($sql);
        $stmt->execute([
            ':session_token' => $sessionToken,
            ':id_user' => $userId
        ]);

        // Stocker les informations dans la session
        $_SESSION['user_id'] = $userId;
        $_SESSION['prenom_user'] = $prenom;
        $_SESSION['email_user'] = $email;
        $_SESSION['role_user'] = $role;

        // Créer un cookie pour la session
        setcookie('user_session', $sessionToken, time() + (86400 * 30), '/'); // Cookie valable 30 jours
    } catch (PDOException $e) {
        echo "Erreur lors de la création de la session : " . $e->getMessage();
    }
    // Fonction pour déconnecter un utilisateur
function logoutUser() {
    // Supprimer les cookies et la session
    if (isset($_SESSION['user_id'])) {
        try {
            $sql = "UPDATE user SET session_token = NULL WHERE id_user = :id_user";
            $stmt = config::getConnexion()->prepare($sql);
            $stmt->execute([':id_user' => $_SESSION['user_id']]);
        } catch (PDOException $e) {
            echo "Erreur lors de la déconnexion : " . $e->getMessage();
        }
    }

    // Supprimer les sessions et les cookies
    session_unset();
    session_destroy();
    setcookie('user_session', '', time() - 3600, '/');
}


}


public function exportToExcel() {
    $list = $this->getAllUsers(); // Récupère tous les utilisateurs depuis la méthode existante

    // Définir les en-têtes pour l'exportation Excel
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=index2.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Vérifier si des données sont disponibles
    if (!empty($list)) {
        echo "<table border='1'>"; // Début du tableau HTML
        echo "<thead>
                <tr>
                    <th>CIN</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Numéro</th>
                    <th>Rôle</th>
                </tr>
              </thead>";
        echo "<tbody>";

        // Boucle pour afficher chaque utilisateur dans une ligne
        foreach ($list as $user) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($user['cin_user']) . "</td>";
            echo "<td>" . htmlspecialchars($user['prenom_user']) . "</td>";
            echo "<td>" . htmlspecialchars($user['nom_user']) . "</td>";
            echo "<td>" . htmlspecialchars($user['email_user']) . "</td>";
            echo "<td>" . htmlspecialchars($user['adress_user']) . "</td>";
            echo "<td>" . htmlspecialchars($user['num_user']) . "</td>";
            echo "<td>" . htmlspecialchars($user['role_user']) . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>"; // Fin du tableau HTML
    } else {
        echo "Aucun utilisateur trouvé."; // Message si aucune donnée n'est disponible
    }
}
<?php
// Inclure le fichier de connexion à la base de données
require_once 'C:\xampp\htdocs\projectA\config.php';
require_once 'vendor/autoload.php';  // Charger PHPMailer via Composer

session_start(); // Démarrer la session

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $cin_user = $_POST['cin_user'];
    $nom_user = $_POST['nom_user'];
    $prenom_user = $_POST['prenom_user'];
    $email_user = $_POST['email_user'];
    $adress_user = $_POST['address_user'];
    $num_user = $_POST['num_user'];
    $pwd_user = $_POST['pwd_user'];

    // Définir le rôle en fonction du prénom
    if (strtoupper(trim($prenom_user)) === 'AICHA') {
        $role_user = 'admin';
    } else {
        $role_user = 'client'; // Rôle par défaut
    }

    // Préparer la requête SQL pour insérer les données dans la base de données
    $sql = "INSERT INTO user (cin_user, nom_user, prenom_user, email_user, adress_user, num_user, pwd_user, role_user) 
            VALUES (:cin_user, :nom_user, :prenom_user, :email_user, :adress_user, :num_user, :pwd_user, :role_user)";

    try {
        // Préparer et exécuter la requête
        $stmt = config::getConnexion()->prepare($sql);
        $stmt->execute([
            ':cin_user' => $cin_user,
            ':nom_user' => $nom_user,
            ':prenom_user' => $prenom_user,
            ':email_user' => $email_user,
            ':adress_user' => $adress_user,
            ':num_user' => $num_user,
            ':pwd_user' => password_hash($pwd_user, PASSWORD_DEFAULT),
            ':role_user' => $role_user
        ]);

        // Sauvegarder le prénom et rôle dans une session
        $_SESSION['prenom_user'] = $prenom_user;
        $_SESSION['role_user'] = $role_user;

        // Fonction pour envoyer l'email
        sendConfirmationEmail($email_user, $prenom_user);

        // Rediriger en fonction du rôle
        if ($role_user === 'admin') {
            header("Location: /projectA/view/back/index2.php");
        } else {
            header("Location: client.php");
        }

        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

function sendConfirmationEmail($email_user, $prenom_user) {
    // Créer une instance de PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    // Paramètres du serveur
    $mail->isSMTP();  // Utiliser SMTP
    $mail->Host = 'smtp.example.com'; // Exemple : smtp.gmail.com
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@example.com'; // Votre e-mail
    $mail->Password = 'your_email_password'; // Votre mot de passe d'email
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;  // Port SMTP

    // Paramètres de l'e-mail
    $mail->setFrom('your_email@example.com', 'Saha Prep'); // L'expéditeur
    $mail->addAddress($email_user); // L'adresse de destination (email de l'utilisateur)
    $mail->isHTML(true); // Utiliser le format HTML
    $mail->Subject = 'Confirmation d\'inscription';
    $mail->Body    = '<h1>Bienvenue sur Saha Prep, ' . htmlspecialchars($prenom_user) . '!</h1>
                      <p>Merci de vous être inscrit sur notre site. Nous sommes heureux de vous avoir parmi nous.</p>';

    // Envoyer l'e-mail
    if($mail->send()) {
        echo 'Un e-mail de confirmation a été envoyé.';
    } else {
        echo 'L\'envoi de l\'e-mail a échoué : ' . $mail->ErrorInfo;
    }
}
?>


        



}

?>
