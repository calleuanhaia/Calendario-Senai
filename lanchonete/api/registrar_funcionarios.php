<?php
    include "../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $nome = $_POST['nome_f'];
        $email = $_POST['email_f'];
        $senha = $_POST['senha_f'];
        $telefone = $_POST['telefone_f'];
        $trabalho = $_POST['trabalho_f'];


        try{
            $cadastrar="INSERT INTO funcionarios (nome,email,senha,telefone,trabalho) VALUES ('$nome','$email','$senha','$telefone','$trabalho')";
            $env=$pdo->prepare($cadastrar);
            $env->execute();

            header("Location: ../pages/register.php");
            exit();
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>