<?php
session_start();
require('../ajax/connection.php');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit;
}

$userId = $_SESSION['user_id'];

// Verifica se a requisição é POST e se o ID da receita foi fornecido
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
    exit;
}

$receitaId = (int)$_POST['id'];

$novoEstadoFavorito = false; 

try {
    $dbh->beginTransaction();

    $stmtCheck = $dbh->prepare("SELECT COUNT(*) FROM favoritos WHERE id_utilizador = :uid AND id_receita = :rid");
    $stmtCheck->bindParam(':uid', $userId, PDO::PARAM_INT);
    $stmtCheck->bindParam(':rid', $receitaId, PDO::PARAM_INT);
    $stmtCheck->execute();
    $isFavorito = $stmtCheck->fetchColumn() > 0;

    if ($isFavorito) {
        $stmtDelete = $dbh->prepare("DELETE FROM favoritos WHERE id_utilizador = :uid AND id_receita = :rid");
        $stmtDelete->bindParam(':uid', $userId, PDO::PARAM_INT);
        $stmtDelete->bindParam(':rid', $receitaId, PDO::PARAM_INT);
        $stmtDelete->execute();
        $novoEstadoFavorito = false;
        
    } else {
        $stmtInsert = $dbh->prepare("INSERT INTO favoritos (id_utilizador, id_receita) VALUES (:uid, :rid)");
        $stmtInsert->bindParam(':uid', $userId, PDO::PARAM_INT);
        $stmtInsert->bindParam(':rid', $receitaId, PDO::PARAM_INT);
        $stmtInsert->execute();
        $novoEstadoFavorito = true;
    }

    $dbh->commit(); 

    echo json_encode([
        'success' => true, 
        'favorito' => $novoEstadoFavorito,
        'message' => $novoEstadoFavorito ? 'Receita adicionada aos favoritos.' : 'Receita removida dos favoritos.'
    ]);

} catch (PDOException $e) {
    $dbh->rollBack(); // Desfaz a transação em caso de erro
    error_log("Erro PDO em adicionarFavoritos: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Erro interno do servidor.']);
}

?>