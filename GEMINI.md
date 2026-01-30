# Project Overview

This is a Laravel 12 web application designed as a library management system. It allows for the management of users ("Usuarios") and books ("Libros").

## Key Technologies

*   **Backend:** PHP 8.2, Laravel 12
*   **Frontend:** Vite, Tailwind CSS, Alpine.js, AdminLTE
*   **Database:** 
    *   **ORM:** Eloquent
    *   **Migrations:** Standard Laravel migrations.
    *   **Seeding:** Extensive seeding for initial data (Books, Users, Roles).
*   **Authentication & Authorization:** 
    *   **Authentication:** Laravel Breeze (likely, based on controllers/views).
    *   **Authorization:** `spatie/laravel-permission` is used for Role-Based Access Control (RBAC).
    *   **Roles:** `admin`, `editor`.
    *   **Permissions:** `create post`, `edit post`, `delete post` (currently named generically in seeder).

## Architecture & Key Components

*   **Models:**
    *   `User`: Standard Laravel user model, enhanced with Spatie's `HasRoles` trait.
    *   `Libro`: Represents a book in the library (Attributes: titulo, autor, anho, genero, descripcion).
    *   `Usuario`: Custom user model (separate from `User`?).
*   **Controllers:**
    *   `LibroController`: Manages book CRUD operations.
    *   `UsuarioController`: Manages user operations.
    *   `Datos`: Appears to be a controller for processing generic data (`/procesar-datos`).
*   **Routes:**
    *   Defined in `routes/web.php`.
    *   Admin routes and Book management are protected by `auth` middleware.
    *   Role-based middleware (e.g., `role:admin`) is referenced in comments, indicating a move towards stricter access control.

## Building and Running

### Setup

To set up the project for the first time:

```bash
composer run setup
```
This command performs: `composer install`, `.env` creation, key generation, database migration (force), `npm install`, and `npm run build`.

### Development Server

To start the development environment (PHP server + Vite + Queue):

```bash
composer run dev
```

### Testing

To run the test suite:

```bash
composer run test
```

## Database Seeding

The `DatabaseSeeder` is configured to:
1.  Clear permission cache.
2.  Create a test user (`test@example.com`).
3.  Create an admin user (`nerea_fernandez@cifpzonzamas.es` with password `12345678`).
4.  Seed a predefined list of ~30 books.
5.  Create `admin` and `editor` roles and assign permissions.
6.  Assign the `admin` role to the admin user.

## Development Conventions

*   **Permissions:** Use `$this->authorize('permission-name')` in controllers or policies, or middleware `role:name` in routes.
*   **Frontend:** Assets are compiled via Vite (`npm run dev` / `npm run build`).
*   **Code Style:** Standard Laravel PSR-4 autoloading and structure.
