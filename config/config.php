<?php
ob_start(); // Garante que nenhum espaço ou HTML quebre os redirecionamentos header()

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = 'db';
$db = 'barber_control';
$user = 'root';
$pass = 'root';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user , $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar com o banco: " . $e->getMessage());
}
