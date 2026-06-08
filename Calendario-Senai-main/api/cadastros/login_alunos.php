<?php
    // Inicia a sessão no topo do arquivo
    session_start();
    include "../../config/config.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $matricula = $_POST['login-id'];
        $password = $_POST['password'];

        try {
            // Utilizando prepared statements para evitar SQL Injection
            $selecionar = "SELECT nome, email FROM alunos WHERE matricula = :matricula AND senha = :senha";
            $select = $pdo->prepare($selecionar);
            $select->execute([
                ':matricula' => $matricula, 
                ':senha' => $password
            ]);

            // fetch(PDO::FETCH_ASSOC) traz um array com 'nome' e 'email' se encontrar, ou false se não encontrar
            $usuario = $select->fetch(PDO::FETCH_ASSOC);

            if($usuario){
                // Salva os dados na sessão
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_email'] = $usuario['email'];
                $_SESSION['usuario_tipo'] = 'aluno'; // Identifica de onde veio

                header("Location: ../../index.php");
                exit();
            } else {
                header("Location: ../../login.php?erro=credenciais");
                exit();
            }
        } catch (PDOException $e){
            echo "Erro ao logar: " . $e->getMessage();
        }
    }
?>