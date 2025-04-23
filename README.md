# 📝 Lista de Tareas (CRUD en PHP + MySQL)

Este proyecto es una aplicación web simple que permite gestionar una lista de tareas. Fue construido como prueba técnica usando PHP, MySQL, jQuery y Bootstrap.

## 📂 Estructura del Proyecto

/componentes/ │ ├── add.php # Agrega una nueva tarea │ ├── delete.php # Elimina (desactiva) una tarea │ ├── edit.php # Edita una tarea existente │ ├── getTareas.php # Obtiene tareas activas │ └── conex.php # Conexión a la base de datos /assets/ │ └── styles.css # Estilos personalizados index.php # Interfaz principal del sistema README.md # Documentación del proyecto


---

## 🚀 Funcionalidades

✅ Crear nueva tarea  
✅ Editar tarea existente  
✅ Eliminar tarea (soft delete con `active_flag`)  
✅ Visualizar solo tareas activas  
✅ Diseño responsive con Bootstrap  
✅ Operaciones sin recargar gracias a jQuery + AJAX

---

## ⚙️ Requisitos

- PHP 7.4 o superior
- MySQL/MariaDB
- Servidor local (XAMPP, WAMP, MAMP o similar)
- Navegador moderno

---

## 🛠️ Instalación

1. **Clona el repositorio**

```bash
git clone https://github.com/tu-usuario/lista-tareas.git
cd lista-tareas
