<?php
    include "config/config.php";
    
    $sql="SELECT * FROM cardapio ORDER BY id DESC";
    $consulta=$pdo->query($sql);
    $cardapios=$consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-x-auto">
    <!-- Adicionei margens (m-6), cor azul, cantos arredondados e transição ao botão novo -->
    <button onclick="location.href='index.php?page=cadastro_cardapio.php'" class="m-6 px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm cursor-pointer">
        Adicionar no Cardápio
    </button>
    
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Lanches</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Bebidas</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Preço do Lanche</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Preço da Bebida</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php foreach ($cardapios as $cardapio): ?>
                <tr class="hover:bg-gray-50/80 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        #<?php echo $cardapio['id']; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        <?php echo $cardapio['lanches']; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        <?php echo $cardapio['bebidas']; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        <?php echo "R$ ". $cardapio['preco']; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        <?php echo "R$ ". $cardapio['preco_b']; ?>
                    </td>
                    <!-- Adicionei 'space-x-2' no <td> para dar um pequeno espaço entre os dois botões -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right space-x-2">
                        <a href="api/delete.php?table=cardapio&id=<?php echo $cardapio['id']; ?>" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 font-medium text-xs rounded-lg transition-colors cursor-pointer border border-red-100">
                            Excluir
                        </a>
                        <a href="index.php?page=atualiza_cardapio.php&id=<?php echo $cardapio['id']; ?>" class="inline-flex items-center px-3 py-1.5 bg-green-50 text-green-600 hover:bg-green-100 hover:text-green-700 font-medium text-xs rounded-lg transition-colors cursor-pointer border border-green-100">
                            Editar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>