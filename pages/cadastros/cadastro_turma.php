<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI Integra - Cadastro de Turma</title>
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

    <main class="relative z-10 w-full max-w-2xl my-auto py-8">
        
        <div class="bg-brand-dark1/60 backdrop-blur-md border border-brand-dark4/40 rounded-2xl p-8 shadow-[0_10px_30px_rgba(0,0,0,0.3)] relative overflow-hidden">
            
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-brand-accent to-transparent"></div>

            <div class="flex items-center gap-4 mb-8 border-b border-brand-dark4/40 pb-6">
                <div class="w-12 h-12 bg-brand-dark2 rounded-xl flex items-center justify-center border border-brand-accent/30 shadow-[0_0_15px_rgba(0,92,169,0.2)]">
                    <i data-lucide="graduation-cap" class="text-brand-accent w-6 h-6"></i>
                </div>
                <div>
                    <div class="inline-flex items-center gap-2 group cursor-default">
                        <span class="text-2xl font-black tracking-wider text-white uppercase">
                            senai<span class="text-brand-accent lowercase font-light">integra</span>
                        </span>
                    </div>
                    <h1 class="text-xl font-bold text-white mt-0.5">Cadastro de Turma</h1>
                    <p class="text-sm text-brand-dark5 mt-1">Preencha os dados abaixo para criar e associar uma nova turma.</p>
                </div>
            </div>

            <form method="POST" action="api/cadastros/cadastrar_turmas.php" class="space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="curso" class="block text-xs font-semibold text-brand-dark5 uppercase tracking-wider mb-2">Curso</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="book-open" class="w-5 h-5 text-brand-dark5"></i>
                            </div>
                            <input type="text" id="curso" name="curso" placeholder="Insira o nome do curso" required
                                class="w-full pl-12 pr-4 py-3 bg-brand-dark2/50 border border-brand-dark4/60 rounded-xl text-sm text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                        </div>
                    </div>

                    <div>
                        <label for="aluno" class="block text-xs font-semibold text-brand-dark5 uppercase tracking-wider mb-2">Aluno</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="user" class="w-5 h-5 text-brand-dark5"></i>
                            </div>
                            <input type="text" id="aluno" name="aluno" placeholder="Insira o nome do aluno" required
                                class="w-full pl-12 pr-4 py-3 bg-brand-dark2/50 border border-brand-dark4/60 rounded-xl text-sm text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="periodo" class="block text-xs font-semibold text-brand-dark5 uppercase tracking-wider mb-2">Período</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="clock" class="w-5 h-5 text-brand-dark5"></i>
                            </div>
                            <select id="periodo" name="periodo" required
                                class="w-full pl-12 pr-12 py-3 bg-brand-dark2/50 border border-brand-dark4/60 rounded-xl text-sm text-white focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300 appearance-none cursor-pointer">
                                <option value="" disabled selected class="text-brand-dark5">Selecione o período</option>
                                <option value="matutino" class="bg-brand-dark1 text-white">Matutino</option>
                                <option value="vespertino" class="bg-brand-dark1 text-white">Vespertino</option>
                                <option value="noturno" class="bg-brand-dark1 text-white">Noturno</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-brand-dark5">
                                <i data-lucide="chevron-down" class="w-5 h-5"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 mt-6 border-t border-brand-dark4/40 space-y-4">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-3.5 bg-brand-accent hover:bg-brand-accentHover text-white text-sm font-bold rounded-xl transition-all shadow-[0_0_20px_rgba(0,92,169,0.3)] hover:shadow-[0_0_25px_rgba(0,92,169,0.5)] active:scale-[0.98]">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                        <span>Cadastrar Turma</span>
                    </button>

                    <div class="text-center text-sm pt-2">
                        <a href="index.php?page=turmas.php" class="font-medium text-brand-dark5 hover:text-white transition-colors flex items-center justify-center gap-1 group">
                            <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover:-translate-x-0.5"></i> 
                            Voltar ao painel
                        </a>
                    </div>
                </div>
            </form>
        </div>
        
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