// --- 1. Sidebar Toggle Logic (Mobile) ---
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        let isSidebarOpen = false;

        function toggleSidebar() {
            isSidebarOpen = !isSidebarOpen;
            if (isSidebarOpen) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.add('opacity-100'), 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.remove('opacity-100');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }

        // --- 2. Chart.js Initialization ---
        document.addEventListener('DOMContentLoaded', function() {
            
            // Common Chart Setup for Dark Theme
            Chart.defaults.color = '#94A3B8'; // estokei-textMuted
            Chart.defaults.font.family = 'Inter, sans-serif';
            const brandAccent = '#D4FF00';
            const brandPanel = '#131B42';
            
            // Movement Bar Chart
            const ctxMovement = document.getElementById('movementChart').getContext('2d');
            
            // Create Gradient for Bars
            const gradientIn = ctxMovement.createLinearGradient(0, 0, 0, 400);
            gradientIn.addColorStop(0, 'rgba(212, 255, 0, 0.8)'); // Accent
            gradientIn.addColorStop(1, 'rgba(212, 255, 0, 0.1)');

            const gradientOut = ctxMovement.createLinearGradient(0, 0, 0, 400);
            gradientOut.addColorStop(0, 'rgba(239, 68, 68, 0.8)'); // Danger red
            gradientOut.addColorStop(1, 'rgba(239, 68, 68, 0.1)');

            new Chart(ctxMovement, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                    datasets: [
                        {
                            label: 'Entradas',
                            data: [650, 590, 800, 810, 560, 550, 400, 700, 650, 820, 900, 1000],
                            backgroundColor: gradientIn,
                            borderRadius: 6,
                            borderWidth: 0,
                            barPercentage: 0.6,
                            categoryPercentage: 0.8
                        },
                        {
                            label: 'Saídas',
                            data: [400, 450, 500, 600, 450, 400, 300, 500, 480, 600, 750, 800],
                            backgroundColor: gradientOut,
                            borderRadius: 6,
                            borderWidth: 0,
                            barPercentage: 0.6,
                            categoryPercentage: 0.8
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'end',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 8,
                                padding: 20
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(10, 16, 46, 0.9)', // estokei-bg
                            titleColor: '#fff',
                            bodyColor: '#cbd5e1',
                            borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1,
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: true,
                            boxPadding: 4
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)',
                                drawBorder: false,
                            },
                            border: { display: false }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false,
                            },
                            border: { display: false }
                        }
                    }
                }
            });

            // Category Doughnut Chart
            const ctxCategory = document.getElementById('categoryChart').getContext('2d');
            new Chart(ctxCategory, {
                type: 'doughnut',
                data: {
                    labels: ['Eletrônicos', 'Móveis', 'Periféricos', 'Escritório'],
                    datasets: [{
                        data: [45, 25, 20, 10],
                        backgroundColor: [
                            '#D4FF00', // Brand Accent
                            '#3B82F6', // Blue
                            '#8B5CF6', // Purple
                            '#10B981'  // Green
                        ],
                        borderWidth: 4,
                        borderColor: brandPanel, // Matches panel background to create gaps
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                color: '#94A3B8'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(10, 16, 46, 0.9)',
                            padding: 12,
                            cornerRadius: 8,
                            borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1
                        }
                    }
                }
            });

            // --- 3. Lógica de Pesquisa da Tabela em Tempo Real ---
            const searchInput = document.getElementById('tableSearch');
            const tableBody = document.getElementById('movementsTableBody');
            
            if (searchInput && tableBody) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const rows = tableBody.getElementsByTagName('tr');
                    
                    Array.from(rows).forEach(row => {
                        // Captura todo o texto da linha (Produto, SKU, Tipo, Status, etc)
                        const rowText = row.textContent.toLowerCase();
                        
                        // Exibe a linha se o texto digitado existir nela, caso contrário, oculta
                        if (rowText.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        });