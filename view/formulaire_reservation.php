<?php
session_start();

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['id_activite']) && isset($_SESSION['user']['id'])) {
    $id_client = $_SESSION['user']['id'];
    $id_activite = $_SESSION['id_activite'];

    require_once '../model/db_connect.php';

    $db = Database::getInstance();
    $conn = $db->getConnection();

    try {
        $sql = "INSERT INTO reservation (id_client, id_activite) VALUES (:id_client, :id_activite)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
        $stmt->bindParam(':id_activite', $id_activite, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Fetch activity details to set in session
            $activity_sql = "SELECT * FROM activite WHERE id_activite = :id_activite";
            $activity_stmt = $conn->prepare($activity_sql);
            $activity_stmt->bindParam(':id_activite', $id_activite, PDO::PARAM_INT);
            $activity_stmt->execute();
            $activity = $activity_stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['vols'] = $activity['vols'];
            $_SESSION['hotels'] = $activity['hotels'];
            $_SESSION['circuits_touristiques'] = $activity['circuits_touristiques'];
            $_SESSION['titre'] = $activity['titre'];
            $_SESSION['prix'] = $activity['prix'];
            $_SESSION['date_debut'] = $activity['date_debut'];
            $_SESSION['date_fin'] = $activity['date_fin'];

            $_SESSION['success_message'] = "Nouvelle réservation créée avec succès";
        } else {
            $_SESSION['error_message'] = "Erreur d'exécution de la requête : " . implode(", ", $stmt->errorInfo());
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erreur : " . $e->getMessage();
    }

    header("Location: user_dashboard.php");
    exit();
} else {
    $_SESSION['error_message'] = "Erreur : Activité ou utilisateur non défini dans la session.";
    header("Location: activities.php");
    exit();
}
?>