<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
<header class="bg-blue-800 text-white py-4 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold">VoyageDream</h1>
      <nav>
        <ul class="flex space-x-6">
          <li><a href="index.php" class="hover:underline">Accueil</a></li>
          <li><a href="activities.php" class="text-white hover:underline">Retour aux Activités</a></li>
          <li><a href="user_dashboard.php" class="hover:underline">Mes Réservations</a></li>
          <li><a href="login.php" class="hover:underline">Déconnexion</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="container mx-auto my-8">
    <section class="text-center mb-12">
      <h2 class="text-4xl font-bold text-gray-800">Explorez Nos Offres</h2>
      <p class="text-gray-600 mt-4">Découvrez nos activités uniques et personnalisez votre expérience de voyage.</p>
    </section>

    <!-- Search Bar -->
    <div class="flex justify-center mb-8">
      <input 
        type="text" 
        placeholder="Recherchez une activité..." 
        class="w-2/3 lg:w-1/3 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
      <button 
        class="ml-4 bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Rechercher</button>
    </div>

    <!-- Activity Cards -->
    <?php
       require_once '../model/db_connect.php'; 
$db = Database::getInstance()->getConnection();

$sql = "SELECT * FROM activite";
$stmt = $db->prepare($sql);
$stmt->execute();
$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php
    foreach ($activities as $activity) {
        $vol = htmlspecialchars($activity['vols']);
        $hotel = htmlspecialchars($activity['hotels']);
        $circuit = htmlspecialchars($activity['circuits_touristiques']);
        $title = htmlspecialchars($activity['titre']);
        $price = number_format($activity['prix'], 2, ',', ' ');
        $start_date = htmlspecialchars($activity['date_debut']);
        $end_date = htmlspecialchars($activity['date_fin']);
        echo "
        <div class='bg-white rounded-lg shadow-lg overflow-hidden'>
            <img src='https://tcsvoyages.ch/wp-content/uploads/2020/06/download-pollina-resort-13-scaled.jpg' alt='Image de l'activité' class='w-full h-48 object-cover'>
            <div class='p-4'>
                <h3 class='text-xl font-semibold text-gray-800'>{$title}</h3>
                <p class='text-gray-600 mt-2'>Vol : {$vol}</p>
                <p class='text-gray-600'>Hôtel : {$hotel}</p>
                <p class='text-gray-600'>Circuit : {$circuit}</p>
                <p class='text-gray-600 mt-2'>Prix : {$price} €</p>
                <p class='text-gray-600'>Dates : du {$start_date} au {$end_date}</p>
                
                <!-- Formulaire de réservation -->
                <form action='formulaire_reservation.php' method='POST'>
                    <input type='hidden' name='id_activite' value='{$activity['id_activite']}'>
                    <button type='submit' class='mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 inline-block'>Réserver</button>
                </form>
            </div>
        </div>";
    
    }
    ?>
</div>

  </main>

  <footer class="bg-blue-800 text-white py-6 mt-12">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 VoyageDream. Tous droits réservés.</p>
    </div>
  </footer>
</body>
</html>
