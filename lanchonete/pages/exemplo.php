        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4 sm:p-6 lg:p-8">
            
            <div class="flex justify-between items-end mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Visão Geral</h1>
                    <p class="text-sm text-gray-500 mt-1">Acompanhe o desempenho da sua lanchonete hoje.</p>
                </div>
                <!-- Mobile Only New Order Button -->
                <button class="sm:hidden bg-orange-500 hover:bg-orange-600 text-white w-10 h-10 rounded-full shadow-lg flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <i class="fa-solid fa-dollar-sign text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Faturamento do Dia</p>
                            <p class="text-2xl font-semibold text-gray-900">R$ 1.240,50</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-500 font-medium flex items-center"><i class="fa-solid fa-arrow-up text-xs mr-1"></i> 12%</span>
                        <span class="text-gray-400 ml-2">vs ontem</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                            <i class="fa-solid fa-receipt text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Pedidos Hoje</p>
                            <p class="text-2xl font-semibold text-gray-900">45</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-500 font-medium flex items-center"><i class="fa-solid fa-arrow-up text-xs mr-1"></i> 5%</span>
                        <span class="text-gray-400 ml-2">vs ontem</span>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <i class="fa-solid fa-ticket text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Ticket Médio</p>
                            <p class="text-2xl font-semibold text-gray-900">R$ 27,50</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-red-500 font-medium flex items-center"><i class="fa-solid fa-arrow-down text-xs mr-1"></i> 2%</span>
                        <span class="text-gray-400 ml-2">vs ontem</span>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                            <i class="fa-solid fa-star text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Clientes Novos</p>
                            <p class="text-2xl font-semibold text-gray-900">8</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-gray-500 font-medium flex items-center"><i class="fa-solid fa-minus text-xs mr-1"></i> 0%</span>
                        <span class="text-gray-400 ml-2">vs ontem</span>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">Pedidos Recentes</h2>
                    <a href="#" class="text-sm font-medium text-orange-500 hover:text-orange-600">Ver todos</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                                <th class="px-6 py-3 font-medium">ID Pedido</th>
                                <th class="px-6 py-3 font-medium">Cliente</th>
                                <th class="px-6 py-3 font-medium">Itens</th>
                                <th class="px-6 py-3 font-medium">Total</th>
                                <th class="px-6 py-3 font-medium">Status</th>
                                <th class="px-6 py-3 font-medium text-right">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <!-- Linha 1 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">#1024</td>
                                <td class="px-6 py-4">João Silva <span class="block text-xs text-gray-500">Mesa 04</span></td>
                                <td class="px-6 py-4 text-gray-600">2x X-Bacon, 1x Coca-Cola</td>
                                <td class="px-6 py-4 font-medium text-gray-900">R$ 45,00</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Preparando
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-gray-400 hover:text-orange-500 transition-colors"><i class="fa-solid fa-eye"></i></button>
                                </td>
                            </tr>
                            <!-- Linha 2 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">#1023</td>
                                <td class="px-6 py-4">Maria Oliveira <span class="block text-xs text-gray-500">Delivery</span></td>
                                <td class="px-6 py-4 text-gray-600">1x Combo Master, 1x Suco Laranja</td>
                                <td class="px-6 py-4 font-medium text-gray-900">R$ 38,50</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Saiu para Entrega
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-gray-400 hover:text-orange-500 transition-colors"><i class="fa-solid fa-eye"></i></button>
                                </td>
                            </tr>
                            <!-- Linha 3 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">#1022</td>
                                <td class="px-6 py-4">Carlos Mendes <span class="block text-xs text-gray-500">Balcão</span></td>
                                <td class="px-6 py-4 text-gray-600">3x Coxinha, 1x Guaraná Lata</td>
                                <td class="px-6 py-4 font-medium text-gray-900">R$ 21,00</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Concluído
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-gray-400 hover:text-orange-500 transition-colors"><i class="fa-solid fa-eye"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>