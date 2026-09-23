<?php

$host = "192.168.10.75";
$usuario = "postgres";
$senha = "M3g@staraptor";
$banco = "chamadomanutencao";

$pdo = new PDO(
    "pgsql:host=$host;port=5432;dbname=$banco",
    $usuario,
    $senha
);