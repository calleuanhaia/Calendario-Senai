<?php
    include "../config/config.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $pedido_id = $_POST['pedido_id'];
        $tipo_pagamento = $_POST['tipo_pagamento'];
        
        // Pega o valor digitado e troca vírgula por ponto para fazer a matemática corretamente
        $valor_pago = str_replace(',', '.', $_POST['valor_pago']);

        try{
            // 1. Busca o preço original daquele pedido no banco de dados
            $sql_busca = "SELECT preco FROM clientes_f WHERE id = :id";
            $consulta = $pdo->prepare($sql_busca);
            $consulta->execute([':id' => $pedido_id]);
            $cliente = $consulta->fetch(PDO::FETCH_ASSOC);

            if($cliente) {
                $preco_banco = str_replace(',', '.', $cliente['preco']);

                // 2. Compara se o valor pago é menor que o preço no banco (converte para número float)
                if ((float)$valor_pago < (float)$preco_banco) {
                    // Valor abaixo! Retorna para o form passando um aviso na URL
                    header("Location: ../index.php?page=paga_pedido.php&id=$pedido_id&erro=valor_menor");
                    exit();
                }

                // 3. O valor é exato ou maior (passou na validação). Registra o pagamento!
                $cadastrar = "INSERT INTO pagamento (tipo_pagamento, preco) VALUES (:tipo, :preco)";
                $env = $pdo->prepare($cadastrar);
                $env->execute([
                    ':tipo' => $tipo_pagamento,
                    ':preco' => $valor_pago // ou você pode forçar a salvar $preco_banco caso não queira salvar o que sobrou de troco
                ]);

                // Redireciona com sucesso para a lista
                header("Location: ../index.php?page=lista_clientes_f.php");
                exit();

            } else {
                echo "Pedido não encontrado.";
            }
            
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>