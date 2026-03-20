<?php
session_start();
$host = 'localhost';  // ou o endereço do seu servidor
$dbname = 'candy'; // substitua com o nome do seu banco de dados
$username = 'root'; // seu usuário MySQL
$password = ''; // sua senha MySQL

// Conexão com o banco de dados
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura as variáveis de POST
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta no banco para verificar se o e-mail existe
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        
        // Verifica se a senha digitada corresponde à senha armazenada
        if (password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido, cria uma sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_email'] = $usuario['email'];
            header('Location: dashboard.php'); // Redireciona para o painel de controle ou página inicial
            exit();
        } else {
            // Senha incorreta
            echo "<script>alert('Senha incorreta');</script>";
        }
    } else {
        // Usuário não encontrado
        echo "<script>alert('Usuário não encontrado');</script>";
    }
}

$conn->close();
?>









<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Candy Love's</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Candy Love's</h1>
            <img src="https://i.pinimg.com/736x/40/2b/e4/402be4a859fd33d361fe0992accda514.jpg" alt="Cupcake" width="150" height="150"> 
        </div>
        <div class="form-container">
            <h2>Login</h2>
            <form id="login-form">
                <input type="email" id="email" placeholder="E-mail" required>
                <input type="password" id="password" placeholder="Senha" required>
                <button type="submit">Entrar</button>
            </form>
            <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>