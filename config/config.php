<?php
$host = 'localhost';
$db = 'barbearia_db';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user , $pass);
} catch (PDOExpection $e) {
    die("Erro ao conectar com o banco: " . $e->getMessage());
}