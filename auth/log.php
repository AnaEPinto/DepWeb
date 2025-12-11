<?php
session_start();
require('../ajax/connection.php'); 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../403.php');
    exit;
}

$email = isset($_POST['email']) ? $_POST['email']: null;

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $valido = true;
    
} else {
    $valido = false;
}

$password = isset($_POST['password']) ? $_POST['password'] : null;

if (!$password) {
    header('Location: ../login.php?erro=password');
}

$sql = "SELECT * FROM utilizadores WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();
$user = $stmt->fetchObject();

if ($valido && $user && password_verify($password, $user->password)) {
    $_SESSION['ligado'] = true;
    $_SESSION['user_id'] = $user->id;
    $_SESSION['email']  = $user->email;
    $_SESSION['nome']   = $user->nome;
    $_SESSION['iniciais'] = strtoupper(substr($user->nome, 0, 1));
    header('Location: ../index.php');
    exit;
} else {
    $_SESSION['ligado'] = false;
    unset($_SESSION['nome'], $_SESSION['iniciais']);
    header('Location: ../login.php');
    exit;
}

header('Location: ../index.php');
exit;    
?>

