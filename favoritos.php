<?php
session_start();
require('ajax/connection.php');

$userId = $_SESSION['user_id'];
if (!$userId) {
    header("Location: index.php");
    exit;
}

$sql = "SELECT r.* FROM favoritos f
        JOIN receitas r ON f.id_receita = r.id
        WHERE f.id_utilizador = :user_id
        ORDER BY r.id DESC";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $userId);
$stmt->execute();
$favoritos = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos - The Recipe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F6F4F3] min-h-screen flex flex-col">

    <?php require('includes/nav.php'); ?>

    <div class="flex-grow px-12 py-8">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">As minhas receitas favoritas</h2>

        <?php if (count($favoritos) > 0): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <?php foreach ($favoritos as $receita): ?>
                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100 group">

                <div class="relative">
                    <img class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                        src="imagem/<?= $receita->imagem ?>" alt="<?= $receita->nome ?>">

                    <span class="absolute top-3 left-3 bg-[#F6F4F3] text-black text-xs font-bold px-2 py-1 rounded-md"><?= $receita->categoria ?></span>
                </div>

                <div class="p-5">
                    <span class="text-sm text-gray-500 block mb-2"><?= $receita->tempo ?></span>
                    <h3 class="text-xl font-bold mb-2"><?= $receita->nome ?></h3>
                    <p class="text-gray-600 text-sm line-clamp-2 mb-4"><?= $receita->descricao ?></p>

                    <a href="receita.php?receita=<?= $receita->id ?>" 
                    class="block text-center py-2 bg-[#F6F4F3] font-semibold rounded-lg hover:bg-[#B09B80]">
                        Ver Detalhes
                    </a>
                </div>
            </div>

            <?php endforeach; ?>
        </div>

        <?php else: ?>

        <p class="text-center text-gray-500 mt-10">Ainda não tens receitas favoritas.</p>

        <?php endif; ?>
    </div>

    <?php require('includes/footer.php'); ?>

    <script>
        document.querySelectorAll('.favorito-btn').forEach(btn => {
            btn.addEventListener('click', async () => {
                const receitaId = btn.dataset.id;

                try {
                    const response = await fetch('adicionarFavoritos.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: 'id=' + encodeURIComponent(receitaId)
                    });

                    const data = await response.json();

                    if (data.favorito) {
                        btn.classList.remove('text-gray-400');
                        btn.classList.add('text-red-500');
                    } else {
                        btn.classList.remove('text-red-500');
                        btn.classList.add('text-gray-400');
                    }
                } catch (error) {
                    console.error('Erro ao atualizar favorito:', error);
                    alert('Ocorreu um erro. Tente novamente.');
                }
            });
        });
    </script>
</body>
</html>


