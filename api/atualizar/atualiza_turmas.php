<?php
    include "../../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        //guarda as informações do formulario em variáveis
        $id = $_POST['id'];
        $curso = $_POST['curso'];
        $aluno = $_POST['aluno'];
        $periodo = $_POST['periodo'];

        try{
            //preparar comando de inserção no banco
            $salvar="UPDATE turmas SET curso = '$curso', aluno = '$aluno', periodo = '$periodo' WHERE id=$id";
            $env=$pdo->prepare($salvar);
            $env->execute();

            //redireciona para algum lugar
            header("Location: ../../index.php?page=turmas.php");
            exit();
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>