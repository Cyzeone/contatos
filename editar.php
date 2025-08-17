<?php
require_once 'conexao.php';

$titulo = "Editar Contato";

$mensagem = '';
$tipo_mensagem = '';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?msg=ID do contato não fornecido&tipo=error");
    exit;
}

$id = (int)$_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = limpar_texto($_POST['nome']);
    $email = limpar_texto($_POST['email']);
    $telefone = limpar_texto($_POST['telefone']);
    
    if (empty($nome)) {
        $mensagem = "O nome é obrigatório!";
        $tipo_mensagem = "error";
    } else {
        $sql = "UPDATE contatos SET 
                nome = '$nome', 
                email = '$email', 
                telefone = '$telefone', 
                data_atualizacao = NOW() 
                WHERE id = $id";
        
        if ($conexao->query($sql) === TRUE) {
            header("Location: index.php?msg=Contato atualizado com sucesso!&tipo=success");
            exit;
        } else {
            $mensagem = "Erro ao atualizar contato: " . $conexao->error;
            $tipo_mensagem = "error";
        }
    }
}

$sql = "SELECT * FROM contatos WHERE id = $id";
$resultado = $conexao->query($sql);

if ($resultado->num_rows == 0) {
    header("Location: index.php?msg=Contato não encontrado&tipo=error");
    exit;
}

$contato = $resultado->fetch_assoc();
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 400px;
            max-width: 90%;
            margin-top: 60px;
        }

        h1 {
            text-align: center;
            color: #f8f8f2;
            margin-bottom: 20px;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #bbb;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #333;
            color: #f8f8f2;
        }

        button[type="submit"] {
            background-color: #03dac6;
            color: #212121;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #018786;
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

        .message {
            margin-top: 20px;
            padding: 15px;
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
        <h1>Editar Contato</h1>
        
        <?php if (!empty($mensagem)): ?>
            <div class="message <?php echo $tipo_mensagem; ?>">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($contato['nome']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Endereço de Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($contato['email']); ?>">
            </div>
            <div class="form-group">
                <label for="telefone">Número de Telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($contato['telefone']); ?>">
            </div>
            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>

<?php
$conexao->close();
?>
