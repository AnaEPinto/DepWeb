<?php
require('../ajax/connection.php');
?>

<!DOCTYPE html>
<html lang="pt">
<head>
     <meta charset="UTF-8">
    <title>Painel de Administração</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <?php require('includes/nav.php'); 

        $totalReceitas = $dbh->query("SELECT COUNT(*) FROM receitas")->fetchColumn();
        $totalCategorias = $dbh->query("SELECT COUNT(DISTINCT categoria) FROM receitas")->fetchColumn();

        $stmt = $dbh->prepare("SELECT id, nome FROM receitas ORDER BY id DESC LIMIT 5");
        $stmt->execute();
        $ultimasReceitas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <div class="flex-1">

            <header class="bg-white border-b p-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-700">Dashboard</h1>
                <span class="text-gray-500">Bem-vindo, Admin</span>
            </header>

            <div class="p-6">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Visão Geral</h2>
                    <a href="receitaNova.php"
                    class="bg-[#D1C8C1] px-4 py-2 rounded font-semibold shadow">
                        + Nova Receita
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-5 rounded shadow">
                        <p class="text-sm text-gray-500">Receitas totais</p>
                        <p class="text-3xl font-bold"><?= (int)$totalReceitas ?></p>
                    </div>

                    <div class="bg-white p-5 rounded shadow">
                        <p class="text-sm text-gray-500">Categorias</p>
                        <p class="text-3xl font-bold"><?= (int)$totalCategorias ?></p>
                    </div>

                    <div class="bg-white p-5 rounded shadow">
                        <p class="text-sm text-gray-500">Receitas esta semana</p>
                        <p class="text-3xl font-bold"><?= (int)$totalReceitas ?></p>
                    </div>
                </div>

                <div class="bg-white p-5 rounded shadow">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-xl font-semibold">Últimas receitas</h3>
                        <a href="receitas.php" class="text-sm text-gray-500 hover:underline">
                            Ver todas
                        </a>
                    </div>

                    <?php if ($ultimasReceitas): ?>
                        <ul class="divide-y">
                            <?php foreach ($ultimasReceitas as $r): ?>
                                <li class="py-2 text-gray-700 font-medium">
                                    <?= htmlspecialchars($r['nome']) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-gray-500">Sem receitas registadas.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</body>
</html>


