
<?php


require_once '../config.php'; 
require_once '../model/user.php';
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





}

?>
