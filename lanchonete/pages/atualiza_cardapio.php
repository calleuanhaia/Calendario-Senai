<?php

    include "config/config.php";

    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $sql="SELECT * FROM cardapio WHERE id=$id";
        $consulta=$pdo->prepare($sql);
        $consulta->execute();

        $cardapio=$consulta->fetch(PDO::FETCH_ASSOC);
    }

?>
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-xl mx-auto mt-6">
    
    <div class="mb-6 border-b border-gray-100 pb-4">
        <h2 class="text-xl font-bold text-gray-800">Atualização de Item no Cardápio</h2>
        <p class="text-sm text-gray-500 mt-1">Preencha os dados abaixo para atualizar os lanches e bebidas.</p>
    </div>

    <!-- Adicionei space-y-5 para dar o espaçamento automático entre os campos, substituindo os <br> -->
    <form method="POST" action="api/atualizar_cardapio.php" class="space-y-5">
    
    <input type="hidden" name="id" value="<?php echo isset($cardapio['id']) ? $cardapio['id'] : ''; ?>">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Lanches</label>
            <!-- Input com bordas arredondadas, fundo cinza claro que fica branco ao clicar, e anel de foco azul -->
            <input type="text" value="<?php echo $cardapio['lanches']; ?>" name="lanches" placeholder="Ex: X-Bacon, Hamburguer..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Bebidas</label>
            <input type="text" value="<?php echo $cardapio['bebidas']; ?>" name="bebidas" placeholder="Ex: Coca-Cola 2L, Suco de Laranja..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Preço do Lanche</label>
            <input type="text" value="<?php echo $cardapio['preco']; ?>" name="preco" placeholder="Ex: R$ 3,35, 5,50..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Preço da Bebida</label>
            <input type="text" value="<?php echo $cardapio['preco_bebida']; ?>" name="preco_b" placeholder="Ex: R$ 3,35, 5,50..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
        </div>

        <div class="pt-4 flex items-center justify-between">
            <!-- Botão de voltar (opcional, mas bom para a navegação) -->
            <button type="button" onclick="location.href='index.php?page=lista_cardapio.php'" class="px-4 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors cursor-pointer">
                Cancelar
            </button>
            
            <!-- Seu botão de registro estilizado -->
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm cursor-pointer">
                Atualizar Cardápio
            </button>
        </div>

    </form>
</div>