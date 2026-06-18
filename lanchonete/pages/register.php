<?php
    include "../config/config.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Lanchonete - Autenticação</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Oculta os <br> originais para usar o espaçamento do Tailwind, sem alterar a estrutura */
        form br {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-4">

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 w-full max-w-md p-8">
        
        <div class="flex items-center justify-center mb-6">
            <i class="fa-solid fa-burger text-orange-500 text-3xl mr-3"></i>
            <span class="text-2xl font-bold tracking-wider text-slate-900">Lanche<span class="text-orange-500">Master</span></span>
        </div>

        <div class="text-center mb-6">
            <h2 id="form_title" class="text-xl font-bold text-gray-900">Bem-vindo de volta!</h2>
            <p id="form_subtitle" class="text-sm text-gray-500 mt-1">Faça login na sua conta para continuar.</p>
        </div>

        <div class="flex justify-center mb-8">
            <div class="bg-gray-100 p-1 rounded-lg inline-flex w-full">
                <button id="btn_tipo_cliente" onclick="setTipo('clientes')" class="w-1/2 py-2 rounded-md text-sm font-medium bg-white shadow-sm text-gray-900 transition-all">
                    <i class="fa-solid fa-user mr-2"></i> Cliente
                </button>
                <button id="btn_tipo_funcionario" onclick="setTipo('funcionarios')" class="w-1/2 py-2 rounded-md text-sm font-medium text-gray-500 hover:text-gray-900 transition-all">
                    <i class="fa-solid fa-id-badge mr-2"></i> Funcionário
                </button>
            </div>
        </div>

        <div>
            
            <div id="log_clientes" class="hidden">
                <form method="POST" action="../api/logar_clientes.php" class="flex flex-col">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email ou Nome de Usuário</label>
                    <input name="log-nome" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 mb-4 transition-colors">
                    <br><br>
                    
                    <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                    <input name="log-senha" type="password" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 mb-4 transition-colors">
                    <br><br>
                    
                    <a onclick="setAcao('reg')" class="text-sm text-orange-500 hover:text-orange-600 font-medium cursor-pointer mb-6 text-center transition-colors">Não possui uma conta? Registre-se</a>
                    
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2.5 rounded-lg shadow-sm transition-colors">Logar</button>
                </form>
            </div>

            <div id="log_funcionarios" class="hidden">
                <form method="POST" action="../api/logar_funcionarios.php" class="flex flex-col">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email ou Nome de Usuário</label>
                    <input name="log-nome" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 mb-4 transition-colors">
                    <br><br>
                    
                    <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                    <input name="log-senha" type="password" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 mb-4 transition-colors">
                    <br><br>
                    
                    <a onclick="setAcao('reg')" class="text-sm text-orange-500 hover:text-orange-600 font-medium cursor-pointer mb-6 text-center transition-colors">Não possui uma conta? Registre-se</a>
                    
                    <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-semibold py-2.5 rounded-lg shadow-sm transition-colors">Logar no Sistema</button>
                </form>
            </div>

            <div id="reg_clientes" class="hidden">
                <form method="POST" action="../api/registrar_clientes.php" class="flex flex-col space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                        <input name="nome_c" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
                    </div>
                    <br><br>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input name="email_c" type="email" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
                    </div>
                    <br><br>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                        <input name="senha_c" type="password" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
                    </div>
                    <br><br>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                        <input name="telefone_c" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
                    </div>
                    <br><br>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Endereço</label>
                        <input name="endereco_c" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
                    </div>
                    <br><br>
                    
                    <a onclick="setAcao('log')" class="text-sm text-orange-500 hover:text-orange-600 font-medium cursor-pointer py-2 text-center transition-colors">Já possui uma conta? Faça login</a>
                    
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2.5 rounded-lg shadow-sm transition-colors mt-2">Registrar</button>
                </form>
            </div>

            <div id="reg_funcionarios" class="hidden">
                <form method="POST" action="../api/registrar_funcionarios.php" class="flex flex-col space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                        <input name="nome_f" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
                    </div>
                    <br><br>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input name="email_f" type="email" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
                    </div>
                    <br><br>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                        <input name="senha_f" type="password" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
                    </div>
                    <br><br>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                        <input name="telefone_f" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
                    </div>
                    <br><br>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Trabalho</label>
                        <input name="trabalho_f" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
                    </div>
                    <br><br>
                    
                    <a onclick="setAcao('log')" class="text-sm text-orange-500 hover:text-orange-600 font-medium cursor-pointer py-2 text-center transition-colors">Já possui uma conta? Faça login</a>
                    
                    <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-semibold py-2.5 rounded-lg shadow-sm transition-colors mt-2">Registrar</button>
                </form>
            </div>

        </div>
    </div>

    <script>
        // Estados iniciais
        let tipoAtual = 'clientes'; // 'clientes' ou 'funcionarios'
        let acaoAtual = 'log'; // 'log' ou 'reg'

        // Funções para alterar o estado
        function setTipo(tipo) {
            tipoAtual = tipo;
            atualizarUI();
        }

        function setAcao(acao) {
            acaoAtual = acao;
            atualizarUI();
        }

        // Função para atualizar a visibilidade dos forms e botões
        function atualizarUI() {
            // 1. Oculta todos os formulários
            const forms = ['log_clientes', 'log_funcionarios', 'reg_clientes', 'reg_funcionarios'];
            forms.forEach(id => {
                document.getElementById(id).classList.add('hidden');
            });

            // 2. Exibe apenas o formulário correto montando a string dinamicamente
            const formAtivo = `${acaoAtual}_${tipoAtual}`;
            document.getElementById(formAtivo).classList.remove('hidden');

            // 3. Atualiza o estilo visual das abas (Cliente / Funcionário)
            const btnCliente = document.getElementById('btn_tipo_cliente');
            const btnFunc = document.getElementById('btn_tipo_funcionario');

            if (tipoAtual === 'clientes') {
                btnCliente.className = "w-1/2 py-2 rounded-md text-sm font-medium bg-white shadow-sm text-gray-900 transition-all";
                btnFunc.className = "w-1/2 py-2 rounded-md text-sm font-medium text-gray-500 hover:text-gray-900 transition-all";
            } else {
                btnFunc.className = "w-1/2 py-2 rounded-md text-sm font-medium bg-white shadow-sm text-gray-900 transition-all";
                btnCliente.className = "w-1/2 py-2 rounded-md text-sm font-medium text-gray-500 hover:text-gray-900 transition-all";
            }

            // 4. Atualiza os títulos dependendo se é Login ou Registro
            const titulo = document.getElementById('form_title');
            const subtitulo = document.getElementById('form_subtitle');
            
            if (acaoAtual === 'log') {
                titulo.innerText = "Bem-vindo de volta!";
                subtitulo.innerText = "Faça login na sua conta para continuar.";
            } else {
                titulo.innerText = "Crie sua conta";
                subtitulo.innerText = "Preencha os dados abaixo para se registrar.";
            }
        }

        // Inicializa a interface com os valores padrão ao carregar a página
        document.addEventListener("DOMContentLoaded", () => {
            atualizarUI();
        });
    </script>
</body>
</html>