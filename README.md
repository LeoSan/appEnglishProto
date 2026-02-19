# AppEnglishProto

Bienvenido al repositorio de **AppEnglishProto**. Este documento sirve como manual técnico y guía de instalación para el proyecto.

## 🚀 Stack Tecnológico

Este proyecto utiliza un conjunto moderno de tecnologías para garantizar escalabilidad, seguridad y una experiencia de desarrollo robusta.

### Backend
- **Framework**: [Laravel 11](https://laravel.com/) - La última versión del framework PHP más popular.
- **Base de Datos**: [PostgreSQL](https://www.postgresql.org/) - Sistema de gestión de base de datos relacional robusto y potente.
- **Autenticación**: [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze) - Implementación simple y mínima de todas las funciones de autenticación de Laravel.
- **Seguridad**: Protección CSRF, XSS, Hashing de contraseñas (Bcrypt) y validación de entradas nativa de Laravel.

### Frontend
- **Estilos**: [Tailwind CSS](https://tailwindcss.com/) - Framework CSS de utilidad primero para un diseño rápido y personalizado.
- **Scripting**: **TypeScript** y JavaScript. Configurado para usar TypeScript (`.ts`) como lenguaje principal para la lógica del cliente.
- **Build Tool**: [Vite](https://vitejs.dev/) - Herramienta de construcción frontend de próxima generación.
- **Motor de Plantillas**: Blade (Laravel por defecto) enriquecido con [Alpine.js](https://alpinejs.dev/) para interactividad ligera.

## 🛠️ Requisitos Previos

Asegúrate de tener instalado en tu entorno de desarrollo:
- **PHP** >= 8.2
- **Composer**
- **Node.js** y **NPM**
- **PostgreSQL**

## 📦 Guía de Instalación y Configuración

Sigue estos pasos para configurar el proyecto localmente:

1.  **Clonar el repositorio** (si aplica) o navegar al directorio del proyecto.

2.  **Instalar dependencias de PHP**:
    ```bash
    composer install
    ```

3.  **Instalar dependencias de JavaScript/TypeScript**:
    ```bash
    npm install
    ```

4.  **Configurar Variables de Entorno**:
    - Copia el archivo de ejemplo `.env.example` a `.env`:
      ```bash
      cp .env.example .env
      ```
    - Edita el archivo `.env` con tus credenciales de base de datos PostgreSQL:
      ```ini
      DB_CONNECTION=pgsql
      DB_HOST=127.0.0.1
      DB_PORT=5432
      DB_DATABASE=appenglishproto
      DB_USERNAME=tu_usuario  # (Ej: leonard)
      DB_PASSWORD=tu_contraseña
      ```

5.  **Generar Key y Migrar Base de Datos**:
    ```bash
    php artisan key:generate
    php artisan migrate
    ```

6.  **Compilar Assets (Frontend)**:
    Para desarrollo (con recarga en caliente):
    ```bash
    npm run dev
    ```
    Para producción:
    ```bash
    npm run build
    ```

7.  **Iniciar Servidor Local**:
    ```bash
    php artisan serve
    ```
    La aplicación estará disponible en `http://localhost:8000`.

## 📂 Estructura y Detalles Técnicos

### TypeScript en Laravel
Hemos migrado la configuración estándar de JavaScript a **TypeScript** para mayor robustez y tipado estático.
- **Punto de Entrada**: `resources/js/app.ts` (anteriormente `app.js`).
- **Configuración**: `tsconfig.json` en la raíz define las reglas de compilación.
- **Vite Integration**: `vite.config.js` está configurado para procesar archivos `.ts`.

Las vistas Blade ahora referencian al archivo TypeScript:
```blade
@vite(['resources/css/app.css', 'resources/js/app.ts'])
```

### Seguridad y Autenticación
El sistema incluye un módulo de Login completo (Registro, Login, Recuperación de Password) generado por Laravel Breeze.
- Las rutas de autenticación se encuentran en `routes/auth.php`.
- Los controladores de autenticación están en `app/Http/Controllers/Auth`.

### Usuario por Defecto (Desarrollo)
Se ha creado un usuario de prueba mediante los seeders:
- **Email**: `test@example.com`
- **Contraseña**: `password`

### Base de Datos
- Las migraciones se encuentran en `database/migrations`.
- El modelo de usuario por defecto es `app/Models/User.php`.

---
*Documentación generada automáticamente para AppEnglishProto.*
