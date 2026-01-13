<?php
session_start();
require('../ajax/connection.php');   

$nome = $_POST['nome']; 
$email = $_POST['email'];
$password = $_POST['password'];

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $valido = true;
    list($utilizador, $dominio) = explode("@", $email);
    
    if (checkdnsrr($dominio, "MX")) {}

} else {
    $valido = false;
}

if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
    echo "Password não cumpre as regras!";
    exit;
}

$sql = "INSERT INTO utilizadores (nome, email, password) VALUES (:nome, :email, :password)";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':nome', $nome);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':password', $password);
$stmt->execute();

$_SESSION['ligado'] = true;
$_SESSION['user_id'] = $user->id;
$_SESSION['email']  = $user->email;
$_SESSION['nome']   = $user->nome;
$_SESSION['iniciais'] = strtoupper(substr($user->nome, 0, 1));
header('Location: ../index.php');
exit;
?>