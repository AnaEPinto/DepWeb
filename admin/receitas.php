<?php
require('../ajax/connection.php');
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração | Receitas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Garante que o overlay tem uma transição suave */
        .overlay-transition {
            transition: opacity 0.3s ease;
        }
    </style>
</head>

<body>
    <?php
        $sql = "SELECT * FROM receitas ORDER BY id DESC";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $receitas = $stmt->fetchAll();
    ?>
      
    <div class="flex h-screen">

        <?php require('includes/nav.php'); ?>
        
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <div class="bg-[#FFFFFF] p-4 flex justify-between items-center z-30 border-black border-b">
                <h1 class="text-2xl font-bold text-gray-700 md:ml-0 ml-4">Gestão de Receitas</h1>
                <span class="text-gray-500 hidden md:block">Bem-vindo, Admin</span>
            </div>

            <div class="flex-1 overflow-y-auto p-6 md:p-8">
                
                <div class="mb-8 flex justify-between items-center">
                    <h2 class="text-3xl font-extrabold text-gray-800">Lista de Receitas Registadas</h2>
                    <a href="receitaNova.php" class="bg-[#D1C8C1] font-bold py-2 px-4 rounded-lg shadow-md flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Nova Receita
                    </a>
                </div>

                <?php if (!empty($receitas)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                    <?php foreach ($receitas as $receita): ?>
                    
                        <div class="bg-[#FFFFFF] rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100 group flex flex-col h-full">
                            <img class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" src="../imagem/<?= $receita['imagem'] ?>" alt="Receita <?= $receita['id'] ?>">
                        
                            <div class="p-5 flex flex-col flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    <?= $receita['nome'] ?>
                                </h3>

                               <div class="mt-auto flex justify-end gap-2 text-sm">
                                    <a href="crud/receitaEditar.php?id=<?= $receita['id'] ?>"
                                        class="px-3 py-1 rounded-md border border-[#B09B80] hover:bg-[#F4ECE2] hover:border-[#4E2D0C] transition">
                                        Editar
                                    </a>

                                    <a href="crud/receitaEliminar.php?id=<?= $receita['id'] ?>"
                                        class="px-3 py-1 rounded-md border border-[#B09B80] hover:bg-[#F4ECE2] hover:border-[#4E2D0C] transition">
                                        Eliminar
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php else: ?>
                <div class="text-center p-10 bg-white rounded-xl shadow-lg">
                    <p class="text-2xl text-gray-500">Nenhuma receita adicionada.</p>
                    <a href="receitaNova.php"
                    class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition">
                        Adicionar Receita
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('menu-toggle');
        const overlay = document.getElementById('overlay'); 

        // Função para Abrir/Fechar a Sidebar e o Overlay
        const toggleSidebar = () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        };

        // Event Listeners
        toggleButton.addEventListener('click', toggleSidebar); // Clicar no Hambúrguer
        overlay.addEventListener('click', toggleSidebar);      // Clicar no Overlay (mobile)
    </script>
</body>
</html>
