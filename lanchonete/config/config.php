<?php
// 1. Configurações de conexão com o banco de dados
$host = 'localhost';
$dbname = 'lanchemaster'; // Substitua pelo nome do seu banco de dados
$username = 'root';     // Substitua pelo seu usuário do MySQL
$password = 'senai';         // Substitua pela sua senha do MySQL

// 2. Estabelecendo a conexão com PDO
try {
    // A string de conexão (DSN) define o banco e o charset
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Configura o PDO para lançar exceções em caso de erros (facilita o debug)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

?>