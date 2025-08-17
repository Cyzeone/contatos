<?php
require_once 'conexao.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: lixeira.php?msg=ID do contato não fornecido&tipo=error");
    exit;
}

$id = (int)$_GET['id'];

$sql = "DELETE FROM contatos WHERE id = $id";

if ($conexao->query($sql) === TRUE) {
    header("Location: lixeira.php?msg=Contato excluído permanentemente&tipo=success");
} else {
    header("Location: lixeira.php?msg=Erro ao excluir contato: " . $conexao->error . "&tipo=error");
}

$conexao->close();
?>
