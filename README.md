# ✨ FSG_CODE - Flexible Software Generator ✨

<p align="center">
  <!-- Optional: Add a cool logo or banner here -->
  <!-- e.g., <img src="link_to_your_logo.png" alt="FSG_CODE Logo" width="200"/> -->
  <strong>A robust web application built with Laravel.</strong>
</p>

---

Welcome to **FSG_CODE**! This repository contains the source code for a web application focused on security, user management, and more. Built with the Laravel framework, it provides a solid foundation for various web-based functionalities.

## 📜 Table of Contents

- [🚀 About The Project](#-about-the-project)
- [🌟 Features](#-features)
- [🛠️ Tech Stack](#️-tech-stack)
- [📋 Prerequisites](#-prerequisites)
- [⚙️ Installation](#️-installation)
- [ධ Usage](#-usage)
- [📁 Project Structure](#-project-structure)
- [🔑 Key Routes](#-key-routes)
- [💾 Database Schema](#-database-schema)
- [🤝 Contributing](#-contributing)
- [📄 License](#-license)
- [📞 Contact](#-contact)

## 🚀 About The Project

FSG_CODE is a Laravel-based web application designed to provide secure user authentication, profile management, and password recovery functionalities. It serves as a template or starting point for more complex applications requiring these core features.

The project leverages Laravel's powerful features for rapid development, clean code, and maintainability.

## 🌟 Features

-   🔐 **User Authentication:** Secure login, registration (implied by user management), and session management.
-   👤 **User Profile Management:**
    -   View user catalog.
    -   Upload and manage user profile photos.
-   🔑 **Password Recovery:**
    -   Request password reset via email.
    -   Validate reset code.
    -   Set a new password.
-   🖼️ **Photo Uploads:** Functionality for users to upload profile pictures.
-   🌐 **Web Interface:** User-friendly web pages for all features.

## 🛠️ Tech Stack

-   **Backend:** PHP, Laravel
-   **Frontend:** Blade (Laravel's templating engine), HTML, CSS, JavaScript
-   **Styling:** Bootstrap 5.3.2
-   **Database:** (Assumed MySQL/MariaDB, PostgreSQL, or SQLite - configurable via `.env`)
-   **Package Management:** Composer (PHP), NPM (JavaScript)
-   **Development Tools:** Vite

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

-   PHP (version compatible with the project's `composer.json`, likely ^8.1 or higher)
-   Composer
-   Node.js and npm (or yarn)
-   A database server (e.g., MySQL, PostgreSQL, SQLite)

## ⚙️ Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/oscarock/FSG_CODE.git
    cd FSG_CODE
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install JavaScript dependencies:**
    ```bash
    npm install
    ```

4.  **Create your environment file:**
    Copy `.env.example` to `.env`:
    ```bash
    cp .env.example .env
    ```

5.  **Generate an application key:**
    ```bash
    php artisan key:generate
    ```

6.  **Configure your `.env` file:**
    Open `.env` and set your database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD, etc.) and any other necessary environment variables (e.g., MAIL_MAILER, MAIL_HOST for password recovery).

7.  **Run database migrations (and seeders if you want initial data):**
    ```bash
    php artisan migrate
    ```
    To include seeders (like `SegUsuarioSeeder`):
    ```bash
    php artisan migrate --seed
    ```

8.  **Build frontend assets:**
    ```bash
    npm run dev
    ```
    Or for production:
    ```bash
    npm run build
    ```

9.  **Set up storage link (if not already done, for public file access like user photos):**
    ```bash
    php artisan storage:link
    ```

## ධ Usage

1.  **Start the development server:**
    ```bash
    php artisan serve
    ```
    This will typically start the application on `http://127.0.0.1:8000`.

2.  **Access the application:**
    Open your web browser and navigate to the URL provided by `php artisan serve`. The default route `/` redirects to `/seguridad/auth/login`.

## 📁 Project Structure

Here's a brief overview of key directories:

-   `app/Http/Controllers/`: Contains controllers that handle incoming HTTP requests.
    -   `Seguridad/`: Controllers specific to security and user management.
-   `app/Models/`: Contains Eloquent models for database interaction.
    -   `Seguridad/`: Models specific to security entities.
-   `config/`: Application configuration files.
-   `database/migrations/`: Database schema migration files.
-   `database/seeders/`: Database seeder files for populating data.
-   `public/`: The web server's document root. Contains compiled assets and `index.php`.
    -   `fotos_usuarios/`: Likely stores user-uploaded profile pictures.
-   `resources/views/`: Contains Blade templates for the frontend.
    -   `layouts/`: Base layout templates.
    -   `modulos/seguridad/`: Views for security-related features (login, user catalog).
-   `routes/`: Defines application routes.
    -   `web.php`: Routes for web interface.
    -   `console.php`: Artisan console commands.
-   `vite.config.js`: Configuration for Vite asset bundling.

## 🔑 Key Routes

The main routes are defined in `routes/web.php`:

-   `/`: Redirects to login.
-   `/seguridad/auth/login`: Login page.
-   `/seguridad/auth/acceso`: Handles login attempt.
-   `/seguridad/usuario/catalogo`: Displays user catalog.
-   `/seguridad/usuarios/{id}/foto`: Handles user photo upload (GET for form, POST for submission).
-   `/seguridad/recuperar-contrasena`: Password recovery form (email submission).
-   `/seguridad/validar-codigo`: Form to validate password recovery code.
-   `/seguridad/nueva-contrasena`: Form to set a new password.

## 💾 Database Schema

Key tables created by migrations:

-   `users`: Standard Laravel users table (though `seg_usuario` seems to be the primary one used for application users).
-   `password_reset_tokens`: Stores tokens for password resets.
-   `sessions`: Stores user session data.
-   `seg_usuario`: Custom user table with fields like `idUsuario`, `usuarioAlias`, `usuarioNombre`, `usuarioEmail`, `usuarioFoto`, `codigoValidacion`, etc.

## 🤝 Contributing

Contributions are welcome!
Please read the `CONTRIBUTING.md` (if available, otherwise feel free to create one based on standard practices) for guidelines.

General steps:
1.  Fork the Project
2.  Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4.  Push to the Branch (`git push origin feature/AmazingFeature`)
5.  Open a Pull Request

## 📄 License

This project is licensed under the MIT License. See the `LICENSE` file for details.
*(If no LICENSE file exists, you might want to add one. The MIT license is a common choice for open-source projects.)*

## 📞 Contact

Project Link: [https://github.com/oscarock/FSG_CODE](https://github.com/oscarock/FSG_CODE)

---

<p align="center">
  <em>Generated with assistance from Roo - Your AI Coding Partner</em>
</p>
