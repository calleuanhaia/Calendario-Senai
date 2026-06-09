<?php
    session_start();
    include "../../config/config.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $idp = $_POST['login-id'];
        $email = $_POST['login-id'];
        $password = $_POST['password'];

        try {
            $selecionar = "SELECT nome, email FROM professores WHERE idp = :idp AND senha = :senha OR email = :email";
            $select = $pdo->prepare($selecionar);
            $select->execute([
                ':idp' => $idp, 
                ':senha' => $password,
                ':email' => $email
            ]);

            $usuario = $select->fetch(PDO::FETCH_ASSOC);

            if($usuario){
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_email'] = $usuario['email'];
                $_SESSION['usuario_tipo'] = 'professor';

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