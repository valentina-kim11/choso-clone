# Choso Digital Marketplace

This project is a multi-seller platform for digital goods built with **Laravel**, **Livewire** and **Tailwind CSS**.

## Features

- Buyer, Seller and Admin user roles
- Product, Category, Order and Wallet management
- Livewire components for browsing products and managing the cart
- Seller dashboard with Choso brand theme colours
- Digital product files stored in `storage/app/products` and served via a protected `/download/{orderItem}` route
- Checkout purchases using the built-in Scoin wallet

### Product Files

Uploaded files are stored in `storage/app/products`. After purchase, buyers can download their files via `/download/{orderItem}`. Each file can be downloaded up to **5 times** within **3 days** of the order date.

## Setup on Codex

1. If PHP is not installed, add it with:
   ```bash
   sudo apt-get update
   sudo apt-get install -y php php-cli php-mbstring php-xml
   ```
2. Install PHP and Node dependencies:
   ```bash
   composer install
   npm install
   ```
3. Copy the environment file and generate the application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Run the database migrations:
   ```bash
   php artisan migrate
   ```
5. Build frontend assets:
   ```bash
   npm run build
   ```
6. Start the development server:
   ```bash
   php artisan serve
   ```

Automated tests require **PHP >= 8.2** and **Composer**:
```bash
php vendor/bin/phpunit
```
