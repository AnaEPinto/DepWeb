<?php
require('../../ajax/connection.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: receitas.php');
    exit;
}

$id = (int) $_GET['id'];

$sql  = "DELETE FROM receitas WHERE id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();

header('Location: ../receitas.php');
exit;
?>