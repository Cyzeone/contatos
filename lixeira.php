<?php
require_once 'conexao.php';

$titulo = "Lixeira de Contatos";

$sql = "SELECT * FROM contatos WHERE status = 'excluido' ORDER BY data_exclusao DESC";

$resultado = $conexao->query($sql);

if (!$resultado) {
    die("Erro na consulta: " . $conexao->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #121212;
            color: #f8f8f2;
            margin: 0;
            padding-bottom: 60px;
        }

        .navbar {
            background-color: #212121;
            color: #f8f8f2;
            padding: 15px 0;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 100;
            border-bottom: 1px solid #333;
        }

        .navbar a {
            color: #f8f8f2;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        .container {
            max-width: 800px;
            margin: 80px auto 20px;
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        h2 {
            color: #f8f8f2;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .contact-list {
            list-style: none;
            padding: 0;
        }

        .contact-item {
            border-bottom: 1px solid #333;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .contact-item:last-child {
            border-bottom: none;
        }

        .contact-details {
            flex-grow: 1;
        }

        .contact-name {
            font-weight: bold;
            margin-bottom: 5px;
            color: #f8f8f2;
        }

        .contact-info {
            color: #bbb;
            font-size: 0.9em;
        }

        .actions a {
            margin-left: 10px;
            text-decoration: none;
            color: #03dac6;
        }

        .actions a:hover {
            text-decoration: underline;
            color: #018786;
        }

        .empty-trash {
            color: #bbb;
            text-align: center;
            font-style: italic;
            padding: 20px 0;
        }

        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            text-align: center;
        }

        .success {
            background-color: #004d40;
            color: #a7ffeb;
            border: 1px solid #00796d;
        }

        .error {
            background-color: #b71c1c;
            color: #ffcdd2;
            border: 1px solid #c62828;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php">Contatos</a>
        <a href="adicionar.php">Adicionar Novo</a>
        <a href="lixeira.php">🗑️ Lixeira</a>
    </nav>

    <div class="container">
        <?php
        if (isset($_GET['msg'])) {
            $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'success';
            echo '<div class="message ' . $tipo . '">' . htmlspecialchars($_GET['msg']) . '</div>';
        }
        ?>

        <h2>Lixeira de Contatos</h2>
        <ul class="contact-list">
            <?php
            if ($resultado->num_rows > 0) {
                while ($contato = $resultado->fetch_assoc()) {
                    echo '<li class="contact-item">';
                    echo '<div class="contact-details">';
                    echo '<div class="contact-name">' . htmlspecialchars($contato['nome']) . '</div>';
                    echo '<div class="contact-info">' . 
                         (empty($contato['email']) ? '' : htmlspecialchars($contato['email'])) . ' | ' . 
                         (empty($contato['telefone']) ? '' : htmlspecialchars($contato['telefone'])) . '</div>';
                    echo '</div>';
                    echo '<div class="actions">';
                    echo '<a href="restaurar.php?id=' . $contato['id'] . '" onclick="return confirm(\'Deseja restaurar este contato?\')">Restaurar</a> | ';
                    echo '<a href="excluir_permanente.php?id=' . $contato['id'] . '" onclick="return confirm(\'Deseja excluir permanentemente este contato? Esta ação não pode ser desfeita.\')">Excluir Perm.</a>';
                    echo '</div>';
                    echo '</li>';
                }
            } else {
                echo '<li class="empty-trash">A lixeira está vazia</li>';
            }
            ?>
        </ul>
    </div>
</body>
</html>

<?php
$conexao->close();
?>
