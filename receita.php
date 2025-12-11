<?php 
    session_start();
    require('ajax/connection.php');
?>
<?php
    if(isset($_GET['receita'])){
        $idReceita = $_GET['receita'];
    }else{
        header('Location:index.html');
        exit;
    }
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

    <?php
        $pagina = 'receitas';
        require('includes/nav.php');
    ?>
    
    <?php 
        $sql = 'SELECT * FROM receitas WHERE id = :id';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $idReceita);
        $stmt->execute();

        if(!$stmt || $stmt->rowCount() != 1){
            header('Location:index.php');
            exit;
        }   

        $receita = $stmt->fetchObject();
        $idReceita    = $receita->id;
        $nome         = $receita->nome;
        $imagem       = $receita->imagem;
        $tempo        = $receita->tempo;
        $ingredientes = $receita->ingredientes;
        $preparacao   = $receita->preparacao;
        $categoria    = $receita->categoria;
        $descricao    = $receita->descricao;
        $quantidade   = $receita->quantidade;
        $orcamento    = $receita->orcamento;
    ?>
    
   <div class="px-2 mt-10 sm:px-4 md:px-8 lg:px-20 xl:px-32">
        <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 text-center my-4"><?= $nome ?></h2>
        <p class="sm:text-lg md:text-xl text-gray-600 text-center max-w-3xl mx-auto mb-6"><?= $descricao ?></p>
        
        <div class="max-w-6xl mx-auto mt-10">
            <div class="bg-gray-50 rounded-lg border border-gray-200 w-full">
                <div class="grid grid-cols-2 md:grid-cols-4 text-gray-700 w-full">
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
                    <button class="flex items-center gap-2 pl-6 py-2 rounded-lg hover:text-red-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                        <span class="font-medium">Favorito</span>
                    </button>
                </div>
            </div>
        
           <div class="w-full mt-10 flex justify-center">
                <img src="imagem/<?= $imagem ?>" alt="Receita <?= $idReceita ?>" class="w-full max-w-3xl h-[500px] object-cover rounded-lg shadow-md">
            </div>

            <div class="mt-10 grid md:grid-cols-2 gap-12 items-start">
                <div class="rounded-lg p-6 min-h-[260px]">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-black pb-2">
                        Ingredientes
                    </h2>
                    <ul class="list-disc list-inside text-gray-700 text-base sm:text-lg space-y-1">
                        <?php
                            $delimitador = "\n"; 
                            $lista_ingredientes = explode($delimitador, trim($ingredientes));
                            foreach ($lista_ingredientes as $ingrediente) {
                                $item = trim($ingrediente);
                                if (!empty($item)) {
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
                            $delimitador = "\n"; 
                            $lista_preparacao = explode($delimitador, trim($preparacao));
                            foreach ($lista_preparacao as $passo) {
                                $item = trim($passo);
                                if (!empty($item)) {
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
    
    <div class="w-full max-w-xl mx-auto px-2">
        <h4 class="text-base sm:text-xl font-semibold mb-2">Deixe aqui a sua opinião:</h4>
        <form class="flex flex-col gap-3">
            <textarea class="border border-black rounded-md p-3 text-lg" rows="4" placeholder="Escreva aqui o que achou desta receita..."></textarea>
            <button type="submit" class="self-end bg-[#B09B80] text-white px-6 py-2 rounded-md hover:bg-[#4E2D0C] transition">
                Enviar
            </button>
        </form>
    </div>

    <div class="z-20 relative">
        <?php require('includes/footer.php'); ?>
    </div>
</body>
</html>