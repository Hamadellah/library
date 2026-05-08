<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100 mt-10">
    <div class="flex items-center mb-6">
        <div class="bg-indigo-100 p-3 rounded-full mr-4">
            <i class="fas fa-book-medical text-indigo-600 text-xl"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Ajouter un nouveau livre</h2>
            <p class="text-sm text-gray-500">Enrichissez l'inventaire de la bibliothèque</p>
        </div>
    </div>

    <form action="dashboard-admin.php" method="POST" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-2">
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Titre de l'ouvrage</label>
                <input type="text" id="title" name="title" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                    placeholder="Ex: Le Petit Prince">
            </div>

            <div>
                <label for="author" class="block text-sm font-semibold text-gray-700 mb-2">Auteur</label>
                <input type="text" id="author" name="author" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                    placeholder="Nom de l'auteur">
            </div>

            <div>
                <label for="isbn" class="block text-sm font-semibold text-gray-700 mb-2">Code ISBN</label>
                <input type="text" id="isbn" name="isbn" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                    placeholder="978-3-16-148410-0">
            </div>

            <div class="col-span-2">
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">État initial</label>
                <select id="status" name="status" 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition bg-white text-gray-700">
                    <option value="disponible">Disponible ✅</option>
                    <option value="reparation">En réparation 🔧</option>
                    <option value="perdu">Perdu ❌</option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4 pt-4">
            <button type="reset" class="px-6 py-2 text-gray-600 hover:text-gray-800 font-medium transition">
                Réinitialiser
            </button>
            <button type="submit" name="addliver" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-bold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                Enregistrer le livre
            </button>
        </div>
    </form>
</div>