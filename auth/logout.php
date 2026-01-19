<?php
session_start();

//Limpa todas as variáveis de sessão
$_SESSION = array(); 

session_destroy();

//Força o vencimento do cookie de sessão.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

$referencia = $_SERVER["HTTP_REFERER"] ?? "../index.php";

header("Location: $referencia");
exit;
?>