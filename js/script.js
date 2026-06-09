/**
 * SolarCO - JavaScript de Validaciones Dinámicas Completas
 * Desarrollado por: Integrante D (Johan)
 * Fecha: Junio 2026
 */

document.addEventListener("DOMContentLoaded", function () {
    
    // ==========================================
    // 1. VALIDACIÓN DEL FORMULARIO DE LOGIN
    // ==========================================
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            const emailInput = document.getElementById("loginEmail");
            const passwordInput = document.getElementById("loginPassword");
            let errorContainer = document.getElementById("loginErrorContainer");

            // Si no existe el contenedor en la plantilla del compañero, lo crea de respaldo
            if (!errorContainer) {
                errorContainer = document.createElement("div");
                errorContainer.id = "loginErrorContainer";
                errorContainer.style.color = "#C9960C";
                errorContainer.style.marginTop = "10px";
                errorContainer.style.fontWeight = "bold";
                loginForm.appendChild(errorContainer);
            }

            if (emailInput.value.trim() === "" || passwordInput.value.trim() === "") {
                e.preventDefault();
                errorContainer.textContent = "Error: Todos los campos del inicio de sesión son obligatorios.";
                errorContainer.style.display = "block";
            } else {
                errorContainer.textContent = "";
            }
        });
    }

    // ==========================================
    // 2. VALIDACIÓN DEL FORMULARIO DE CONTACTO
    // ==========================================
    const contactoForm = document.getElementById("contactoForm");
    if (contactoForm) {
        contactoForm.addEventListener("submit", function (e) {
            const nombre = document.getElementById("nombre");
            const apellido = document.getElementById("apellido");
            const email = document.getElementById("email");
            const mensaje = document.getElementById("mensaje");
            const errorContainer = document.getElementById("contactoErrorContainer");

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let errores = [];

            // Validación de campos vacíos
            if (nombre.value.trim() === "" || apellido.value.trim() === "" || email.value.trim() === "" || mensaje.value.trim() === "") {
                errores.push("Todos los campos marcados como obligatorios deben ser diligenciados.");
            }

            // Validación de formato de correo
            if (email.value.trim() !== "" && !emailRegex.test(email.value.trim())) {
                errores.push("Por favor, ingrese una dirección de correo electrónico válida.");
            }

            // Gestión del contenedor visual de errores
            if (errores.length > 0) {
                e.preventDefault(); // Detiene el envío
                if (errorContainer) {
                    errorContainer.innerHTML = errores.join("<br>");
                    errorContainer.style.display = "block";
                    // Hace un scroll suave hacia el contenedor de errores
                    errorContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                if (errorContainer) {
                    errorContainer.style.display = "none";
                }
            }
        });
    }

    // ==========================================
    // 3. VALIDACIÓN DEL FORMULARIO DE PROYECTOS
    // ==========================================
    const proyectoForm = document.getElementById("proyectoForm");
    if (proyectoForm) {
        proyectoForm.addEventListener("submit", function (e) {
            const capacidadInput = document.getElementById("capacidad_kw");
            const capacidadValue = parseFloat(capacidadInput.value);
            let errorContainer = document.getElementById("proyectoErrorContainer");

            if (!errorContainer) {
                errorContainer = document.createElement("div");
                errorContainer.id = "proyectoErrorContainer";
                errorContainer.style.color = "#dc3545";
                errorContainer.style.marginTop = "10px";
                errorContainer.style.fontWeight = "bold";
                errorContainer.style.textAlign = "left";
                proyectoForm.appendChild(errorContainer);
            }

            if (isNaN(capacidadValue) || capacidadValue <= 0) {
                e.preventDefault();
                errorContainer.textContent = "Error: La capacidad instalada (kW) debe ser un valor numérico superior a cero.";
                errorContainer.style.display = "block";
            } else {
                errorContainer.style.display = "none";
            }
        });
    }
});