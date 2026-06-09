<?php
    include "../../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $curso = $_POST['curso'];
        $aluno = $_POST['aluno'];
        $periodo = $_POST['periodo'];

        try{
            $cadastrar="INSERT INTO turmas (curso,aluno,periodo) VALUES ('$curso','$aluno','$periodo')";
            $env=$pdo->prepare($cadastrar);
            $env->execute();

            header("Location: ../../index.php?page=turmas.php");
            exit();
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>