<?php
    include "../config/config.php";

    // verificar se estamos recebendo a tabela e o id de exclusão
    if(isset($_GET['table']) && isset($_GET['id'])){
        $table = $_GET['table'];
        $id = $_GET['id'];

        try{
            $delete="DELETE FROM $table WHERE id = $id";
            $comando=$pdo->prepare($delete);
            $comando->execute();

            header("Location: ../index.php?page=lista_".$table.".php");
        } catch (PDOException $e) {
            echo "Deu erro";
        }
    } else{
        
    }

?>