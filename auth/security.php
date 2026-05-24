<?php
session_start();
// para sempre iniciar a url do inicio, para evitar que se outros arquivos usar o security.php além do index.php 
// não dê erro de página 404
if (empty($_SESSION["username"])) {
    $protocolo = "";
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
        $protocolo = "https://";
    } else {
        $protocolo = "http://";
    }
    $host = $_SERVER['HTTP_HOST'] ;
    header ("Location: " . $protocolo . $host . "/auth/login.php") ;
    exit();
}
?>