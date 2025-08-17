<?php

$host = "localhost";      
$usuario = "root";        
$senha = "";              
$banco = "sistema_contatos"; 


$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}

$conexao->set_charset("utf8mb4");

function limpar_texto($texto) {
    global $conexao;
    $texto = trim($texto);
    $texto = htmlspecialchars($texto);
    $texto = $conexao->real_escape_string($texto);
    return $texto;
}
?>
