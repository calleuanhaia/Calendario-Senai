<?php 
    // 1. Conexão com o banco de dados fornecida por você
    include("config/config.php");

    // 2. Consulta ao banco de dados
    $sql = "SELECT * FROM horarios ORDER BY id DESC";
    $consulta = $pdo->query($sql);
    
    // 3. Obtém os resultados como um array associativo
    $horarios = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // --- FUNÇÕES MANTIDAS E ADAPTADAS ---
    
    // 1. Data atual para o destaque
    $dataAtual = date('Y-m-d');

    // 2. Simulação de alerta de emergência de professores
    $professoresEmergencia = ['João', 'Maria', 'Substituto']; 

    // 3. Divisão de cores adaptada para o Modo Escuro Premium (Badges Translúcidos)
    if (!function_exists('obterCorCurso')) {
        function obterCorCurso($nomeCurso) {
            $cores = [
                'bg-blue-500/10 text-blue-400 border border-blue-500/20', 
                'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20', 
                'bg-purple-500/10 text-purple-400 border border-purple-500/20', 
                'bg-amber-500/10 text-amber-400 border border-amber-500/20', 
                'bg-pink-500/10 text-pink-400 border border-pink-500/20', 
                'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20'
            ];
            // Cria um ID numérico a partir do texto para garantir estabilidade de cor por curso
            $hash = crc32($nomeCurso);
            return $cores[$hash % count($cores)];
        }
    }
    if(!isset($_SESSION['usuario_nome'])) {
        header("Location: login.php");
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
    <title>SENAI Integra - Quadro de Horários</title>
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
                        <i data-lucide="calendar" class="text-brand-accent w-6 h-6"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white mb-0.5">Quadro de Horários</h1>
                        <p class="text-sm text-brand-dark5 font-light">Consulte a lista atualizada de cursos, professores e seus respectivos horários.</p>
                    </div>
                </div>
            </div>

            <div class="mb-6 flex flex-col md:flex-row gap-4 justify-between items-center">
                <div class="w-full md:w-1/2 relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i data-lucide="search" class="w-4 h-4 text-brand-dark5"></i>
                    </div>
                    <input type="text" id="campoFiltro" class="bg-brand-dark2/50 border border-brand-dark4/60 text-white text-sm rounded-xl focus:ring-1 focus:ring-brand-accent focus:border-brand-accent block w-full pl-10 p-2.5 outline-none transition-all placeholder-brand-dark5" placeholder="Filtrar por curso, professor, data...">
                </div>
                <?php if ($tipo === 'professor' || $tipo === 'coordenacao'): ?>
                    <button onclick="location.href='index.php?page=cadastro_calendario_alunos.php'" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-brand-dark2 hover:bg-brand-dark3 border border-brand-dark4/60 text-white text-sm font-medium py-2.5 px-4 rounded-xl transition-all duration-300 hover:border-brand-accent focus:outline-none focus:ring-1 focus:ring-brand-accent">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        Novo Horário
                    </button>
                <?php endif; ?>
                <div class="w-full md:w-auto bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-2.5 rounded-xl flex items-center gap-2 shadow-[0_0_15px_rgba(239,68,68,0.05)]" role="alert">
                    <i data-lucide="alert-triangle" class="w-4 h-4 animate-pulse text-red-400"></i>
                    <span class="font-medium text-xs tracking-wide">Fique atento aos alertas destacados em vermelho</span>
                </div>
            </div>

            <div class="overflow-auto max-h-[60vh] rounded-2xl border border-brand-dark4/40 bg-brand-bg/50">
                <table class="w-full text-left border-collapse whitespace-nowrap relative">
                    <thead class="bg-brand-dark2/80 text-brand-dark5 text-[11px] uppercase tracking-widest font-semibold border-b border-brand-dark4/60 sticky top-0 z-10 backdrop-blur-md">
                        <tr>
                            <th class="py-4 px-6">Data</th>
                            <th class="py-4 px-6">Hora</th>
                            <th class="py-4 px-6">Professor(a)</th>
                            <th class="py-4 px-6">Curso</th>
                            <?php if ($tipo === 'professor' || $tipo === 'coordenacao'): ?>
                                <th class="py-4 px-6">Ações</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    
                    <tbody id="corpoTabela" class="text-sm text-gray-300 divide-y divide-brand-dark4/30">
                        <?php if (count($horarios) > 0): ?>
                            
                            <?php foreach ($horarios as $horario): ?>
                                
                                <?php 
                                    $dataBd = $horario['horario_data'];
                                    $dataFormatada = !empty($dataBd) ? date('d/m/Y', strtotime($dataBd)) : '---';
                                    
                                    $horaBd = $horario['horario_hora'];
                                    $horaFormatada = !empty($horaBd) ? date('H:i', strtotime($horaBd)) : '---';
                                    
                                    // 1. Verificação de Destaque da Data Atual
                                    $isHoje = ($dataBd === $dataAtual);
                                    
                                    // 2. Verificação de Alerta de Emergência
                                    $nomeProf = $horario['horario_professor'];
                                    $isEmergencia = false;
                                    foreach($professoresEmergencia as $profEmergencia) {
                                        if (stripos($nomeProf, $profEmergencia) !== false) {
                                            $isEmergencia = true; break;
                                        }
                                    }

                                    // 3. Aplicação de Classes CSS Adaptadas para o Modo Escuro
                                    $classesLinha = "transition-colors duration-200 group linha-horario ";
                                    if ($isEmergencia) {
                                        $classesLinha .= "bg-red-950/20 hover:bg-red-950/40 border-l-4 border-l-red-500";
                                    } elseif ($isHoje) {
                                        $classesLinha .= "bg-amber-950/20 hover:bg-amber-950/40 border-l-4 border-l-amber-500";
                                    } else {
                                        $classesLinha .= "hover:bg-brand-dark2/40 border-l-4 border-l-transparent";
                                    }

                                    // 4. Resgate do Badge Customizado do Curso
                                    $corBadgeCurso = obterCorCurso($horario['horario_curso']);
                                ?>

                                <tr class="<?php echo $classesLinha; ?>">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="calendar-days" class="w-4 h-4 text-brand-dark5"></i>
                                            <span class="font-medium <?php echo $isHoje ? 'text-amber-400' : ($isEmergencia ? 'text-red-400' : 'text-white'); ?>">
                                                <?php echo htmlspecialchars($dataFormatada); ?>
                                            </span>
                                            <?php if($isHoje): ?>
                                                <span class="ml-1 px-2 py-0.5 bg-amber-500/20 border border-amber-500/40 text-amber-400 text-[10px] font-bold rounded-full uppercase tracking-wider">Hoje</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                        <div class="flex items-center text-gray-300 gap-2">
                                            <i data-lucide="clock" class="w-4 h-4 text-brand-dark5"></i>
                                            <span class="font-mono"><?php echo htmlspecialchars($horaFormatada); ?></span>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-full flex items-center justify-center text-[10px] font-bold text-white uppercase shadow-inner <?php echo $isEmergencia ? 'bg-red-900/50 border border-red-500/40' : ($isHoje ? 'bg-amber-900/50 border border-amber-500/40' : 'bg-brand-dark3 border border-brand-dark4/60'); ?>">
                                                <?php echo mb_substr(htmlspecialchars($nomeProf), 0, 1, 'UTF-8'); ?>
                                            </div>
                                            <span class="<?php echo $isEmergencia ? 'font-bold text-red-400' : 'text-gray-200'; ?>">
                                                <?php echo htmlspecialchars($nomeProf); ?>
                                            </span>
                                            <?php if($isEmergencia): ?>
                                                <span title="Alerta de Emergência!" class="flex items-center justify-center w-5 h-5 bg-red-500/20 text-red-400 rounded-full border border-red-500/30 animate-pulse">
                                                    <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                        <span class="inline-block px-3 py-1 rounded-full text-[11px] font-semibold tracking-wide <?php echo $corBadgeCurso; ?>">
                                            <?php echo htmlspecialchars($horario['horario_curso']); ?>
                                        </span>
                                    </td>
                                    <?php if ($tipo === 'professor' || $tipo === 'coordenacao'): ?>
                                        <td class="py-4 px-6">
                                            <a href="index.php?page=atualizar_calendario.php&id=<?php echo $horario['id']; ?>" class="text-brand-accent hover:text-brand-accentLight transition-colors text-sm font-medium">
                                                Atualizar Horário
                                            </a>
                                            <a href="api/deletar/delete_calendario.php?table=horarios&id=<?php echo $horario['id']; ?>" 
                                                class="flex items-center gap-1 text-red-500 hover:text-red-400 transition-colors text-sm font-medium bg-red-500/10 hover:bg-red-500/20 px-3 py-1.5 rounded-lg border border-red-500/20 w-max">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                Excluir Horário
                                            </a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                            
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="py-12 text-center text-brand-dark5">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <i data-lucide="inbox" class="w-10 h-10 opacity-40"></i>
                                        <p class="text-base font-light">Nenhum horário cadastrado no momento.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6 flex items-center justify-between text-xs text-brand-dark5">
                <p>Total de registros no sistema: <span class="font-bold text-white"><?php echo count($horarios); ?></span><span id="contadorFiltro" class="font-medium text-brand-accent ml-1"></span></p>
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
            const linhas = document.querySelectorAll('.linha-horario');
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