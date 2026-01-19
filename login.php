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

<body class="bg-[#F6F4F3] min-h-screen flex flex-col">

    <?php require('includes/nav.php'); ?>

    <div class="flex-1 relative flex items-center justify-center px-4 sm:px-10 py-8">

        <img src="imagem/login.jpg" alt="Cozinados" class="absolute inset-0 w-full h-full object-cover px-10">

        <div class="relative w-full max-w-md bg-white/95 p-6 sm:p-8 rounded-lg shadow-lg mx-4">
            <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-center text-gray-800">
                Iniciar Sessão
            </h2>

            <form action="auth/log.php" method="POST" class="space-y-3 sm:space-y-4">
                <div>
                    <label for="email" class="block font-medium text-gray-700 mb-1 text-sm sm:text-base">Email</label>
                    <input type="email" id="email" name="email" required class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md focus:outline-none focus:border-[#B09B80]">
                </div>

                <div>
                    <label for="password" class="block font-medium text-gray-700 mb-1 text-sm sm:text-base">Palavra-passe</label>
                    <input type="password" id="password" name="password" required class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md focus:outline-none focus:border-[#B09B80]">
                </div>

                <button type="submit" class="w-full bg-[#B09B80] text-white py-2 rounded-md hover:bg-[#9a866b] text-sm sm:text-base">
                    Entrar
                </button>
            </form>

            <p class="mt-3 sm:mt-4 text-center text-xs sm:text-sm text-gray-600">
                Não tem uma conta? 
                <a href="register.php" class="text-[#B09B80] hover:underline font-medium">Registar-se</a>
            </p>
        </div>

    </div>

    <?php require('includes/footer.php'); ?>

</body>
</html>

