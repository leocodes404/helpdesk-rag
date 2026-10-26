# HelpDesk RAG: Plataforma Web para Gestión Inteligente de Tickets y Soporte TI

Plataforma web para la recepción, triaje y resolución asistida de incidencias tecnológicas en entornos institucionales universitarios. El sistema implementa una arquitectura distribuida con persistencia relacional en MySQL y proyecta asistencia contextual mediante Recuperación Aumentada por Generación (RAG).

---

## 📌 Información Académica
* **Institución:** Universidad Nacional del Santa (UNS)
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
* **Gestor de Base de Datos:** MySQL 8.0+ / MariaDB 10.4+.
* **Cliente de Base de Datos:** HeidiSQL (integrado en Laragon) o phpMyAdmin.
* **Navegador Web:** Google Chrome, Mozilla Firefox o Microsoft Edge.

---

## 📂 Estructura del Repositorio

```text
helpdesk-rag/
├── conexion/ 
│   ├── conexion.php                         # Conexión PDO segura a MySQL
│   ├── guardar_ticket.php                   # Inserción relacional y manejo de transacciones
│   └── consultar_estado_publico.php         # Consulta asíncrona (JSON) con INNER JOIN
├── vistas/
│   ├── index.html                           # Landing page institucional del proyecto
│   ├── login.html                           # Formulario de acceso al ERP interno
│   ├── panel.html                           # Panel administrativo (Dashboard, Triaje, Técnico)
│   ├── ticket.html                          # Formulario público de registro de incidencias
│   └── seguimiento.html                     # Consulta pública del estado de un ticket
├── database/
│   └── Script_CrearDataBase_HelpDeskRAG.sql # Script DDL/DML con 10 tablas (3FN) y seeders
├── app.js                                   # Control de navegación y modales de la interfaz
├── estilos.css                              # Sistema de diseño y hojas de estilo responsivas
├── icono.png                                # Recursos gráficos institucionales
└── README.md                                # Documentación técnica de instalación y ejecución
