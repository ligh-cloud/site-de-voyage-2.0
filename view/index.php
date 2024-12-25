<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelRes - Accueil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="index.php" class="text-xl font-bold text-blue-600">TravelRes</a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="index.php" class="text-gray-700 hover:text-blue-600">Accueil</a>
                    <a href="catalog.php" class="text-gray-700 hover:text-blue-600">Catalogue</a>
                    <div id="authButtons">
                        <a href="login.php" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Connexion</a>
                        <a href="signup.php" class="px-4 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-50">Inscription</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <header class="relative bg-cover bg-center h-screen" style="background-image: url('https://images.pexels.com/photos/1659438/pexels-photo-1659438.jpeg?auto=compress&cs=tinysrgb&w=1600');">
        <div class="absolute inset-0 bg-blue-900 bg-opacity-50"></div>
        <div class="relative z-10 flex flex-col items-center justify-center text-center text-white h-full">
            <h1 class="text-5xl font-bold mb-6">Bienvenue sur TravelRes</h1>
            <p class="text-2xl mb-8">Découvrez les meilleures destinations pour vos prochaines vacances</p>
            <a href="catalog.php" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Explorer les voyages
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white shadow-lg rounded-lg">
                <img src="https://images.pexels.com/photos/1174732/pexels-photo-1174732.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="Destination 1" class="w-full h-64 object-cover rounded-t-lg">
                <div class="p-6">
                    <h2 class="text-lg font-bold mb-2">Plage de rêve</h2>
                    <p class="text-gray-600 mb-4">Détendez-vous sur des plages de sable fin et découvrez un cadre paradisiaque.</p>
                    <a href="catalog.php" class="text-blue-600 hover:underline">En savoir plus</a>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg">
                <img src="https://images.pexels.com/photos/417074/pexels-photo-417074.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="Destination 2" class="w-full h-64 object-cover rounded-t-lg">
                <div class="p-6">
                    <h2 class="text-lg font-bold mb-2">Montagnes majestueuses</h2>
                    <p class="text-gray-600 mb-4">Explorez des paysages à couper le souffle avec des randonnées inoubliables.</p>
                    <a href="catalog.php" class="text-blue-600 hover:underline">En savoir plus</a>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg">
                <img src="https://images.pexels.com/photos/466685/pexels-photo-466685.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="Destination 3" class="w-full h-64 object-cover rounded-t-lg">
                <div class="p-6">
                    <h2 class="text-lg font-bold mb-2">Villes animées</h2>
                    <p class="text-gray-600 mb-4">Découvrez la vie urbaine et explorez les sites culturels fascinants.</p>
                    <a href="catalog.php" class="text-blue-600 hover:underline">En savoir plus</a>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg">
                <img src="https://images.pexels.com/photos/1001435/pexels-photo-1001435.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="Destination 4" class="w-full h-64 object-cover rounded-t-lg">
                <div class="p-6">
                    <h2 class="text-lg font-bold mb-2">Désert mystique</h2>
                    <p class="text-gray-600 mb-4">Vivez une aventure unique au cœur des dunes dorées et des oasis secrètes.</p>
                    <a href="catalog.php" class="text-blue-600 hover:underline">En savoir plus</a>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg">
                <img src="https://images.pexels.com/photos/572937/pexels-photo-572937.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="Destination 5" class="w-full h-64 object-cover rounded-t-lg">
                <div class="p-6">
                    <h2 class="text-lg font-bold mb-2">Forêt enchantée</h2>
                    <p class="text-gray-600 mb-4">Plongez dans la nature sauvage et explorez des forêts verdoyantes.</p>
                    <a href="catalog.php" class="text-blue-600 hover:underline">En savoir plus</a>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg">
                <img src="https://images.pexels.com/photos/147411/italy-mountains-dawn-daybreak-147411.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="Destination 6" class="w-full h-64 object-cover rounded-t-lg">
                <div class="p-6">
                    <h2 class="text-lg font-bold mb-2">Lac tranquille</h2>
                    <p class="text-gray-600 mb-4">Profitez de la sérénité et des paysages époustouflants autour de l'eau.</p>
                    <a href="catalog.php" class="text-blue-600 hover:underline">En savoir plus</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p class="text-lg mb-4">© 2024 TravelRes. Tous droits réservés.</p>
            <div class="flex justify-center space-x-6">
                <a href="#" class="text-gray-400 hover:text-white">Politique de confidentialité</a>
                <a href="#" class="text-gray-400 hover:text-white">Conditions d'utilisation</a>
                <a href="#" class="text-gray-400 hover:text-white">Contact</a>
            </div>
        </div>
    </footer>
</body>
</html>