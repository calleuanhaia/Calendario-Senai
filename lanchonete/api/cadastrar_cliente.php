<?php
    include "../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        $pedido = $_POST['pedido'];
        $pedido_B = $_POST['pedido_b'];
        $preco = $_POST['preco'];
        $preco_b = $_POST['preco_b'];

        try{
            $cadastrar="INSERT INTO clientes_f (nome,telefone,endereco,lanche,bebida,preco,preco_bebida) VALUES ('$nome','$telefone','$endereco','$pedido','$pedido_B','$preco','$preco_b')";
            $env=$pdo->prepare($cadastrar);
            $env->execute();

            header("Location: ../index.php?page=lista_clientes_f.php");
            exit();
            
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>