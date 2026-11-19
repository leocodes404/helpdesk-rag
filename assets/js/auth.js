/**
 * HelpDesk RAG - Authentication UI Interactions
 * Control de segmented control, medidor de contraseña y visibilidad
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Segmented Control (Pestañas Iniciar Sesión / Crear Cuenta)
    const segmentedControl = document.querySelector('.auth-segmented-control');
    const tabButtons = document.querySelectorAll('.auth-tab-btn');
    const tabContents = document.querySelectorAll('.auth-tab-content');

    const switchTab = (tabName) => {
        if (!segmentedControl) return;

        segmentedControl.setAttribute('data-active', tabName);

        tabButtons.forEach(btn => {
            btn.classList.toggle('active', btn.getAttribute('data-tab') === tabName);
        });

        tabContents.forEach(content => {
            content.classList.toggle('active', content.id === `tab-${tabName}`);
        });
    };

    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const tabName = btn.getAttribute('data-tab');
            switchTab(tabName);
        });
    });

    // Activar pestaña predeterminada si viene indicada en el contenedor
    if (segmentedControl) {
        const initialTab = segmentedControl.getAttribute('data-active') || 'login';
        switchTab(initialTab);
    }

    // 2. Mostrar / Ocultar contraseñas
    const toggleButtons = document.querySelectorAll('.auth-password-toggle');
    toggleButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetInputId = btn.getAttribute('data-target');
            const input = document.getElementById(targetInputId);
            if (!input) return;

            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';

            // Alternar icono SVG
            const eyeOpen = btn.querySelector('.eye-open');
            const eyeClosed = btn.querySelector('.eye-closed');
            if (eyeOpen && eyeClosed) {
                eyeOpen.style.display = isPassword ? 'none' : 'block';
                eyeClosed.style.display = isPassword ? 'block' : 'none';
            }
        });
    });

    // 3. Medidor interactivo de fortaleza de contraseña
    const regPassword = document.getElementById('reg_password');
    const strengthFill = document.getElementById('strength-fill');
    const strengthText = document.getElementById('strength-text');

    if (regPassword && strengthFill && strengthText) {
        regPassword.addEventListener('input', () => {
            const val = regPassword.value;
            let score = 0;

            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            if (val.length === 0) {
                strengthFill.style.width = '0%';
                strengthText.textContent = 'Mínimo 8 caracteres';
                strengthText.style.color = 'var(--text-muted)';
            } else if (score <= 1) {
                strengthFill.style.width = '25%';
                strengthFill.style.backgroundColor = '#EF4444';
                strengthText.textContent = 'Débil (se requieren al menos 8 caracteres)';
                strengthText.style.color = '#EF4444';
            } else if (score === 2) {
                strengthFill.style.width = '55%';
                strengthFill.style.backgroundColor = '#F59E0B';
                strengthText.textContent = 'Media (añade números o mayúsculas)';
                strengthText.style.color = '#F59E0B';
            } else {
                strengthFill.style.width = '100%';
                strengthFill.style.backgroundColor = '#10B981';
                strengthText.textContent = 'Contraseña Segura';
                strengthText.style.color = '#10B981';
            }

            checkPasswordMatch();
        });
    }

    // 4. Validación en vivo de coincidencia de contraseñas
    const regConfirm = document.getElementById('reg_password_confirm');
    const matchIndicator = document.getElementById('match-indicator');

    const checkPasswordMatch = () => {
        if (!regPassword || !regConfirm || !matchIndicator) return;

        const p1 = regPassword.value;
        const p2 = regConfirm.value;

        if (p2.length === 0) {
            matchIndicator.textContent = '';
            matchIndicator.className = 'auth-match-indicator';
            return;
        }

        if (p1 === p2) {
            matchIndicator.innerHTML = '✓ Las contraseñas coinciden';
            matchIndicator.className = 'auth-match-indicator match';
        } else {
            matchIndicator.innerHTML = '✕ Las contraseñas no coinciden';
            matchIndicator.className = 'auth-match-indicator mismatch';
        }
    };

    if (regConfirm) {
        regConfirm.addEventListener('input', checkPasswordMatch);
    }

    // 5. Estado de carga en envío de formularios
    document.querySelectorAll('.auth-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const btn = this.querySelector('.auth-submit-btn');
            if (btn) {
                btn.classList.add('loading');
                btn.innerHTML = `
                    <svg class="spinner" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="animation: spin 0.8s linear infinite;">
                        <circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle>
                        <path d="M12 2a10 10 0 0 1 10 10" stroke-opacity="0.9"></path>
                    </svg>
                    <span>Procesando...</span>
                `;
            }
        });
    });
});
