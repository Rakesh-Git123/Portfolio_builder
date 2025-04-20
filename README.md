
# Laravel Portfolio Builder

A dynamic Portfolio Builder web application built with Laravel. This project allows users to register, log in, and manage their portfolio including skills, education, experience, and projects.

## 🔧 Features

- User Authentication (Login/Register)
- Create/Update Portfolio
- Add/Edit/Delete:
  - Skills
  - Education
  - Experience
  - Projects
- About Me Section
- Responsive Bootstrap UI

---

## 🚀 Getting Started

Follow these steps to set up the project on your local machine.

### 📦 Requirements

- PHP >= 8.1
- Composer
- MySQL
- Laravel 10+ (comes via composer)

---

## 🛠️ Installation Steps

### 1. Clone or Extract the Project

If you have ZIP file, extract it. Or clone from GitHub:

```bash
git clone https://github.com/your-username/portfolio-builder.git
cd portfolio-builder
```

---

### 2. Install Dependencies

```bash
composer install
```

---

### 3. Configure Environment File

```bash
cp .env.example .env
```

Edit the `.env` file and update your database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio_builder
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

### 5. Create Database

Go to [phpMyAdmin](http://localhost/phpmyadmin) or use command line:

```sql
CREATE DATABASE portfolio_builder;
```

---

### 6. Run Migrations

```bash
php artisan migrate
```

---

### 7. Create Storage Link

```bash
php artisan storage:link
```

---

### 8. Run the Application

```bash
php artisan serve
```

Then visit: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📁 Folder Structure

- `/app` – Application Logic
- `/resources/views` – Blade Views
- `/routes/web.php` – Web Routes
- `/public` – Public assets (images, CSS, JS)
- `/database/migrations` – Database structure

---

## ✍️ Author

Made with ❤️ by Rakesh

---

## 📜 License

This project is open-source and free to use.

