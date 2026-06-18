<?php
    session_start();

    // Verifica se a pessoa realmente fez login
    if(!isset($_SESSION['usuario_nome'])) {
        header("Location: pages/register.php");
        exit();
    }

    $nome = $_SESSION['usuario_nome'];
    $email = $_SESSION['usuario_email'];
    $tipo = $_SESSION['usuario_tipo'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Lanchonete - Dashboard</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome para Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Transição suave para o menu mobile */
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 h-screen overflow-hidden flex">

    <!-- Overlay Escuro para Mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="bg-slate-900 text-white w-64 flex-shrink-0 fixed md:static inset-y-0 left-0 transform -translate-x-full md:translate-x-0 z-30 flex flex-col shadow-2xl">
        <!-- Logo -->
        <div class="h-16 flex items-center justify-center border-b border-slate-700 bg-slate-950 px-6">
            <i class="fa-solid fa-burger text-orange-500 text-2xl mr-3"></i>
            <span class="text-xl font-bold tracking-wider">Lanche<span class="text-orange-500">Master</span></span>
        </div>

        <!-- Menu de Navegação -->
        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1 px-3">
                <li>
                    <a href="index.php?page=lista_cardapio.php" class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                        <i class="fa-solid fa-cash-register w-6"></i>
                        <span class="font-medium">Cardápio</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?page=lista_clientes_f.php" class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                        <i class="fa-solid fa-list-ul w-6"></i>
                        <span class="font-medium">Pedidos</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?page=lista_funcionarios.php" class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                        <i class="fa-solid fa-motorcycle w-6"></i>
                        <span class="font-medium">Entregadores</span>
                    </a>
                </li>
            </ul>

            <div class="mt-8 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                Administração
            </div>
            <ul class="space-y-1 px-3 mt-2">
                <li>
                    <a href="#" class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                        <i class="fa-solid fa-chart-line w-6"></i>
                        <span class="font-medium">Relatórios</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                        <i class="fa-solid fa-gear w-6"></i>
                        <span class="font-medium">Configurações</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Informação do Usuário no Rodapé da Sidebar -->
        <div class="p-4 border-t border-slate-700 bg-slate-950">
            <div class="flex items-center">
                <img src="https://placehold.co/40x40/f97316/ffffff?text=AD" alt="Admin" class="w-10 h-10 rounded-full border-2 border-slate-600">
                <div class="ml-3">
                    <p class="text-sm font-medium text-white"><?php echo $nome; ?></p>
                    <p class="text-xs text-slate-400"><?php echo $email; ?></p>
                </div>
                <button onclick="location.href='pages/register.php'" class="ml-auto text-slate-400 hover:text-white transition-colors">
                    <i class="fa-solid fa-sign-out-alt"></i>
                </button>
            </div>
        </div>
    </aside>