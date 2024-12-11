
# Restaurant Management System

Welcome to the **Restaurant Management System** project! This application is designed to help restaurants manage their daily operations with user roles for admins, waiters, cashiers, and chefs. It provides a full-featured CRUD system for managing menus, orders, users, and more.

## Features

- **Admin Panel with CRUD operations** for managing:
  - Categories
  - Concessions
  - Menu Items
  - Tables
  - Orders Management
  - Order Items
  - User Management (Roles, Staff Members, Users)

- **Waiter**: Can place dine-in orders by adding menu items, concessions, tables, and customer details.
- **Cashier**: Can place takeaway orders.
- **Chef**: Can view orders, change order statuses, and mark completed orders, which will trigger notifications to the front office.

## Table of Contents

1. [About the Project](#about-the-project)
2. [Installation Instructions](#installation-instructions)
3. [Environment Setup](#environment-setup)
4. [Admin Panel Features](#admin-panel-features)
5. [User Roles & Permissions](#user-roles--permissions)
6. [Technologies Used](#technologies-used)
7. [Database Architecture](#database-architecture)
8. [Login Credentials](#login-credentials)
9. [License](#license)

## About the Project

The **Restaurant Management System** is a web-based application built with the **Laravel** framework. The system allows the management of all aspects of a restaurant, from managing categories and menu items to tracking orders, user roles, and notifications.

The application uses role-based access control (RBAC) with the following roles:

- **Admin**: Full access to manage categories, menu items, staff, orders, and more.
- **Waiter**: Can create dine-in orders and add relevant customer details.
- **Cashier**: Handles takeaway orders.
- **Chef**: Views orders, updates order statuses, and marks them as completed.

## Installation Instructions

### Prerequisites

Before setting up the project, ensure you have the following installed:
- PHP (version 7.4+ recommended)
- Composer (for PHP dependencies)
- Node.js (for front-end dependencies)
- MySQL (for database)
- Laravel (the PHP framework)

### Setup

1. Clone the repository:
    ```bash
    git clone https://github.com/rasandilikshana/restaurant-system.git
    cd restaurant-system
    ```

2. Install PHP dependencies using Composer:
    ```bash
    composer install
    ```

3. Install front-end dependencies using npm:
    ```bash
    npm install
    ```

4. Create `.env` file:
    ```bash
    cp .env.example .env
    ```
    ```env
    APP_URL=http://127.0.0.1:8000
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=restaurant-system
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. Generate application key:
    ```bash
    php artisan key:generate
    ```

6. Run database migrations and seed data:
    ```bash
    php artisan migrate:fresh --seed
    ```

7. Link storage:
    ```bash
    php artisan storage:link
    ```

8. Start the local development server:
    ```bash
    php artisan serve
    ```

9. Run the front-end development server:
    ```bash
    npm run dev
    ```

## Admin Panel Features

The **Admin Panel** provides comprehensive CRUD operations for managing the restaurant’s data. The key features include:

- **Categories**: Create, update, and delete categories for organizing menu items.
- **Concessions**: Add, update, and delete concessions (discounts) available to customers.
- **Menu Items**: Manage menu items, including their name, description, price, image, and availability.
- **Tables**: Manage restaurant tables, including availability and assignments.
- **Orders Management**: View and manage orders placed by waiters and cashiers.
- **Order Items**: Manage items within each order, such as adding/removing menu items and updating quantities.
- **User Management**: Create, update, and delete staff members. Manage roles and permissions.

## User Roles & Permissions

The system uses **role-based access control (RBAC)** to define permissions for different users:

- **Admin**: Full access to all features (CRUD operations on all resources).
- **Waiter**: Can place dine-in orders, apply concessions, assign tables, and enter customer details.
- **Cashier**: Can create and manage takeaway orders and process billing.
- **Chef**: Views orders, updates order statuses (e.g., "In Progress", "Completed"), and sends notifications to the front office.

## Technologies Used

The following technologies are utilized in the development of this system:

- **Laravel**: Backend framework for handling application logic, database interactions, and routing.
- **Filament**: Admin panel package used for building the UI for CRUD operations and managing restaurant data.
- **Reverb**: Real-time event broadcasting system used for order notifications.
- **Breez**: Background job management for tasks such as processing orders and sending notifications.

## Database Architecture

You can view the database schema for the project here:  
[Database Schema](https://dbdiagram.io/d/67528b17e9daa85acadaf66a)

## Login Credentials

### Admin Login
To access the **Admin Panel**, navigate to the following URL:
- **Admin URL**: [http://127.0.0.1:8000/admin/login](http://127.0.0.1:8000/admin/login)
  - Email: `admin@example.com`
  - Password: `adminpassword`

### Staff Login
To log in as a staff member (waiter, cashier, or chef), use the following URL:
- **Staff URL**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
  
  **Waiter Login**:
  - Email: `waiter@example.com`
  - Password: `waiterpassword`

  **Cashier Login**:
  - Email: `cashier@example.com`
  - Password: `cashierpassword`

  **Chef Login**:
  - Email: `chef@example.com`
  - Password: `chefpassword`

## License

The Restaurant Management System is open-sourced software licensed under the **MIT license**.

---

For more details on configuration and extending the application, check the official [Laravel documentation](https://laravel.com/docs).

If you encounter any issues or have questions, feel free to open an issue on the [GitHub repository](https://github.com/rasandilikshana/restaurant-system).
