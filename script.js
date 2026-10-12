/**
 * NexusDesk - HelpDesk RAG
 * Aplicaciones Distribuidas I
 */

"use strict";

document.addEventListener("DOMContentLoaded", () => {

    // Elementos del DOM
    const DOM = {
        modalOverlay: document.getElementById("modal-login"),
        modalCloseBtn: document.getElementById("modal-close-btn"),
        modalContainer: document.querySelector(".modal-container"),
        openModalBtns: document.querySelectorAll(".btn-open-modal"),

        loginForm: document.getElementById("login-form"),
        inputUsername: document.getElementById("login-username"),
        inputPassword: document.getElementById("login-password"),
        selectRole: document.getElementById("login-role"),
        submitBtn: document.getElementById("btn-submit-login"),
        submitBtnText: document.querySelector("#btn-submit-login .btn-text"),
        submitSpinner: document.getElementById("btn-spinner"),
        authFeedback: document.getElementById("auth-feedback"),

        errorUsername: document.getElementById("error-username"),
        errorPassword: document.getElementById("error-password"),
        errorRole: document.getElementById("error-role"),

        navToggle: document.getElementById("nav-toggle"),
        navMenu: document.getElementById("nav-menu"),
        navLinks: document.querySelectorAll(".nav-link"),

        sections: document.querySelectorAll("section[id]")
    };

    // Control del Modal
    const openModal = () => {
        if (!DOM.modalOverlay) return;
        DOM.modalOverlay.classList.add("active");
        DOM.modalOverlay.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";

        setTimeout(() => {
            if (DOM.inputUsername) DOM.inputUsername.focus();
        }, 150);

        clearFormFeedback();
    };

    const closeModal = () => {
        if (!DOM.modalOverlay) return;
        DOM.modalOverlay.classList.remove("active");
        DOM.modalOverlay.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
        clearFormFeedback();
    };

    DOM.openModalBtns.forEach((btn) => {
        btn.addEventListener("click", (event) => {
            event.preventDefault();
            if (DOM.navMenu && DOM.navMenu.classList.contains("nav-open")) {
                toggleMobileMenu(false);
            }
            openModal();
        });
    });

    if (DOM.modalCloseBtn) {
        DOM.modalCloseBtn.addEventListener("click", closeModal);
    }

    if (DOM.modalOverlay) {
        DOM.modalOverlay.addEventListener("click", (event) => {
            if (event.target === DOM.modalOverlay) {
                closeModal();
            }
        });
    }

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && DOM.modalOverlay && DOM.modalOverlay.classList.contains("active")) {
            closeModal();
        }
    });

    // Menú Móvil
    const toggleMobileMenu = (forceState = null) => {
        if (!DOM.navMenu || !DOM.navToggle) return;

        const shouldOpen = forceState !== null
            ? forceState
            : !DOM.navMenu.classList.contains("nav-open");

        if (shouldOpen) {
            DOM.navMenu.classList.add("nav-open");
            DOM.navToggle.setAttribute("aria-expanded", "true");
        } else {
            DOM.navMenu.classList.remove("nav-open");
            DOM.navToggle.setAttribute("aria-expanded", "false");
        }
    };

    if (DOM.navToggle) {
        DOM.navToggle.addEventListener("click", () => toggleMobileMenu());
    }

    DOM.navLinks.forEach((link) => {
        link.addEventListener("click", () => {
            if (window.innerWidth <= 768) {
                toggleMobileMenu(false);
            }
        });
    });

    // Formulario y Simulación de Login
    const clearFormFeedback = () => {
        if (DOM.authFeedback) {
            DOM.authFeedback.hidden = true;
            DOM.authFeedback.className = "auth-feedback";
            DOM.authFeedback.innerHTML = "";
        }

        [DOM.inputUsername, DOM.inputPassword, DOM.selectRole].forEach((input) => {
            if (input) input.classList.remove("input-invalid");
        });

        if (DOM.errorUsername) DOM.errorUsername.textContent = "";
        if (DOM.errorPassword) DOM.errorPassword.textContent = "";
        if (DOM.errorRole) DOM.errorRole.textContent = "";
    };

    const roleNames = {
        solicitante: "Usuario Solicitante",
        tecnico: "Técnico de Soporte",
        supervisor: "Supervisor TI"
    };

    const handleLoginSubmit = (event) => {
        event.preventDefault();
        clearFormFeedback();

        const username = DOM.inputUsername.value.trim();
        const password = DOM.inputPassword.value;
        const role = DOM.selectRole.value;

        let hasErrors = false;

        if (!username) {
            DOM.inputUsername.classList.add("input-invalid");
            if (DOM.errorUsername) DOM.errorUsername.textContent = "Ingrese su usuario o correo.";
            hasErrors = true;
        } else if (username.length < 3) {
            DOM.inputUsername.classList.add("input-invalid");
            if (DOM.errorUsername) DOM.errorUsername.textContent = "Debe tener al menos 3 caracteres.";
            hasErrors = true;
        }

        if (!password) {
            DOM.inputPassword.classList.add("input-invalid");
            if (DOM.errorPassword) DOM.errorPassword.textContent = "Ingrese su contraseña.";
            hasErrors = true;
        } else if (password.length < 4) {
            DOM.inputPassword.classList.add("input-invalid");
            if (DOM.errorPassword) DOM.errorPassword.textContent = "Debe tener al menos 4 caracteres.";
            hasErrors = true;
        }

        if (!role) {
            DOM.selectRole.classList.add("input-invalid");
            if (DOM.errorRole) DOM.errorRole.textContent = "Seleccione un rol.";
            hasErrors = true;
        }

        if (hasErrors) return;

        DOM.submitBtn.disabled = true;
        if (DOM.submitBtnText) DOM.submitBtnText.textContent = "Validando...";
        if (DOM.submitSpinner) DOM.submitSpinner.hidden = false;

        console.group("Acceso a Intranet - NexusDesk");
        console.table({
            "Usuario": username,
            "Rol": roleNames[role] || role,
            "Fecha": new Date().toLocaleString()
        });
        console.groupEnd();

        setTimeout(() => {
            DOM.submitBtn.disabled = false;
            if (DOM.submitBtnText) DOM.submitBtnText.textContent = "Iniciar Sesión";
            if (DOM.submitSpinner) DOM.submitSpinner.hidden = true;

            if (DOM.authFeedback) {
                DOM.authFeedback.hidden = false;
                DOM.authFeedback.className = "auth-feedback success";
                DOM.authFeedback.innerHTML = `
          <strong>✓ Acceso Concedido</strong>
          <span>Usuario: <strong>${escapeHtml(username)}</strong></span>
          <span>Rol: <strong>${escapeHtml(roleNames[role] || role)}</strong></span>
        `;
            }

            setTimeout(() => {
                closeModal();
                DOM.loginForm.reset();
                clearFormFeedback();
            }, 2400);

        }, 600);
    };

    if (DOM.loginForm) {
        DOM.loginForm.addEventListener("submit", handleLoginSubmit);
    }

    // Utilidades
    const escapeHtml = (text) => {
        const div = document.createElement("div");
        div.textContent = text;
        return div.innerHTML;
    };

    // Scroll y Sección Activa
    if ("IntersectionObserver" in window && DOM.sections.length > 0) {
        const observerOptions = {
            root: null,
            rootMargin: "-20% 0px -70% 0px",
            threshold: 0
        };

        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const sectionId = entry.target.getAttribute("id");
                    DOM.navLinks.forEach((link) => {
                        const href = link.getAttribute("href");
                        if (href === `#${sectionId}`) {
                            link.classList.add("active");
                        } else {
                            link.classList.remove("active");
                        }
                    });
                }
            });
        }, observerOptions);

        DOM.sections.forEach((section) => {
            sectionObserver.observe(section);
        });
    }

});
