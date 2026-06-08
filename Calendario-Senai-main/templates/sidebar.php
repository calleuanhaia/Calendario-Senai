<?php
    session_start();

    // Verifica se a pessoa realmente fez login
    if(!isset($_SESSION['usuario_nome'])) {
        header("Location: login.php");
        exit();
    }

    $nome = $_SESSION['usuario_nome'];
    $email = $_SESSION['usuario_email'];
    $tipo = $_SESSION['usuario_tipo']; // Aqui você saberá se é aluno, professor ou coordenador
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI Integra - Painel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            accent: '#005CA9',      // Azul Oficial SENAI
                            accentHover: '#004B87', // Azul SENAI Escuro para Hover
                            accentLight: '#EBF5FF', // Azul Claro para destaques secundários
                            bg: '#040B14',          // Fundo Azul Noturno Ultra Escuro
                            dark1: '#0A1626',       // Azul de fundo do Card/Sidebar
                            dark2: '#12233C',       // Azul de fundo dos Inputs/Hover
                            dark3: '#1B3153',       // Azul de destaque intermediário
                            dark4: '#284570',       // Azul para Bordas e Linhas
                            dark5: '#6E8BB5',       // Azul acinzentado para textos de apoio
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #040B14;
            color: #ffffff;
            /* Remove scrollbar na raiz pois controlaremos internamente */
            overflow: hidden; 
        }

        /* Efeitos visuais de fundo industriais e cibernéticos */
        .glow-bg {
            position: absolute;
            border-radius: 50%;
            background: rgba(0, 92, 169, 0.06);
            filter: blur(130px);
            z-index: 0;
            pointer-events: none;
        }

        /* Estilização da barra de rolagem */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #0A1626; 
        }
        ::-webkit-scrollbar-thumb {
            background: #284570; 
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #6E8BB5; 
        }
    </style>
</head>

<body class="flex h-screen w-full selection:bg-brand-accent selection:text-white">

    <div class="glow-bg w-[800px] h-[800px] top-[-300px] right-[-200px]"></div>
    <div class="glow-bg w-[600px] h-[600px] bottom-[-200px] left-[-200px]"></div>

    <aside class="w-72 bg-brand-dark1/95 backdrop-blur-xl border-r border-brand-dark4/40 flex flex-col relative z-20 shadow-[10px_0_30px_rgba(0,0,0,0.5)] transition-all">
        
        <div class="absolute top-0 right-0 w-[1px] h-full bg-gradient-to-b from-transparent via-brand-accent/50 to-transparent"></div>

        <div class="h-20 flex items-center px-6 border-b border-brand-dark4/40">
            <div class="inline-flex items-center gap-3 group cursor-pointer">
                <div class="w-10 h-10 bg-brand-dark2 rounded-xl flex items-center justify-center border border-brand-accent/30 group-hover:border-brand-accent transition-colors shadow-[0_0_15px_rgba(0,92,169,0.2)]">
                    <i data-lucide="cpu" class="text-brand-accent w-5 h-5"></i>
                </div>
                <span class="text-xl font-black tracking-wider text-white uppercase">
                    senai<span class="text-brand-accent lowercase font-light">integra</span>
                </span>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
            <p class="text-[10px] font-bold text-brand-dark5 uppercase tracking-widest mb-4 px-2">Menu Principal</p>
            <a href="index.php?page=calendario_aluno.php" class="flex items-center gap-3 px-4 py-3 text-brand-dark5 hover:text-white hover:bg-brand-dark2/50 rounded-xl transition-all group border-l-2 border-transparent hover:border-brand-dark5/30">
                <i data-lucide="book-open" class="w-5 h-5 group-hover:text-white transition-colors"></i>
                <span class="font-medium text-sm">Calendario</span>
            </a>

            <a href="index.php?page=localizacao.php" class="flex items-center gap-3 px-4 py-3 text-brand-dark5 hover:text-white hover:bg-brand-dark2/50 rounded-xl transition-all group border-l-2 border-transparent hover:border-brand-dark5/30">
                <i data-lucide="calendar" class="w-5 h-5 group-hover:text-white transition-colors"></i>
                <span class="font-medium text-sm">Localizações</span>
            </a>

            <a href="index.php?page=turmas.php" class="flex items-center gap-3 px-4 py-3 text-brand-dark5 hover:text-white hover:bg-brand-dark2/50 rounded-xl transition-all group border-l-2 border-transparent hover:border-brand-dark5/30">
                <i data-lucide="clipboard-list" class="w-5 h-5 group-hover:text-white transition-colors"></i>
                <span class="font-medium text-sm">Turmas</span>
            </a>

            <p class="text-[10px] font-bold text-brand-dark5 uppercase tracking-widest mt-8 mb-4 px-2">Suporte & Opções</p>

            <a href="#" class="flex items-center gap-3 px-4 py-3 text-brand-dark5 hover:text-white hover:bg-brand-dark2/50 rounded-xl transition-all group border-l-2 border-transparent hover:border-brand-dark5/30">
                <i data-lucide="settings" class="w-5 h-5 group-hover:text-white transition-colors"></i>
                <span class="font-medium text-sm">Configurações</span>
            </a>
        </nav>

        <div class="p-4 border-t border-brand-dark4/40 bg-brand-dark1">
            <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-brand-dark2/50 transition-colors cursor-pointer">
                <div class="w-10 h-10 rounded-full bg-brand-dark3 flex items-center justify-center border border-brand-dark4">
                    <span class="font-bold text-sm text-brand-accentLight">AL</span>
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-bold text-white truncate"><?php echo $nome; ?></p>
                    <p class="text-xs text-brand-dark5 truncate"><?php echo $email; ?></p>
                </div>
                <button onclick="location.href='login.php'" class="text-brand-dark5 hover:text-red-400 transition-colors p-1" title="Sair">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </aside>