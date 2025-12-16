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

<body class= "bg-[#F6F4F3]">

    <?php require('includes/nav.php'); ?>

    <div class="px-12 py-8">
        <div class="flex">

            <?php
                $categoria = $_GET['categoria'] ?? null;

                if ($categoria) {
                    $sql  = "SELECT * FROM receitas WHERE categoria = '$categoria'";
                } else {
                    $sql  = "SELECT * FROM receitas";
                }

                $stmt = $dbh->prepare($sql);
                $stmt->execute();
            ?>

            <div class="hidden md:block lg:w-64 sticky top-4 bg-white p-5 rounded-xl shadow-md border border-gray-100">
                <h2 class="font-bold text-xl text-gray-800">Categoria</h2>
                
                <div class="border-b border-black my-2"></div>
            
                <div class="flex items-center m-2">
                    <input type="radio" name="categorias" value="Entradas" id="entradas" onclick="window.location.href='receitas.php?categoria=Entradas';" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                    <label for="entradas" class="mx-2 text-sm font-medium text-gray-700 cursor-pointer">Entradas</label>
                </div>

                <div class="flex items-center m-2">
                    <input type="radio" name="categorias" value="Massas" id="massas" onclick="window.location.href='receitas.php?categoria=Massas';" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                    <label for="massas" class="mx-2 text-sm font-medium text-gray-700 cursor-pointer">Massas</label>
                </div>

                <div class="flex items-center m-2">
                    <input type="radio" name="categorias" value="Carne" id="carne" onclick="window.location.href='receitas.php?categoria=Carne';" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                    <label for="carne" class="mx-2 text-sm font-medium text-gray-700 cursor-pointer">Carne</label>
                </div>

                <div class="flex items-center m-2">
                    <input type="radio" name="categorias" value="Peixe" id="peixe" onclick="window.location.href='receitas.php?categoria=Peixe';" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                    <label for="peixe" class="mx-2 text-sm font-medium text-gray-700 cursor-pointer">Peixe</label>
                </div>

                <div class="flex items-center m-2">
                    <input type="radio" name="categorias" value="Vegetariano" id="vegetariano" onclick="window.location.href='receitas.php?categoria=Vegetariano';" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                    <label for="vegetariano" class="mx-2 text-sm font-medium text-gray-700 cursor-pointer">Vegetariano</label>
                </div>

                <div class="flex items-center m-2"> 
                    <input type="radio" name="categorias" value="Sobremesas" id="sobremesas" onclick="window.location.href='receitas.php?categoria=Sobremesas';" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                    <label for="sobremesas" class="mx-2 text-sm font-medium text-gray-700 cursor-pointer">Sobremesas</label>
                </div>
            </div>

            <div class="flex-1 md:px-4">
                
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Receitas</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                    <?php 
                        while($receita = $stmt->fetchObject()){
                        $idReceita = $receita->id;
                        $nome      = $receita->nome;
                        $imagem    = $receita->imagem;
                        $tempo     = $receita->tempo;
                        $categoria = $receita->categoria;
                        $descricao = $receita->descricao;

                        $userId = $_SESSION['user_id'] ?? null;
$estaFavorito = false;

if ($userId) {
    $stmtFav = $dbh->prepare("SELECT 1 FROM favoritos WHERE id_utilizador = :uid AND id_receita = :rid");
    $stmtFav->bindValue(':uid', $userId);
    $stmtFav->bindValue(':rid', $idReceita);
    $stmtFav->execute();
    $estaFavorito = $stmtFav->fetchColumn() ? true : false;
}

                    ?>

                    <div class="bg-[#FFFFFF] rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100 group">

<div class="relative">
                    <img class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                         src="imagem/<?= $imagem ?>" alt="<?= $nome ?>">

                    <!-- Botão favoritos -->
                    <?php if ($userId): ?>
                    <a href="auth/adicionarFavoritos.php?id=<?= $idReceita ?>" 
                       class="absolute top-3 right-3 bg-white/90 p-2 rounded-full text-gray-400 hover:text-red-500 hover:bg-white transition-colors shadow-sm flex items-center justify-center">
                        <?php if ($estaFavorito): ?>
                            <!-- coração preenchido -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 24 24" stroke="none">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        <?php else: ?>
                            <!-- coração vazio -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        <?php endif; ?>
                    </a>
                    <?php endif; ?>

                    <span class="absolute top-3 left-3 bg-[#F6F4F3] text-black text-xs font-bold px-2 py-1 rounded-md"><?= $categoria ?></span>
                </div>


                        <div class="p-5">
                            <div class="flex items-center justify-between mb-2 ">
                                <span class="text-sm text-gray-500 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <?= $tempo ?>
                                </span>
                            </div>
                        
                            <h3 class="text-xl font-bold text-gray-900 mb-2"><?= $nome ?></h3>

                            <p class="text-gray-600 text-sm line-clamp-2 mb-4"><?= $descricao ?></p>   
                            
                            <button class="w-full sm:py-5 md:py-2 flex justify-center items-center"> 
                                <a href="receita.php?receita=<?= $idReceita ?>" class="w-full py-2 bg-[#F6F4F3] text-black font-semibold rounded-lg hover:bg-[#B09B80]"> Ver Detalhes </a>
                            </button>
                        </div>
                    </div>

                    <?php 
                    } 
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
    
    <?php require('includes/footer.php'); ?>    
</body>
</html>