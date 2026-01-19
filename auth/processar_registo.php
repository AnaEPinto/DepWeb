<?php
session_start();
require('../ajax/connection.php');

$nome      = trim($_POST['nome']);
$email     = trim($_POST['email']);
$password  = $_POST['password'];
$password2 = $_POST['password2'];

if ($nome === '' || $email === '' || $password === '' || $password2 === '') {
    header("Location: ../registo.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../registo.php");
    exit;
}

if ($password !== $password2) {
    header("Location: ../registo.php");
    exit;
}

if (
    strlen($password) < 8 ||
    !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[a-z]/', $password) ||
    !preg_match('/[0-9]/', $password)
) {
    header("Location: ../registo.php");
    exit;
}

$password = password($password);

$stmt = $dbh->prepare(" INSERT INTO utilizadores (nome, email, password) VALUES (:nome, :email, :password) ");

$stmt->execute([
    ':nome'     => $nome,
    ':email'    => $email,
    ':password' => $password_hash
]);

$_SESSION['ligado']   = true;
$_SESSION['nome']     = $nome;
$_SESSION['email']    = $email;
$_SESSION['user_id']  = $dbh->lastInsertId();

header("Location: ../index.php");
exit;
