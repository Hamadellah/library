<?php


session_start(); // Darouri bach t-3ref l-ID dyal l-member li dakhél
require_once __DIR__ . '/src/config/database.php';
require_once __DIR__ . '/src/Entities/user.php';
require_once __DIR__ . '/src/Entities/membre.php';

$db = new Database();
$conn = $db->getConnection();

$member_id = $_SESSION['user_id'] ?? 5; 


$currentMember = new Member("Nom", "Email", $member_id);

if (isset($_GET['action']) && $_GET['action'] == 'borrow' && isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    
    if ($currentMember->borrowBook($conn, $book_id)) {

        header("Location: dashboard-member.php?status=success");
        exit();
    } else {

        header("Location: dashboard-member.php?status=error");
        exit();
    }
}


$stmt = $conn->query("SELECT * FROM books WHERE status = 'Disponible'");
$availableBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<body class="bg-slate-50 font-sans">

    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:block">
            <div class="p-6">
                <h1 class="text-2xl font-bold italic text-sky-400">BIBLIO-TECH</h1>
                <p class="text-xs text-slate-400">Espace Étudiant/Prof</p>
            </div>
            <nav class="mt-6">
                <a href="#" class="flex items-center py-3 px-6 bg-slate-800 text-white border-l-4 border-sky-500">
                    <i class="fas fa-th-large mr-3"></i> Mon Dashboard
                </a>
                <div class="absolute bottom-0 w-64 p-6">
                    <a href="logout.php" class="flex items-center text-red-400 hover:text-red-300 transition">
                        <i class="fas fa-sign-out-alt mr-3"></i> Déconnexion
                    </a>
                </div>
            </nav>
        </aside>

        <main class="flex-1 overflow-y-auto p-8">
            <header class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800">Bienvenue, Othmane !</h2>
                    <p class="text-slate-500 italic">"La lecture est une amitié." — Marcel Proust</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800">Membre Actif</p>
                        <p class="text-xs text-emerald-500">ID: #12345</p>
                    </div>
                    <div class="h-12 w-12 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 border-2 border-sky-200">
                        <i class="fas fa-user-graduate text-xl"></i>
                    </div>
                </div>
            </header>
            <h3 class="text-xl font-bold text-slate-800 mb-6">Catalogue Disponible</h3>

<div class=" grid grid-cols-1 md:grid-cols-2 gap-4">
    <?php foreach ($availableBooks as $book): ?>
    <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
        <div class="flex items-start">
            <div class="flex-1">
                <h4 class="font-bold text-slate-800"><?php echo htmlspecialchars($book['title']); ?></h4>
                <p class="text-sm text-slate-500"><?php echo htmlspecialchars($book['author']); ?></p>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-xs font-bold px-2 py-1 bg-emerald-50 text-emerald-600 rounded">Disponible</span>
                    
                    <a href="dashboard-member.php?action=borrow&book_id=<?php echo $book['id']; ?>" 
                       onclick="return confirm('Bghiti t-borrowi had l-ktab?')"
                       class="text-xs font-bold bg-sky-600 text-white px-3 py-2 rounded-lg hover:bg-sky-700 transition">
                        Emprunter
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>


                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 h-fit">
                    <h3 class="text-xl font-bold text-slate-800 mb-6">Mes Emprunts (US8)</h3>
                    <div class="space-y-4">
                        <div class="flex items-center p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="w-10 h-10 rounded bg-sky-100 flex items-center justify-center text-sky-600 mr-3">
                                <i class="fas fa-bookmark"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-slate-800">L'Art du PHP</p>
                                <p class="text-xs text-slate-400">Retour le: 15/05/2026</p>
                            </div>
                            <button title="Retourner le livre (US7)" class="text-slate-400 hover:text-emerald-500 transition">
                                <i class="fas fa-undo-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>