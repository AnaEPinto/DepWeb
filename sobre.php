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

    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center my-6">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold m-4">A Nossa Filosofia</h1>
            <p class="text-base sm:text-xl">Acreditamos que comer bem não tem de ser complicado.</p>
        </div>

        <div class="flex overflow-x-auto gap-6 my-6">
            <div class="snap-start shrink-0 min-w-[320px] sm:min-w-[440px]">
                <img src="imagem/comida_caseira.jpg" class="w-full h-72 sm:h-80 md:h-96 lg:h-[28rem] object-cover rounded-2xl shadow" alt="Comida Caseira" />
            </div>
            <div class="snap-start shrink-0 min-w-[320px] sm:min-w-[440px]">
                <img src="imagem/cozinhar.jpg" class="w-full h-72 sm:h-80 md:h-96 lg:h-[28rem] object-cover rounded-2xl shadow" alt="Cozinhar" />
            </div>
            <div class="snap-start shrink-0 min-w-[320px] sm:min-w-[440px]">
                <img src="imagem/ingredientes_mercado.jpg" class="w-full h-72 sm:h-80 md:h-96 lg:h-[28rem] object-cover rounded-2xl shadow" alt="Ingredientes de um mercado"/>
            </div>
            <div class="snap-start shrink-0 min-w-[320px] sm:min-w-[440px]">
                <img src="imagem/pessoas_mesa.jpg" class="w-full h-72 sm:h-80 md:h-96 lg:h-[28rem] object-cover rounded-2xl shadow" alt="Familia a mesa"/>
            </div>
        </div>


        <div class="sm:text-lg max-w-none space-y-4 mx-auto my-10">
            <p class="first-letter:float-left first-letter:mr-3 first-letter:text-7xl first-letter:font-bold">
            O "The Recipe" não foi conceptualizado em cozinhas imaculadas, dignas de estrelas Michelin, nem idealizado por chefs de renome internacional. A nossa ideia é mais humilde, mas mais próxima da sua realidade. Este projeto nasceu da tirania do relógio e da pressão constante da rotina que, muito provavelmente, define também os seus dias.
            </p>  
            <p>Somos uma equipa de entusiastas da boa comida que, tal como você, tem de fazer malabarismos entre o trabalho, a família, o ginásio e a eterna pergunta: "O que é o jantar hoje?". Passámos demasiado tempo a frustrar-nos com o estado da Internet. Cansámo-nos de procurar receitas "rápidas" que, afinal, tinham 20 ingredientes (incluindo aquele "tempero especial" que só se encontra numa loja gourmet a 50km de distância) e 15 passos que sujavam a cozinha toda.</p>
            <p>Por isso, criámos este espaço com uma missão muito clara: ser o seu filtro. Deixamos de lado o que é acessório e focamo-nos no que realmente importa.</p>
            <blockquote class="border-l-4 border-[#B09B80] bg-[#D1C8C1] p-6 rounded-r-lg italic">
                "O 'The Recipe' nasceu desse desejo de partilhar. Queremos que este site seja o vosso caderno de receitas digital, um lugar onde encontram inspiração, seja para um jantar rápido de terça-feira ou para aquele almoço especial de domingo."
            </blockquote>
        </div>

        <div class="my-10">
            <h2 class="text-2xl sm:text-3xl font-bold text-center mb-10">Os Nossos 3 Pilares</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100 text-center">
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-1">Simplicidade</h3>
                    <p class="text-gray-600">Ingredientes que encontra em qualquer supermercado. Passos claros e diretos, sem "linguagem de chef".</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100 text-center">
                   <h3 class="text-2xl font-bold text-gray-800 mb-2">Rapidez</h3>
                    <p class="text-gray-600">Respeitamos o seu tempo. A maioria das nossas receitas é pensada para se encaixar nas rotinas mais ocupadas.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100 text-center">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Sabor</h3>
                    <p class="text-gray-600">Rápido não significa aborrecido. Cada receita é testada para garantir que é, acima de tudo, deliciosa.</p>
                </div>
            </div>
        </div>
    </div>

    <?php require('includes/footer.php'); ?>
    
</body>
</html>