<?php
    // comunicar com o banco
    include "../config/config.php";

    // ver se estamos recebendo no servidor um metodo de requisição do tipo post
    if($_SERVER['REQUEST_METHOD']=="POST"){
        // receber as informações do formulario pelo metodo post
        $lanches=$_POST['lanches']; 
        $bebidas=$_POST['bebidas']; 
        $preco = $_POST['preco'];
        $preco_b = $_POST['preco_b'];

        // tentar realizar o cadastro no banco
        try{
            $sql="INSERT INTO cardapio (lanches, bebidas, preco, preco_bebida) VALUES ('$lanches', '$bebidas', $preco, $preco_b)";
            $insert=$pdo->prepare($sql);
            $insert->execute();

            header("Location: ../index.php?page=lista_cardapio.php");
            exit();
        } catch(PDOException $e){
            echo "Erro ao cadastrar".$e->getMessage();
        }

    }else{
        header("Location: ../index.php");
        exit();
    }

?>