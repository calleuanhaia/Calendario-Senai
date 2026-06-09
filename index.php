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
        $page = "calendario_aluno.php";
    }

    // código inicial do site
    include "templates/header.php";

    // --- VERIFICAÇÃO DINÂMICA DE PASTAS ---
    
    // Definimos os caminhos possíveis para o arquivo
    $caminho_leitores  = "pages/leitores/" . $page;
    $caminho_atualizar  = "pages/atualizar/" . $page;
    $caminho_cadastrar = "pages/cadastros/" . $page; // Altere para "cadastro" se o nome da sua pasta for esse
    $caminho_raiz_pages = "pages/" . $page;          // Caso o arquivo esteja direto na pasta pages

    // O sistema testa onde o arquivo realmente está antes de incluí-lo
    if (file_exists($caminho_leitores)) {
        include $caminho_leitores;
    } elseif (file_exists($caminho_cadastrar)) {
        include $caminho_cadastrar;
    } elseif (file_exists($caminho_atualizar)) {
        include $caminho_atualizar;
    } elseif (file_exists($caminho_raiz_pages)) {
        include $caminho_raiz_pages;
    } else {
        // Se não encontrar em nenhuma das pastas, mostra um erro amigável em vez de quebrar a página
        echo "<div style='padding: 20px; color: red;'><strong>Erro 404:</strong> A página '" . htmlspecialchars($page) . "' não foi encontrada em nenhuma das pastas configuradas.</div>";
    }

    // código do final do site e fechamentos
    include "templates/footer.php";
?>