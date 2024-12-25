<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelRes - Tableau de Bord</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="index.html" class="text-xl font-bold text-blue-600">TravelRes</a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="index.html" class="text-gray-700 hover:text-blue-600">Accueil</a>
                    <a href="catalog.html" class="text-gray-700 hover:text-blue-600">Catalogue</a>
                    <button onclick="logout()" class="px-4 py-2 text-red-600 hover:text-red-700">Déconnexion</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Mon Tableau de Bord</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Mes Réservations</h2>
                <div id="reservationsList" class="space-y-4">
                    <!-- reservations will be loaded here -->
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Mon Profil</h2>
                <form id="profileForm" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Email</label>
                        <input type="email" id="userEmail" class="w-full border rounded p-2" readonly>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700">
                        Mettre à jour
                    </button>
                </form>
            </div>
        </div>
    </div>

   
</body>
</html>