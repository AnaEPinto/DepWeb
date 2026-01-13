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

<body class= "bg-[#F6F4F3] min-h-screen flex flex-col">
    
    <?php require('includes/nav.php'); ?>

    <div class="flex-grow">
        <div class="">
            <div class="hidden md:flex px-10">
                <img class="w-full rounded-sm" src="imagem/cozinha1.png" alt="Imagem de uma cozinha">
            </div>

            <div class="max-w-7xl mx-auto relative md:hidden px-10">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-2 bg-[#FFFFFF]/75 font-bold text-lg text-center border rounded-md backdrop-blur-sm">
                    Bem-vindo(a) a The Recipe!
                </div>
                <img class="w-auto h-52 rounded-sm object-center" src="imagem/cozinha1.png" alt="Imagem de uma cozinha">
            </div>
        </div>

        <div class="">
            <hr class="border-black mx-10 my-2">
        </div> 

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 px-8 md:px-14 py-6 items-center ">

            <div class="space-y-4">
                
                <h1 class="hidden md:flex font-bold text-3xl">
                    Bem-vindo(a) a The Recipe!
                </h1>
                <p class="sm:text-lg">
                    O dia a dia é uma correria, por isso deixamos de lado receitas complicadas e ingredientes impossíveis, tudo é simples, direto e pensado para a sua rotina.
                </p>
                
                <div>
                    <h2 class="text-2xl font-semibold pt-1"> 
                        Simples, Rápido e Delicioso
                    </h2>
                    <p class="sm:text-lg">
                        Aqui encontra receitas simples, rápidas e deliciosas para qualquer momento, de almoços improvisados a jantares em família, sempre com pratos saborosos e com ótimo aspeto.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold">
                        A Sua Cozinha Virtual
                    </h2>
                    <p class="sm:text-lg">
                        A The Recipe quer transformar o clássico “o que é o jantar?” num momento fácil e inspirador. Aqui, a simplicidade é o segredo para refeições saborosas e inesquecíveis.  
                    </p>
                </div>
            </div>

            <div class="space-y-4 hidden md:block">
                <img class="w-full h-48 object-cover rounded-sm" src="imagem/cozinhados_1.jpg" alt="Cozinha com molho">
                <img class="w-full h-48 object-cover rounded-sm" src="imagem/cozinhados_2.png" alt="Prato delicioso">
            </div>

            <div class="">
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-800">
                    Vamos por as mãos na massa?
                </h3>
            </div>
        </div>

        <button class="w-full px-6 sm:px-10 sm:py-5 md:px-16 lg:px-24  flex justify-center items-center">
            <a href="receitas.php" class="bg-black text-white px-6 py-3 rounded-full text-base sm:text-lg font-semibold hover:bg-gray-800 transition">
                Explore as Receitas
            </a>
        </button>
    </div>
    <?php require('includes/footer.php'); ?>

</body>
</html>