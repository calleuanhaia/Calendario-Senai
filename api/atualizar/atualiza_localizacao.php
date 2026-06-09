<?php
    include "../../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        //guarda as informações do formulario em variáveis
        $id = $_POST['id'];
        $instituicao = $_POST['instituicao'];
        $sala = $_POST['sala'];
        $professor = $_POST['professor'];
        $turma = $_POST['turma'];
        $itens = $_POST['itens'];
        $tipo_sala = $_POST['tipo_sala'];

        try{
            //preparar comando de inserção no banco
            $salvar="UPDATE localizacao SET instituicao = '$instituicao', sala = '$sala', professor = '$professor', turma = '$turma', itens = '$itens', tipo_sala = '$tipo_sala' WHERE id=$id";
            $env=$pdo->prepare($salvar);
            $env->execute();

            //redireciona para algum lugar
            header("Location: ../../index.php?page=localizacao.php");
            exit();
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>