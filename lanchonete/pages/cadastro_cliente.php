<?php
    include "config/config.php";

    // Garante que a sessão está ativa para pegar o e-mail do sidebar
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Pega o e-mail direto da sessão (do usuário logado)
    if (isset($_SESSION['usuario_email'])) {
        $email = $_SESSION['usuario_email'];

        // Proteção contra SQL Injection usando Prepared Statements (:email)
        $sql = "SELECT * FROM clientes WHERE email = :email";
        $consulta = $pdo->prepare($sql);
        $consulta->execute([':email' => $email]);

        $cliente = $consulta->fetch(PDO::FETCH_ASSOC);
    }

    $sql="SELECT * FROM cardapio ORDER BY id DESC";
    $consulta=$pdo->query($sql);
    $cardapios=$consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8 max-w-2xl">
    
    <div class="px-6 py-5 border-b border-gray-100">
        <h2 class="text-lg font-semibold text-gray-900">Registrar Novo Pedido</h2>
        <p class="text-sm text-gray-500 mt-1">Confirme seus dados e insira o que deseja pedir.</p>
    </div>

    <div class="p-6">
        <form method="POST" action="api/cadastrar_cliente.php" class="space-y-5">
            <input type="hidden" name="id" value="<?php echo isset($cliente['id']) ? $cliente['id'] : ''; ?>">
            <input type="hidden" name="id" value="<?php echo isset($cardapios['id']) ? $cardapios['id'] : ''; ?>">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                <input name="nome" value="<?php echo isset($cliente['nome']) ? $cliente['nome'] : '';?>" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors text-gray-900">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                <input name="telefone" value="<?php echo isset($cliente['telefone']) ? $cliente['telefone'] : '';?>" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors text-gray-900">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Endereço</label>
                <input name="endereco" value="<?php echo isset($cliente['endereco']) ? $cliente['endereco'] : '';?>" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors text-gray-900">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lanche</label>
                <select name="pedido" placeholder="Ex: X-Tudo..." class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors text-gray-900 placeholder-gray-400">
                <?php foreach ($cardapios as $cardapio): ?>
                    <option><?php echo $cardapio['lanches']; ?></option>
                <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bebida</label>
                <select name="pedido_b" placeholder="Ex: X-Tudo..." class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors text-gray-900 placeholder-gray-400">
                <?php foreach ($cardapios as $cardapio): ?>
                    <option><?php echo $cardapio['bebidas']; ?></option>
                <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Preço do Lanche</label>
                <select name="preco" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors text-gray-900">
                    <?php foreach ($cardapios as $cardapio): ?>
                        <option><?php echo $cardapio['preco'];?></option>
                    <?php endforeach; ?>
                </select>
                
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Preço da Bebida</label>
                <select name="preco_b" class="block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors text-gray-900">
                    <?php foreach ($cardapios as $cardapio): ?>
                        <option><?php echo $cardapio['preco_bebida'];?></option>
                    <?php endforeach; ?>
                </select>
                
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="w-full sm:w-auto bg-orange-500 hover:bg-orange-600 text-white px-6 py-2.5 rounded-lg text-sm font-semibold shadow-sm transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-paper-plane mr-2"></i> Enviar Pedido
                </button>
            </div>
        </form>
    </div>
</div>