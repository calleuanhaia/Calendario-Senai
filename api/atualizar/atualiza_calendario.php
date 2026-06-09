<?php
    include "../../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        //guarda as informações do formulario em variáveis
        $id = $_POST['id'];
        $horario_data = $_POST['horario_data'];
        $horario_hora = $_POST['horario_hora'];
        $horario_professor = $_POST['horario_professor'];
        $horario_curso = $_POST['horario_curso'];

        try{
            //preparar comando de inserção no banco
            $salvar="UPDATE horarios SET horario_data = '$horario_data', horario_hora = '$horario_hora', horario_professor = '$horario_professor', horario_curso = '$horario_curso' WHERE id=$id";
            $env=$pdo->prepare($salvar);
            $env->execute();

            //redireciona para algum lugar
            header("Location: ../../index.php?page=calendario_aluno.php");
            exit();
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>