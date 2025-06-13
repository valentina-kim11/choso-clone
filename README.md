# Choso Digital Marketplace

This project is a multi‑seller platform for digital products built with **Laravel**, **Livewire** and **Tailwind CSS**.  It provides buyer, seller and admin flows inspired by sites like Gumroad and Plati.market but customised for the Vietnamese market.

## Features

- Buyer, Seller and Admin user roles
- Product, Category, Order and Wallet management
- Livewire components for browsing products, viewing details and managing the cart
- Seller dashboard
- Choso brand theme colours

## Setup on Codex

1. Install PHP and Node dependencies:
   ```bash
   composer install
   npm install
   ```
2. Copy the environment file and generate the application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Run the database migrations:
   ```bash
   php artisan migrate
   ```
4. Build frontend assets:
   ```bash
   npm run build
   ```
5. Start the development server:
   ```bash
   php artisan serve
   ```

Automated tests can be run with:
```bash
php vendor/bin/phpunit
```
