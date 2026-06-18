        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-4 px-6 mt-auto">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <p class="text-sm text-gray-500">
                    &copy; <script>document.write(new Date().getFullYear())</script> LancheMaster. Todos os direitos reservados.
                </p>
                <div class="mt-2 sm:mt-0 flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-gray-500"><i class="fa-solid fa-circle-question"></i> Suporte</a>
                    <span class="text-gray-300">|</span>
                    <span class="text-sm text-gray-500">Versão 1.0.0</span>
                </div>
            </div>
        </footer>

    </div>

    <!-- Script para funcionalidade da UI (Sidebar Mobile) -->
    <script type="text/javascript" src="assets/js/main.js">
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            // Toggle classes for mobile slide-in
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>
</body>
</html>