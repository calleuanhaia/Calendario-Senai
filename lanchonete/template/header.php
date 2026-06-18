<?php include "sidebar.php"; ?>
<div class="flex-1 flex flex-col w-full">
        
        <!-- Header -->
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-4 sm:px-6 lg:px-8 z-10">
            <!-- Left Side: Mobile Button & Search -->
            <div class="flex items-center flex-1">
                <button onclick="toggleSidebar()" class="text-gray-500 hover:text-gray-700 focus:outline-none md:hidden mr-4">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                
                <div class="hidden sm:block relative w-full max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-search"></i>
                    </span>
                    <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 sm:text-sm transition-colors" placeholder="Buscar pedidos, clientes, itens...">
                </div>
            </div>

            <!-- Right Side: Actions & Profile -->
            <div class="flex items-center space-x-4">
                <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition-colors flex items-center hidden sm:flex">
                    <i class="fa-solid fa-plus mr-2"></i> Novo Pedido
                </button>
                
                <button class="relative text-gray-500 hover:text-gray-700 transition-colors p-2">
                    <i class="fa-regular fa-bell text-xl"></i>
                    <span class="absolute top-1 right-1 block h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"></span>
                </button>
            </div>
        </header>