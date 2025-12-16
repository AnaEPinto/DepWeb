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
    <div class="flex-grow flex items-center justify-center relative">

        <img src="imagem/login.jpg" alt="Cozinados" class="absolute inset-0 w-full h-full object-cover px-10">

        <div class="relative z-10 w-full max-w-md bg-[#F6F4F3]/95 p-6 rounded-lg shadow-md mx-4 border border-gray-100">

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">
                Iniciar Sessão
            </h2>

            <form action="auth/log.php" method="POST" class="space-y-4">
                <div>
                    <label for="email" class="font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md"
                    >
                </div>

                <div>
                    <label for="password" class="font-medium text-gray-700">Palavra-passe</label>
                    <input type="password" id="password" name="password" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md"
                    >
                </div>

                <button type="submit" class="w-full bg-[#B09B80] text-white py-2 rounded-md hover:bg-[#9a866b] transition">
                    Entrar
                </button>
            </form>

            <p class="mt-4 text-center text-sm text-gray-600">
                Não tem uma conta?
                <a href="register.php" class="text-[#B09B80] hover:underline">
                    Registar-se
                </a>
            </p>

        </div>
    </div>

    <?php require('includes/footer.php'); ?>

</body>

    </body>
</html>