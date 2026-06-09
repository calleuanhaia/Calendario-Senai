<?php
    // 1. Conexão com o banco de dados
    include "config/config.php";
    
    // 2. Consulta ao banco de dados
    $sql="SELECT * FROM professores ORDER BY id DESC";
    $consulta=$pdo->query($sql);
    $professores=$consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI Integra - Atualização de Professores</title>
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

        /* Customização da barra de rolagem */
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
                        <i data-lucide="user-cog" class="text-brand-accent w-6 h-6"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white mb-0.5">Atualização de Professores</h1>
                        <p class="text-sm text-brand-dark5 font-light">Gerencie e edite os registros dos professores do sistema.</p>
                    </div>
                </div>
            </div>

            <div class="mb-6 flex flex-col md:flex-row gap-4 justify-between items-center">
                <div class="w-full relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i data-lucide="search" class="w-4 h-4 text-brand-dark5"></i>
                    </div>
                    <input type="text" id="campoFiltro" class="bg-brand-dark2/50 border border-brand-dark4/60 text-white text-sm rounded-xl focus:ring-1 focus:ring-brand-accent focus:border-brand-accent block w-full pl-10 p-2.5 outline-none transition-all placeholder-brand-dark5" placeholder="Filtrar registro para atualização...">
                </div>
            </div>

            <div class="overflow-auto max-h-[60vh] rounded-2xl border border-brand-dark4/40 bg-brand-bg/50">
                <table class="w-full text-left border-collapse whitespace-nowrap relative">
                    <thead class="bg-brand-dark2/80 text-brand-dark5 text-[11px] uppercase tracking-widest font-semibold border-b border-brand-dark4/60 sticky top-0 z-10 backdrop-blur-md">
                        <tr>
                            <th class="py-4 px-6">ID</th>
                            <th class="py-4 px-6">Nome</th>
                            <th class="py-4 px-6">Email</th>
                            <th class="py-4 px-6">Senha</th>
                            <th class="py-4 px-6">IDP</th>
                            <th class="py-4 px-6">Ação</th>
                        </tr>
                    </thead>
                    
                    <tbody id="corpoTabela" class="text-sm text-gray-300 divide-y divide-brand-dark4/30">
                        <?php if (count($professores) > 0): ?>
                            
                            <?php foreach ($professores as $professor): ?>
                                <?php $nomeProfessor = $professor['nome']; ?>

                                <tr class="transition-colors duration-200 group hover:bg-brand-accent/5 hover:border-l-brand-accent border-l-4 border-l-transparent linha-registro">
                                    <td class="py-4 px-6">
                                        <span class="text-brand-dark5 font-mono text-xs">#<?php echo htmlspecialchars($professor['id']); ?></span>
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-brand-dark3 border border-brand-dark4/60 flex items-center justify-center text-[11px] font-bold text-white uppercase shadow-inner">
                                                <?php echo mb_substr(htmlspecialchars($nomeProfessor), 0, 1, 'UTF-8'); ?>
                                            </div>
                                            <span class="font-medium text-gray-200">
                                                <?php echo htmlspecialchars($nomeProfessor); ?>
                                            </span>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                        <div class="flex items-center text-gray-400 gap-2">
                                            <i data-lucide="mail" class="w-4 h-4 opacity-70"></i>
                                            <span><?php echo htmlspecialchars($professor['email']); ?></span>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                        <div class="flex items-center text-gray-500 gap-2">
                                            <i data-lucide="key" class="w-4 h-4 opacity-70"></i>
                                            <span class="font-mono text-xs opacity-80">
                                                <?php echo htmlspecialchars($professor['senha']); ?>
                                            </span>
                                        </div>
                                    </td>

                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <span class="bg-brand-dark3/80 border border-brand-dark4/50 text-brand-dark5 px-2 py-1 rounded-md text-xs font-mono">
                                                <?php echo htmlspecialchars($professor['idp']); ?>
                                            </span>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                        <a href="index.php?page=atualizar_professores_cordenacao.php&id=<?php echo $professor['id']; ?>" 
                                           class="flex items-center gap-1.5 text-brand-accent hover:text-white transition-colors text-sm font-medium bg-brand-accent/10 hover:bg-brand-accent px-3 py-1.5 rounded-lg border border-brand-accent/20 hover:border-brand-accent w-max group-hover:shadow-[0_0_10px_rgba(0,92,169,0.3)]">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
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
                                        <p class="text-base font-light">Nenhum professor cadastrado no momento.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6 flex items-center justify-between text-xs text-brand-dark5">
                <p>Total de professores no sistema: <span class="font-bold text-white"><?php echo count($professores); ?></span><span id="contadorFiltro" class="font-medium text-brand-accent ml-1"></span></p>
            </div>

        </div>
        
        <p class="text-center text-[10px] text-brand-dark5 mt-6 font-light uppercase tracking-widest">
            © 2026 Portal SENAI Integra. Todos os direitos reservados.
        </p>

    </main>

    <script>
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', function() {
            const inputPesquisa = document.getElementById('campoFiltro');
            const linhas = document.querySelectorAll('.linha-registro');
            const contadorFiltro = document.getElementById('contadorFiltro');

            if(inputPesquisa) {
                inputPesquisa.addEventListener('input', function() {
                    const termo = this.value.toLowerCase().trim();
                    let visiveis = 0;

                    linhas.forEach(linha => {
                        if (linha.textContent.toLowerCase().includes(termo)) {
                            linha.style.display = ''; 
                            visiveis++;
                        } else {
                            linha.style.display = 'none'; 
                        }
                    });

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