<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI Integra - Cadastro de Localização</title>
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
        input:-webkit-autofill:active,
        select:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 30px #12233C inset !important;
            -webkit-text-fill-color: white !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>

<body class="relative flex flex-col items-center justify-center min-h-screen p-4 overflow-x-hidden selection:bg-brand-accent selection:text-white">

    <div class="glow-bg w-[700px] h-[700px] top-[-250px] left-[-250px]"></div>
    <div class="glow-bg w-[600px] h-[600px] bottom-[-200px] right-[-200px]"></div>

    <main class="relative z-10 w-full max-w-md my-auto py-8">
        
        <div class="bg-brand-dark1/90 backdrop-blur-2xl border border-brand-dark4/50 rounded-3xl p-6 sm:p-8 shadow-[0_25px_60px_rgba(0,0,0,0.6)] relative overflow-hidden">
            
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-brand-accent to-transparent"></div>

            <div class="flex flex-col items-center justify-center mb-6">
                <div class="inline-flex items-center gap-2 mb-3 group cursor-default">
                    <div class="w-11 h-11 bg-brand-dark2 rounded-xl flex items-center justify-center border border-brand-accent/30 group-hover:border-brand-accent transition-colors shadow-[0_0_15px_rgba(0,92,169,0.2)]">
                        <i data-lucide="map-pin" class="text-brand-accent w-6 h-6"></i>
                    </div>
                    <span class="text-2xl font-black tracking-wider text-white uppercase">
                        senai<span class="text-brand-accent lowercase font-light">integra</span>
                    </span>
                </div>
                <h1 class="text-xl font-bold text-white mb-1">Cadastro de Localização</h1>
                <p class="text-xs text-brand-dark5 font-light text-center">Preencha os dados abaixo para registrar uma nova localização e seus parâmetros.</p>
            </div>

            <form method="POST" action="api/cadastros/cadastrar_localizacao.php" class="space-y-4">
                
                <div>
                    <label for="instituicao" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">Instituição</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="building" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="text" id="instituicao" name="instituicao" placeholder="Ex: SENAI Cimatec" required
                            class="w-full pl-11 pr-4 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                    </div>
                </div>

                <div>
                    <label for="sala" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">Sala</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="door-open" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="text" id="sala" name="sala" placeholder="Ex: Laboratório 04 ou Sala 202" required
                            class="w-full pl-11 pr-4 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                    </div>
                </div>

                <div>
                    <label for="professor" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">Professor</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="text" id="professor" name="professor" placeholder="Nome do docente responsável" required
                            class="w-full pl-11 pr-4 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                    </div>
                </div>

                <div>
                    <label for="turma" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">Turma</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="users" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="text" id="turma" name="turma" placeholder="Código ou nome da turma" required
                            class="w-full pl-11 pr-4 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                    </div>
                </div>

                <div>
                    <label for="itens" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">Itens</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="package" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="text" id="itens" name="itens" placeholder="Ex: 20 Computadores, 1 Projetor" required
                            class="w-full pl-11 pr-4 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                    </div>
                </div>

                <div>
                    <label for="tipo_sala" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">Tipo de Sala</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="layers" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="text" id="tipo_sala" name="tipo_sala" placeholder="Ex: Laboratório, Teórica, Oficina" required
                            class="w-full pl-11 pr-4 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                    </div>
                </div>

                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-brand-accent hover:bg-brand-accentHover text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(0,92,169,0.2)] hover:shadow-[0_5px_20px_rgba(0,92,169,0.4)] hover:-translate-y-0.5 mt-4">
                    <span>Cadastrar</span>
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                </button>

                <div class="text-center text-sm pt-2">
                    <a href="../../dashboard.php" class="font-medium text-brand-dark5 hover:text-brand-accent transition-colors inline-flex items-center gap-1">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i> Voltar ao painel
                    </a>
                </div>
            </form>
        </div>
        
        <p class="text-center text-[10px] text-brand-dark5 mt-6 font-light uppercase tracking-widest">
            © 2026 Portal SENAI Integra. Todos os direitos reservados.
        </p>

    </main>

    <script>
        // Inicializa os ícones Lucide dinamicamente
        lucide.createIcons();
    </script>
</body>

</html>