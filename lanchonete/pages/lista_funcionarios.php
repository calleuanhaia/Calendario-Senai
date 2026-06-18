<?php
    include "config/config.php";
    
    $sql="SELECT * FROM funcionarios WHERE trabalho = 'Delivery' OR trabalho = 'delivery' ORDER BY id DESC";
    $consulta=$pdo->query($sql);
    $funcionarios=$consulta->fetchAll(PDO::FETCH_ASSOC);

    if(!isset($_SESSION['usuario_nome'])) {
        header("Location: register.php");
        exit();
    }

    $nome = $_SESSION['usuario_nome'];
    $email = $_SESSION['usuario_email'];
    $tipo = $_SESSION['usuario_tipo'];
?>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8 w-full">
    
    <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Pedidos e funcionarios</h2>
            <p class="text-sm text-gray-500 mt-1">Gerencie os pedidos registrados no sistema.</p>
        </div>
        
        <button onclick="location.href='index.php?page=cadastro_funcionario.php'" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition-colors flex items-center whitespace-nowrap">
            <i class="fa-solid fa-plus mr-2"></i> Adicionar Pedido
        </button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                    <th class="px-6 py-3 font-medium">ID</th>
                    <th class="px-6 py-3 font-medium">Nome</th>
                    <th class="px-6 py-3 font-medium">Telefone</th>
                    <th class="px-6 py-3 font-medium">Trabalho</th>
                    <th class="px-6 py-3 font-medium">Ações</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                <?php foreach ($funcionarios as $funcionario): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            #<?php echo $funcionario['id']; ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800">
                            <?php echo $funcionario['nome']; ?>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            <?php echo $funcionario['telefone']; ?>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            <?php echo $funcionario['trabalho']; ?>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            <a href="api/delete.php?table=funcionarios&id=<?php echo $funcionario['id']; ?>" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 font-medium text-xs rounded-lg transition-colors cursor-pointer border border-red-100">
                                Excluir
                            </a>
                            <a href="index.php?page=atualiza_pedidos.php&id=<?php echo $funcionario['id']; ?>" class="inline-flex items-center px-3 py-1.5 bg-green-50 text-green-600 hover:bg-green-100 hover:text-green-700 font-medium text-xs rounded-lg transition-colors cursor-pointer border border-green-100">
                                Editar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>