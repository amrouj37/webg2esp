
<?php


require_once '../config.php'; 
require_once '../model/user.php';
class userC{
    public function getUser() {
        $conn = config::getConnexion(); // Connexion à la base de données

        $sql = "SELECT * FROM user";

        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            $query->execute(); // Exécution de la requête
            return $query->fetchAll(); // Retourne tous les résultats
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }


public function addUser($user) {
    $conn = config::getConnexion(); // Connexion à la base de données
    $sql = "INSERT INTO user(cin_user, nom_user, prenom_user, email_user, adress_user, num_user, pwd_user, role_user) VALUES ( :cin_user, :nom_user, :prenom_user,:email_user, :adress_user, :num_user, :pwd_user, :role_user)";

    try {
        $query = $conn->prepare($sql); // Préparation de la requête(optional)
        $query->execute([
            ':cin_user' => $user['cin_user'],
            ':nom_user' => $user['nom_user'],
            ':prenom_user' => $user['prenom_user'],
            ':email_user' => $user['email_user'],
            ':adress_user' => $user['adress_user'],
            ':num_user' => $user['num_user'],
            ':pwd_user' => $user['pwd_user'],
            ':role_user' => $user['role_user']
        ]); // Exécution avec les valeurs du nouvel utilisateur
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
    }
}

public function updateUser($id_user,$user){
    $conn = config::getConnexion();
    $sql="UPDATE user SET cin_user=:cin_user ,nom_user=:nom_user ,prenom_user=:prenom_user ,email_user=:email_user ,adress_user=:adress_user ,num_user=:num_user ,pwd_user=:pwd_user ,role_user=:role_user   WHERE id_user = :id_user";
    try{
        $query=$conn->prepare($sql);
        $query->execute([
            ':id_user'=>$id_user,
            ':cin_user'=>$user['cin_user'],
            ':nom_user'=>$user['nom_user'],
            ':prenom_user'=>$user['prenom_user'],
            ':email_user'=>$user['email_user'],
            ':adress_user'=>$user['adress_user'],
            ':num_user'=>$user['num_user'],
            ':pwd_user'=>$user['pwd_user'],
            ':role_user'=>$user['role_user']
        ]);
    }
    catch (Exception $e) {
        die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
    }
}
    // Supprimer un utilisateur
    public function deleteUser($id_user){
        $conn = config::getConnexion();
        $sql="DELETE FROM user WHERE id_user = :id_user";
        try{
            $query=$conn->prepare($sql);
            $query->execute([':id_user'=>$id_user]);
        }
        catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
   }


public function getUserById($id_user){
    $conn = config::getConnexion();
    $sql="select * from User where id_user=:id_user ";
    try{
       $query=$conn->prepare($sql);
         $query->execute( [':id_user'=>$id_user]);
        return $query->fetch();


        } 
catch (Exception $e) {
    die('Erreur: ' . $e->getMessage());
}
}

}

?>
