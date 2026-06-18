<?php
    // recebendo da url a página a ser exibida
    // $_GET serve para procurar e pegar elementos da variável que vão após o "?"

    // para criar uma página nova no sistema devemos:
    // 1 - criar um novo arquivo para a página dentro da pasta "pages"
    // 2 - adicionar o botão no menu lateral ("sidebar.php") que é a tag "<a>"
    // 3 - adicionar o link da página criada no "href" da tag "<a>" criada, por exemplo: index.php?page=NOME_DA_SUA_PAGINA.php

    if(isset($_GET['page'])){
        $page = $_GET['page']; 
    } else{
        $page = "exemplo.php";
    }

    // código inicial do site
    include "template/header.php";

    // conteudo do site que são os arquivos da pasta pages
    include "pages/" .$page;

    // código do final do site e fechamentos
    include "template/footer.php";
?>