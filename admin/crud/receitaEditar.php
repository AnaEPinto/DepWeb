<?php
session_start();
require('/../../ajax/connection.php');

/* valida ID */
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: ../receitas.php");
    exit;
}

$stmt = $dbh->prepare("SELECT * FROM receitas WHERE id = ?");
$stmt->execute([$id]);
$receita = $stmt->fetch();

if (!$receita) {
    header("Location: ../receitas.php");
    exit;
}

/* atualiza */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $imagem = $receita['imagem'];

    if (!empty($_FILES['imagem']['name'])) {
        $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png','webp'])) {
            $imagem = uniqid() . '.' . $ext;
            move_uploaded_file(
                $_FILES['imagem']['tmp_name'],
                __DIR__ . '/../../imagem/' . $imagem
            );
        }
    }

    $stmt = $dbh->prepare(" UPDATE receitas SET nome=?, tempo=?, ingredientes=?, preparacao=?, 
    categoria=?, descricao=?, quantidade=?, orcamento=?, imagem=? WHERE id=?"
    );

    $stmt->execute([
        $_POST['nome'],
        $_POST['tempo'],
        $_POST['ingredientes'],
        $_POST['preparacao'],
        $_POST['categoria'],
        $_POST['descricao'],
        (int)$_POST['quantidade'],
        $_POST['orcamento'],
        $imagem,
        $id
    ]);

    header("Location: ../receitas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Receita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Editar Receita</h1>

        <form method="post" enctype="multipart/form-data" class="bg-white p-6 rounded shadow space-y-4">

            <input type="text" name="nome" value="<?= ($receita['nome']) ?>" required class="w-full border p-2 rounded">
            <input type="text" name="tempo" value="<?= ($receita['tempo']) ?>" required class="w-full border p-2 rounded">

            <textarea name="ingredientes" required class="w-full border p-2 rounded"><?= ($receita['ingredientes']) ?></textarea>
            <textarea name="preparacao" required class="w-full border p-2 rounded"><?= ($receita['preparacao']) ?></textarea>

            <input type="text" name="categoria" value="<?= ($receita['categoria']) ?>" required class="w-full border p-2 rounded">
            <textarea name="descricao" class="w-full border p-2 rounded"><?= ($receita['descricao']) ?></textarea>

            <div class="grid grid-cols-2 gap-4">
                <input type="number" name="quantidade" value="<?= (int)$receita['quantidade'] ?>" min="1" required class="border p-2 rounded">
                <input type="text" name="orcamento" value="<?= ($receita['orcamento']) ?>" required class="border p-2 rounded">
            </div>

            <?php if ($receita['imagem']): ?>
                <img src="/DEPWEB/imagem/<?= ($receita['imagem']) ?>" class="w-40 rounded">
            <?php endif; ?>

            <input type="file" name="imagem" class="w-full border p-2 rounded">

            <div class="flex justify-end gap-3 pt-4">
                <a href="../receitas.php" class="px-4 py-2 border rounded">Cancelar</a>
                <button class="px-4 py-2 bg-indigo-600 text-white rounded">Guardar</button>
            </div>

        </form>
    </div>
</body>
</html>
