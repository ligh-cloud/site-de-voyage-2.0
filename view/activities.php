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
          <li><a href="#" class="hover:underline">Accueil</a></li>
          <li><a href="#" class="hover:underline">Mes Réservations</a></li>
          <li><a href="#" class="hover:underline">Déconnexion</a></li>
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Card Example -->
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <img src="https://tcsvoyages.ch/wp-content/uploads/2020/06/download-pollina-resort-13-scaled.jpg" alt="Activity Image" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="text-xl font-semibold text-gray-800">Séjour Balnéaire</h3>
          <p class="text-gray-600 mt-2">Découvrez les plages paradisiaques et profitez d'un séjour inoubliable.</p>
          <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">réserver</button>
        </div>
      </div>
      
      <!-- More cards here -->
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <img src="https://th.bing.com/th/id/R.b4f4c9dbff2b5f0dfea7c8ccbc16cb9c?rik=4TLsy6uwiQ57hQ&riu=http%3a%2f%2fwww.hotellesskieurs.com%2fphotos%2fcontenu%2f1572%2fbig%2ffotolia_56569523_s.jpg&ehk=Ah8ZPfYa5wxZox7ZvNMxOuN2SIGxy7n6wHTIOnKC7B8%3d&risl=&pid=ImgRaw&r=0" alt="Activity Image" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="text-xl font-semibold text-gray-800">Circuit Montagnard</h3>
          <p class="text-gray-600 mt-2">Explorez les sommets et laissez-vous émerveiller par la nature.</p>
          <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">réserver</button>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <img src="https://th.bing.com/th/id/OIP.ap89izELUT8u3fmEHn4NTwHaHa?rs=1&pid=ImgDetMain" alt="Activity Image" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="text-xl font-semibold text-gray-800">Escapade Urbaine</h3>
          <p class="text-gray-600 mt-2">Découvrez le charme des grandes villes et leurs trésors cachés.</p>
          <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">réserver</button>
        </div>
      </div>
    </div>
  </main>

  <footer class="bg-blue-800 text-white py-6 mt-12">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 VoyageDream. Tous droits réservés.</p>
    </div>
  </footer>
</body>
</html>
