Mini eShop Order Management API
Laravel
PHP
MySQL
Swagger

A lightweight backend service for e-commerce order management with RESTful API built with Laravel.

Features
Create new orders with items

Retrieve order details by ID

List all orders

Automatic total price calculation

Comprehensive API documentation (Swagger/OpenAPI)

Input validation

Clean code architecture following Laravel best practices

Requirements
PHP 8.1 or higher

Composer

MySQL 8.0 or higher

Laravel 10.x or 11.x

Installation
Clone the repository:

bash
Copy
git clone https://github.com/yourusername/mini-eshop-api.git
cd mini-eshop-api
Install dependencies:

bash
Copy
composer install
Create and configure .env file:

bash
Copy
cp .env.example .env
Generate application key:

bash
Copy
php artisan key:generate
Configure database settings in .env:

ini
Copy
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_eshop
DB_USERNAME=root
DB_PASSWORD=
Run migrations:

bash
Copy
php artisan migrate
Generate Swagger documentation:

bash
Copy
php artisan l5-swagger:generate
Running the Application
Start the development server:

bash
Copy
php artisan serve
The API will be available at http://localhost:8000

API Documentation
Interactive API documentation is available at:

Copy
http://localhost:8000/api/documentation
API Endpoints
Create Order
POST /api/orders

Request Body:

json
Copy
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
Get Order by ID
GET /api/orders/{id}

List All Orders
GET /api/orders

Testing
Run PHPUnit tests:

bash
Copy
php artisan test
Test cases include:

Order creation

Input validation

Order retrieval

Order listing

Error handling

Database Schema
Orders Table
id - Primary key

customer_email - string

status - enum (NEW, PROCESSING, COMPLETED, CANCELLED)

total_price - decimal

created_at - timestamp

updated_at - timestamp

Order Items Table
id - Primary key

order_id - Foreign key to orders

product_name - string

unit_price - decimal

quantity - integer

created_at - timestamp

updated_at - timestamp

Deployment
Using Docker
Build the Docker image:

bash
Copy
docker-compose build
Start the containers:

bash
Copy
docker-compose up -d
Run migrations:

bash
Copy
docker-compose exec app php artisan migrate
Generate Swagger docs:

bash
Copy
docker-compose exec app php artisan l5-swagger:generate
The application will be available at http://localhost:8080

Contributing
Fork the project

Create your feature branch (git checkout -b feature/AmazingFeature)

Commit your changes (git commit -m 'Add some AmazingFeature')

Push to the branch (git push origin feature/AmazingFeature)

Open a Pull Request

License
Distributed under the MIT License. See LICENSE for more information.

Contact
Your Name - @yourtwitter - your.email@example.com

Project Link: https://github.com/yourusername/mini-eshop-api
