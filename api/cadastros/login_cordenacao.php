<?php
    session_start();
    include "../../config/config.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = $_POST['login-id'];
        $password = $_POST['password'];

        try {
            $selecionar = "SELECT nome, email FROM cordenacao WHERE email = :email AND senha = :senha";
            $select = $pdo->prepare($selecionar);
            $select->execute([
                ':email' => $email, 
                ':senha' => $password
            ]);

            $usuario = $select->fetch(PDO::FETCH_ASSOC);

            if($usuario){
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_email'] = $usuario['email'];
                $_SESSION['usuario_tipo'] = 'coordenacao';

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