<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI Integra - Cadastro de Calendário</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Google Fonts (Outfit) -->
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
                            dark1: '#0A1626',       // Azul de fundo do Card
                            dark2: '#12233C',       // Azul de fundo dos Inputs
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
            min-height: 100vh; 
        }

        /* Efeitos visuais de fundo industriais e cibernéticos do SENAI */
        .glow-bg {
            position: absolute;
            border-radius: 50%;
            background: rgba(0, 92, 169, 0.08);
            filter: blur(130px);
            z-index: 0;
            pointer-events: none;
        }

        /* Correção de preenchimento automático do navegador com tom azulado */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active{
            -webkit-box-shadow: 0 0 0 30px #12233C inset !important;
            -webkit-text-fill-color: white !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        /* Força os seletores nativos de data/hora a acompanharem o tema escuro */
        input[type="date"], input[type="time"] {
            color-scheme: dark;
        }
    </style>
</head>

<body class="relative flex flex-col items-center justify-center min-h-screen p-4 overflow-x-hidden selection:bg-brand-accent selection:text-white">

    <!-- Efeitos de Luz de Fundo com as cores da paleta SENAI -->
    <div class="glow-bg w-[700px] h-[700px] top-[-250px] left-[-250px]"></div>
    <div class="glow-bg w-[600px] h-[600px] bottom-[-200px] right-[-200px]"></div>

    <!-- Container Principal -->
    <main class="relative z-10 w-full max-w-md my-auto py-8">
        
        <!-- Card do Formulário de Cadastro -->
        <div class="bg-brand-dark1/90 backdrop-blur-2xl border border-brand-dark4/50 rounded-3xl p-6 sm:p-8 shadow-[0_25px_60px_rgba(0,0,0,0.6)] relative overflow-hidden">
            
            <!-- Linha decorativa no topo (Azul SENAI Oficial) -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-brand-accent to-transparent"></div>

            <!-- Header / Logo SENAI Integra -->
            <div class="flex flex-col items-center justify-center mb-6">
                <div class="inline-flex items-center gap-2 mb-3 group cursor-default">
                    <div class="w-11 h-11 bg-brand-dark2 rounded-xl flex items-center justify-center border border-brand-accent/30 group-hover:border-brand-accent transition-colors shadow-[0_0_15px_rgba(0,92,169,0.2)]">
                        <i data-lucide="calendar-plus" class="text-brand-accent w-6 h-6"></i>
                    </div>
                    <span class="text-2xl font-black tracking-wider text-white uppercase">
                        senai<span class="text-brand-accent lowercase font-light">integra</span>
                    </span>
                </div>
                <h1 class="text-xl font-bold text-white mb-1">Cadastro de Calendário</h1>
                <p class="text-xs text-brand-dark5 font-light text-center">Preencha os dados abaixo para registrar um novo horário.</p>
            </div>

            <!-- Formulário de Cadastro -->
            <form method="POST" action="api/cadastros/cadastrar_calendario_alunos.php" class="space-y-4">
                
                <!-- Campo: Data -->
                <div>
                    <label for="data" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">Data</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="calendar" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="date" id="data" name="data" required
                            class="w-full pl-11 pr-4 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                    </div>
                </div>

                <!-- Campo: Hora -->
                <div>
                    <label for="time" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">Hora</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="clock" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="time" id="time" name="time" required
                            class="w-full pl-11 pr-4 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                    </div>
                </div>

                <!-- Campo: Professor -->
                <div>
                    <label for="professor" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">Professor</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="graduation-cap" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="text" id="professor" name="professor" placeholder="Nome do professor" required
                            class="w-full pl-11 pr-4 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                    </div>
                </div>

                <!-- Campo: Curso -->
                <div>
                    <label for="curso" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">Curso</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="book-open" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="text" id="curso" name="curso" placeholder="Nome do curso" required
                            class="w-full pl-11 pr-4 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                    </div>
                </div>

                <!-- Botão de Enviar -->
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-brand-accent hover:bg-brand-accentHover text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(0,92,169,0.2)] hover:shadow-[0_5px_20px_rgba(0,92,169,0.4)] hover:-translate-y-0.5 mt-4">
                    <span>Cadastrar</span>
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                </button>

                <!-- Link de Voltar -->
                <div class="text-center text-sm pt-2">
                    <a href="../../login.php" class="font-medium text-brand-dark5 hover:text-white transition-colors flex items-center justify-center gap-1">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i> Voltar ao painel
                    </a>
                </div>
            </form>
        </div>
        
        <!-- Texto de Copyright fora do card -->
        <p class="text-center text-[10px] text-brand-dark5 mt-6 font-light uppercase tracking-widest">
            © 2026 Portal SENAI Integra. Todos os direitos reservados.
        </p>

    </main>

    <script>
        // Inicializa os ícones Lucide
        lucide.createIcons();
    </script>
</body>

</html>