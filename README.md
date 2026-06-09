# SolarCO - Plataforma Web de Gestión de Energía Solar

## 📄 Descripción del Proyecto
SolarCO es una solución web informativa y de gestión diseñada para empresas de instalación de energía solar fotovoltaica en Colombia. Permite a los usuarios conocer las ventajas de la transición energética, explorar proyectos activos y enviar consultas de soporte, mientras que ofrece un panel administrativo protegido para el control del portafolio.

---

## 👥 Estructura del Equipo de Desarrollo
- **Sergio:** Configuración de entorno, base de datos (`config/db.php`), autenticación de usuarios (`login.php`, `logout.php`), y control de acciones.
- **Integrante B:** Módulo de administración y gestión del CRUD de proyectos (`proyectos.php`).
- **Integrante C:** Diseño estético global (`css/style.css`), página de inicio (`index.php`) y sección informativa (`energia-solar.php`).
- **Integrante D (Johan):** Formulario de contacto con persistencia PDO (`contacto.php`), validaciones dinámicas en JS puro (`js/script.js`), panel interactivo en HTML5 Canvas (`estadisticas.php`), y documentación técnica.

---

## 🛠️ Tecnologías Utilizadas
- **Backend:** PHP Procedimental con arquitectura PDO (PHP Data Objects).
- **Frontend:** HTML5 Semántico, CSS3 Adaptativo y JavaScript Puro (Vanilla JS).
- **Base de Datos:** MySQL (Servidor local administrado con XAMPP / Laragon).

---

## 🚀 Instrucciones de Instalación y Despliegue Local

Para ejecutar este entorno de desarrollo en su máquina local, siga los siguientes pasos:

1. **Clonar el repositorio** dentro del directorio de despliegue de su servidor local:
   ```bash
   cd /c/xampp/htdocs/
   git clone [https://github.com/semurillo05/solarco.git](https://github.com/semurillo05/solarco.git)
   cd solarco