<?php
require_once 'conexao.php';

$titulo = "Lista de Contatos";

$termo_busca = isset($_GET['busca']) ? limpar_texto($_GET['busca']) : '';

if (!empty($termo_busca)) {
    $sql = "SELECT * FROM contatos WHERE 
            status = 'ativo' AND 
            (nome LIKE '%$termo_busca%' OR 
             email LIKE '%$termo_busca%' OR 
             telefone LIKE '%$termo_busca%')
            ORDER BY nome";
} else {
    $sql = "SELECT * FROM contatos WHERE status = 'ativo' ORDER BY nome";
}

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

        .search-bar {
            display: flex;
            margin-bottom: 20px;
        }

        .search-input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 4px 0 0 4px;
            font-size: 16px;
            background-color: #333;
            color: #f8f8f2;
        }

        .search-button {
            background-color: #03dac6;
            color: #212121;
            border: none;
            padding: 10px 15px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .search-button:hover {
            background-color: #018786;
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

        .add-button-fixed {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #03dac6;
            color: #212121;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .add-button-fixed:hover {
            background-color: #018786;
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

        <form action="index.php" method="GET">
            <div class="search-bar">
                <input type="text" name="busca" class="search-input" placeholder="Buscar contato..." value="<?php echo htmlspecialchars($termo_busca); ?>">
                <button type="submit" class="search-button">Buscar</button>
            </div>
        </form>

        <h2>Meus Contatos</h2>
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
                    echo '<a href="editar.php?id=' . $contato['id'] . '">Editar</a> | ';
                    echo '<a href="excluir.php?id=' . $contato['id'] . '" onclick="return confirm(\'Deseja mover este contato para a lixeira?\')">Excluir</a>';
                    echo '</div>';
                    echo '</li>';
                }
            } else {
                echo '<li class="contact-item">Nenhum contato encontrado</li>';
            }
            ?>
        </ul>
    </div>

    <a href="adicionar.php" class="add-button-fixed">+</a>
</body>
</html>

<?php
$conexao->close();
?>
