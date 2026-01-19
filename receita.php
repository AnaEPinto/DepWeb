<?php
session_start();
require('ajax/connection.php');

// valida como inteiro, devolve null/false se for inválido
$id_receita = filter_input(INPUT_GET, 'receita', FILTER_VALIDATE_INT);

if (!$id_receita) {
    header('Location: index.php');
    exit;
}
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
    
    <?php 
        $sql = 'SELECT * FROM receitas WHERE id = :id';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id_receita);
        $stmt->execute();

        if(!$stmt || $stmt->rowCount() != 1){
            header('Location:index.php');
            exit;
        }   

        $receita = $stmt->fetchObject();
        $id_receita    = $receita->id;
        $nome         = $receita->nome;
        $imagem       = $receita->imagem;
        $tempo        = $receita->tempo;
        $ingredientes = $receita->ingredientes;
        $preparacao   = $receita->preparacao;
        $categoria    = $receita->categoria;
        $descricao    = $receita->descricao;
        $quantidade   = $receita->quantidade;
        $orcamento    = $receita->orcamento;

        $userId = $_SESSION['user_id'] ?? null;
        $estaFavorito = false;
        if ($userId) {
            $stmtFav = $dbh->prepare("SELECT 1 FROM favoritos WHERE id_utilizador = :uid AND id_receita = :rid");
            $stmtFav->bindValue(':uid', $userId);
            $stmtFav->bindValue(':rid', $id_receita);
            $stmtFav->execute();
            $estaFavorito = $stmtFav->fetchColumn();
        }
    ?>
    
   <div class="px-2 mt-10 sm:px-4 md:px-8 lg:px-20 xl:px-32">
        <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 text-center my-4"><?= $nome ?></h2>
        <p class="sm:text-lg md:text-xl text-gray-600 text-center max-w-3xl mx-auto mb-6"><?= $descricao ?></p>
        
        <div class="max-w-6xl mx-auto mt-10">
           <div class="bg-gray-50 rounded-lg border border-gray-200 w-full mt-4">
                <div class="grid grid-cols-2 md:grid-cols-4 text-gray-700">
                    <div class="flex items-center gap-2 pl-6 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="font-medium"><?= $tempo ?></span>
                    </div>

                    <div class="flex items-center gap-2 pl-6 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                        <span class="font-medium"><?= $quantidade ?> pessoas</span>
                    </div>

                    <div class="flex items-center gap-2 pl-6 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 7.756a4.5 4.5 0 1 0 0 8.488M7.5 10.5h5.25m-5.25 3h5.25M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="font-medium"><?= $orcamento ?></span>
                    </div>

                    <div class="flex items-center gap-2 pl-6 py-2">
                        <?php if ($userId): ?>
                            <button class="favorito-btn flex items-center gap-1 hover:text-red-500 transition" data-id="<?= $id_receita ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 <?= $estaFavorito ? 'text-red-500' : '' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span class="font-medium">Favorito</span>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

                    
           <div class="w-full mt-10 flex justify-center">
                <img src="imagem/<?= $imagem ?>" alt="Receita <?= $id_receita ?>" class="w-full max-w-3xl h-[500px] object-cover rounded-lg shadow-md">
            </div>

            <div class="mt-10 grid md:grid-cols-2 gap-12 items-start">
                <div class="rounded-lg p-6 min-h-[260px]">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-black pb-2">
                        Ingredientes
                    </h2>
                    <ul class="list-disc list-inside text-gray-700 text-base sm:text-lg space-y-1">
                        <?php
                            $lista = explode("\n", $ingredientes);
                            foreach ($lista as $linha) {
                                $item = trim($linha);
                                if ($item !== '') {
                                    echo "<li>$item</li>";
                                }
                            }
                        ?>
                    </ul>
                </div>

                <div class="rounded-lg p-6 min-h-[260px]">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-black pb-2">
                        Modo de Preparação
                    </h2>
                    <ol class="list-decimal list-inside text-gray-700 text-base sm:text-lg space-y-1">
                        <?php
                            $lista = explode("\n", $preparacao);
                            foreach ($lista as $linha) {
                                $item = trim($linha);
                                if ($item !== '') {
                                    echo "<li>$item</li>";
                                }
                            }
                        ?>
                    </ol> 
                </div>
            </div>
        </div>
    </div>

    <div class="my-10">
        <hr class="border-black mx-10 my-2">
    </div> 

    <?php
        $sqlComentarios = " SELECT c.comentario,  c.data_comentario, u.nome FROM comentario c JOIN utilizadores u ON u.id = c.id_utilizador WHERE c.id_receita = ? ORDER BY c.data_comentario DESC";
        $stmtComentarios = $dbh->prepare($sqlComentarios);
        $stmtComentarios->execute([$id_receita]);
        $comentarios = $stmtComentarios->fetchAll();
    ?>

    <?php if (isset($_SESSION['user_id'])):?>

    <div class="w-full max-w-xl mx-auto px-2">
        <h4 class="text-base sm:text-xl font-semibold mb-2">
            Deixe aqui a sua opinião:
        </h4>

        <form method="POST" action="auth/adicionarComentario.php" class="flex flex-col gap-3">
            <textarea name="comentario" class="border border-black rounded-md p-3 text-lg" rows="4" zrequired> </textarea>

            <input type="hidden" name="id_receita" value="<?= $id_receita ?>">

            <button type="submit" class="self-end bg-[#B09B80] text-white px-6 py-2 rounded-md hover:bg-[#4E2D0C] transition">
                Enviar
            </button>
        </form>
    </div>

    <?php else: ?>

    <div class="text-center pb-4">
        <p class="text-gray-700">
            Tens de <a href="login.php" class="text-[#B09B80] underline">iniciar sessão</a>
            para deixar um comentário.
        </p>
    </div>
    
    <?php endif; ?>

    <?php if (!empty($comentarios)): ?>

    <div class="space-y-4 px-24 pt-6 max-w-3xl mx-auto mb-10">
        <?php foreach ($comentarios as $c): ?>
        <p class="text-md text-gray-900 leading-relaxed"> Opinião de outros utilizadores: </p>   
        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
            <p class="text-sm text-gray-800 leading-relaxed"> <?= $c['comentario'] ?> </p>
            <p class="text-xs text-gray-500 mt-1">
                <span class="font-medium text-gray-700"><?= $c['nome'] ?></span>
                comentou no dia
                <?= date('d/m/Y \à\s H:i', strtotime($c['data_comentario'])) ?>
            </p>

        </div>
        <?php endforeach; ?>
    </div>

    <?php else: ?>
        <p class="text-center text-gray-600 py-4">
            Ainda não há comentários para esta receita. Seja o primeiro a comentar!
        </p>
    <?php endif; ?>

    <?php require('includes/footer.php'); ?>
    
    <script>
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
    </script>   

</body>
</html>