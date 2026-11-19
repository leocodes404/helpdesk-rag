/**
 * HelpDesk RAG - Global Theme Controller (Light & Dark Mode)
 * Gestión persistente del tema sin parpadeos y con sincronización en tiempo real
 */

(function() {
    const THEME_KEY = 'helpdesk-theme';

    const getStoredTheme = () => localStorage.getItem(THEME_KEY);

    const getPreferredTheme = () => {
        const stored = getStoredTheme();
        if (stored) return stored;
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    };

    const setTheme = (theme) => {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem(THEME_KEY, theme);
        
        // Disparar evento personalizado por si otros módulos reaccionan al tema
        window.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme } }));
    };

    // Inicializar listeners al cargar el DOM
    document.addEventListener('DOMContentLoaded', () => {
        // Enlazar todos los botones con clase theme-toggle-btn
        const toggleButtons = document.querySelectorAll('.theme-toggle-btn');

        toggleButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
                const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
                setTheme(nextTheme);
            });
        });

        // Escuchar cambios del sistema operativo si el usuario no ha forzado uno
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!getStoredTheme()) {
                setTheme(e.matches ? 'dark' : 'light');
            }
        });
    });

    // Exponer API global
    window.HelpDeskTheme = {
        getTheme: () => document.documentElement.getAttribute('data-theme') || 'light',
        setTheme: setTheme
    };
})();
