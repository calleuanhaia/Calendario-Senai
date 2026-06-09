<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI Integra - Cadastro de Coordenação</title>
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
        input:-webkit-autofill:active{
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
                        <i data-lucide="user-check" class="text-brand-accent w-6 h-6"></i>
                    </div>
                    <span class="text-2xl font-black tracking-wider text-white uppercase">
                        senai<span class="text-brand-accent lowercase font-light">integra</span>
                    </span>
                </div>
                <h1 class="text-xl font-bold text-white mb-1">Cadastro de Coordenação</h1>
                <p class="text-xs text-brand-dark5 font-light text-center">Preencha os dados abaixo para criar sua conta administrativa.</p>
            </div>

            <form method="POST" action="../../api/cadastros/cadastrar_cordenacao.php" class="space-y-4">
                
                <div>
                    <label for="nome" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">Nome Completo</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="text" id="nome" name="nome" placeholder="Insira seu nome" required
                            class="w-full pl-11 pr-4 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">E-mail</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="email" id="email" name="email" placeholder="Insira seu email" required
                            class="w-full pl-11 pr-4 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                    </div>
                </div>

                <div>
                    <label for="senha" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">Senha de Acesso</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="password" id="senha" name="senha" placeholder="Insira sua senha" required
                            class="w-full pl-11 pr-12 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                        
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-brand-dark5 hover:text-white transition-colors focus:outline-none">
                            <i data-lucide="eye" id="eye-icon" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-brand-accent hover:bg-brand-accentHover text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(0,92,169,0.2)] hover:shadow-[0_5px_20px_rgba(0,92,169,0.4)] hover:-translate-y-0.5 mt-4">
                    <span>Cadastrar</span>
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                </button>

                <div class="text-center text-sm pt-2">
                    <span class="text-brand-dark5">Já tem uma conta?</span>
                    <a href="../../login.php" class="font-medium text-brand-accent hover:text-white transition-colors ml-1">Entrar</a>
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

        // Lógica para alternar a visibilidade da senha
        function togglePassword() {
            const passwordInput = document.getElementById('senha');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('data-lucide', 'eye');
            }
            
            lucide.createIcons();
        }
    </script>
</body>

</html>