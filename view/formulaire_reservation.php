<?php
session_start();

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$nom = $_SESSION['user']['nom'] ?? 'Inconnu';
$prenom = $_SESSION['user']['prenom'] ?? 'Inconnu';
$email = $_SESSION['user']['email'] ?? 'Inconnu';
$role = $_SESSION['user']['role'] ?? 'Utilisateur';

$vol = $_SESSION['vols'] ?? 'Aucune réservation';
$hotel = $_SESSION['hotels'] ?? 'Aucune réservation';
$circuit = $_SESSION['circuits_touristiques'] ?? 'Aucune réservation';
$titre = $_SESSION['titre'] ?? 'Aucune réservation';
$prix = $_SESSION['prix'] ?? '0';
$date_debut = $_SESSION['date_debut'] ?? 'Non spécifiée';
$date_fin = $_SESSION['date_fin'] ?? 'Non spécifiée';

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
            echo "Nouvelle réservation créée avec succès";
        } else {
            echo "Erreur d'exécution de la requête : ";
            print_r($stmt->errorInfo());
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Erreur : Activité ou utilisateur non défini dans la session.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord | Voyage Authentique</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-blue-800 text-white py-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">VoyageDream</h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="index.php" class="hover:underline">Accueil</a></li>
                    <li><a href="activities.php" class="hover:underline">Retour aux Activités</a></li>
                    <li><a href="user_dashboard.php" class="hover:underline">Mes Réservations</a></li>
                    <li><a href="user_dashboard.php?logout=true" class="hover:underline">Déconnexion</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-8">
        <h2 class="text-3xl font-bold mb-6 text-center">Mon Tableau de Bord</h2>
        <p class="text-xl text-center text-gray-800 mb-6"><?php echo htmlspecialchars("Bienvenue, $nom $prenom"); ?></p>

        <!-- Réservations -->
        <section class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
            <h2 class="text-2xl font-bold text-blue-700 mb-6">Détails de votre réservation</h2>
            <div>
                <p><strong>Vol :</strong> <?php echo htmlspecialchars($vol); ?></p>
                <p><strong>Hôtel :</strong> <?php echo htmlspecialchars($hotel); ?></p>
                <p><strong>Circuit Touristique :</strong> <?php echo htmlspecialchars($circuit); ?></p>
                <p><strong>Activité :</strong> <?php echo htmlspecialchars($titre); ?></p>
                <p><strong>Prix :</strong> <?php echo htmlspecialchars($prix); ?> €</p>
                <p><strong>Date de Début :</strong> <?php echo htmlspecialchars($date_debut); ?></p>
                <p><strong>Date de Fin :</strong> <?php echo htmlspecialchars($date_fin); ?></p>
            </div>
        </section>
        
        <!-- Personal Information -->
        <section class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
            <h1 class="text-2xl font-bold text-blue-700 mb-6 text-center">Mes Informations Personnelles</h1>
            <div>
                <p><strong>Nom :</strong> <?php echo htmlspecialchars($nom); ?></p>
                <p><strong>Prénom :</strong> <?php echo htmlspecialchars($prenom); ?></p>
                <p><strong>Email :</strong> <?php echo htmlspecialchars($email); ?></p>
                <p><strong>Rôle :</strong> <?php echo htmlspecialchars($role); ?></p>
            </div>
        </section>
    </main>
</body>
</html>