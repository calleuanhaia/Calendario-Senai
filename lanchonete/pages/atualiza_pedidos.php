<?php

    include "config/config.php";

    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $sql="SELECT * FROM clientes_f WHERE id=$id";
        $consulta=$pdo->prepare($sql);
        $consulta->execute();

        $cliente=$consulta->fetch(PDO::FETCH_ASSOC);
    }

?>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8 max-w-2xl">
    
    <div class="px-6 py-5 border-b border-gray-100">
        <h2 class="text-lg font-semibold text-gray-900">Atualizar seu Pedido</h2>
        <p class="text-sm text-gray-500 mt-1">Confirme seus dados e insira o que deseja atualizar.</p>
    </div>

    <div class="p-6">
        <form method="POST" action="api/atualizar_pedidos.php" class="space-y-5">
            <input type="hidden" name="id" value="<?php echo isset($cliente['id']) ? $cliente['id'] : ''; ?>">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                <input name="nome" value="<?php echo isset($cliente['nome']) ? $cliente['nome'] : '';?>" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors text-gray-900">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                <input name="telefone" value="<?php echo isset($cliente['telefone']) ? $cliente['telefone'] : '';?>" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors text-gray-900">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Endereço</label>
                <input name="endereco" value="<?php echo isset($cliente['endereco']) ? $cliente['endereco'] : '';?>" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors text-gray-900">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pedido</label>
                <input name="pedido" value="<?php echo isset($cliente['pedido']) ? $cliente['pedido'] : '';?>" placeholder="Ex: 1x X-Tudo, 2x Guarana Lata..." class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors text-gray-900 placeholder-gray-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Preço</label>
                <input name="preco" value="<?php echo isset($cliente['preco']) ? $cliente['preco'] : '';?>" placeholder="Ex: R$ 3.50..." class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors text-gray-900 placeholder-gray-400">
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="w-full sm:w-auto bg-orange-500 hover:bg-orange-600 text-white px-6 py-2.5 rounded-lg text-sm font-semibold shadow-sm transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-paper-plane mr-2"></i> Atualizar Pedido
                </button>
            </div>
        </form>
    </div>
</div>