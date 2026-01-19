<?php 
session_start();  
require('ajax/connection.php');

$busca = $_GET['busca'] ?? '';
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

    <div class="flex-grow px-12 py-8">
        <div class="flex"> 
            <div class="hidden md:block lg:w-64 sticky top-4 bg-white p-5 rounded-xl shadow-md border border-gray-100">

                <h2 class="font-bold text-xl text-gray-800">Categoria</h2>
                
                <div class="border-b border-black my-2"></div>
            
                <div class="flex items-center m-2">
                    <input type="radio" id="entradas" name="categorias" value="Entradas" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                    <label for="entradas" class="mx-2 text-sm font-medium text-gray-700 cursor-pointer">Entradas</label>
                </div>

                <div class="flex items-center m-2">
                    <input type="radio" id="massas" name="categorias" value="Massas" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                    <label for="massas" class="mx-2 text-sm font-medium text-gray-700 cursor-pointer">Massas</label>
                </div>

                <div class="flex items-center m-2">
                    <input type="radio" id="carne" name="categorias" value="Carne" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                    <label for="carne" class="mx-2 text-sm font-medium text-gray-700 cursor-pointer">Carne</label>
                </div>

                <div class="flex items-center m-2">
                    <input type="radio" id="peixe" name="categorias" value="Peixe" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                    <label for="peixe" class="mx-2 text-sm font-medium text-gray-700 cursor-pointer">Peixe</label>
                </div>

                <div class="flex items-center m-2">
                    <input type="radio" id="vegetariano" name="categorias" value="Vegetariano" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                    <label for="vegetariano" class="mx-2 text-sm font-medium text-gray-700 cursor-pointer">Vegetariano</label>
                </div>

                <div class="flex items-center m-2">
                    <input type="radio" id="sobremesas" name="categorias" value="Sobremesas" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                    <label for="sobremesas" class="mx-2 text-sm font-medium text-gray-700 cursor-pointer">Sobremesas</label>
                </div>
            </div>

            <?php
                if ($busca != '') {
                    $sql = "SELECT * FROM receitas WHERE nome LIKE :busca";
                    $stmt = $dbh->prepare($sql);
                    $stmt->bindValue(':busca', "%$busca%");
                } else {
                    $sql = "SELECT * FROM receitas";
                    $stmt = $dbh->prepare($sql);
                }
                $stmt->execute();
            ?>

            <div class="flex-1 md:px-4">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Receitas</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                    <?php while($receita = $stmt->fetchObject()):
                        $idReceita = $receita->id;
                        $nome = $receita->nome;
                        $imagem = $receita->imagem;
                        $tempo = $receita->tempo;
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

                    <div class="receita bg-white rounded-xl shadow-sm overflow-hidden relative group"data-categoria="<?= $categoria ?>">

                        <img src="imagem/<?= $imagem ?>" alt="<?= $nome ?>" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">

                        <?php if ($userId): ?>
                        <button class="favorito-btn absolute top-3 right-3 bg-[#FFFFFF]/90 p-2 rounded-full text-gray-400 hover:text-red-500 hover:bg-[#FFFFFF] transition-colors shadow-sm <?= $estaFavorito ? 'text-red-500' : 'text-gray-400 hover:text-red-500' ?>"
                                data-id="<?= $idReceita ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                        <?php endif; ?>

                        <span class="absolute top-3 left-3 bg-[#F6F4F3] text-black text-xs font-bold px-2 py-1 rounded-md"><?= $categoria ?></span>

                        <div class="p-5">
                            <span class="text-sm text-gray-500 mb-2 block"><?= $tempo ?></span>
                            <h3 class="text-xl font-bold mb-2"><?= $nome ?></h3>
                            <p class="text-gray-600 text-sm line-clamp-2 mb-4"><?= $descricao ?></p>
                            <a href="receita.php?receita=<?= $idReceita ?>" class="block py-2 bg-[#F6F4F3] text-black font-semibold rounded-lg text-center hover:bg-[#B09B80]">Ver Detalhes</a>
                        </div>
                    </div>

                    <?php endwhile; ?>

                </div>
            </div>
        </div>
    </div>
    
    <?php require('includes/footer.php'); ?> 
    
    <script>
        document.querySelectorAll('input[name="categorias"]').forEach(radio => {
            radio.onclick = () => {
                document.querySelectorAll('.receita').forEach(r => {
                    r.style.display =
                        r.dataset.categoria === radio.value ? 'block' : 'none';
                });
            };
        });

        document.querySelectorAll('.favorito-btn').forEach(btn => {
            btn.addEventListener('click', async () => {
                const receitaId = btn.dataset.id;

                try {
                    const response = await fetch('auth/adicionarFavoritos.php', {
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

        let visiveis = 6;
        let categoriaAtual = null;

        function atualizarLista() {
            const receitas = document.querySelectorAll(".receita");
            let mostradas = 0;

            receitas.forEach(r => {
                if (!categoriaAtual || r.dataset.categoria === categoriaAtual) {
                    if (mostradas < visiveis) {
                        r.style.display = "block";
                        mostradas++;
                    } else {
                        r.style.display = "none";
                    }
                } else {
                    r.style.display = "none";
                }
            });
        }

        document.querySelectorAll('input[name="categorias"]').forEach(radio => {
            radio.addEventListener("click", () => {
                categoriaAtual = radio.value;
                visiveis = 6;
                atualizarLista();
            });
        });

        window.addEventListener("scroll", () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 200) {
                visiveis += 6;
                atualizarLista();
            }
        });
        atualizarLista();
    </script>
</body>
</html>
