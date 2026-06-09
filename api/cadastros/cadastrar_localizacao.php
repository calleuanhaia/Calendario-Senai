<?php
    include "../../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $instituicao = $_POST['instituicao'];
        $sala = $_POST['sala'];
        $professor = $_POST['professor'];
        $turma = $_POST['turma'];
        $itens = $_POST['itens'];
        $tipo_sala = $_POST['tipo_sala'];

        try{
            $cadastrar="INSERT INTO localizacao (instituicao,sala,professor,turma,itens,tipo_sala) VALUES ('$instituicao','$sala','$professor','$turma','$itens','$tipo_sala')";
            $env=$pdo->prepare($cadastrar);
            $env->execute();

            header("Location: ../../index.php?page=localizacao.php");
            exit();
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>