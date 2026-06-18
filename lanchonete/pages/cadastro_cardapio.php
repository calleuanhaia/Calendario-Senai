<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-xl mx-auto mt-6">
    
    <div class="mb-6 border-b border-gray-100 pb-4">
        <h2 class="text-xl font-bold text-gray-800">Novo Item no Cardápio</h2>
        <p class="text-sm text-gray-500 mt-1">Preencha os dados abaixo para registrar novos lanches e bebidas.</p>
    </div>

    <!-- Adicionei space-y-5 para dar o espaçamento automático entre os campos, substituindo os <br> -->
    <form method="POST" action="api/cadastrar_cardapio.php" class="space-y-5">
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Lanches</label>
            <!-- Input com bordas arredondadas, fundo cinza claro que fica branco ao clicar, e anel de foco azul -->
            <input type="text" name="lanches" placeholder="Ex: X-Bacon, Hamburguer..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Bebidas</label>
            <input type="text" name="bebidas" placeholder="Ex: Coca-Cola 2L, Suco de Laranja..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Preço do Lanche</label>
            <input type="text" name="preco" placeholder="Ex: R$ 3,35, 5,50..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Preço da Bebida</label>
            <input type="text" name="preco_b" placeholder="Ex: R$ 3,35, 5,50..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
        </div>

        <div class="pt-4 flex items-center justify-between">
            <!-- Botão de voltar (opcional, mas bom para a navegação) -->
            <button type="button" onclick="location.href='index.php?page=lista_cardapio.php'" class="px-4 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors cursor-pointer">
                Cancelar
            </button>
            
            <!-- Seu botão de registro estilizado -->
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm cursor-pointer">
                Cadastro Cardápio
            </button>
        </div>

    </form>
</div>