# 🛍️ Mini eShop Order Management API

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Swagger](https://img.shields.io/badge/Swagger-85EA2D?style=for-the-badge&logo=swagger&logoColor=black)

A lightweight backend service for e-commerce order management with RESTful API built with Laravel.

## ✨ Features

- ✅ Create new orders with items
- 🔍 Retrieve order details by ID
- 📋 List all orders
- 🧮 Automatic total price calculation
- 📚 Comprehensive API documentation (Swagger/OpenAPI)
- 🛡️ Input validation
- 🏗️ Clean code architecture following Laravel best practices

## ⚙️ Requirements

- PHP 8.1+
- Composer 2.0+
- MySQL 8.0+
- Laravel 10.x/11.x

## 🚀 Installation

```bash
# Clone the repository
git clone https://github.com/abdulawr/mini-eshop-api.git
cd mini-eshop-api

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env
nano .env

# Run migrations
php artisan migrate

# Generate API docs
php artisan l5-swagger:generate

{
  "customer_email": "user@example.com",
  "items": [
    {
      "product_name": "Keyboard",
      "unit_price": 45.50,
      "quantity": 1
    },
    {
      "product_name": "Mouse",
      "unit_price": 20.00,
      "quantity": 2
    }
  ]
}

php artisan test
