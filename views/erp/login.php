<?php
// views/erp/login.php - Acceso y Registro de Personal TI (Split-Screen Moderno con Modo Claro/Oscuro)
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al Sistema - HelpDesk RAG</title>

    <!-- Script Anti-FOUC para prevenir parpadeo de tema -->
    <script>
        (function() {
            const saved = localStorage.getItem('helpdesk-theme');
            const theme = saved || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    <!-- Estilos del Sistema de Temas y Pantalla de Autenticación -->
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body class="auth-page">

    <div class="auth-split-wrapper">
        
        <!-- ====================================================================
             PANEL IZQUIERDO: BRANDING Y PROPUESTA DE VALOR
             ==================================================================== -->
        <aside class="auth-panel-brand">
            <div class="auth-brand-glow"></div>

            <div class="auth-brand-header">
                <a href="index.php?ruta=inicio" class="auth-back-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span>Volver al inicio</span>
                </a>

                <div class="auth-brand-logo">
                    <div class="auth-logo-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5"></path>
                            <path d="M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                    <span>HelpDesk <span style="color: #38BDF8;">RAG</span></span>
                </div>
            </div>

            <div class="auth-brand-content">
                <span class="auth-brand-tag">Gestión Institucional TI</span>
                <h1 class="auth-brand-title">
                    Control centralizado y soporte inteligente <span>con IA y RAG</span>
                </h1>
                <p class="auth-brand-desc">
                    Plataforma para recepción de incidencias, triaje predictivo asistido y resolución fundamentada en la base de conocimiento institucional.
                </p>

                <!-- Tarjeta Glassmorphism de Indicadores -->
                <div class="auth-features-card">
                    <div class="auth-feature-row">
                        <div class="auth-feature-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                        </div>
                        <div class="auth-feature-text">
                            <h4>Persistencia MySQL 3FN</h4>
                            <p>Transacciones ACID con integridad referencial e historial inmutable.</p>
                        </div>
                    </div>

                    <div class="auth-feature-row">
                        <div class="auth-feature-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        </div>
                        <div class="auth-feature-text">
                            <h4>Control de Acceso RBAC</h4>
                            <p>Bandejas personalizadas según roles técnicos y supervisión global.</p>
                        </div>
                    </div>

                    <div class="auth-feature-row">
                        <div class="auth-feature-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                        </div>
                        <div class="auth-feature-text">
                            <h4>Asistente RAG con Citas</h4>
                            <p>Respuestas verificables basadas en manuales oficiales de la UNS.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="auth-brand-footer">
                <span>Universidad Nacional del Santa • Aplicaciones Distribuidas I — Ciclo 2026-II</span>
            </div>
        </aside>

        <!-- ====================================================================
             PANEL DERECHO: FORMULARIOS (LOGIN Y REGISTRO)
             ==================================================================== -->
        <main class="auth-panel-form">
            <!-- Selector de Tema en Esquina Superior Derecha -->
            <div class="auth-form-top-actions">
                <button type="button" class="theme-toggle-btn" aria-label="Cambiar tema claro u oscuro" title="Cambiar tema">
                    <svg class="theme-icon-moon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                    <svg class="theme-icon-sun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                </button>
            </div>

            <div class="auth-form-container">
                <div class="auth-form-header">
                    <h2>Acceso al Sistema</h2>
                    <p>Ingresa tus credenciales o solicita tu cuenta de personal TI.</p>
                </div>

                <!-- Segmented Control (Pestañas tipo píldora) -->
                <div class="auth-segmented-control" data-active="<?= htmlspecialchars($authTab ?? 'login') ?>">
                    <div class="auth-tab-slider"></div>
                    <button type="button" class="auth-tab-btn <?= ($authTab ?? 'login') === 'login' ? 'active' : '' ?>" data-tab="login">Iniciar Sesión</button>
                    <button type="button" class="auth-tab-btn <?= ($authTab ?? 'login') === 'registro' ? 'active' : '' ?>" data-tab="registro">Crear Cuenta</button>
                </div>

                <!-- Alertas Flash -->
                <?php if (!empty($authError)): ?>
                    <div class="auth-alert auth-alert-error" role="alert">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink: 0;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <span><?= htmlspecialchars($authError) ?></span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($authExito)): ?>
                    <div class="auth-alert auth-alert-success" role="status">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink: 0;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span><?= htmlspecialchars($authExito) ?></span>
                    </div>
                <?php endif; ?>

                <!-- PESTAÑA 1: INICIAR SESIÓN -->
                <div class="auth-tab-content <?= ($authTab ?? 'login') === 'login' ? 'active' : '' ?>" id="tab-login">
                    <form action="index.php?ruta=autenticar" method="POST" class="auth-form">
                        <div class="auth-form-group">
                            <label for="login_correo" class="auth-label">Correo institucional o de gestión</label>
                            <div class="auth-input-wrapper">
                                <span class="auth-input-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                </span>
                                <input type="email" id="login_correo" name="correo" class="auth-input" placeholder="Ej: usuario@uns.edu.pe" value="<?= htmlspecialchars($authEmail ?? '') ?>" required autocomplete="email">
                            </div>
                        </div>

                        <div class="auth-form-group">
                            <label for="login_clave" class="auth-label">Contraseña</label>
                            <div class="auth-input-wrapper">
                                <span class="auth-input-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                </span>
                                <input type="password" id="login_clave" name="clave" class="auth-input has-toggle" placeholder="••••••••" required autocomplete="current-password">
                                <button type="button" class="auth-password-toggle" data-target="login_clave" aria-label="Mostrar u ocultar contraseña">
                                    <svg class="eye-open" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <svg class="eye-closed" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="auth-submit-btn">
                            <span>Ingresar al Sistema</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </button>
                    </form>
                </div>

                <!-- PESTAÑA 2: CREAR CUENTA (REGISTRO REAL EN MYSQL) -->
                <div class="auth-tab-content <?= ($authTab ?? 'login') === 'registro' ? 'active' : '' ?>" id="tab-registro">
                    <form action="index.php?ruta=registrar-usuario" method="POST" class="auth-form">
                        <div class="auth-form-row">
                            <div class="auth-form-group">
                                <label for="reg_nombre" class="auth-label">Nombres</label>
                                <div class="auth-input-wrapper">
                                    <span class="auth-input-icon">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    </span>
                                    <input type="text" id="reg_nombre" name="nombre" class="auth-input" placeholder="Ej: Carlos" required>
                                </div>
                            </div>
                            <div class="auth-form-group">
                                <label for="reg_apellido" class="auth-label">Apellidos</label>
                                <div class="auth-input-wrapper">
                                    <span class="auth-input-icon">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    </span>
                                    <input type="text" id="reg_apellido" name="apellido" class="auth-input" placeholder="Ej: Gómez" required>
                                </div>
                            </div>
                        </div>

                        <div class="auth-form-group">
                            <label for="reg_email" class="auth-label">Correo Institucional</label>
                            <div class="auth-input-wrapper">
                                <span class="auth-input-icon">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                </span>
                                <input type="email" id="reg_email" name="email" class="auth-input" placeholder="Ej: cgomez@uns.edu.pe" required autocomplete="email">
                            </div>
                        </div>

                        <div class="auth-form-row">
                            <div class="auth-form-group">
                                <label for="reg_telefono" class="auth-label">Teléfono / Anexo <span style="color: var(--text-muted); font-weight: 400;">(opcional)</span></label>
                                <div class="auth-input-wrapper">
                                    <span class="auth-input-icon">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                    </span>
                                    <input type="tel" id="reg_telefono" name="telefono" class="auth-input" placeholder="Ej: 943123456">
                                </div>
                            </div>
                            <div class="auth-form-group">
                                <label for="reg_rol" class="auth-label">Rol en el Sistema</label>
                                <div class="auth-input-wrapper">
                                    <span class="auth-input-icon">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                                    </span>
                                    <select id="reg_rol" name="id_rol" class="auth-select" required>
                                        <?php if (!empty($roles)): ?>
                                            <?php foreach ($roles as $r): ?>
                                                <?php if ((int)$r['id'] !== 4): // Excluir solicitante genérico de la lista de personal ?>
                                                    <option value="<?= (int)$r['id'] ?>" <?= (int)$r['id'] === 3 ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($r['nombre']) ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="3" selected>Técnico TI</option>
                                            <option value="2">Supervisor de Soporte</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="auth-form-group">
                            <label for="reg_password" class="auth-label">Contraseña (Mínimo 8 caracteres)</label>
                            <div class="auth-input-wrapper">
                                <span class="auth-input-icon">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                </span>
                                <input type="password" id="reg_password" name="password" class="auth-input has-toggle" placeholder="••••••••" minlength="8" required autocomplete="new-password">
                                <button type="button" class="auth-password-toggle" data-target="reg_password" aria-label="Mostrar u ocultar contraseña">
                                    <svg class="eye-open" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <svg class="eye-closed" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                </button>
                            </div>
                            <!-- Barra de fortaleza -->
                            <div class="auth-strength-meter">
                                <div class="auth-strength-bar">
                                    <div class="auth-strength-fill" id="strength-fill"></div>
                                </div>
                                <div class="auth-strength-label">
                                    <span>Seguridad de clave:</span>
                                    <span id="strength-text">Mínimo 8 caracteres</span>
                                </div>
                            </div>
                        </div>

                        <div class="auth-form-group">
                            <label for="reg_password_confirm" class="auth-label">Confirmar Contraseña</label>
                            <div class="auth-input-wrapper">
                                <span class="auth-input-icon">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                </span>
                                <input type="password" id="reg_password_confirm" name="password_confirm" class="auth-input has-toggle" placeholder="••••••••" minlength="8" required autocomplete="new-password">
                                <button type="button" class="auth-password-toggle" data-target="reg_password_confirm" aria-label="Mostrar u ocultar contraseña">
                                    <svg class="eye-open" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <svg class="eye-closed" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                </button>
                            </div>
                            <div class="auth-match-indicator" id="match-indicator"></div>
                        </div>

                        <button type="submit" class="auth-submit-btn">
                            <span>Crear Cuenta de Personal</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </button>
                    </form>
                </div>

                <!-- Footer de Autoservicio Público -->
                <div class="auth-footer-links">
                    <span>¿Necesitas reportar una incidencia sin cuenta?</span><br>
                    <a href="index.php?ruta=ticket">Crear Ticket</a> &bull;
                    <a href="index.php?ruta=seguimiento">Consultar Estado</a> &bull;
                    <a href="index.php?ruta=inicio">Inicio</a>
                </div>
            </div>
        </main>

    </div>

    <!-- Scripts de Tema y de Interacciones de Autenticación -->
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/auth.js"></script>
</body>
</html>
