<?php
require_once __DIR__ . '/src/config/database.php';
require_once __DIR__ . '/src/Entities/user.php';
require_once __DIR__ . '/src/Entities/librarian.php';
require_once __DIR__ . '/src/Entities/book.php';
$dB = new Database();
$conn = $dB->getConnection();
$admin = new Librarian("Othmane Admin", "admin@bibliotech.ma");
$vewbooks=$admin->viewAllBooks($conn);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // On récupère les données proprement
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $status = $_POST['status'] ?? "Disponible";

    // ✅ ON PASSE LES ARGUMENTS AU CONSTRUCTEUR ICI
    $newBook = new Book($title, $author, $isbn, $status);

$admin = new Librarian("Othmane Admin", "admin@bibliotech.ma");
    
    try {
        $admin->addBook($conn, $newBook);
        header("Location: dashboard-admin.php?success=1");
        exit(); 
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $db = new Database();
    $conn = $db->getConnection();
    
    // Khass t-creer l'admin bach t-khdem b les fonctions dyalo
    $admin = new Librarian("Admin", "admin@email.com");
    
    try {
        $admin->removeBook($conn, $id);
        // Mli t-msse7, rje3 l l-dashboard
        header("Location: dashboard-admin.php?deleted=1");
        exit();
    } catch (Exception $e) {
        echo "Erreur de suppression: " . $e->getMessage();
    }
}

?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bibliothécaire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-indigo-900 text-white flex-shrink-0 hidden md:block">
            <div class="p-6">
                <h1 class="text-2xl font-bold italic">BIBLIO-TECH</h1>
            </div>
            <nav class="mt-6">
                <a href="#" class="flex items-center py-3 px-6 bg-indigo-800 text-white">
                    <i class="fas fa-chart-line mr-3"></i> Dashboard
                </a>
                <a href="#" class="flex items-center py-3 px-6 text-indigo-300 hover:bg-indigo-800 hover:text-white transition">
                    <i class="fas fa-book mr-3"></i> Catalogue (US1, US3)
                </a>
                <a href="#" class="flex items-center py-3 px-6 text-indigo-300 hover:bg-indigo-800 hover:text-white transition">
                    <i class="fas fa-users mr-3"></i> Membres (US2)
                </a>
                <a href="#" class="flex items-center py-3 px-6 text-indigo-300 hover:bg-indigo-800 hover:text-white transition mt-10">
                    <i class="fas fa-sign-out-alt mr-3"></i> Déconnexion
                </a>
            </nav>
        </aside>

        <main class="flex-1 overflow-y-auto p-8">
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-semibold text-gray-800">Gestion du Système</h2>
                    <p class="text-gray-500">Bienvenue, Admin !</p>
                </div>
                <div class="flex space-x-4">
<a href="formuleraddliver.php">
    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition">
        <i class="fas fa-plus mr-2"></i> Nouveau Livre
    </button>
</a>
                    <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition">
                        <i class="fas fa-user-plus mr-2"></i> Nouveau Membre
                    </button>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-indigo-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Total Livres</p>
                    <p class="text-2xl font-semibold">1,240</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-amber-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">En Emprunt (US6)</p>
                    <p class="text-2xl font-semibold">45</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-emerald-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Membres Actifs</p>
                    <p class="text-2xl font-semibold">312</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Inventaire Récent (US3)</h3>
                </div>
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="py-4 px-6 font-semibold">Titre / ISBN</th>
                            <th class="py-4 px-6 font-semibold">Auteur</th>
                            <th class="py-4 px-6 font-semibold">État</th>
                            <th class="py-4 px-6 font-semibold">Actions</th>
                        </tr>
                    </thead>
<tbody class="divide-y divide-gray-100 text-gray-700">
    <?php foreach ($vewbooks as $book): ?>
    <tr>
        <td class="py-4 px-6">
            <span class="block font-medium"><?php echo htmlspecialchars($book['title']); ?></span>
            <span class="text-xs text-gray-400"><?php echo htmlspecialchars($book['isbn']); ?></span>
        </td>
        <td class="py-4 px-6">
            <?php echo htmlspecialchars($book['author']); ?>
        </td>
        <td class="py-4 px-6">
            <?php 
                $statusClass = $book['status'] == 'Disponible' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700';
            ?>
            <span class="px-3 py-1 text-xs font-bold rounded-full <?php echo $statusClass; ?>">
                <?php echo htmlspecialchars($book['status']); ?>
            </span>
        </td>
        <td class="py-4 px-6">
            <button class="text-amber-500 hover:text-amber-700 mr-3">
                <i class="fas fa-tools"></i>
            </button>
<td class="py-4 px-6">
    <button class="text-amber-500 hover:text-amber-700 mr-3">
        <i class="fas fa-tools"></i>
    </button>
    
    <a href="remove-book.php?id=<?php echo $book['id']; ?>" 
       onclick="return confirm('Wash tiyeq bli bghiti t-msse7 had l-ktab?')"
       class="text-red-500 hover:text-red-700">
        <i class="fas fa-trash"></i>
    </a>
</td>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
                </table>
            </div>
        </main>
    </div>

</body>
</html>