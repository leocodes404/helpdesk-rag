<?php
// views/publico/index.php - Landing Page Principal (Estilo RedSun SaaS con Modo Claro/Oscuro)
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelpDesk RAG - Gestión Inteligente de Tickets y Soporte TI</title>
    
    <!-- Script Anti-FOUC para prevenir parpadeo de tema -->
    <script>
        (function() {
            const saved = localStorage.getItem('helpdesk-theme');
            const theme = saved || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    <!-- Sistema Global de Temas y Estilos de la Landing -->
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/landing.css">
</head>
<body class="landing-body" id="top">

    <!-- ====================================================================
         SECCIÓN 1: NAVBAR FLOTANTE GLASSMORPHISM
         ==================================================================== -->
    <header class="rs-navbar-wrapper">
        <nav class="rs-navbar" aria-label="Navegación principal">
            <a href="index.php?ruta=inicio" class="rs-brand">
                <div class="rs-brand-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                        <path d="M2 17l10 5 10-5"></path>
                        <path d="M2 12l10 5 10-5"></path>
                    </svg>
                </div>
                <span>HelpDesk <span style="color: var(--rs-primary);">RAG</span></span>
            </a>

            <ul class="rs-nav-links">
                <li><a href="#funcionalidades">Funcionalidades</a></li>
                <li><a href="#asistente-rag">Asistente RAG</a></li>
                <li><a href="#roles">Roles</a></li>
                <li><a href="#equipo">Equipo</a></li>
            </ul>

            <div class="rs-nav-actions">
                <!-- Botón Interruptor Modo Claro / Modo Oscuro -->
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

                <a href="index.php?ruta=seguimiento" class="rs-btn rs-btn-secondary">Consultar Ticket</a>
                <a href="index.php?ruta=login" class="rs-btn rs-btn-primary">Ingresar al sistema</a>
                <button type="button" class="rs-menu-toggle" id="rs-mobile-toggle" aria-label="Abrir menú">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <!-- ====================================================================
         SECCIÓN 2: HERO SECTION (BLUR-TO-SHARP REVEAL & SHIMMER)
         ==================================================================== -->
    <section class="rs-hero-section">
        <div class="rs-hero-glow"></div>
        <div class="rs-hero-grid"></div>

        <div class="rs-container">
            <div class="rs-hero-content">
                <div class="rs-hero-pill hero-stagger-1">
                    <span class="rs-hero-pill-sparkle">✨</span>
                    <span>Aplicaciones Distribuidas I • Grupo 02</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </div>

                <h1 class="rs-hero-title hero-stagger-2">
                    Gestión inteligente de<br>
                    <span class="text-gradient">tickets y soporte TI con IA</span>
                </h1>

                <p class="rs-hero-subtitle hero-stagger-3">
                    Centraliza la recepción de incidencias, clasifica solicitudes con modelos de lenguaje y acelera la resolución técnica mediante respuestas fundamentadas en manuales oficiales con RAG.
                </p>

                <div class="rs-hero-cta-group hero-stagger-4">
                    <a href="index.php?ruta=ticket" class="rs-btn rs-btn-primary" style="padding: 14px 28px; font-size: 1rem;">
                        <span>Crear Ticket</span>
                        <svg class="btn-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="index.php?ruta=seguimiento" class="rs-btn rs-btn-secondary" style="padding: 14px 26px; font-size: 1rem;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <span>Consultar Estado de Ticket</span>
                    </a>
                </div>
            </div>

            <!-- Mockup Visual de Producto en Alta Fidelidad (HTML/CSS puro con Micro-Tilt 3D) -->
            <div class="rs-hero-mockup-wrapper hero-stagger-5">
                <div class="rs-mockup-window">
                    <div class="rs-mockup-header">
                        <div class="rs-mockup-dots">
                            <span class="rs-mockup-dot red"></span>
                            <span class="rs-mockup-dot yellow"></span>
                            <span class="rs-mockup-dot green"></span>
                        </div>
                        <div class="rs-mockup-searchbar">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            <span>helpdesk-rag / panel / #TCK-0042</span>
                        </div>
                    </div>

                    <div class="rs-mockup-body">
                        <!-- Columna Izquierda: Ticket Entrante -->
                        <div class="rs-mockup-col-ticket">
                            <div>
                                <div class="ticket-header">
                                    <span class="ticket-code">#TCK-0042</span>
                                    <span class="ticket-status">En Atención</span>
                                </div>
                                <h4 class="ticket-title">No puedo acceder al correo institucional</h4>
                                <p class="ticket-desc">
                                    "El sistema indica credenciales incorrectas tras el cambio de ciclo académico. Requiero ingresar para enviar mi acta de prácticas."
                                </p>

                                <!-- Triaje IA -->
                                <div class="rs-triaje-box">
                                    <div class="rs-triaje-title">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                        </svg>
                                        <span>Triaje Predictivo Sugerido</span>
                                    </div>
                                    <div class="rs-triaje-tags">
                                        <span class="rs-tag-item rs-tag-category">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                            Categoría: Cuentas y Accesos
                                        </span>
                                        <span class="rs-tag-item rs-tag-priority">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                            Prioridad: Alta
                                        </span>
                                        <span class="rs-tag-item rs-tag-service">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                            Servicio: Correo Institucional
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Fila de equilibrio de altura y evidencia adjunta -->
                            <div class="rs-ticket-footer-row">
                                <span class="rs-ticket-service-badge">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                    Servidor: LDAP UNS Central
                                </span>
                                <span class="rs-attachment-chip">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                                    error_credenciales.png
                                </span>
                            </div>
                        </div>

                        <!-- Columna Derecha: Asistente RAG -->
                        <div class="rs-mockup-col-rag">
                            <div>
                                <div class="rs-rag-header">
                                    <span class="rs-rag-title">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--rs-primary);">
                                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                        </svg>
                                        Asistente RAG
                                    </span>
                                    <span class="rs-rag-badge">
                                        <span class="live-dot"></span>
                                        Citas Verificadas
                                    </span>
                                </div>

                                <div class="rs-rag-sources">
                                    <span class="rs-sources-label">Fuentes Recuperadas:</span>
                                    <div class="rs-sources-list">
                                        <div class="rs-source-item">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                                            <span>Manual de Cuentas UNS §2.1 (Pág. 14)</span>
                                        </div>
                                        <div class="rs-source-item">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                                            <span>Guía LDAP: Procedimiento de Desbloqueo</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="rs-rag-solution-box">
                                    <h5>Propuesta Generada para el Técnico:</h5>
                                    <ol>
                                        <li>Comprobar estado en Directorio Activo LDAP (bloqueo por 5 intentos fallidos).</li>
                                        <li>Generar clave temporal de 8 caracteres alfanuméricos y sincronizar base central.</li>
                                        <li>Solicitar reinicio de sesión en incógnito para descartar caché local.</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="rs-rag-actions">
                                <button type="button" class="rs-action-btn rs-action-accept">✓ Aceptar</button>
                                <button type="button" class="rs-action-btn rs-action-modify">✎ Modificar</button>
                                <button type="button" class="rs-action-btn rs-action-discard">✕ Descartar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================================
         NUEVA FRANJA COMPACTA: STACK TECNOLÓGICO MINIMALISTA
         ==================================================================== -->
    <section class="rs-tech-strip-section rs-reveal">
        <div class="rs-container">
            <p class="rs-tech-strip-title">Arquitectura y tecnologías del sistema</p>
            <div class="rs-tech-chips-wrapper">
                <div class="rs-tech-chip">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 18l6-6-6-6M8 6l-6 6 6 6"></path></svg>
                    <span>PHP 8 + PDO</span>
                </div>
                <div class="rs-tech-chip">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                    <span>MySQL InnoDB (3FN)</span>
                </div>
                <div class="rs-tech-chip">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    <span>Arquitectura MVC</span>
                </div>
                <div class="rs-tech-chip">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                    <span>Pipeline RAG</span>
                </div>
                <div class="rs-tech-chip">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    <span>API Gemini</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================================
         SECCIÓN 3: STRIP DE 4 PILARES (ESTILO REDSUN)
         ==================================================================== -->
    <section class="rs-pillars-section">
        <div class="rs-container">
            <div class="rs-pillars-grid">
                <!-- Pilar 1 -->
                <div class="rs-pillar-card rs-reveal rs-reveal-delay-1">
                    <div class="rs-pillar-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="12" y1="18" x2="12" y2="12"></line>
                            <line x1="9" y1="15" x2="15" y2="15"></line>
                        </svg>
                    </div>
                    <h3 class="rs-pillar-title">Autoservicio Rápido</h3>
                    <p class="rs-pillar-desc">
                        Registro público con adjuntos de evidencias y seguimiento en tiempo real con código correlativo único <code>TCK-XXXX</code> sin crear cuentas previas.
                    </p>
                </div>

                <!-- Pilar 2 -->
                <div class="rs-pillar-card rs-reveal rs-reveal-delay-2">
                    <div class="rs-pillar-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                    </div>
                    <h3 class="rs-pillar-title">Triaje Predictivo IA</h3>
                    <p class="rs-pillar-desc">
                        Sugerencia automática de categoría, servicio afectado, nivel de severidad y posible causa raíz a partir del texto libre redactado por el usuario.
                    </p>
                </div>

                <!-- Pilar 3 -->
                <div class="rs-pillar-card rs-reveal rs-reveal-delay-3">
                    <div class="rs-pillar-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            <circle cx="12" cy="10" r="2"></circle>
                        </svg>
                    </div>
                    <h3 class="rs-pillar-title">Asistente RAG Verificable</h3>
                    <p class="rs-pillar-desc">
                        Respuestas fundamentadas exclusivamente en manuales técnicos y normativas institucionales indexadas, con citas exactas para mitigar alucinaciones.
                    </p>
                </div>

                <!-- Pilar 4 -->
                <div class="rs-pillar-card rs-reveal rs-reveal-delay-4">
                    <div class="rs-pillar-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <polyline points="9 12 11 14 15 10"></polyline>
                        </svg>
                    </div>
                    <h3 class="rs-pillar-title">Trazabilidad 3FN</h3>
                    <p class="rs-pillar-desc">
                        Modelo relacional normalizado en MySQL InnoDB con integridad referencial estricta, historial inmutable de estados y auditoría de decisiones IA.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================================
         SECCIÓN 4: BLOQUES ALTERNADOS DE PRODUCTO (50/50)
         ==================================================================== -->
    <section class="rs-feature-block-section" id="funcionalidades">
        <div class="rs-container">
            <!-- Bloque A: Control Operativo y Triaje Inteligente -->
            <div class="rs-feature-row rs-reveal">
                <div class="rs-feature-content">
                    <span class="rs-badge rs-badge-brand">TRIAJE &amp; FLUJO</span>
                    <h2 class="rs-feature-title">Del reporte en lenguaje natural a la asignación en segundos</h2>
                    <p class="rs-feature-desc">
                        El sistema analiza el reporte recibido, extrae entidades clave del contexto institucional y asiste al supervisor para canalizar cada incidencia sin cuellos de botella.
                    </p>
                    <ul class="rs-feature-list">
                        <li class="rs-feature-item">
                            <div class="rs-check-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <span><strong>Clasificación sugerida por IA:</strong> Deducción de categoría y prioridad calculada a partir de los patrones semánticos del texto.</span>
                        </li>
                        <li class="rs-feature-item">
                            <div class="rs-check-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <span><strong>Asignación supervisada a técnicos:</strong> Validación con un solo clic y asignación de personal según servicio y carga operativa.</span>
                        </li>
                        <li class="rs-feature-item">
                            <div class="rs-check-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <span><strong>Transiciones controladas de estado:</strong> Máquina de estados con registro histórico de cada cambio para trazabilidad absoluta.</span>
                        </li>
                    </ul>
                </div>

                <!-- Visual: Mini-Tabla Bandeja Supervisor -->
                <div class="rs-mockup-supervisor-table">
                    <div class="rs-mockup-table-head">
                        <h4>Bandeja de Incidencias Pendientes</h4>
                        <span class="rs-badge rs-badge-subtle">Filtro: Activos</span>
                    </div>
                    <table class="rs-ui-table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Servicio</th>
                                <th>Prioridad</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong style="color: var(--rs-primary);">TCK-0042</strong></td>
                                <td>Correo Institucional</td>
                                <td><span style="color: #DC2626; font-weight: 600;">Alta</span></td>
                                <td><span class="rs-ui-badge badge-status-atencion">En Atención</span></td>
                            </tr>
                            <tr>
                                <td><strong style="color: var(--rs-primary);">TCK-0041</strong></td>
                                <td>Wi-Fi Pabellón B</td>
                                <td><span style="color: #D97706; font-weight: 600;">Media</span></td>
                                <td><span class="rs-ui-badge badge-status-registrado">Registrado</span></td>
                            </tr>
                            <tr>
                                <td><strong style="color: var(--rs-primary);">TCK-0040</strong></td>
                                <td>Laboratorio 03 (Impresora)</td>
                                <td><span style="color: #2563EB; font-weight: 600;">Baja</span></td>
                                <td><span class="rs-ui-badge badge-status-resuelto">Resuelto</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="height: 80px;"></div>

            <!-- Bloque B: Asistente RAG con Human-in-the-Loop -->
            <div class="rs-feature-row reverse rs-reveal" id="asistente-rag">
                <div class="rs-feature-content">
                    <span class="rs-badge rs-badge-brand">MOTOR RAG + BASE DE CONOCIMIENTO</span>
                    <h2 class="rs-feature-title">Soluciones respaldadas por manuales oficiales, siempre bajo control humano</h2>
                    <p class="rs-feature-desc">
                        El motor de Recuperación Aumentada por Generación consulta manuales técnicos aprobados, sintetiza una propuesta contextualizada y exige la validación expresa del técnico de soporte.
                    </p>
                    <ul class="rs-feature-list">
                        <li class="rs-feature-item">
                            <div class="rs-check-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <span><strong>Recuperación semántica de fragmentos oficiales:</strong> Búsqueda vectorial sobre la documentación institucional para encontrar la solución precisa.</span>
                        </li>
                        <li class="rs-feature-item">
                            <div class="rs-check-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <span><strong>Decisión obligatoria (Human-in-the-Loop):</strong> El técnico evalúa la propuesta marcando <em>Aceptar</em>, <em>Modificar</em> o <em>Descartar</em>.</span>
                        </li>
                        <li class="rs-feature-item">
                            <div class="rs-check-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <span><strong>Métricas de latencia y evaluación:</strong> Monitoreo de tiempos de inferencia y tasa de adopción para auditoría de calidad de la IA.</span>
                        </li>
                    </ul>
                </div>

                <!-- Visual: Tarjeta Interactiva de Comparación RAG -->
                <div class="rs-tabs-card">
                    <div class="rs-tabs-nav" role="tablist">
                        <button type="button" class="rs-tab-btn" data-tab="tab-sin-rag" role="tab">Sin RAG (Línea Base)</button>
                        <button type="button" class="rs-tab-btn active" data-tab="tab-con-rag" role="tab">Con HelpDesk RAG</button>
                    </div>

                    <!-- Pestaña 1: Sin RAG -->
                    <div class="rs-tab-pane" id="tab-sin-rag" role="tabpanel">
                        <div class="rs-tab-content-box" style="border-left: 3px solid #EF4444;">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                                <span style="font-size: 0.8125rem; font-weight: 700; color: #DC2626;">Respuesta Genérica Sin Respaldo</span>
                                <span style="font-size: 0.72rem; color: #94A3B8;">Modelo Base Sin Documentos</span>
                            </div>
                            <p style="font-size: 0.85rem; color: #64748B; margin-bottom: 12px; font-style: italic;">
                                "Por favor intente reiniciar su computadora o contacte al administrador de TI de su facultad para solicitar una nueva contraseña en ventanilla."
                            </p>
                            <div class="rs-tab-metric-row">
                                <div class="rs-tab-metric">
                                    <div class="rs-tab-metric-title">Citas Oficiales</div>
                                    <div class="rs-tab-metric-value" style="color: #DC2626;">0 (Ninguna)</div>
                                </div>
                                <div class="rs-tab-metric">
                                    <div class="rs-tab-metric-title">Riesgo Alucinación</div>
                                    <div class="rs-tab-metric-value" style="color: #DC2626;">Alto (78%)</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña 2: Con HelpDesk RAG -->
                    <div class="rs-tab-pane active" id="tab-con-rag" role="tabpanel">
                        <div class="rs-tab-content-box" style="border-left: 3px solid var(--rs-primary);">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                                <span style="font-size: 0.8125rem; font-weight: 700; color: var(--rs-primary);">Solución Basada en Base de Conocimiento</span>
                                <span class="rs-badge rs-badge-brand" style="font-size: 0.7rem; padding: 2px 8px;">Precision@3: 94.2%</span>
                            </div>
                            <p style="font-size: 0.85rem; color: var(--rs-text-primary); margin-bottom: 12px;">
                                Procedimiento oficial según <strong>Manual de Cuentas UNS §2.1</strong>: Comprobar bloqueo LDAP, desbloquear usuario en servidor central y remitir PIN provisional al correo alternativo validado.
                            </p>
                            <div class="rs-tab-metric-row">
                                <div class="rs-tab-metric">
                                    <div class="rs-tab-metric-title">Citas Verificadas</div>
                                    <div class="rs-tab-metric-value" style="color: #16A34A;">2 Manuales</div>
                                </div>
                                <div class="rs-tab-metric">
                                    <div class="rs-tab-metric-title">Latencia RAG</div>
                                    <div class="rs-tab-metric-value" style="color: var(--rs-primary);">420 ms</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================================
         SECCIÓN 5: ARQUITECTURA POR ROLES (#roles)
         ==================================================================== -->
    <section class="rs-roles-section" id="roles">
        <div class="rs-container">
            <div class="rs-section-header rs-reveal">
                <span class="rs-badge rs-badge-brand">MATRIZ DE ACCESOS</span>
                <h2>Diseñado para cada integrante del soporte institucional</h2>
                <p>Separación estricta de responsabilidades según la normativa de seguridad y el flujo operativo de TI.</p>
            </div>

            <div class="rs-roles-grid">
                <!-- Rol 1: Solicitante -->
                <div class="rs-role-card rs-reveal rs-reveal-delay-1">
                    <div>
                        <div class="rs-role-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <h3 class="rs-role-name">Usuario Solicitante</h3>
                        <p class="rs-role-desc">Acceso público de autoservicio sin registro previo para estudiantes, docentes y administrativos.</p>
                        
                        <ul class="rs-role-permissions">
                            <li class="rs-perm-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Crear tickets con evidencias adjuntas</span>
                            </li>
                            <li class="rs-perm-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Recibir código correlativo único <code>TCK-XXXX</code></span>
                            </li>
                            <li class="rs-perm-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Consultar estado en vivo con código y correo</span>
                            </li>
                            <li class="rs-perm-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Visualizar diagnósticos y soluciones finales</span>
                            </li>
                        </ul>
                    </div>

                    <a href="index.php?ruta=ticket" class="rs-btn rs-btn-secondary">Reportar Incidencia</a>
                </div>

                <!-- Rol 2: Técnico de Soporte (Destacada) -->
                <div class="rs-role-card highlighted rs-reveal rs-reveal-delay-2">
                    <span class="rs-role-top-badge">Asistido por RAG</span>
                    <div>
                        <div class="rs-role-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                            </svg>
                        </div>
                        <h3 class="rs-role-name">Técnico de Soporte</h3>
                        <p class="rs-role-desc">Atención asistida de incidencias con recomendaciones fundamentadas de IA y panel personal.</p>
                        
                        <ul class="rs-role-permissions">
                            <li class="rs-perm-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Bandeja personal filtrada por prioridad y SLA</span>
                            </li>
                            <li class="rs-perm-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Consulta al Asistente RAG con fuentes oficiales</span>
                            </li>
                            <li class="rs-perm-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Registro de diagnóstico técnico y solución aplicada</span>
                            </li>
                            <li class="rs-perm-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Calificación de propuestas IA (Aceptar / Modificar / Descartar)</span>
                            </li>
                        </ul>
                    </div>

                    <a href="index.php?ruta=login" class="rs-btn rs-btn-primary">Acceso Técnico</a>
                </div>

                <!-- Rol 3: Supervisor de Soporte -->
                <div class="rs-role-card rs-reveal rs-reveal-delay-3">
                    <div>
                        <div class="rs-role-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                        </div>
                        <h3 class="rs-role-name">Supervisor de Soporte</h3>
                        <p class="rs-role-desc">Gobierno global, auditoría de transacciones, triaje asistido y métricas de rendimiento.</p>
                        
                        <ul class="rs-role-permissions">
                            <li class="rs-perm-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Confirmación y ajuste del triaje predictivo IA</span>
                            </li>
                            <li class="rs-perm-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Asignación y balance de carga entre técnicos</span>
                            </li>
                            <li class="rs-perm-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Gestión de Base de Conocimiento y catálogos</span>
                            </li>
                            <li class="rs-perm-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Dashboard de métricas, historial y cierre de tickets</span>
                            </li>
                        </ul>
                    </div>

                    <a href="index.php?ruta=login" class="rs-btn rs-btn-secondary">Panel Supervisor</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================================
         SECCIÓN 6: EQUIPO DE DESARROLLO (#equipo)
         ==================================================================== -->
    <section class="rs-team-section" id="equipo">
        <div class="rs-container">
            <div class="rs-section-header rs-reveal">
                <span class="rs-badge rs-badge-brand">EQUIPO NEXUSDESK • GRUPO 02</span>
                <h2>Ingeniería de Sistemas e Informática</h2>
                <p>Universidad Nacional del Santa — Aplicaciones Distribuidas I (Ciclo 2026-II)</p>
            </div>

            <!-- Fila Superior: 3 Integrantes -->
            <div class="rs-team-grid">
                <!-- Integrante 1 -->
                <div class="rs-team-card rs-reveal rs-reveal-delay-1">
                    <div class="rs-team-avatar">KJ</div>
                    <div class="rs-team-info">
                        <h4 class="rs-team-name">Carrillo Navarro, Kelvin Jefferson</h4>
                        <p class="rs-team-role">Documentación y Calidad</p>
                        <span class="rs-team-code">0202414008</span>
                    </div>
                </div>

                <!-- Integrante 2 -->
                <div class="rs-team-card rs-reveal rs-reveal-delay-2">
                    <div class="rs-team-avatar">AL</div>
                    <div class="rs-team-info">
                        <h4 class="rs-team-name">Carranza Albujar, Anthony Leonardo</h4>
                        <p class="rs-team-role">Inteligencia Artificial (RAG)</p>
                        <span class="rs-team-code">0202414007</span>
                    </div>
                </div>

                <!-- Integrante 3 -->
                <div class="rs-team-card rs-reveal rs-reveal-delay-3">
                    <div class="rs-team-avatar">MA</div>
                    <div class="rs-team-info">
                        <h4 class="rs-team-name">Crisanto Santiago, Michel Aurelio</h4>
                        <p class="rs-team-role">Base de Datos (MySQL 3FN)</p>
                        <span class="rs-team-code">0202414013</span>
                    </div>
                </div>
            </div>

            <!-- Fila Inferior: 2 Integrantes Centrados -->
            <div class="rs-team-grid-bottom">
                <!-- Integrante 4 -->
                <div class="rs-team-card rs-reveal rs-reveal-delay-1">
                    <div class="rs-team-avatar">JN</div>
                    <div class="rs-team-info">
                        <h4 class="rs-team-name">Norabuena Melgarejo, Joshua</h4>
                        <p class="rs-team-role">Frontend e Interfaz</p>
                        <span class="rs-team-code">0202414031</span>
                    </div>
                </div>

                <!-- Integrante 5 -->
                <div class="rs-team-card rs-reveal rs-reveal-delay-2">
                    <div class="rs-team-avatar">CF</div>
                    <div class="rs-team-info">
                        <h4 class="rs-team-name">Ramírez Saldaña, Carlos Fabrizio</h4>
                        <p class="rs-team-role">Backend y Servidor</p>
                        <span class="rs-team-code">0202414040</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================================
         SECCIÓN 7: BANNER CTA FINAL
         ==================================================================== -->
    <section class="rs-cta-section">
        <div class="rs-container">
            <div class="rs-cta-banner rs-reveal">
                <h2 class="rs-cta-title">¿Necesitas reportar o dar seguimiento a una incidencia TI?</h2>
                <p class="rs-cta-desc">
                    Genera tu ticket con evidencias adjuntas en menos de un minuto o verifica el estado en vivo de tu solicitud con tu código correlativo.
                </p>
                <div class="rs-cta-buttons">
                    <a href="index.php?ruta=ticket" class="rs-btn rs-btn-primary" style="padding: 14px 28px;">
                        <span>Crear Nuevo Ticket</span>
                        <svg class="btn-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="index.php?ruta=seguimiento" class="rs-btn rs-btn-secondary" style="padding: 14px 28px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <span>Consultar Estado</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================================
         SECCIÓN 8: FOOTER ESTRUCTURADO
         ==================================================================== -->
    <footer class="rs-footer">
        <div class="rs-container">
            <div class="rs-footer-grid">
                <!-- Columna 1: Marca y Propuesta -->
                <div class="rs-footer-brand">
                    <h3>
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--rs-primary);">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5"></path>
                            <path d="M2 12l10 5 10-5"></path>
                        </svg>
                        HelpDesk RAG
                    </h3>
                    <p class="rs-footer-desc">
                        Plataforma web para gestión inteligente de tickets y soporte TI potenciada con PLN y RAG sobre manuales institucionales universitarios.
                    </p>
                </div>

                <!-- Columna 2: Navegación -->
                <div class="rs-footer-col">
                    <h4>Navegación</h4>
                    <ul class="rs-footer-links">
                        <li><a href="#top">Inicio</a></li>
                        <li><a href="#funcionalidades">Funcionalidades</a></li>
                        <li><a href="#asistente-rag">Asistente RAG</a></li>
                        <li><a href="#roles">Roles</a></li>
                        <li><a href="#equipo">Equipo</a></li>
                    </ul>
                </div>

                <!-- Columna 3: Accesos del Sistema -->
                <div class="rs-footer-col">
                    <h4>Accesos Directos</h4>
                    <ul class="rs-footer-links">
                        <li><a href="index.php?ruta=ticket">Crear Ticket</a></li>
                        <li><a href="index.php?ruta=seguimiento">Seguimiento de Ticket</a></li>
                        <li><a href="index.php?ruta=login">Acceso ERP / Personal TI</a></li>
                        <li><a href="index.php?ruta=panel">Panel de Control</a></li>
                    </ul>
                </div>

                <!-- Columna 4: Info Académica -->
                <div class="rs-footer-col">
                    <h4>Información Académica</h4>
                    <p style="font-size: 0.85rem; line-height: 1.6; color: #94A3B8;">
                        <strong>Universidad Nacional del Santa</strong><br>
                        Escuela de Ingeniería de Sistemas e Informática<br>
                        Aplicaciones Distribuidas I • Ciclo 2026-II<br>
                        <span style="color: var(--rs-primary);">Equipo NexusDesk — Grupo 02</span>
                    </p>
                </div>
            </div>

            <div class="rs-footer-bottom">
                <span>&copy; 2026 NexusDesk — Grupo 02. Universidad Nacional del Santa. Todos los derechos reservados.</span>
                <span>Arquitectura Distribuida • PHP/PDO + MySQL InnoDB 3FN</span>
            </div>
        </div>
    </footer>

    <!-- Scripts: Sistema de Tema y Animaciones de la Landing -->
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/landing.js"></script>
</body>
</html>
