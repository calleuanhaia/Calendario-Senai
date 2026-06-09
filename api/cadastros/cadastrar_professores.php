<?php
    include "../../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $idp = $_POST['idp'];

        try{
            $cadastrar="INSERT INTO professores (nome,email,senha,idp) VALUES ('$nome','$email','$senha',$idp)";
            $env=$pdo->prepare($cadastrar);
            $env->execute();

            header("Location: ../../login.php");
            exit();
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>