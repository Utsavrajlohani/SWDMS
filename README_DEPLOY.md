# InfinityFree Deployment Guide for SWDMS

Follow these steps to deploy your Laravel project to InfinityFree:

## 1. Prepare Folders

On your PC, create two folders:
- `htdocs` (This will be your web root)
- `laravel_core` (This will contain the Laravel system)

## 2. Arrange Files

- Move EVERYTHING from the project's **`public/`** folder into the **`htdocs/`** folder.
- Move all OTHER folders (`app`, `bootstrap`, `config`, `database`, `resources`, `routes`, `storage`, `vendor`, `composer.json`, etc.) into the **`laravel_core/`** folder.

## 3. Update index.php

Open `htdocs/index.php` and update the paths to point to `laravel_core`.
It should look like this:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance mode
if (file_exists($maintenance = __DIR__.'/../laravel_core/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composer autoloader
require __DIR__.'/../laravel_core/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__.'/../laravel_core/bootstrap/app.php';

$app->handleRequest(Request::capture());
```

## 4. Upload to InfinityFree

Using an FTP client (like FileZilla), upload both folders (`htdocs` and `laravel_core`) to the root of your InfinityFree account. 
The `htdocs` folder should merge with the existing `htdocs` on the server.

## 5. Configure Database (.env)

Edit `laravel_core/.env` on the server with your InfinityFree MySQL details (Host, Database, User, Password).

## 6. Import Database (SQL)

- Local PC pe **phpMyAdmin** ya kisi bhi DB tool se `swdms_new` database ko **Export** karein (SQL format mein).
- InfinityFree dashboard pe **phpMyAdmin** open karein.
- Wahan apna naya database select karein aur **Import** tab mein ja kar apna SQL file upload kar dein.

## 7. Permissions

Ensure `laravel_core/storage` and `laravel_core/bootstrap/cache` are writable (chmod 775 or 777 if needed).
