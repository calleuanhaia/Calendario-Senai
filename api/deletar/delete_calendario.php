<?php
    include "../../config/config.php";

    // verificar se estamos recebendo a tabela e o id de exclusão
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        try{
            $delete="DELETE FROM horarios WHERE id = $id";
            $comando=$pdo->prepare($delete);
            $comando->execute();

            header("Location: ../../index.php?page=calendario_aluno.php");
        } catch (PDOException $e) {
            echo "Deu erro";
        }
    } else{
        
    }

?>