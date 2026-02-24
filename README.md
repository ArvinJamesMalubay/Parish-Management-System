# Parish Record Management System

A web-based Parish Record Management System built with **Laravel 11** and **MySQL**, featuring a premium "Sacred & Modern" UI design.

---

## 🚀 Getting Started

### Prerequisites

- **PHP 8.2+** — [Download PHP](https://windows.php.net/download/)
- **Composer** — [Download Composer](https://getcomposer.org/download/)
- **MySQL 8.0+** — via XAMPP, Laragon, or standalone install
- A local server tool like [Laragon](https://laragon.org/) (recommended for Windows) or XAMPP

### Recommended (Easiest on Windows): Laragon

1. Download and install [Laragon](https://laragon.org/)
2. Laragon ships with PHP, Composer, and MySQL — no manual setup needed

---

## ⚙️ Installation

```bash
# 1. Install PHP dependencies
composer install

# 2. Copy the environment file
cp .env.example .env

# 3. Generate the application key
php artisan key:generate

# 4. Configure your database in .env:
#    DB_DATABASE=parish_rms
#    DB_USERNAME=root
#    DB_PASSWORD=           ← your MySQL root password

# 5. Create the database in MySQL:
#    CREATE DATABASE parish_rms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# 6. Run migrations
php artisan migrate

# 7. Start the development server
php artisan serve
```

Then open **http://127.0.0.1:8000** in your browser.

---

## 📋 Features (Scaffold)

| Module                   | Description                                         |
| ------------------------ | --------------------------------------------------- |
| **Dashboard**            | Overview stats, quick actions, recent activity      |
| **Parishioners**         | Member registry — personal info, family links       |
| **Families**             | Family household records with member grouping       |
| **Baptism Records**      | Baptism date, officiant, godparents, book reference |
| **Confirmation Records** | Confirmation date, bishop, sponsor, book reference  |
| **Marriage Records**     | Groom, bride, date, officiant, witnesses            |
| **Death Records**        | Deceased, death date, cause, burial details         |

---

## 🎨 Design

Theme: **Sacred & Modern**

- Fonts: `Cinzel` (display headers) + `Lato` (body)
- Palette: Midnight Navy · Warm Gold · Soft Ivory
- Custom CSS at `public/css/parish.css`
- Fully responsive (mobile sidebar toggle included)

---

## 📁 Project Structure

```
app/
  Http/Controllers/     ← Resource controllers for all modules
  Models/               ← Eloquent models with relationships
config/
  app.php               ← App config (timezone: Asia/Manila)
  database.php          ← MySQL connection config
database/
  migrations/           ← 7 migration files
public/
  css/parish.css        ← Full custom stylesheet
resources/views/
  layouts/app.blade.php ← Master layout
  auth/                 ← Login & Register pages
  dashboard.blade.php   ← Dashboard
  members/              ← Parishioner views
  baptisms/             ← Baptism record views
  marriages/            ← Marriage record views
  deaths/               ← Death record views
  confirmations/        ← Confirmation record views
  families/             ← Family views
routes/
  web.php               ← All application routes
  auth.php              ← Auth routes
```

---

## 🗄️ Database Schema

```
users               → App administrators
members             → Parish members / parishioners
families            → Family groups
baptism_records     → Baptism sacrament records
marriage_records    → Marriage sacrament records
death_records       → Death / burial records
confirmation_records → Confirmation sacrament records
```

---

## 📌 Notes

- The `PARISH_NAME` env variable can be set to your parish name (shown in sidebar footer)
- All dates default to Philippines timezone (`Asia/Manila`)
- Business logic (search, filtering, reporting, certificate generation) will be added in the next phase
