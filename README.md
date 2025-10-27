# 🏨 Bookingin Hotel - Hotel Management System

<div align="center">
  
  ![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
  ![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white)
  ![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

</div>

## 📋 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Prerequisites](#-prerequisites)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Database Setup](#-database-setup)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
- [API Integration](#-api-integration)
- [Contributing](#-contributing)
- [License](#-license)

## 🌟 Overview

**Bookingin Hotel** is a comprehensive hotel management system built with Laravel 10. This system provides a complete solution for managing hotel operations including room reservations, guest management, payment processing, and administrative tasks. The application features a role-based access control system with separate interfaces for administrators, receptionists, and guests.

## ✨ Features

### 🎯 Core Features

- **📅 Reservation Management**
  - Online room booking system
  - Check-in/Check-out date management
  - Reservation status tracking (Pending, Success, Canceled)
  - Booking code generation for each reservation
  - Reschedule functionality with tracking
  
- **👥 Guest Management**
  - Guest information management
  - Guest history tracking
  - Soft delete functionality for data recovery
  
- **🛏️ Room Management**
  - Room categories and pricing
  - Room availability tracking
  - Multiple room photos per room
  - Room features assignment
  - Room gallery management
  
- **💳 Payment Integration**
  - Midtrans payment gateway integration
  - Multiple payment methods (Bank Transfer, Credit Card, e-Wallet)
  - Payment status tracking
  - Automatic total payment calculation with tax and service fee
  
- **🔐 Authentication & Authorization**
  - Role-based access control (Admin, Receptionist, Guest)
  - Google OAuth integration
  - Secure login/logout functionality
  - User registration system
  
- **📧 Email Notifications**
  - Booking confirmation emails
  - Reservation success notifications
  
- **📊 Reporting**
  - Reservation reports
  - Custom date range filtering
  - Export functionality
  
- **🗑️ Soft Delete & Recovery**
  - Data recovery for deleted records
  - Trash management system
  - Permanent delete functionality (admin only)

### 🎨 User Interfaces

- **Backend Dashboard** - Admin and Receptionist panel
- **Frontend Interface** - Guest booking interface
- **Responsive Design** - Mobile-friendly layouts

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 10.x
- **Language**: PHP 8.1+
- **Database**: MySQL/MariaDB
- **Authentication**: Laravel Sanctum
- **OAuth**: Laravel Socialite (Google)

### Frontend
- **Blade Templates** - Laravel Blade templating engine
- **CSS Framework**: Bootstrap 4
- **JavaScript**: jQuery, DataTables
- **UI Libraries**: SweetAlert2, Matrix Admin Template

### Payment Gateway
- **Midtrans** - Indonesian payment gateway integration

### Additional Packages
- `midtrans/midtrans-php` - Payment processing
- `laravel/socialite` - Social authentication
- `guzzlehttp/guzzle` - HTTP client

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- PHP >= 8.1
- Composer
- Node.js & NPM (for frontend assets)
- MySQL or MariaDB
- Web Server (Apache/Nginx)
- Git

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd Bookingin-Hotel
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install NPM dependencies (if needed)
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Environment

Edit the `.env` file with your configuration:

```env
APP_NAME="Bookingin Hotel"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookingin_hotel
DB_USERNAME=root
DB_PASSWORD=

# Midtrans Configuration
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@bookinginhotel.com
```

### 5. Database Setup

```bash
# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

## 📁 Project Structure

```
Bookingin-Hotel/
├── app/
│   ├── Console/          # Artisan commands
│   ├── Exceptions/       # Exception handlers
│   ├── Helpers/          # Helper classes
│   ├── Http/
│   │   ├── Controllers/  # Application controllers
│   │   └── Middleware/   # Custom middleware
│   ├── Mail/             # Mail classes
│   ├── Models/           # Eloquent models
│   └── Providers/        # Service providers
├── config/               # Configuration files
├── database/
│   ├── migrations/       # Database migrations
│   └── seeders/          # Database seeders
├── public/               # Public assets
│   ├── backend/          # Backend assets
│   └── frontend/         # Frontend assets
├── resources/
│   ├── views/            # Blade templates
│   │   ├── backend/      # Admin views
│   │   ├── frontend/     # Guest views
│   │   └── emails/       # Email templates
│   ├── css/              # Stylesheets
│   └── js/               # JavaScript files
├── routes/               # Route definitions
├── storage/              # File storage
└── tests/                # Test files
```

## 💾 Database Schema

### Main Tables

- **users** - System users (admins, receptionists, guests)
- **guests** - Guest information
- **room_categories** - Room category definitions
- **rooms** - Room details and pricing
- **room_photos** - Room images
- **features** - Room features/amenities
- **feature_room** - Room-feature pivot table
- **reservations** - Booking records
- **contacts** - Contact messages

## 🔧 Usage

### Starting the Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

### Default Credentials

After running the seeders, you can use:

**Admin Account:**
- Email: admin@bookinginhotel.com
- Password: password

**Receptionist Account:**
- Email: receptionist@bookinginhotel.com
- Password: password

**Guest Account:**
- Email: guest@bookinginhotel.com
- Password: password

### Key Routes

**Backend Routes:**
- `/backend/login` - Admin/Receptionist login
- `/backend/beranda` - Dashboard
- `/backend/reservation` - Reservation management
- `/backend/room` - Room management
- `/backend/guest` - Guest management

**Frontend Routes:**
- `/beranda` - Guest home page
- `/room` - Browse available rooms
- `/room/detail/{id}` - Room details
- `/booking/{room_id}` - Booking form
- `/history` - Booking history

## 🔌 API Integration

### Midtrans Configuration

1. Sign up at [Midtrans](https://midtrans.com)
2. Get your Server Key and Client Key
3. Add credentials to `.env` file
4. Configure webhook URL in Midtrans dashboard

### Google OAuth Setup

1. Create a project in [Google Cloud Console](https://console.cloud.google.com)
2. Enable Google+ API
3. Create OAuth 2.0 credentials
4. Add credentials to `.env`:
   ```env
   GOOGLE_CLIENT_ID=your_client_id
   GOOGLE_CLIENT_SECRET=your_client_secret
   GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
   ```

## 🔐 Security Features

- Password hashing with bcrypt
- CSRF protection
- SQL injection prevention
- XSS protection
- Role-based access control
- Middleware authentication
- Secure session management

## 🧪 Testing

```bash
# Run tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature
```

## 📝 Additional Commands

```bash
# Clear all caches
php artisan optimize:clear

# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache
```

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

**Bookingin Hotel Development Team**

## 🙏 Acknowledgments

- Laravel Framework
- Midtrans Payment Gateway
- Matrix Admin Template
- All contributors and developers

---

<div align="center">
  
  Made with ❤️ using Laravel

  **Built with Laravel 10 | PHP 8.1+**

</div>
