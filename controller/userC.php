
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

}

?>
