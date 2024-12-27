<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_activite'])) {
    $_SESSION['id_activite'] = $_POST['id_activite'];
    header("Location: formulaire_reservation.php");
    exit();
} else {
    echo "Erreur : ID d'activité non défini.";
}
?>