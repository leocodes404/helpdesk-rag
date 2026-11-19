# HelpDesk RAG: Plataforma Web para Gestión Inteligente de Tickets y Soporte TI

Plataforma web para la recepción, triaje y resolución asistida de incidencias tecnológicas en entornos institucionales universitarios. El sistema implementa una arquitectura MVC pura y orientada a servicios en PHP/PDO con persistencia relacional en MySQL (3FN), sistema global de Modo Claro / Modo Oscuro sin parpadeos (Anti-FOUC) y asistencia contextual mediante Recuperación Aumentada por Generación (RAG).

---

## 📌 Información Académica
* **Institución:** Universidad Nacional del Santa (UNS)
* **Facultad:** Facultad de Ingeniería
* **Escuela:** Escuela Profesional de Ingeniería de Sistemas e Informática
* **Curso:** Aplicaciones Distribuidas I
* **Ciclo:** 2026-II
* **Docente:** Dr. Mirko Manrique Ronceros
* **Equipo:** NexusDesk (Grupo 02)

---

## 👥 Integrantes del Equipo (NexusDesk)

| Integrante | Código | Rol Asignado |
| :--- | :--- | :--- |
| **Carranza Albujar, Anthony Leonardo** | 0202414007 | Inteligencia Artificial y Lógica RAG |
| **Carrillo Navarro, Kelvin Jefferson** | 0202414008 | Documentación, Calidad y Pruebas |
| **Crisanto Santiago, Michel Aurelio** | 0202414013 | Base de Datos y Modelado Relacional |
| **Norabuena Melgarejo, Joshua** | 0202414031 | Frontend, Vistas e Interfaz |
| **Ramirez Saldaña, Carlos Fabrizio** | 0202414040 | Backend y Arquitectura de Servidor |

---

## 🛠️ Requisitos del Sistema
Para desplegar y ejecutar el proyecto localmente se requiere:
* **Entorno Integrado:** [Laragon](https://laragon.org/) (recomendado) o XAMPP con soporte para Apache y MySQL.
* **Servidor Web:** Apache 2.4 o superior.
* **Intérprete:** PHP 8.1 o superior (con extensiones `pdo_mysql`, `mbstring` habilitadas).
* **Gestor de Base de Datos:** MySQL 8.0+ / MariaDB 10.4+ (InnoDB).
* **Cliente de Base de Datos:** HeidiSQL (integrado en Laragon) o phpMyAdmin.
* **Navegador Web:** Google Chrome, Mozilla Firefox o Microsoft Edge.

---

## 📂 Arquitectura del Proyecto (MVC + Servicios)

```text
helpdesk-rag/
├── index.php                  # Punto de entrada único (Front Controller)
├── .htaccess                  # Reglas Apache (DirectoryIndex y Options -Indexes)
├── .gitignore                 # Exclusión de uploads/ y credenciales .env
├── README.md                  # Documentación técnica y académica del proyecto
│
├── config/                    # Configuración centralizada de base de datos
│   └── conexion.php           # Conexión PDO segura (UTF-8, excepciones activas)
│
├── app/                       # Núcleo MVC en PHP puro
│   ├── controllers/
│   │   ├── TicketController.php  # Manejo de peticiones HTTP de tickets y consulta JSON
│   │   └── AuthController.php    # Autenticación, registro con password_hash y logout
│   ├── models/
│   │   ├── TicketModel.php       # Consultas preparadas para Tickets y Evidencias
│   │   ├── UsuarioModel.php      # Gestión de usuarios, roles y autenticación
│   │   └── HistorialModel.php    # Registro inmutable de transiciones de estado
│   └── services/
│       └── TicketService.php     # Transacciones ACID (beginTransaction, commit, rollBack)
│
├── views/                     # Pantallas del sistema
│   ├── publico/
│   │   ├── index.php          # Landing page moderna SaaS (Estilo RedSun con Dark Mode)
│   │   ├── ticket.php         # Formulario público de registro de incidencias
│   │   ├── confirmacion.php   # Pantalla de confirmación y emisión de código correlativo
│   │   └── seguimiento.php    # Consulta pública en tiempo real del estado del ticket
│   └── erp/
│       ├── login.php          # Acceso y registro Split-Screen (Técnico / Supervisor)
│       └── panel.php          # Panel administrativo protegido (Dashboard, Triaje, RAG)
│
├── assets/                    # Recursos estáticos
│   ├── css/
│   │   ├── theme.css          # Variables globales para Modo Claro y Modo Oscuro
│   │   ├── auth.css           # Estilos Split-Screen para Login y Registro
│   │   ├── landing.css        # Sistema de diseño aislado para la landing
│   │   └── estilos.css        # Hoja de estilos original para vistas internas y ERP
│   ├── js/
│   │   ├── theme.js           # Controlador de persistencia y toggle de tema
│   │   ├── auth.js            # Interacciones de segmented control y medidor de clave
│   │   ├── landing.js         # Animaciones, micro-tilt 3D y pestañas de la landing
│   │   └── app.js             # Lógica de navegación y modales de las vistas internas
│   └── img/
│       └── icono.png          # Recursos gráficos institucionales
│
├── database/                  # Modelado físico relacional
│   └── Script_CrearDataBase_HelpDeskRAG.sql # Script DDL/DML con 10 tablas (3FN)
│
└── uploads/                   # Directorio para evidencias adjuntas de tickets
    └── .gitkeep
```

---

## 🧭 Enrutamiento del Front Controller (`index.php`)

El proyecto opera mediante un único Front Controller con rutas relativas compatibles con subcarpetas locales (`http://localhost/helpdesk-rag/`) y subdominios en producción (`https://aplicaciondistribuida.cetivirgendelapuerta.com/`):

| Ruta | Parámetro | Acción / Controlador |
| :--- | :--- | :--- |
| **Inicio** | `index.php?ruta=inicio` | Carga la Landing Page (`views/publico/index.php`) |
| **Nuevo Ticket** | `index.php?ruta=ticket` | Carga el formulario de registro (`views/publico/ticket.php`) |
| **Seguimiento** | `index.php?ruta=seguimiento` | Carga la consulta pública en vivo (`views/publico/seguimiento.php`) |
| **Login / Registro** | `index.php?ruta=login` | Ejecuta `AuthController::mostrarLogin()` |
| **Autenticar** | `index.php?ruta=autenticar` | Ejecuta `AuthController::autenticar()` (POST) |
| **Registrar Usuario** | `index.php?ruta=registrar-usuario` | Ejecuta `AuthController::registrar()` (POST) |
| **Cerrar Sesión** | `index.php?ruta=logout` | Ejecuta `AuthController::logout()` |
| **Panel Control** | `index.php?ruta=panel` | Protegido con sesión activa &rarr; `views/erp/panel.php` |
| **Guardar Ticket** | `index.php?ruta=guardar-ticket` | Ejecuta `TicketController::guardar()` (POST) |
| **API Consulta** | `index.php?ruta=api-consultar-ticket` | Ejecuta `TicketController::consultarPublico()` (JSON) |
