# 📰 BlogYaari – Blog Management System

A fully-featured Blog Management System built with **Laravel 10**, **MySQL**, **jQuery/AJAX**, and responsive **HTML/CSS**. Developed as part of the JobYaari PHP/Laravel Developer Intern Assessment.

---

## 🚀 Live Demo

- **Blog Site:** [your-live-url.com](https://your-live-url.com)
- **Admin Panel:** [your-live-url.com/admin/login](https://your-live-url.com/admin/login)
- **Admin Email:** `admin@blogyaari.com`
- **Admin Password:** `admin@123`

---

## ✨ Features

### 👤 User Side
- **Blog Listing Page** – Responsive grid of all published blogs with image, title, short description, date, and category
- **Blog Detail Page** – Full blog content with related posts, share buttons (WhatsApp, Twitter, Copy Link)
- **AJAX Search** – Live search without page reload
- **AJAX Category Filter** – Filter blogs by category using pills or dropdown (no page refresh)
- **AJAX Date Filter** – Filter blogs by specific date (no page refresh)
- **Responsive Design** – Works perfectly on mobile and desktop
- **Pagination** – Server-side pagination for blog listing

### 🔐 Admin Panel
- **Secure Login** – Admin-only authentication (non-admin users are rejected)
- **Dashboard** – Stats overview (total blogs, published, drafts, categories) + recent posts
- **Add Blog** – Title, content (HTML supported), short description, category, image upload, publish toggle
- **Edit Blog** – Full edit with current image preview and replace option
- **Delete Blog** – With confirmation dialog and automatic image cleanup
- **Category Management** – Add and delete categories with blog counts
- **Image Upload** – Upload and store blog cover images

---

## 🛠 Tech Stack

| Layer       | Technology                    |
|-------------|-------------------------------|
| Backend     | PHP 8.1+, Laravel 10          |
| Database    | MySQL 8.0                     |
| Frontend    | HTML5, CSS3 (responsive)      |
| JS          | jQuery 3.7, AJAX              |
| Auth        | Laravel built-in Auth         |
| Storage     | Laravel Storage (public disk) |
| Fonts       | Google Fonts (Baloo 2, Hind)  |
| Icons       | Font Awesome 6.5              |

---

## ⚙️ Setup Steps

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL
- Node.js (optional)

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/blog-management-system.git
cd blog-management-system
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database
Edit `.env` file:
```env
DB_DATABASE=blog_system
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Create Database & Run Migrations
```bash
# Create the database first (in MySQL):
# CREATE DATABASE blog_system;

php artisan migrate
```

### 6. Seed Sample Data
```bash
php artisan db:seed
```
This creates:
- Admin user: `admin@blogyaari.com` / `admin@123`
- 6 sample categories
- 6 sample blog posts

### 7. Storage Link
```bash
php artisan storage:link
```

### 8. Run the Application
```bash
php artisan serve
```

Visit: `http://localhost:8000`

---

## 📂 Project Structure

```
blog-management-system/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── BlogController.php          # Public blog listing & detail
│   │   │   └── Admin/
│   │   │       ├── AuthController.php      # Admin login/logout
│   │   │       ├── DashboardController.php # Admin dashboard
│   │   │       ├── BlogController.php      # Blog CRUD
│   │   │       └── CategoryController.php  # Category management
│   │   └── Middleware/
│   │       └── AdminMiddleware.php         # Protects admin routes
│   └── Models/
│       ├── Blog.php
│       ├── Category.php
│       └── User.php
├── database/
│   ├── migrations/                         # DB schema
│   └── seeders/
│       └── DatabaseSeeder.php              # Sample data
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php                   # Public layout
│   │   └── admin.blade.php                 # Admin layout
│   ├── blog/
│   │   ├── index.blade.php                 # Blog listing + AJAX filters
│   │   ├── show.blade.php                  # Blog detail
│   │   └── partials/
│   │       ├── blog-cards.blade.php        # AJAX-rendered card grid
│   │       └── pagination.blade.php        # Custom pagination
│   └── admin/
│       ├── auth/login.blade.php
│       ├── dashboard.blade.php
│       ├── blogs/{index,create,edit}.blade.php
│       └── categories/index.blade.php
└── routes/
    └── web.php                             # All routes
```

---

## 🔧 AJAX Implementation

The filter system uses **jQuery AJAX** with zero page reloads:

```javascript
$.ajax({
    url: AJAX_URL,
    type: 'GET',
    headers: { 'X-Requested-With': 'XMLHttpRequest' },
    data: { search, category_id, date },
    success(res) {
        $('#blogs-container').html(res.html);
        $('#result-count').text(res.count + ' posts found');
    }
});
```

The Laravel controller detects AJAX requests via `$request->ajax()` and returns JSON with rendered HTML + count, instead of a full page.

---

## 🌐 Deployment

### Free Hosting (InfinityFree / 000WebHost)
1. Export your MySQL database
2. Upload all project files via FTP
3. Import database via phpMyAdmin
4. Update `.env` with hosting DB credentials
5. Run `php artisan storage:link` (or manually symlink)

### Render (Recommended)
1. Push code to GitHub
2. Create a new Web Service on Render
3. Set build command: `composer install && php artisan migrate --seed`
4. Add all environment variables from `.env`

---

## 📝 Admin Credentials

| Field    | Value                  |
|----------|------------------------|
| URL      | `/admin/login`         |
| Email    | `admin@blogyaari.com`  |
| Password | `admin@123`            |

---

## 📄 License

MIT License – Free to use for educational purposes.

---

*Built with ❤️ using Laravel 10 + jQuery/AJAX for the JobYaari Developer Assessment*
