<?php
    include "../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $nome = $_POST['nome_c'];
        $email = $_POST['email_c'];
        $senha = $_POST['senha_c'];
        $telefone = $_POST['telefone_c'];
        $endereco = $_POST['endereco_c'];


        try{
            $cadastrar="INSERT INTO clientes (nome,email,senha,telefone,endereco) VALUES ('$nome','$email','$senha','$telefone','$endereco')";
            $env=$pdo->prepare($cadastrar);
            $env->execute();

            header("Location: ../pages/register.php");
            exit();
            
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>