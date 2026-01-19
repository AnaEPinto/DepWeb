<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Quill -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
</head>

<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen">

        <?php require('includes/nav.php'); ?>

        <div class="flex-1 overflow-y-auto p-6">

            <h2 class="text-3xl font-bold mb-6">Criar Nova Receita</h2>

            <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
                <form id="form-receita" action="crud/receitaCriar.php" method="POST" enctype="multipart/form-data" class="space-y-6">

                    <div>
                        <label class="block mb-1 font-medium">Nome</label>
                        <input name="nome" type="text" required class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Tempo</label>
                        <input name="tempo" type="text" required class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Ingredientes</label>
                        <div id="editor-ingredientes" class="h-32 border rounded"></div>
                        <textarea id="ingredientes" name="ingredientes" class="hidden"></textarea>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Preparação</label>
                        <div id="editor-preparacao" class="h-32 border rounded"></div>
                        <textarea id="preparacao" name="preparacao" class="hidden"></textarea>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Descrição</label>
                        <div id="editor-descricao" class="h-32 border rounded"></div>
                        <textarea id="descricao" name="descricao" class="hidden"></textarea>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Categoria</label>
                        <select name="categoria" required class="w-full border rounded px-3 py-2">
                            <option value="">Selecione uma categoria</option>
                            <option value="Entradas">Entradas</option>
                            <option value="Salada">Salada</option>
                            <option value="Massas">Massas</option>
                            <option value="Peixe">Peixe</option>
                            <option value="Carne">Carne</option>
                            <option value="Vegetariano">Vegetariano</option>
                            <option value="Sobremesas">Sobremesas</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Quantidade</label>
                        <input name="quantidade" type="number" min="1" required class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Orçamento</label>
                        <select name="orcamento" required class="w-full border rounded px-3 py-2">
                            <option value="">Selecione uma categoria</option>
                            <option value="Económico">Económico</option>
                            <option value="Médio">Médio</option>
                            <option value="Alto">Alto</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Imagem</label>
                        <input id="imagem" name="imagem" type="file" accept="imagem/*" required>
                        <img id="preview" class="hidden mt-3 max-h-40 rounded">
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="receitas.php" class="px-4 py-2 bg-gray-300 rounded">Cancelar</a>
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded">
                            Guardar Receita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const toolbar = [
            ["bold", "italic", "underline"],
            [{ list: "ordered" }, { list: "bullet" }],
            ["clean"]
        ];

        const qIngredientes = new Quill('#editor-ingredientes', {
            theme: "snow",
            modules: { toolbar },
            placeholder: "Necessário selecionar a opção de lista com pontos"
        });

        const qPreparacao = new Quill('#editor-preparacao', {
            theme: "snow",
            modules: { toolbar },
            placeholder: "Necessário selecionar a opção de lista com números"
       
        });

        const qDescricao = new Quill('#editor-descricao', {
            theme: "snow",
            modules: { toolbar }
        });

        document.getElementById("form-receita").addEventListener("submit", function () {
            document.getElementById("ingredientes").value = qIngredientes.getText().trim();
            document.getElementById("preparacao").value = qPreparacao.getText().trim();
            document.getElementById("descricao").value = qDescricao.getText().trim();
        });
    </script>
</body>
</html>
