<?php
session_start();
// Certifique-se de que o caminho para 'connection.php' está correto.
require('../ajax/connection.php');

header('Content-Type: application/json');

// 1. Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Não Autorizado
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit;
}

$userId = $_SESSION['user_id'];

// 2. Verificar o método e obter o ID da Receita
// O JavaScript envia os dados como application/x-www-form-urlencoded
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id']) || !is_numeric($_POST['id'])) {
    http_response_code(400); // Pedido Inválido
    echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
    exit;
}

$receitaId = (int)$_POST['id'];

// Variável para rastrear se a receita está ou estará marcada como favorita
$novoEstadoFavorito = false; 

try {
    // Inicia uma transação para garantir que as operações sejam atómicas
    $dbh->beginTransaction();
    
    // 3. Verificar se a receita já é favorita
    $stmtCheck = $dbh->prepare("SELECT COUNT(*) FROM favoritos WHERE id_utilizador = :uid AND id_receita = :rid");
    $stmtCheck->bindParam(':uid', $userId, PDO::PARAM_INT);
    $stmtCheck->bindParam(':rid', $receitaId, PDO::PARAM_INT);
    $stmtCheck->execute();
    $isFavorito = $stmtCheck->fetchColumn() > 0;

    if ($isFavorito) {
        // 4. Se JÁ FOR favorita -> REMOVER (DELETE)
        $stmtDelete = $dbh->prepare("DELETE FROM favoritos WHERE id_utilizador = :uid AND id_receita = :rid");
        $stmtDelete->bindParam(':uid', $userId, PDO::PARAM_INT);
        $stmtDelete->bindParam(':rid', $receitaId, PDO::PARAM_INT);
        $stmtDelete->execute();
        $novoEstadoFavorito = false;
        
    } else {
        // 5. Se NÃO FOR favorita -> ADICIONAR (INSERT)
        $stmtInsert = $dbh->prepare("INSERT INTO favoritos (id_utilizador, id_receita) VALUES (:uid, :rid)");
        $stmtInsert->bindParam(':uid', $userId, PDO::PARAM_INT);
        $stmtInsert->bindParam(':rid', $receitaId, PDO::PARAM_INT);
        $stmtInsert->execute();
        $novoEstadoFavorito = true;
    }

    $dbh->commit(); // Confirma a transação

    // 6. Enviar a resposta de sucesso para o JavaScript
    echo json_encode([
        'success' => true, 
        'favorito' => $novoEstadoFavorito,
        'message' => $novoEstadoFavorito ? 'Receita adicionada aos favoritos.' : 'Receita removida dos favoritos.'
    ]);

} catch (PDOException $e) {
    $dbh->rollBack(); // Desfaz a transação em caso de erro
    http_response_code(500); // Erro Interno do Servidor
    error_log("Erro PDO em adicionarFavoritos: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Erro interno do servidor.']);
}

?>