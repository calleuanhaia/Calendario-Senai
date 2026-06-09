<?php
    include "config/config.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Proteção correta contra SQL Injection usando Prepared Statements (:id)
        $sql = "SELECT * FROM professores WHERE id = :id";
        $consulta = $pdo->prepare($sql);
        $consulta->execute([':id' => $id]);

        $professor = $consulta->fetch(PDO::FETCH_ASSOC);
    }
?>

<div class="max-w-2xl mx-auto w-full bg-brand-dark1/60 backdrop-blur-md border border-brand-dark4/40 rounded-2xl p-8 shadow-[0_10px_30px_rgba(0,0,0,0.3)] mt-8">
    
    <div class="flex items-center gap-4 mb-8 border-b border-brand-dark4/40 pb-6">
        <div class="w-12 h-12 bg-brand-dark2 rounded-xl flex items-center justify-center border border-brand-accent/30 shadow-[0_0_15px_rgba(0,92,169,0.2)]">
            <i data-lucide="graduation-cap" class="text-brand-accent w-6 h-6"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-white">Editar Professor / Coordenação</h2>
            <p class="text-sm text-brand-dark5 mt-1">Atualize as informações cadastrais e credenciais de acesso do docente.</p>
        </div>
    </div>

    <form action="api/atualizar/atualiza_professores_cordenacao.php" method="POST" class="space-y-6">
        
        <input type="hidden" name="id" value="<?php echo isset($professor['id']) ? $professor['id'] : ''; ?>">

        <div>
            <label class="block text-xs font-semibold text-brand-dark5 uppercase tracking-wider mb-2">Nome Completo</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i data-lucide="user" class="w-5 h-5 text-brand-dark5"></i>
                </div>
                <input type="text" name="nome" required 
                    class="w-full pl-12 pr-4 py-3 bg-brand-dark2/50 border border-brand-dark4/60 rounded-xl text-sm text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300"
                    value="<?php echo isset($professor['nome']) ? htmlspecialchars($professor['nome']) : ''; ?>"
                    placeholder="Nome completo do professor">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold text-brand-dark5 uppercase tracking-wider mb-2">E-mail Institucional</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i data-lucide="mail" class="w-5 h-5 text-brand-dark5"></i>
                    </div>
                    <input type="email" name="email" required 
                        class="w-full pl-12 pr-4 py-3 bg-brand-dark2/50 border border-brand-dark4/60 rounded-xl text-sm text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300"
                        value="<?php echo isset($professor['email']) ? htmlspecialchars($professor['email']) : ''; ?>"
                        placeholder="exemplo@institucional.com">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-brand-dark5 uppercase tracking-wider mb-2">IDP (Login)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i data-lucide="fingerprint" class="w-5 h-5 text-brand-dark5"></i>
                    </div>
                    <input type="text" name="login-id" required 
                        class="w-full pl-12 pr-4 py-3 bg-brand-dark2/50 border border-brand-dark4/60 rounded-xl text-sm text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300"
                        value="<?php echo isset($professor['idp']) ? htmlspecialchars($professor['idp']) : ''; ?>"
                        placeholder="Identificador de acesso">
                </div>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-brand-dark5 uppercase tracking-wider mb-2">Nova Senha de Acesso</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i data-lucide="lock" class="w-5 h-5 text-brand-dark5"></i>
                </div>
                <input type="password" name="password" 
                    class="w-full pl-12 pr-4 py-3 bg-brand-dark2/50 border border-brand-dark4/60 rounded-xl text-sm text-white placeholder-brand-dark5 focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-all duration-300"
                    value="<?php echo isset($professor['senha']) ? htmlspecialchars($professor['senha']) : ''; ?>"
                    placeholder="Digite uma nova senha se desejar alterar">
            </div>
        </div>

        <div class="pt-4 mt-6 border-t border-brand-dark4/40">
            <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 bg-brand-accent hover:bg-brand-accentHover text-white text-sm font-bold rounded-xl transition-all shadow-[0_0_20px_rgba(0,92,169,0.3)] hover:shadow-[0_0_25px_rgba(0,92,169,0.5)] active:scale-[0.98]">
                <i data-lucide="save" class="w-5 h-5"></i>
                Atualizar Registro
            </button>
        </div>

    </form>
</div>