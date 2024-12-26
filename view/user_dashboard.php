<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
    // Récupérer les informations utilisateur
    $nom = $_SESSION['user']['nom'] ?? 'Inconnu';
    $prenom = $_SESSION['user']['prenom'] ?? 'Inconnu';
    $email = $_SESSION['user']['email'] ?? 'Inconnu';
    $role = $_SESSION['user']['role'] ?? 'Utilisateur';

    // Message de bienvenue
    $messageBienvenue = "Bienvenue, $nom $prenom";
} else {
    header("Location: login.php");
    exit();
}

// Déconnexion
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de Bord | Voyage Authentique</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <!-- Header -->
  <header class="bg-blue-600 text-white py-4">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold">Voyage Authentique</h1>
      <nav>
        <a href="activities.php" class="text-white hover:underline">Retour aux Activités</a>
        <form action="" method="GET" class="inline">
          <button type="submit" name="logout" class="bg-bleu-500 text-white px-4 py-2 rounded hover:bg-bleu-600">
            Déconnexion
          </button>
        </form>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container mx-auto mt-8">
    <h2 class="text-3xl font-bold mb-6 text-center">Mon Tableau de Bord</h2>

    <!-- Message de bienvenue -->
    <p class="text-xl text-center text-gray-800 mb-6"><?php echo htmlspecialchars($messageBienvenue); ?></p>

    <!-- Reservations -->
    <section class="mb-8">
      <h3 class="text-2xl font-bold mb-4">Mes Réservations</h3>
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="border-b pb-4 mb-4">
          <h4 class="text-xl font-bold">Vols - Paris</h4>
          <h4 class="text-xl font-bold">Hôtels - Hôtel Le Palais</h4>
          <h4 class="text-xl font-bold">Circuits Touristiques - Paris</h4>
          <p class="text-gray-800 font-bold">Réservé le : 2024-12-20</p>
          <h4 class="text-xl font-bold">Statut de Réservation : Confirmé</h4>
        </div>
      </div>
    </section>

    <!-- Personal Information -->
    <section>
      <h3 class="text-2xl font-bold mb-4">Mes Informations Personnelles</h3>
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <p><span class="font-bold">Nom :</span> <?php echo htmlspecialchars($nom); ?></p>
        <p><span class="font-bold">Prénom :</span> <?php echo htmlspecialchars($prenom); ?></p>
        <p><span class="font-bold">Email :</span> <?php echo htmlspecialchars($email); ?></p>
        <p><span class="font-bold">Rôle :</span> <?php echo htmlspecialchars($role); ?></p>
      </div>
    </section>
  </main>
</body>
</html>
