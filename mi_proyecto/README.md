# 🛒 Tienda Virtual "El Paraíso"

Proyecto web para la gestión de compras y ventas de productos naturales, desarrollado con PHP, MySQL y Bootstrap. Orientado a brindar una experiencia limpia, modular y escalable.

---

## 📌 Características principales

- ✅ Registro e inicio de sesión con validación segura (`password_hash`)
- ✅ Estructura organizada en MVC: controllers, views, models
- ✅ Diseño responsive con Bootstrap 5
- ✅ Sistema de roles: cliente y admin
- ✅ Carrito de compras (estructura lista)
- ✅ Registro de acciones en log para auditoría
- ✅ Base de datos en MySQL lista con relaciones y llaves foráneas
- ✅ Panel administrativo en progreso
- ✅ Preparado para integrar más módulos (blog, soporte, etc.)

---

## 🧱 Tecnologías utilizadas

- PHP 8+
- MySQL / MariaDB
- HTML5 / CSS3
- Bootstrap 5
- XAMPP / phpMyAdmin
- Git / GitHub

---

## 🗂️ Estructura del proyecto

```bash
mi_proyecto/
├── controllers/       # Lógica principal (AuthController.php)
├── includes/          # Conexión BD y lógica auxiliar (conexion.php, procesar_auth.php)
├── models/            # Acceso a datos (Usuario.php)
├── templates/         # Reutilizables (header.php, footer.php, banner.php)
├── views/             # Vistas principales (auth.php, contac.php, nosotros.php, etc.)
├── config.php         # Configuración global del sistema (BASE_URL)
├── .gitignore         # Exclusiones para Git
├── README.md          # Este archivo
⚙️ Requisitos
XAMPP con Apache y MySQL activos

PHP 8.0 o superior

Importar el archivo tienda_virtual.sql en phpMyAdmin

Colocar el proyecto en htdocs/ (ejemplo: C:/xampp/htdocs/mi_proyecto)

Acceder vía: http://localhost/mi_proyecto/

🚀 Primeros pasos
Clonar o copiar el proyecto en htdocs

Crear la base de datos tienda_virtual y ejecutar el script SQL

Asegurar que el puerto MySQL en conexion.php coincida (ej: 3307)

Ejecutar en el navegador:

arduino
Copiar
Editar
http://localhost/mi_proyecto/views/auth.php
🛡️ Seguridad
Contraseñas cifradas con password_hash()

Control de sesiones con $_SESSION

Validación de duplicidad de correo en registro

Preparado para middleware de acceso a rutas protegidas

👤 Autor
Manuel Fontalvo Coronado
🌱 Desarrollador web y móvil
📧 fontalvcoronado9@gmail.com

📝 Licencia
Este proyecto está bajo la licencia MIT — libre para uso y modificación.