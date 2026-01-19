<?php
session_start();
require('../ajax/connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

$texto = trim($_POST['comentario'] ?? '');
$idReceita = $_POST['id_receita'] ?? null;

if ($texto === '' || !$idReceita) {
    header("Location: ../receita.php?receita=$idReceita");
    exit;
}

$sql = "INSERT INTO comentario (id_utilizador, id_receita, comentario)
        VALUES (:id_utilizador, :id_receita, :comentario)";

$stmt = $dbh->prepare($sql);
$stmt->execute([
    ':id_utilizador' => $_SESSION['user_id'],
    ':id_receita'    => $idReceita,
    ':comentario'    => $texto
]);


header("Location: ../receita.php?receita=$idReceita");
exit;
