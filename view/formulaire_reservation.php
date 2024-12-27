<?php
session_start();

// Inclure la connexion à la base de données
require_once '../model/db_connect.php'; // Assurez-vous que le chemin est correct

// Obtenir la connexion à la base de données
$pdo = Database::getInstance()->getConnection();

// Vérifier si l'id_activite a été soumis via POST
if (isset($_POST['id_activite'])) {
    $id_activite = $_POST['id_activite'];

    // Stocker l'id_activite dans la session pour l'utiliser plus tard
    $_SESSION['id_activite'] = $id_activite;

    // Récupérer les informations de l'activité depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM activite WHERE id_activite = :id_activite");
    $stmt->execute(['id_activite' => $id_activite]);
    $activity = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$activity) {
        die("L'activité n'a pas été trouvée.");
    }
} else {
    die("Aucune activité sélectionnée.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_client = $_SESSION['id_client']; // Assurez-vous que l'utilisateur est connecté
    $id_activite = $_POST['id_activite'];


    // Préparer et exécuter la requête d'insertion dans la base de données
    $stmt = $pdo->prepare("INSERT INTO reservation (id_client, id_activite, status) VALUES (:id_client, :id_activite, :status)");
    $stmt->execute([
        'id_client' => $id_client,
        'id_activite' => $id_activite,
        'status' => " "
    ]);

    echo "Votre réservation a été effectuée avec succès!";
} else {
    die("Accès non autorisé.");
}
?>


