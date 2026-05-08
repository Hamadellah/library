<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100 mt-10">
    <div class="flex items-center mb-6">
        <div class="bg-emerald-100 p-3 rounded-full mr-4">
            <i class="fas fa-user-plus text-emerald-600 text-xl"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Inscrire un nouveau membre</h2>
            <p class="text-sm text-gray-500">Ajoutez un étudiant ou un professeur au système</p>
        </div>
    </div>

    <form action="dashboard-admin.php" method="POST" class="space-y-6">
        <input type="hidden" name="action" value="register_member">
        
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-2">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nom complet</label>
                <input type="text" id="name" name="name" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                    placeholder="Ex: Ahmed El Idrissi">
            </div>

            <div class="col-span-2">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Adresse Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                    placeholder="exemple@univ.ma">
            </div>

            <div class="col-span-2">
                <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Type de membre</label>
                <div class="flex space-x-4">
                    <label class="flex-1">
                        <input type="radio" name="role" value="Etudiant" class="hidden peer" checked>
                        <div class="p-4 text-center border rounded-lg cursor-pointer transition peer-checked:bg-emerald-50 peer-checked:border-emerald-500 peer-checked:text-emerald-700 hover:bg-gray-50">
                            <i class="fas fa-user-graduate mb-2 block text-xl"></i>
                            Étudiant
                        </div>
                    </label>
                    <label class="flex-1">
                        <input type="radio" name="role" value="Professeur" class="hidden peer">
                        <div class="p-4 text-center border rounded-lg cursor-pointer transition peer-checked:bg-emerald-50 peer-checked:border-emerald-500 peer-checked:text-emerald-700 hover:bg-gray-50">
                            <i class="fas fa-chalkboard-teacher mb-2 block text-xl"></i>
                            Professeur
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4 pt-4 border-top">
            <button  type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-lg font-bold shadow-md transition duration-200 w-full">
                Enregistrer le membre
            </button>
        </div>
    </form>
</div>