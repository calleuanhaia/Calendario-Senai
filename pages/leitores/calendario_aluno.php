<?php 
    include("config/config.php");

    $sql = "SELECT * FROM horarios ORDER BY id DESC";
    $consulta = $pdo->query($sql);
    
    
    $horarios = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

