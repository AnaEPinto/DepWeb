<?php
session_start();
require('ajax/connection.php');
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Recipe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F6F4F3] min-h-screen flex flex-col">

    <?php require('includes/nav.php'); ?>

    <div class="flex-grow">
        <?php if (!empty($_SESSION['ligado'])): ?>

        <div class="px-12 py-8">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">
                As minhas receitas favoritas
            </h2>

            <?php
                $userId = $_SESSION['user_id'];
                $sql = "SELECT * FROM favoritos f
                        JOIN receitas r ON f.id_receita = r.id
                        WHERE f.id_utilizador = :user_id";
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue(':user_id', $userId);
                $stmt->execute();
                $favoritos = $stmt->fetchAll(PDO::FETCH_OBJ);

            ?>

            <?php if (count($favoritos) > 0): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    <?php foreach ($favoritos as $receita): ?>
                        <div class="bg-[#FFFFFF] rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100 group"">

                            <div class="relative">
                                <img class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                    src="imagem/<?= ($receita->imagem) ?>"
                                    alt="<?= ($receita->nome) ?>">

                                <span class="absolute top-3 left-3 bg-[#F6F4F3] text-xs font-bold px-2 py-1 rounded">
                                    <?= ($receita->categoria) ?>
                                </span>
                            </div>

                            <div class="p-5">
                                <span class="text-sm text-gray-500 block mb-2">
                                    <?= ($receita->tempo) ?>
                                </span>

                                <h3 class="text-xl font-bold mb-2">
                                    <?= ($receita->nome) ?>
                                </h3>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    <?= ($receita->descricao) ?>
                                </p>

                                <a href="receita.php?receita=<?= (int)$receita->id ?>"
                                class="block text-center py-2 bg-[#F6F4F3] font-semibold rounded-lg hover:bg-[#B09B80]">
                                    Ver Detalhes
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-gray-500 mt-10">
                    Ainda não tens receitas favoritas.
                </p>
            <?php endif; ?>
        </div>

        <?php else: ?>
            <p class="text-center mt-20 text-gray-600">
                Tens de iniciar sessão para ver as tuas receitas favoritas.
            </p>
        <?php endif; ?>

    </div>

    <?php require('includes/footer.php'); ?>
</body>
</html>
