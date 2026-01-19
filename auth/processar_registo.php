<?php
session_start();
require('../ajax/connection.php');

$nome       = trim($_POST['nome'] ?? '');
$email      = trim($_POST['email'] ?? '');
$password   = $_POST['password'] ?? '';
$password2  = $_POST['password2'] ?? '';

if ($nome === '' || $email === '' || $password === '' || $password2 === '') {
    $_SESSION['erro'] = "Todos os campos são obrigatórios.";
    header("Location: ../registo.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['erro'] = "Email inválido.";
    header("Location: ../registo.php");
    exit;
}

if ($password !== $password2) {
    $_SESSION['erro'] = "As palavras-passe não coincidem.";
    header("Location: ../registo.php");
    exit;
}

if (strlen($password) < 8 ||
    !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[a-z]/', $password) ||
    !preg_match('/[0-9]/', $password)
) {
    $_SESSION['erro'] = "A palavra-passe deve ter pelo menos 8 caracteres, uma letra maiúscula, uma minúscula e um número.";
    header("Location: ../registo.php");
    exit;
}


$stmt = $dbh->prepare("SELECT id FROM utilizadores WHERE email = :email");
$stmt->execute([':email' => $email]);

if ($stmt->rowCount() > 0) {
    $_SESSION['erro'] = "Este email já está registado.";
    header("Location: ../registo.php");
    exit;
}

$password_hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO utilizadores (nome, email, password)
        VALUES (:nome, :email, :password)";

$stmt = $dbh->prepare($sql);
$stmt->execute([
    ':nome'     => $nome,
    ':email'    => $email,
    ':password' => $password_hash
]);

$user_id = $dbh->lastInsertId();


$_SESSION['ligado']    = true;
$_SESSION['user_id']   = $user_id;
$_SESSION['email']     = $email;
$_SESSION['nome']      = $nome;
$_SESSION['iniciais']  = strtoupper(substr($nome, 0, 1));

header("Location: ../index.php");
exit;
?>