<?php
session_start();
require('../ajax/connection.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../403.php');
    exit;
}

$email    = isset($_POST['email']) ? trim($_POST['email']) : null;
$password = isset($_POST['password']) ? trim($_POST['password']) : null;

$valido = filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;

if (!$password) {
    $_SESSION['ligado'] = false;
    header('Location: ../login.php?erro=password');
    exit;
}

$sql = "SELECT * FROM utilizadores WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();
$user = $stmt->fetchObject();

if (!$user) {
    $_SESSION['ligado'] = false;
    header('Location: ../login.php?erro=login');
    exit;
}

if ($password !== $user->password) {
    $_SESSION['ligado'] = false;
    header('Location: ../login.php?erro=login');
    exit;
}

if ($valido) {
    $_SESSION['ligado']   = true;
    $_SESSION['user_id']  = $user->id;
    $_SESSION['email']    = $user->email;
    $_SESSION['nome']     = $user->nome;
    $_SESSION['iniciais'] = strtoupper(substr($user->nome, 0, 1));
    header('Location: ../index.php');
    exit;
} else {
    $_SESSION['ligado'] = false;
    unset($_SESSION['nome'], $_SESSION['iniciais']);
    header('Location: ../login.php?erro=login');
    exit;
}
