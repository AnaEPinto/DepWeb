<?php
session_start();
require('../ajax/connection.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../403.php');
    exit;
}

$email    = trim($_POST['email']);
$password = trim($_POST['password']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['ligado'] = false;
    header('Location: ../login.php?erro=email');
    exit;
}

if ($password === '') {
    $_SESSION['ligado'] = false;
    header('Location: ../login.php?erro=password');
    exit;
}

$sql = "SELECT * FROM utilizadores WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->execute([':email' => $email]);
$user = $stmt->fetchObject();

if (!$user || $password !== $user->password) {
    $_SESSION['ligado'] = false;
    header('Location: ../login.php?erro=login');
    exit;
}

$_SESSION['ligado']   = true;
$_SESSION['user_id']  = $user->id;
$_SESSION['email']    = $user->email;
$_SESSION['nome']     = $user->nome;
$_SESSION['iniciais'] = strtoupper(substr($user->nome, 0, 1));

header('Location: ../index.php');
exit;
