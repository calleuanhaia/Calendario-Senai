<?php
    include "../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        //guarda as informações do formulario em variáveis
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        $pedido = $_POST['pedido'];
        $preco = $_POST['preco'];


        try{
            //preparar comando de inserção no banco
            $salvar="UPDATE clientes_f SET nome = '$nome', telefone = '$telefone', endereco = '$endereco', pedido = '$pedido', preco = '$preco' WHERE id=$id";
            $env=$pdo->prepare($salvar);
            $env->execute();

            //redireciona para algum lugar
            header("Location: ../index.php?page=lista_clientes_f.php");
            exit();
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>