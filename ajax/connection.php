<?php 
$user = 'root';
$pass = '';
try {
    $dbh = new PDO('mysql:host=localhost;dbname=therecipe', $user, $pass);
} catch (PDOException $e) {}
?>