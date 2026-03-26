# Smart Wholesale Distribution Management System (SWDMS)

A robust Laravel-based system for managing wholesale distribution, including retailers, orders, products, and payments.

## Prerequisites

Before running the project, ensure you have the following installed:

- **PHP** >= 8.2
- **Composer**
- **Node.js** & **NPM**
- **MySQL** or compatible database

## Installation

1.  **Clone the Repository**
    ```bash
    git clone <repository-url>
    cd SWDMS
    ```

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Install Node Dependencies**
    ```bash
    npm install
    ```

4.  **Environment Setup**
    - Copy `.env.example` to `.env`
    - Update database credentials in `.env`:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=swdms_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Migrate and Seed Database**
    This command creates tables and populates them with sample data (Including Admin and Retailer accounts).
    ```bash
    php artisan migrate:fresh --seed
    ```

## Running the Application

1.  **Start Local Development Server**
    ```bash
    php artisan serve
    ```

2.  **Compile Assets (Vite)**
    ```bash
    npm run dev
    ```

3.  **Access in Browser**
    Visit [http://localhost:8000](http://localhost:8000)

## Login Credentials

### 1. Admin (Wholesaler)
Use this account to manage products, retailers, and orders.
- **Email**: `admin@swdms.com`
- **Password**: `password`



## Key Features

- **Wholesaler Dashboard**: Analytics, Product Management, Retailer Management, Order Approval.
- **Retailer Dashboard**: Place Orders, View History, Manage Profile.
- **Order Flow**: Credit limit checks, Stock deduction, Payment tracking.
