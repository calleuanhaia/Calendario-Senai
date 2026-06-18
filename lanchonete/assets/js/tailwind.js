        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        estokei: {
                            bg: '#0A102E',       // Azul Escuro Profundo (Fundo)
                            panel: '#131B42',    // Azul Escuro Médio (Cards/Sidebar)
                            panelHover: '#1C275C',// Azul Hover
                            accent: '#D4FF00',   // Verde/Amarelo Neon (Identidade)
                            accentHover: '#bce600',
                            textMain: '#F8FAFC', // Texto Principal
                            textMuted: '#94A3B8',// Texto Secundário
                            danger: '#EF4444',
                            success: '#10B981',
                            warning: '#F59E0B'
                        }
                    },
                    boxShadow: {
                        'neon': '0 0 15px rgba(212, 255, 0, 0.3)',
                        'neon-strong': '0 0 25px rgba(212, 255, 0, 0.5)',
                    }
                }
            }
        }