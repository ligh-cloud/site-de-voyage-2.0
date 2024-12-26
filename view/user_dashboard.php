
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
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container mx-auto mt-8">
    <h2 class="text-3xl font-bold mb-6 text-center">Mon Tableau de Bord</h2>

    <!-- Reservations -->
    <section class="mb-8">
      <h3 class="text-2xl font-bold mb-4">Mes Réservations</h3>
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="border-b pb-4 mb-4">
          <h4 class="text-xl font-bold">Vols - Paris</h4>
          <h4 class="text-xl font-bold">hotels - hotel le palais </h4>
          <h4 class="text-xl font-bold">circuits_touristiques - Paris</h4>
          <p class="text-gray-800 font-bold">Réservé le : 2024-12-20</p>
          <h4 class="text-xl font-bold">status de reservation : confirmer </h4>
        </div>
        <!-- Add more reservation entries -->
      </div>
    </section>

    <!-- Personal Information -->
    <section>
      <h3 class="text-2xl font-bold mb-4">Mes Informations Personnelles</h3>
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <p><span class="font-bold">Nom :</span> Jean </p>
        <p><span class="font-bold">prenom :</span>  Dupont</p>
        <p><span class="font-bold">Email :</span> jean.dupont@example.com</p>
        
      </div>
    </section>
  </main>
</body>
</html>
