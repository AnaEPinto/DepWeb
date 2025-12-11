<?php 
session_start();  
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Recipe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class= "bg-[#F6F4F3]">
    <?php require('includes/nav.php'); ?>

    <?php require('ajax/connection.php'); ?>
    
    <?php if (isset($_SESSION['ligado']) && $_SESSION['ligado'] == true): ?>
    <div class="relative group"> 
        <div class="px-12 py-8">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">As minhas receitas favoritas</h2>
            <?php
                $userId = $_SESSION['user_id'];
                $sql = "SELECT * FROM favoritos f
                        JOIN receitas r ON f.id_receita = r.id
                WHERE f.id_utilizador = :user_id";
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue(':user_id', $userId);
                $stmt->execute();
                $favoritos = $stmt->fetchAll(PDO::FETCH_OBJ);

                if (count($favoritos) > 0):
            ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($favoritos as $receita): ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                        <img src="<?= htmlspecialchars($receita->imagem); ?>" alt="<?= htmlspecialchars($receita->nome); ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2"><?= htmlspecialchars($receita->nome); ?></h3>
                            <p class="text-gray-600 text-sm mb-4"><?= htmlspecialchars($receita->descricao); ?></p>
                            <a href="receita.php?receita=<?= htmlspecialchars($receita->id); ?>" class="text-[#B09B80] hover:underline">Ver Receita</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
                <p class="text-center text-gray-600">Ainda não adicionou nenhuma receita aos favoritos.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php else: ?>
        <div class="w-full h-[560px] flex items-center justify-center py-20">
            <a href="login.php" class="text-gray-600 text-lg text-center">
                Necessita iniciar sessão para aceder aos favoritos!
            </a>
        </div>
    <?php endif; ?>

    <?php require('includes/footer.php'); ?>
</body>
</html>