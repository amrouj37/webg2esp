<?php
// Inclure la bibliothèque FPDF
require_once('../config.php');  // Inclure le fichier de configuration pour la connexion à la base de données

require('../lib/fpdf.php'); // Chemin vers fpdf.php dans le dossier lib

class PDF extends FPDF
{
    // En-tête
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Liste des Utilisateurs', 0, 1, 'C');
        $this->Ln(10); // Saut de ligne
    }

    // Pied de page
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Créer un objet PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Récupérer les données des utilisateurs
try {
    $sql = "SELECT * FROM user ORDER BY id_user DESC"; // Remplacez avec votre requête SQL
    $stmt = config::getConnexion()->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Ajouter l'en-tête de la table
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(30, 10, 'CIN', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Prenom', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Nom', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Email', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Telephone', 1, 1, 'C', true);

// Ajouter les données des utilisateurs
foreach ($users as $user) {
    $pdf->Cell(30, 10, $user['cin_user'], 1);
    $pdf->Cell(30, 10, $user['prenom_user'], 1);
    $pdf->Cell(30, 10, $user['nom_user'], 1);
    $pdf->Cell(60, 10, $user['email_user'], 1);
    $pdf->Cell(40, 10, $user['num_user'], 1, 1);
}

// Sortie du fichier
$pdf->Output('D', 'Liste_Utilisateurs.pdf');
?>
