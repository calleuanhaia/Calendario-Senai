<?php 
    // 1. Conexão com o banco de dados fornecida por você
    include("config/config.php");

    // 2. Consulta ao banco de dados
    $sql = "SELECT * FROM turmas ORDER BY id DESC";
    $consulta = $pdo->query($sql);
    $turmas = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI Integra - Turmas</title>
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
                            dark2: '#12233C',       // Azul de fundo dos Inputs/Tabelas
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

        /* Efeitos visuais de fundo */
        .glow-bg {
            position: absolute;
            border-radius: 50%;
            background: rgba(0, 92, 169, 0.08);
            filter: blur(130px);
            z-index: 0;
            pointer-events: none;
        }

        /* Customização da barra de rolagem para a tabela */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0A1626; 
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
                        <h1 class="text-2xl font-bold text-white mb-0.5">Turmas</h1>
                        <p class="text-sm text-brand-dark5 font-light">Gerenciamento de turmas, cursos matriculados e alunos.</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                    <div class="relative w-full sm:w-64">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i data-lucide="search" class="w-4 h-4 text-brand-dark5"></i>
                        </div>
                        <input type="text" id="campoFiltro" class="bg-brand-dark2/50 border border-brand-dark4/60 text-white text-sm rounded-xl focus:ring-1 focus:ring-brand-accent focus:border-brand-accent block w-full pl-10 p-2.5 outline-none transition-all placeholder-brand-dark5" placeholder="Filtrar turmas...">
                    </div>

                    <button onclick="location.href='index.php?page=cadastro_turma.php'" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-brand-dark2 hover:bg-brand-dark3 border border-brand-dark4/60 text-white text-sm font-medium py-2.5 px-4 rounded-xl transition-all duration-300 hover:border-brand-accent focus:outline-none focus:ring-1 focus:ring-brand-accent">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        Nova Turma
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-brand-dark4/40 bg-brand-bg/50">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead class="bg-brand-dark2/80 text-brand-dark5 text-[11px] uppercase tracking-widest font-semibold border-b border-brand-dark4/60">
                        <tr>
                            <th class="py-4 px-6 text-center w-16">ID</th>
                            <th class="py-4 px-6">Curso</th>
                            <th class="py-4 px-6">Aluno</th>
                            <th class="py-4 px-6 text-center">Período</th>
                        </tr>
                    </thead>
                    
                    <tbody class="text-sm text-gray-300 divide-y divide-brand-dark4/30">
                        <?php if(count($turmas) > 0): ?>
                            <?php foreach ($turmas as $turma): ?>
                                <tr class="hover:bg-brand-dark2/40 transition-colors duration-200 group linha-tabela">
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-flex items-center justify-center px-2.5 py-1 rounded-md bg-brand-dark2 border border-brand-dark4/50 text-brand-accent font-mono text-xs font-bold group-hover:border-brand-accent/50 transition-colors">
                                            #<?php echo htmlspecialchars($turma['id']); ?>
                                        </span>
                                    </td>
                                    
                                    <td class="py-4 px-6 font-medium text-white">
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="book-open" class="w-4 h-4 text-brand-dark5"></i>
                                            <?php echo htmlspecialchars($turma['curso']); ?>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-brand-dark3 flex items-center justify-center text-[10px] font-bold text-white uppercase">
                                                <?php echo mb_substr(htmlspecialchars($turma['aluno']), 0, 1, 'UTF-8'); ?>
                                            </div>
                                            <?php echo htmlspecialchars($turma['aluno']); ?>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6 text-center">
                                        <span class="px-3 py-1.5 rounded-full text-[11px] font-semibold tracking-wide 
                                            <?php 
                                                echo (stripos($turma['periodo'], 'noturno') !== false) 
                                                    ? 'bg-brand-accent/20 text-blue-400 border border-brand-accent/40' 
                                                    : 'bg-brand-dark3 text-gray-300 border border-brand-dark4/50'; 
                                            ?>">
                                            <?php echo htmlspecialchars($turma['periodo']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="py-12 text-center text-brand-dark5">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <i data-lucide="inbox" class="w-10 h-10 opacity-50"></i>
                                        <p>Nenhuma turma encontrada no banco de dados.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex items-center justify-between text-xs text-brand-dark5">
                <p>Mostrando <span class="font-bold text-white"><?php echo count($turmas); ?></span> registros no total.<span id="contadorFiltro" class="font-medium text-brand-accent ml-1"></span></p>
                <div class="flex gap-2">
                    <button class="p-1.5 rounded-md hover:bg-brand-dark2 transition-colors cursor-not-allowed opacity-50"><i data-lucide="chevron-left" class="w-4 h-4"></i></button>
                    <button class="p-1.5 rounded-md hover:bg-brand-dark2 hover:text-white transition-colors"><i data-lucide="chevron-right" class="w-4 h-4"></i></button>
                </div>
            </div>

        </div>
        
        <p class="text-center text-[10px] text-brand-dark5 mt-6 font-light uppercase tracking-widest">
            © 2026 Portal SENAI Integra. Todos os direitos reservados.
        </p>

    </main>

    <script>
        // Inicializa os ícones Lucide
        lucide.createIcons();

        // --- SISTEMA DE PESQUISA/FILTRO EM TEMPO REAL ---
        document.addEventListener('DOMContentLoaded', function() {
            const inputPesquisa = document.getElementById('campoFiltro');
            const linhas = document.querySelectorAll('.linha-tabela');
            const contadorFiltro = document.getElementById('contadorFiltro');

            if(inputPesquisa) {
                inputPesquisa.addEventListener('input', function() {
                    const termo = this.value.toLowerCase().trim();
                    let visiveis = 0;

                    linhas.forEach(linha => {
                        // Verifica se o conteúdo textual da linha engloba o termo pesquisado
                        if (linha.textContent.toLowerCase().includes(termo)) {
                            linha.style.display = ''; // Exibe a linha
                            visiveis++;
                        } else {
                            linha.style.display = 'none'; // Oculta a linha
                        }
                    });

                    // Atualiza dinamicamente o contador do filtro no rodapé
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