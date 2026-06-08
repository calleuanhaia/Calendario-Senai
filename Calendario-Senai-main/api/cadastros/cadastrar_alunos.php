<?php
    include "../../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $matricula = $_POST['matricula'];
        $senha = $_POST['senha'];

        try{
            $cadastrar="INSERT INTO alunos (nome,email,senha,matricula) VALUES ('$nome','$email','$senha',$matricula)";
            $env=$pdo->prepare($cadastrar);
            $env->execute();

            header("Location: ../../index.php");
            exit();
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>