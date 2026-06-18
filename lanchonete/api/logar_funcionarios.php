<?php
    // Inicia a sessão no topo do arquivo
    session_start();
    include "../config/config.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['log-nome'];
        $email = $_POST['log-nome'];
        $senha = $_POST['log-senha'];

        try {
            // Utilizando prepared statements para evitar SQL Injection
            $selecionar = "SELECT nome, email FROM funcionarios WHERE nome = :nome AND senha = :senha or email = :email";
            $select = $pdo->prepare($selecionar);
            $select->execute([
                ':nome' => $nome, 
                ':email' => $email,
                ':senha' => $senha
            ]);

            // fetch(PDO::FETCH_ASSOC) traz um array com 'nome' e 'email' se encontrar, ou false se não encontrar
            $usuario = $select->fetch(PDO::FETCH_ASSOC);

            if($usuario){
                // Salva os dados na sessão
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_email'] = $usuario['email'];
                $_SESSION['usuario_tipo'] = 'funcionario'; // Identifica de onde veio

                header("Location: ../index.php");
                exit();
            } else {
                header("Location: ../pages/register.php?erro=credenciais");
                exit();
            }
        } catch (PDOException $e){
            echo "Erro ao logar: " . $e->getMessage();
        }
    }
?>