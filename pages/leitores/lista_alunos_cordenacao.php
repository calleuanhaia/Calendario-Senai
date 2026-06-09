<?php
    // 1. Conexão com o banco de dados
    include "config/config.php";
    
    // 2. Consulta ao banco de dados
    $sql="SELECT * FROM alunos ORDER BY id DESC";
    $consulta=$pdo->query($sql);
    $alunos=$consulta->fetchAll(PDO::FETCH_ASSOC);

    // Funções e variáveis de suporte para o visual
    if (!function_exists('obterCorBadge')) {
        function obterCorBadge($texto) {
            $cores = [
                'bg-blue-500/10 text-blue-400 border border-blue-500/20', 
                'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20', 
                'bg-purple-500/10 text-purple-400 border border-purple-500/20', 
                'bg-amber-500/10 text-amber-400 border border-amber-500/20', 
                'bg-pink-500/10 text-pink-400 border border-pink-500/20', 
                'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20'
            ];
            $hash = crc32($texto);
            return $cores[$hash % count($cores)];
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI Integra - Gestão de Alunos</title>
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
                            accent: '#005CA9',      
                            accentHover: '#004B87', 
                            accentLight: '#EBF5FF', 
                            bg: '#040B14',          
                            dark1: '#0A1626',       
                            dark2: '#12233C',       
                            dark3: '#1B3153',       
                            dark4: '#284570',       
                            dark5: '#6E8BB5',       
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

        /* Efeitos visuais de fundo esféricos */
        .glow-bg {
            position: absolute;
            border-radius: 50%;
            background: rgba(0, 92, 169, 0.08);
            filter: blur(130px);
            z-index: 0;
            pointer-events: none;
        }

        /* Customização da barra de rolagem para a tabela e o corpo */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0A1626; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb {
            background: #284570; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #005CA9; 
        }
    </style>
</head>

<body class="relative flex flex-col items-center justify-center min-h-screen p-4 sm:p-8 overflow-x-hidden selection:bg-brand-accent selection:text-white">

    <div class="glow-bg w-[700px] h-[700px] top-[-250px] left-[-250px]"></div>
    <div class="glow-bg w-[600px] h-[600px] bottom-[-200px] right-[-200px]"></div>

    <main class="relative z-10 w-full max-w-6xl my-auto">
        
        <div class="bg-brand-dark1/90 backdrop-blur-2xl border border-brand-dark4/50 rounded-3xl p-6 sm:p-8 shadow-[0_25px_60px_rgba(0,0,0,0.6)] relative overflow-hidden">
            
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-brand-accent to-transparent"></div>

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-brand-dark2 rounded-xl flex items-center justify-center border border-brand-accent/30 shadow-[0_0_15px_rgba(0,92,169,0.2)]">
                        <i data-lucide="users" class="text-brand-accent w-6 h-6"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white mb-0.5">Gestão de Alunos</h1>
                        <p class="text-sm text-brand-dark5 font-light">Gerencie os cadastros, matrículas e informações de acesso dos alunos.</p>
                    </div>
                </div>
            </div>

            <div class="mb-6 flex flex-col md:flex-row gap-4 justify-between items-center">
                <div class="w-full md:w-1/2 relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i data-lucide="search" class="w-4 h-4 text-brand-dark5"></i>
                    </div>
                    <input type="text" id="campoFiltro" class="bg-brand-dark2/50 border border-brand-dark4/60 text-white text-sm rounded-xl focus:ring-1 focus:ring-brand-accent focus:border-brand-accent block w-full pl-10 p-2.5 outline-none transition-all placeholder-brand-dark5" placeholder="Filtrar por nome, email ou matrícula...">
                </div>
                <button onclick="location.href='index.php?page=cadastro_aluno.php'" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-brand-dark2 hover:bg-brand-dark3 border border-brand-dark4/60 text-white text-sm font-medium py-2.5 px-4 rounded-xl transition-all duration-300 hover:border-brand-accent focus:outline-none focus:ring-1 focus:ring-brand-accent">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    Novo Aluno
                </button>
            </div>

            <div class="overflow-auto max-h-[60vh] rounded-2xl border border-brand-dark4/40 bg-brand-bg/50">
                <table class="w-full text-left border-collapse whitespace-nowrap relative">
                    <thead class="bg-brand-dark2/80 text-brand-dark5 text-[11px] uppercase tracking-widest font-semibold border-b border-brand-dark4/60 sticky top-0 z-10 backdrop-blur-md">
                        <tr>
                            <th class="py-4 px-6">ID</th>
                            <th class="py-4 px-6">Aluno(a)</th>
                            <th class="py-4 px-6">E-mail</th>
                            <th class="py-4 px-6">Senha</th>
                            <th class="py-4 px-6">Matrícula</th>
                            <th class="py-4 px-6">Ações</th>
                        </tr>
                    </thead>
                    
                    <tbody id="corpoTabela" class="text-sm text-gray-300 divide-y divide-brand-dark4/30">
                        <?php if (count($alunos) > 0): ?>
                            
                            <?php foreach ($alunos as $aluno): ?>
                                <?php 
                                    $nomeAluno = $aluno['nome'];
                                    // Pega um badge de cor aleatória baseada no número da matrícula
                                    $corBadgeMatricula = obterCorBadge($aluno['matricula']); 
                                ?>

                                <tr class="transition-colors duration-200 group hover:bg-brand-dark2/40 border-l-4 border-l-transparent linha-aluno">
                                    <td class="py-4 px-6">
                                        <span class="text-brand-dark5 font-mono text-xs">#<?php echo htmlspecialchars($aluno['id']); ?></span>
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-brand-dark3 border border-brand-dark4/60 flex items-center justify-center text-[11px] font-bold text-white uppercase shadow-inner">
                                                <?php echo mb_substr(htmlspecialchars($nomeAluno), 0, 1, 'UTF-8'); ?>
                                            </div>
                                            <span class="font-medium text-gray-200">
                                                <?php echo htmlspecialchars($nomeAluno); ?>
                                            </span>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                        <div class="flex items-center text-gray-400 gap-2">
                                            <i data-lucide="mail" class="w-4 h-4 opacity-70"></i>
                                            <span><?php echo htmlspecialchars($aluno['email']); ?></span>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                        <div class="flex items-center text-gray-500 gap-2">
                                            <i data-lucide="key" class="w-4 h-4 opacity-70"></i>
                                            <span class="font-mono text-xs opacity-80" title="Senha criptografada ou visível de acordo com regra de negócio">
                                                <?php echo htmlspecialchars($aluno['senha']); ?>
                                            </span>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                        <span class="inline-block px-3 py-1 rounded-full text-[11px] font-mono font-semibold tracking-wide <?php echo $corBadgeMatricula; ?>">
                                            <?php echo htmlspecialchars($aluno['matricula']); ?>
                                        </span>
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                        <a href="index.php?page=atualizar_alunos_cordenacao.php&id=<?php echo $aluno['id']; ?>" class="flex items-center gap-1 text-brand-accent hover:text-brand-accentLight transition-colors text-sm font-medium">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                            Atualizar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="py-12 text-center text-brand-dark5">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <i data-lucide="users" class="w-10 h-10 opacity-40"></i>
                                        <p class="text-base font-light">Nenhum aluno cadastrado no momento.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6 flex items-center justify-between text-xs text-brand-dark5">
                <p>Total de alunos no sistema: <span class="font-bold text-white"><?php echo count($alunos); ?></span><span id="contadorFiltro" class="font-medium text-brand-accent ml-1"></span></p>
                <div class="flex gap-2">
                    <button class="p-1.5 rounded-md hover:bg-brand-dark2 transition-colors cursor-not-allowed opacity-40"><i data-lucide="chevron-left" class="w-4 h-4"></i></button>
                    <button class="p-1.5 rounded-md hover:bg-brand-dark2 hover:text-white transition-colors"><i data-lucide="chevron-right" class="w-4 h-4"></i></button>
                </div>
            </div>

        </div>
        
        <p class="text-center text-[10px] text-brand-dark5 mt-6 font-light uppercase tracking-widest">
            © 2026 Portal SENAI Integra. Todos os direitos reservados.
        </p>

    </main>

    <script>
        // Inicializa os ícones Lucide modernos de forma dinâmica
        lucide.createIcons();

        // --- SISTEMA DE FILTRO EM TEMPO REAL ---
        document.addEventListener('DOMContentLoaded', function() {
            const inputPesquisa = document.getElementById('campoFiltro');
            const linhas = document.querySelectorAll('.linha-aluno');
            const contadorFiltro = document.getElementById('contadorFiltro');

            if(inputPesquisa) {
                inputPesquisa.addEventListener('input', function() {
                    const termo = this.value.toLowerCase().trim();
                    let visiveis = 0;

                    linhas.forEach(linha => {
                        if (linha.textContent.toLowerCase().includes(termo)) {
                            linha.style.display = ''; // Mostra a linha
                            visiveis++;
                        } else {
                            linha.style.display = 'none'; // Esconde a linha
                        }
                    });

                    // Atualiza dinamicamente o rodapé com os dados filtrados
                    if (termo.length > 0) {
                        contadorFiltro.textContent = ` (Filtrando: ${visiveis} resultado/s)`;
                    } else {
                        contadorFiltro.textContent = '';
                    }
                });
            }
        });
    </script>
</body>

</html>