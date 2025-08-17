<?php
require_once 'conexao.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: lixeira.php?msg=ID do contato não fornecido&tipo=error");
    exit;
}

$id = (int)$_GET['id'];

$sql = "UPDATE contatos SET 
        status = 'ativo', 
        data_exclusao = NULL 
        WHERE id = $id";

if ($conexao->query($sql) === TRUE) {
    header("Location: lixeira.php?msg=Contato restaurado com sucesso&tipo=success");
} else {
    header("Location: lixeira.php?msg=Erro ao restaurar contato: " . $conexao->error . "&tipo=error");
}

$conexao->close();
?>
