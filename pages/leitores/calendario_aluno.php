<?php 
    // 1. Conexão com o banco de dados fornecida por você
    include("config/config.php");

    // 2. Consulta ao banco de dados
    $sql = "SELECT * FROM horarios ORDER BY horario_data ASC, horario_hora ASC";
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

    // --- LÓGICA DO CALENDÁRIO ---
    // Determinar o mês e ano atual a ser exibido
    $ym = isset($_GET['ym']) ? $_GET['ym'] : date('Y-m');
    $timestamp = strtotime($ym . '-01');
    if ($timestamp === false) {
        $ym = date('Y-m');
        $timestamp = strtotime($ym . '-01');
    }

    // Variáveis para navegação de meses
    $prev_ym = date('Y-m', strtotime('-1 month', $timestamp));
    $next_ym = date('Y-m', strtotime('+1 month', $timestamp));

    // Função para manter os parâmetros de página/rota ao mudar de mês
    function buildUrlCalendario($ym) {
        $params = $_GET;
        $params['ym'] = $ym;
        return '?' . http_build_query($params);
    }

    // Limites do calendário atual
    $numeroDiasMes = date('t', $timestamp);
    $diaSemanaPrimeiroDia = date('w', $timestamp); // 0 (Dom) a 6 (Sáb)
    $mesAtualNum = date('n', $timestamp);
    $anoAtualNum = date('Y', $timestamp);

    $mesesPt = ['', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    $tituloMes = $mesesPt[$mesAtualNum] . ' de ' . $anoAtualNum;

    // Agrupar os horários por data para renderizar nos dias do calendário
    $eventosPorData = [];
    foreach ($horarios as $horario) {
        $dataBd = $horario['horario_data'];
        if (!isset($eventosPorData[$dataBd])) {
            $eventosPorData[$dataBd] = [];
        }
        $eventosPorData[$dataBd][] = $horario;
    }
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

        /* Customização da barra de rolagem */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
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

    <main class="relative z-10 w-full max-w-7xl my-auto">
        
        <div class="bg-brand-dark1/90 backdrop-blur-2xl border border-brand-dark4/50 rounded-3xl p-6 sm:p-8 shadow-[0_25px_60px_rgba(0,0,0,0.6)] relative overflow-hidden">
            
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-brand-accent to-transparent"></div>

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-brand-dark2 rounded-xl flex items-center justify-center border border-brand-accent/30 shadow-[0_0_15px_rgba(0,92,169,0.2)]">
                        <i data-lucide="calendar" class="text-brand-accent w-6 h-6"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white mb-0.5">Calendário de Horários</h1>
                        <p class="text-sm text-brand-dark5 font-light">Gerencie e visualize a grade curricular mensal.</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 bg-brand-dark2/50 border border-brand-dark4/60 rounded-xl p-1.5 w-full md:w-auto justify-between">
                    <a href="<?php echo buildUrlCalendario($prev_ym); ?>" class="p-2 rounded-lg hover:bg-brand-dark3 transition-colors text-brand-dark5 hover:text-white" title="Mês Anterior">
                        <i data-lucide="chevron-left" class="w-5 h-5"></i>
                    </a>
                    <span class="font-semibold text-white tracking-wide text-sm px-4 uppercase"><?php echo $tituloMes; ?></span>
                    <a href="<?php echo buildUrlCalendario($next_ym); ?>" class="p-2 rounded-lg hover:bg-brand-dark3 transition-colors text-brand-dark5 hover:text-white" title="Próximo Mês">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>

            <div class="mb-6 flex flex-col lg:flex-row gap-4 justify-between items-center">
                <div class="w-full lg:w-1/3 relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i data-lucide="search" class="w-4 h-4 text-brand-dark5"></i>
                    </div>
                    <input type="text" id="campoFiltro" class="bg-brand-dark2/50 border border-brand-dark4/60 text-white text-sm rounded-xl focus:ring-1 focus:ring-brand-accent focus:border-brand-accent block w-full pl-10 p-2.5 outline-none transition-all placeholder-brand-dark5" placeholder="Filtrar eventos do mês...">
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">

                    <?php if ($tipo === 'professor' || $tipo === 'coordenacao'): ?>
                        <button onclick="location.href='index.php?page=cadastro_calendario_alunos.php'" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-brand-dark2 hover:bg-brand-dark3 border border-brand-dark4/60 text-white text-sm font-medium py-2.5 px-6 rounded-xl transition-all duration-300 hover:border-brand-accent focus:outline-none focus:ring-1 focus:ring-brand-accent whitespace-nowrap">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            Novo Horário
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-brand-dark4/40 bg-brand-bg/40">
                <div class="min-w-[900px]"> <div class="grid grid-cols-7 gap-px bg-brand-dark4/40 border-b border-brand-dark4/60">
                        <?php 
                        $diasSemana = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
                        foreach ($diasSemana as $dia) {
                            echo "<div class='text-center py-3 text-[11px] uppercase tracking-widest font-semibold text-brand-dark5 bg-brand-dark2/80 backdrop-blur-md'>{$dia}</div>";
                        }
                        ?>
                    </div>

                    <div class="grid grid-cols-7 gap-px bg-brand-dark4/40">
                        <?php
                        // Células vazias iniciais
                        for ($i = 0; $i < $diaSemanaPrimeiroDia; $i++) {
                            echo '<div class="bg-brand-bg/50 min-h-[140px]"></div>';
                        }

                        // Loop de todos os dias do mês
                        for ($dia = 1; $dia <= $numeroDiasMes; $dia++) {
                            $dataLoop = $ym . '-' . str_pad($dia, 2, '0', STR_PAD_LEFT);
                            $isHoje = ($dataLoop === $dataAtual);
                            
                            $bgCell = $isHoje ? 'bg-amber-950/10' : 'bg-brand-dark1/60 hover:bg-brand-dark2/30 transition-colors';
                            $borderCell = $isHoje ? 'border-t-2 border-t-amber-500' : '';
                            $textDay = $isHoje ? 'text-amber-400 bg-amber-500/10 rounded-md px-1.5' : 'text-gray-400';

                            echo "<div class='min-h-[140px] p-2 flex flex-col gap-2 relative {$bgCell} {$borderCell} group/cell'>";
                            
                            // Cabeçalho da Célula (Número do dia)
                            echo "<div class='flex justify-between items-center mb-1'>";
                            echo "<span class='text-sm font-bold {$textDay}'>{$dia}</span>";
                            if ($isHoje) {
                                echo "<span class='text-[9px] uppercase font-bold tracking-wider text-amber-500'>Hoje</span>";
                            }
                            echo "</div>";

                            // Container de Eventos do dia
                            echo "<div class='flex flex-col gap-2 overflow-y-auto max-h-[220px] pr-1 pb-1'>";
                            
                            if (isset($eventosPorData[$dataLoop])) {
                                foreach ($eventosPorData[$dataLoop] as $horario) {
                                    $horaBd = $horario['horario_hora'];
                                    $horaFormatada = !empty($horaBd) ? date('H:i', strtotime($horaBd)) : '--:--';
                                    $nomeProf = $horario['horario_professor'];
                                    $nomeCurso = $horario['horario_curso'];
                                    
                                    // Verificação de Alerta de Emergência
                                    $isEmergencia = false;
                                    foreach($professoresEmergencia as $profEmergencia) {
                                        if (stripos($nomeProf, $profEmergencia) !== false) {
                                            $isEmergencia = true; break;
                                        }
                                    }

                                    // Customização das Cores do Card (Mesma função de antes)
                                    $classesPill = obterCorCurso($nomeCurso);
                                    if ($isEmergencia) {
                                        $classesPill = 'bg-red-950/40 text-red-400 border border-red-500/50';
                                    }

                                    // Render do Card do Evento (que substitui a linha da tabela)
                                    ?>
                                    <div class="evento-calendario relative group p-2 rounded-lg text-left shadow-sm flex flex-col gap-1 transition-all hover:scale-[1.02] <?php echo $classesPill; ?>">
                                        
                                        <div class="flex justify-between items-center">
                                            <span class="text-xs font-bold font-mono tracking-tight flex items-center gap-1">
                                                <i data-lucide="clock" class="w-3 h-3 opacity-70"></i> 
                                                <?php echo htmlspecialchars($horaFormatada); ?>
                                            </span>
                                            <?php if($isEmergencia): ?>
                                                <i data-lucide="alert-circle" class="w-3 h-3 text-red-400 animate-pulse" title="Alerta!"></i>
                                            <?php endif; ?>
                                        </div>

                                        <div class="text-[11px] font-semibold flex items-center gap-1.5 truncate">
                                            <div class="w-4 h-4 rounded flex items-center justify-center text-[8px] bg-black/20 font-bold uppercase shrink-0">
                                                <?php echo mb_substr(htmlspecialchars($nomeProf), 0, 1, 'UTF-8'); ?>
                                            </div>
                                            <span class="truncate" title="<?php echo htmlspecialchars($nomeProf); ?>">
                                                <?php echo htmlspecialchars($nomeProf); ?>
                                            </span>
                                        </div>

                                        <div class="text-[10px] font-medium opacity-80 truncate leading-tight uppercase" title="<?php echo htmlspecialchars($nomeCurso); ?>">
                                            <?php echo htmlspecialchars($nomeCurso); ?>
                                        </div>

                                        <?php if ($tipo === 'professor' || $tipo === 'coordenacao'): ?>
                                            <div class="flex items-center gap-2 mt-1.5 pt-1.5 border-t border-current border-opacity-20 justify-end md:opacity-0 md:group-hover:opacity-100 transition-opacity">
                                                <a href="index.php?page=atualizar_calendario.php&id=<?php echo $horario['id']; ?>" class="hover:text-white transition-colors" title="Editar">
                                                    <i data-lucide="edit-2" class="w-3.5 h-3.5"></i>
                                                </a>
                                                <a href="api/deletar/delete_calendario.php?table=horarios&id=<?php echo $horario['id']; ?>" class="text-red-400 hover:text-red-300 transition-colors" title="Excluir">
                                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <?php
                                }
                            }
                            
                            echo "</div>"; // Fim Container de Eventos
                            echo "</div>"; // Fim Célula do dia
                        }

                        // Completar as células vazias do final para fechar o grid simétrico (opcional mas recomendado)
                        $totalCelulas = $diaSemanaPrimeiroDia + $numeroDiasMes;
                        $restoGrid = $totalCelulas % 7;
                        if ($restoGrid != 0) {
                            $celulasFaltantes = 7 - $restoGrid;
                            for ($i = 0; $i < $celulasFaltantes; $i++) {
                                echo '<div class="bg-brand-bg/50 min-h-[140px]"></div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex items-center justify-between text-xs text-brand-dark5">
                <p>Total de agendamentos visíveis: <span class="font-bold text-white"><?php echo count($horarios); ?></span><span id="contadorFiltro" class="font-medium text-brand-accent ml-1"></span></p>
            </div>

        </div>
        
        <p class="text-center text-[10px] text-brand-dark5 mt-6 font-light uppercase tracking-widest">
            © 2026 Portal SENAI Integra. Todos os direitos reservados.
        </p>

    </main>

    <script>
        lucide.createIcons();

        // --- SISTEMA DE FILTRO EM TEMPO REAL ADAPTADO PARA O CALENDÁRIO ---
        document.addEventListener('DOMContentLoaded', function() {
            const inputPesquisa = document.getElementById('campoFiltro');
            const eventos = document.querySelectorAll('.evento-calendario');
            const contadorFiltro = document.getElementById('contadorFiltro');

            if(inputPesquisa) {
                inputPesquisa.addEventListener('input', function() {
                    const termo = this.value.toLowerCase().trim();
                    let visiveis = 0;

                    eventos.forEach(evento => {
                        // Faz a busca em todo o conteúdo textual do "card" do evento
                        if (evento.textContent.toLowerCase().includes(termo)) {
                            evento.style.display = 'flex'; // Exibe o evento no calendário
                            visiveis++;
                        } else {
                            evento.style.display = 'none'; // Esconde o evento do calendário
                        }
                    });

                    if (termo.length > 0) {
                        contadorFiltro.textContent = ` (Filtrando: ${visiveis} resultado/s no mês atual)`;
                    } else {
                        contadorFiltro.textContent = '';
                    }
                });
            }
        });
    </script>
</body>

</html>