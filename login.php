<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI Integra - Login</title>
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

        /* Transição suave de abas */
        .tab-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>

<body class="relative flex flex-col items-center justify-center min-h-screen p-4 overflow-x-hidden selection:bg-brand-accent selection:text-white">

    <!-- Efeitos de Luz de Fundo com as cores da paleta SENAI -->
    <div class="glow-bg w-[700px] h-[700px] top-[-250px] left-[-250px]"></div>
    <div class="glow-bg w-[600px] h-[600px] bottom-[-200px] right-[-200px]"></div>
    
    <!-- Toast de Notificação customizado no tema Azul/Branco -->
    <div id="toast" class="fixed top-5 right-5 z-50 transform translate-y-[-150%] opacity-0 transition-all duration-500 ease-out flex items-center gap-3 bg-brand-dark1 border border-brand-accent/40 text-white px-5 py-4 rounded-2xl shadow-[0_10px_35px_rgba(0,92,169,0.15)] max-w-sm">
        <div id="toast-icon-container" class="p-2 rounded-xl bg-brand-accent/20 text-brand-accent">
            <i data-lucide="info" class="w-5 h-5"></i>
        </div>
        <div>
            <p id="toast-title" class="font-bold text-sm text-white">Notificação</p>
            <p id="toast-message" class="text-xs text-brand-dark5 mt-0.5">Mensagem do sistema.</p>
        </div>
    </div>

    <!-- Container Principal -->
    <main class="relative z-10 w-full max-w-md my-auto">
        
        <!-- Card do Formulário de Acesso -->
        <div class="bg-brand-dark1/90 backdrop-blur-2xl border border-brand-dark4/50 rounded-3xl p-6 sm:p-8 shadow-[0_25px_60px_rgba(0,0,0,0.6)] relative overflow-hidden">
            
            <!-- Linha decorativa no topo (Azul SENAI Oficial) -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-brand-accent to-transparent"></div>

            <!-- Header / Logo SENAI Integra -->
            <div class="flex flex-col items-center justify-center mb-8">
                <div class="inline-flex items-center gap-2 mb-3 group cursor-default">
                    <div class="w-11 h-11 bg-brand-dark2 rounded-xl flex items-center justify-center border border-brand-accent/30 group-hover:border-brand-accent transition-colors shadow-[0_0_15px_rgba(0,92,169,0.2)]">
                        <i data-lucide="cpu" class="text-brand-accent w-6 h-6"></i>
                    </div>
                    <span class="text-2xl font-black tracking-wider text-white uppercase">
                        senai<span class="text-brand-accent lowercase font-light">integra</span>
                    </span>
                </div>
                <h1 class="text-xl font-bold text-white mb-1">Acesse sua Conta</h1>
                <p class="text-xs text-brand-dark5 font-light text-center">Conecte-se ao ecossistema de aprendizado industrial.</p>
            </div>

            <!-- Seletor de Perfis (Tabs Industriais) -->
            <div class="bg-brand-bg p-1 rounded-2xl border border-brand-dark4/40 flex items-center mb-6 relative">
                <!-- Indicador deslizante de fundo ativo -->
                <div id="tab-indicator" class="absolute top-1 bottom-1 left-1 w-[31%] bg-brand-accent border border-brand-accentHover rounded-xl tab-transition shadow-[0_4px_12px_rgba(0,92,169,0.3)]"></div>

                <button type="button" onclick="switchProfile('aluno', 0)" class="relative z-10 flex-1 py-2.5 text-xs font-bold rounded-xl text-white flex flex-col sm:flex-row items-center justify-center gap-1.5 tab-transition focus:outline-none">
                    <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                    <span>Aluno</span>
                </button>
                <button type="button" onclick="switchProfile('professor', 1)" class="relative z-10 flex-1 py-2.5 text-xs font-semibold rounded-xl text-brand-dark5 flex flex-col sm:flex-row items-center justify-center gap-1.5 tab-transition focus:outline-none">
                    <i data-lucide="presentation" class="w-4 h-4"></i>
                    <span>Professor</span>
                </button>
                <button type="button" onclick="switchProfile('gestao', 2)" class="relative z-10 flex-1 py-2.5 text-xs font-semibold rounded-xl text-brand-dark5 flex flex-col sm:flex-row items-center justify-center gap-1.5 tab-transition focus:outline-none">
                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                    <span>Gestão</span>
                </button>
            </div>

            <!-- Formulário Dinâmico -->
            <form onsubmit="handleLogin(event)" class="space-y-4">
                
                <!-- Campo de Identificação Dinâmico -->
                <div>
                    <label id="input-label" for="login-id" class="block text-sm font-semibold text-gray-300 mb-1.5 ml-1">Matrícula / RA</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <div id="input-icon-container" class="text-brand-dark5">
                                <i data-lucide="hash" id="field-icon" class="w-5 h-5"></i>
                            </div>
                        </div>
                        <input type="text" id="login-id" name="login-id" placeholder="Ex: 2401832-9" required
                            class="w-full pl-11 pr-4 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                    </div>
                </div>

                <!-- Campo de Senha -->
                <div>
                    <div class="flex items-center justify-between mb-1.5 ml-1">
                        <label for="password" class="block text-sm font-semibold text-gray-300">Senha de Acesso</label>
                        <a href="#" onclick="showDemoToast('Recuperação de Acesso', 'Um link de redefinição foi enviado para o e-mail cadastrado.', 'mail')" class="text-xs text-brand-accent hover:text-white transition-colors">Esqueceu a senha?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-5 h-5 text-brand-dark5"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                            class="w-full pl-11 pr-12 py-3 bg-brand-dark2 border border-brand-dark4/60 rounded-xl text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300">
                        
                        <!-- Botão mostrar/ocultar senha -->
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-brand-dark5 hover:text-white transition-colors focus:outline-none">
                            <i data-lucide="eye" id="eye-icon" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Manter Conectado Checkbox -->
                <div class="flex items-center ml-1 py-1">
                    <label class="inline-flex items-center cursor-pointer select-none">
                        <input type="checkbox" class="sr-only peer" name="remember">
                        <div class="w-9 h-5 bg-brand-dark2 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-brand-accent relative"></div>
                        <span class="ml-3 text-xs font-medium text-brand-dark5">Permanecer conectado neste dispositivo</span>
                    </label>
                </div>

                <!-- Botão de Login (Azul SENAI com Texto Branco) -->
                <button type="submit" id="btn-submit"
                    class="w-full flex items-center justify-center gap-2 bg-brand-accent hover:bg-brand-accentHover text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(0,92,169,0.2)] hover:shadow-[0_5px_20px_rgba(0,92,169,0.4)] hover:-translate-y-0.5 mt-2">
                    <span id="btn-text">Entrar no Portal</span>
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
            </form>

            <!-- Rodapé do Card -->
            <div class="mt-6 pt-5 border-t border-brand-dark4/40 text-center">
                <p class="text-xs text-brand-dark5">
                    Primeiro acesso ou precisa de ajuda técnica? 
                    <a href="#" onclick="showDemoToast('Central de Ajuda', 'Fale com o suporte técnico no chat do whatsapp ou coordenação.', 'help-circle')" class="font-medium text-white hover:underline underline-offset-4 transition-all">
                        Suporte ao Usuário
                    </a>
                </p>
            </div>
        </div>
        
        <!-- Texto de Copyright fora do card -->
        <p class="text-center text-[10px] text-brand-dark5 mt-6 font-light uppercase tracking-widest">
            © 2026 Portal SENAI Integra. Todos os direitos reservados.
        </p>

    </main>

    <script>
        // Inicializa os ícones Lucide
        lucide.createIcons();

        // Estado do Perfil Selecionado
        let activeProfile = 'aluno';

        // Lógica para alternar perfis e atualizar dinamicamente a UI
        function switchProfile(profile, index) {
            activeProfile = profile;
            
            // 1. Atualizar o indicador visual deslizante
            const indicator = document.getElementById('tab-indicator');
            if (index === 0) {
                indicator.style.left = '4px';
                indicator.style.width = '31%';
            } else if (index === 1) {
                indicator.style.left = '34.5%';
                indicator.style.width = '31%';
            } else if (index === 2) {
                indicator.style.left = '65%';
                indicator.style.width = '33.5%';
            }

            // 2. Atualizar classes de estilo dos botões
            const buttons = document.querySelectorAll('[onclick^="switchProfile"]');
            buttons.forEach((btn, i) => {
                if (i === index) {
                    btn.classList.add('text-white');
                    btn.classList.remove('text-brand-dark5');
                    btn.classList.add('font-bold');
                    btn.classList.remove('font-semibold');
                } else {
                    btn.classList.remove('text-white');
                    btn.classList.add('text-brand-dark5');
                    btn.classList.remove('font-bold');
                    btn.classList.add('font-semibold');
                }
            });

            // 3. Atualizar Labels, placeholders e ícones correspondentes
            const label = document.getElementById('input-label');
            const input = document.getElementById('login-id');
            const iconContainer = document.getElementById('input-icon-container');

            if (profile === 'aluno') {
                label.textContent = 'Matrícula / RA';
                input.placeholder = 'Ex: 2401832-9';
                input.type = 'text';
                iconContainer.innerHTML = '<i data-lucide="hash" id="field-icon" class="w-5 h-5"></i>';
            } else if (profile === 'professor') {
                label.textContent = 'NIF / E-mail';
                input.placeholder = 'Ex: 9283748 ou prof.silva@senai.br';
                input.type = 'text';
                iconContainer.innerHTML = '<i data-lucide="user-check" id="field-icon" class="w-5 h-5"></i>';
            } else if (profile === 'gestao') {
                label.textContent = 'E-mail Corporativo';
                input.placeholder = 'Ex: nome.sobrenome@senai.br';
                input.type = 'email';
                iconContainer.innerHTML = '<i data-lucide="mail" id="field-icon" class="w-5 h-5"></i>';
            }

            // Recria apenas os ícones atualizados na mudança dinâmica
            lucide.createIcons();
        }

        // Lógica para alternar a visibilidade da senha
        function togglePassword() {
            const passwordInput = document.getElementById('password');
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

        // Sistema de Toast Notification Minimalista
        let toastTimeout;
        function showDemoToast(title, message, iconName = 'info') {
            clearTimeout(toastTimeout);
            
            const toast = document.getElementById('toast');
            const toastTitle = document.getElementById('toast-title');
            const toastMessage = document.getElementById('toast-message');
            const iconContainer = document.getElementById('toast-icon-container');

            toastTitle.textContent = title;
            toastMessage.textContent = message;
            iconContainer.innerHTML = `<i data-lucide="${iconName}" class="w-5 h-5"></i>`;
            
            lucide.createIcons();

            // Mostra o Toast deslizando para baixo
            toast.classList.remove('translate-y-[-150%]', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');

            // Agenda a ocultação do Toast
            toastTimeout = setTimeout(() => {
                toast.classList.add('translate-y-[-150%]', 'opacity-0');
                toast.classList.remove('translate-y-0', 'opacity-100');
            }, 4000);
        }

        // Simulação de login robusta e responsiva
        function handleLogin(event) {
            event.preventDefault();
            
            const btnSubmit = document.getElementById('btn-submit');
            const btnText = document.getElementById('btn-text');

            // Visual feedback de carregamento minimalista
            btnSubmit.disabled = true;
            btnSubmit.style.opacity = '0.8';
            btnText.innerHTML = '<span class="inline-block animate-spin mr-2 border-2 border-white border-t-transparent rounded-full w-4 h-4"></span> Validando...';

            setTimeout(() => {
                // Reverter estado original do botão
                btnSubmit.disabled = false;
                btnSubmit.style.opacity = '1';
                btnText.innerHTML = 'Entrar no Portal';

                const profileNames = {
                    'aluno': 'Aluno',
                    'professor': 'Professor(a)',
                    'gestao': 'Membro da Gestão'
                };
                
                showDemoToast(
                    `Conexão bem-sucedida`, 
                    `Seja bem-vindo ao portal, ${profileNames[activeProfile]}!`, 
                    'check-circle'
                );
            }, 1200);
        }
    </script>
</body>

</html>