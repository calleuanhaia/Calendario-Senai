<?php
    include "../../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        //guarda as informações do formulario em variáveis
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['password'];
        $matricula = $_POST['login-id'];

        try{
            //preparar comando de inserção no banco
            $salvar="UPDATE alunos SET nome = '$nome', email = '$email', senha = '$senha', matricula = $matricula WHERE id=$id";
            $env=$pdo->prepare($salvar);
            $env->execute();

            //redireciona para algum lugar
            header("Location: ../../index.php?page=atualizar_alunos.php");
            exit();
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>