<?php
    include "../../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        try{
            $cadastrar="INSERT INTO cordenacao (nome,email,senha) VALUES ('$nome','$email','$senha')";
            $env=$pdo->prepare($cadastrar);
            $env->execute();

            header("Location: ../../index.php");
            exit();
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>