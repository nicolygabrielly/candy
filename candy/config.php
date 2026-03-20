<?php
// Definições de configuração do banco de dados
define('DB_HOST', 'localhost');          // Host do banco de dados (normalmente localhost)
define('DB_NAME', 'seu_banco_de_dados'); // Nome do banco de dados
define('DB_USER', 'root');               // Usuário do banco de dados
define('DB_PASS', '');                   // Senha do banco de dados (vazia no caso local)
define('DB_CHARSET', 'utf8mb4');         // Charset utilizado no banco (UTF-8 recomendado)

// Criação da conexão com o banco de dados utilizando PDO
try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilita exceções em caso de erro
} catch (PDOException $e) {
    // Caso haja erro na conexão, exibe a mensagem
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Configurações adicionais (se necessário)
define('SITE_URL', 'http://localhost/seu_projeto'); // URL do seu site (ajustar conforme seu ambiente)