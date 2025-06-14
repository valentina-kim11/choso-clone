# Choso Digital Marketplace


This project is a multi‑seller platform for digital products built with **Laravel**, **Livewire** and **Tailwind CSS**.  It provides buyer, seller and admin flows inspired by sites like Gumroad and Plati.market but customised for the Vietnamese market.

This project is a multi-seller platform for digital goods built with **Laravel**, **Livewire** and **Tailwind CSS**.


## Features

- Buyer, Seller and Admin user roles
- Product, Category, Order and Wallet management

- Livewire components for browsing products, viewing details and managing the cart
- Seller dashboard
- Choso brand theme colours

- Livewire components for browsing products and managing the cart
- Seller dashboard with Choso brand theme colours
- Checkout purchases using the built-in Scoin wallet

### Wallet Logs


Uploaded product files are stored in `storage/app/products`. After a purchase, buyers receive links pointing to `/download/{orderItem}`. The route validates ownership and returns the file via `Storage::disk('products')->download()`.

Downloads are limited to **5 times** within **3 days** of the order date. Further requests will be rejected.


- Checkout purchases using the built-in Scoin wallet
- Product files stored in `storage/app/products` and downloadable via `Storage::url($product->file_path)`

Every change to a user's wallet balance is recorded in the `wallet_logs` table. Buyers access their history at `/shop/wallet-logs`, sellers at `/seller/wallet-logs`, and admins can review all logs at `/admin/wallet-logs`.


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


Automated tests can be run with:
```bash
php vendor/bin/phpunit
```

To run the tests, install PHP >= 8.2 and Composer then execute:
```bash
php vendor/bin/phpunit
```

To run the tests, ensure PHP 8.2 and Composer are installed on your system.


Để chạy được test, hệ thống cần PHP >= 8.2 và Composer.


