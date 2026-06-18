<?php
    include "../config/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        //guarda as informações do formulario em variáveis
        $id = $_POST['id'];
        $lanches = $_POST['lanches'];
        $bebidas = $_POST['bebidas'];
        $preco = $_POST['preco'];

        try{
            //preparar comando de inserção no banco
            $salvar="UPDATE cardapio SET lanches = '$lanches', bebidas = '$bebidas', preco = $preco WHERE id=$id";
            $env=$pdo->prepare($salvar);
            $env->execute();

            //redireciona para algum lugar
            header("Location: ../index.php?page=lista_cardapio.php");
            exit();
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>