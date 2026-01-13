<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location:../receitaNova.php');
    exit;
}

require('../../ajax/connection.php');

$nome         = trim($_POST['nome']);
$tempo        = trim($_POST['tempo']);
$ingredientes = trim($_POST['ingredientes']);
$preparacao   = trim($_POST['preparacao']);
$categoria    = trim($_POST['categoria']);
$descricao    = trim($_POST['descricao']);
$quantidade   = (int)($_POST['quantidade']);
$orcamento    = trim($_POST['orcamento']);

if (!$nome || !$tempo || !$ingredientes || !$preparacao || !$categoria || !$descricao || !$quantidade || !$orcamento) {
    header('Location:../receitaNova.php?erro=dados');
    exit;
}

if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== 0) {
    header('Location:../eventoNovo.php?erro=evioimagem');
    exit;
}

$permitidas = ['jpg','jpeg','png','webp'];
$ext = strtolower(pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION));

if (!in_array($ext, $permitidas)) {
    header('Location:../eventoNovo.php?erro=imagemformatoinvalido');
    exit;
}
$nomeFicheiro = bin2hex(random_bytes(16)) . "." . $ext; 

$ficheiroFinal = "../../imagem/" . $nomeFicheiro;
move_uploaded_file($_FILES["imagem"]["tmp_name"], $ficheiroFinal);

$ingredientes = nl2br($ingredientes); 
$preparacao   = nl2br($preparacao);

$sql = "INSERT INTO receitas (nome, tempo, ingredientes, preparacao, categoria, descricao, quantidade, orcamento, imagem)
VALUES (:nome, :tempo, :ingredientes, :preparacao, :categoria, :descricao, :quantidade, :orcamento, :imagem)";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':nome', $nome);
$stmt->bindValue(':tempo', $tempo);
$stmt->bindValue(':ingredientes', $ingredientes);
$stmt->bindValue(':preparacao', $preparacao);
$stmt->bindValue(':categoria', $categoria);
$stmt->bindValue(':descricao', $descricao);
$stmt->bindValue(':quantidade', $quantidade);
$stmt->bindValue(':orcamento', $orcamento);
$stmt->bindValue(':imagem', $nomeFicheiro);

if ($stmt->execute()) {

    header('Location: ../receitaNova.php?ok=1');
    exit;
} else {
    header('Location: ../receitaNova.php?erro=bd');
    exit;
}