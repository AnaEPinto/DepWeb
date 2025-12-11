<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    // Só gera se ainda não existir um token na sessão
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); 
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

    <body class="bg-[#F6F4F3]">

        <div class="h-screen flex flex-col overflow-hidden">

            <?php require('includes/nav.php'); ?>

            <div class="relative flex-grow flex items-center justify-center overflow-hidden">
                
                <img class="absolute inset-0 w-full h-full object-cover px-10" src="imagem/login.jpg" alt="Cozinados">

                <div class="relative z-10 w-full max-w-md bg-[#F6F4F3]/95 p-6 rounded-lg shadow-md mx-4 border border-gray-100">
                            
                    <h2 class="text-2xl font-bold text-center text-gray-900 mb-4">Criar a sua conta</h2>

                    <form class="space-y-3" action="auth/processar_registo.php" method="POST">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                            <input id="nome" name="nome" type="text" required class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input id="email" name="email" type="email" required class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Palavra-passe</label>
                            <input id="password" name="password" type="password" autocomplete="new-password" required class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm">
                        </div>

                        <div>
                            <label for="password2" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Palavra-passe</label>
                            <input id="password2" name="password2" type="password" autocomplete="new-password" required class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm">
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center bg-[#B09B80] text-white px-6 py-2 rounded-md hover:bg-[#4E2D0C] transition">
                                Criar Conta
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="z-20 relative">
                <?php require('includes/footer.php'); ?>
            </div>
        </div>
    </body>


</html>