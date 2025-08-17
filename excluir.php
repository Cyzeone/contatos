<?php
require_once 'conexao.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?msg=ID do contato não fornecido&tipo=error");
    exit;
}

$id = (int)$_GET['id'];

$sql = "UPDATE contatos SET 
        status = 'excluido', 
        data_exclusao = NOW() 
        WHERE id = $id";

if ($conexao->query($sql) === TRUE) {
    header("Location: index.php?msg=Contato movido para a lixeira&tipo=success");
} else {
    header("Location: index.php?msg=Erro ao excluir contato: " . $conexao->error . "&tipo=error");
}

$conexao->close();
?>
