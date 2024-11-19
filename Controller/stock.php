<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'C:\xampp\htdocs\projet_adam_final\config.php'; 
include 'C:\xampp\htdocs\projet_adam_final\Model\stockModel.php';
class stockC{
public function ajouter($stock){
	$pdo=conn::getConnexion();
	try {
		$query=$pdo->prepare(
			"INSERT INTO stock (nom_produit,quantite,unite,date_expir,prix_uni,id_four,dispo)
			VALUES (:nom_produit,:quantite,:unite,:date_expir,:prix_uni,:id_four,:dispo);"
		);
		$query->execute([
            'nom_produit'=>$stock->getnom_produit(),
			'quantite'=>$stock->getquantite(),
			'unite'=>$stock->getunite(),
			'date_expir'=>$stock->getdate_expir(),
			'prix_uni'=>$stock->getprix_uni(),
			'id_four'=>$stock->getid_four(),
			'dispo'=>$stock->getdispo(),
			
		]);
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}
public function modifier($stocke,$nom_produit){
	$pdo=conn::getConnexion();
	try {
		$sql="UPDATE stock SET quantite=:quantite,unite=:unite,date_expir=:date_expir,prix_uni=:prix_uni,id_four=:id_four,dispo=:dispo WHERE nom_produit=:nom_produit";
		$req=$pdo->prepare($sql);
		
		
        $req->bindValue(':quantite', $stocke->quantite); 
        $req->bindValue(':unite', $stocke->unite);
        $req->bindValue(':date_expir', $stocke->date_expir);
        $req->bindValue(':prix_uni', $stocke->prix_uni);
        $req->bindValue(':id_four', $stocke->id_four);
        $req->bindValue(':dispo', $stocke->dispo);
		$req->bindValue(':nom_produit', $nom_produit);
		$req->execute();
		
		
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}
public function supprimer($nom_produit)
{
    $sql ="DELETE FROM stock WHERE nom_produit= :nom_produit";
    $db =conn::getConnexion();
    $query=$db->prepare($sql);
    $query->bindvalue(':nom_produit',$nom_produit);
    try {
$query->execute();

    }catch(PDOException $e){
        $e->getMessage();
    }


}

}

?>