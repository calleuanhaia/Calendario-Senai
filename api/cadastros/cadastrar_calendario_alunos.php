<?php
    include "../../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $data = $_POST['data'];
        $time = $_POST['time'];
        $professor = $_POST['professor'];
        $curso = $_POST['curso'];

        try{
            $cadastrar="INSERT INTO horarios (horario_data,horario_hora,horario_professor,horario_curso) VALUES ('$data','$time','$professor','$curso')";
            $env=$pdo->prepare($cadastrar);
            $env->execute();

            header("Location: ../../index.php?page=calendario_aluno.php");
            exit();
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>