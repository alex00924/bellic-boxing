## Install

### Close Repository

```
git clone https://github.com/aleksandarpesic851/bellic-boxing
```

### Install Dependencies

```
composer install
php artisan key:generate
npm install
```

This application is using GD extension to resize signature image.
If the server is not activated this extension, activate it.

In windows xampp, you can update it in php.ini file

```
extension=gd
```

In ubuntu, you have to install extension

```
sudo apt-get install php8.1-gd
sudo service apache2 restart
```

### Create Database

Configuration database settings in .env file.

```
php artisan migrate
php artisan db:seed
```

### Link Storage

```
php artisan storage:link
```

## Dependencies

### Livewire

```
composer require livewire/livewire
```

### Authenticate - Breeze

```
composer require laravel/breeze --dev
php artisan breeze:install
```

### Roles and Permissions - Spatie

```
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan make:seeder RoleAndPermissionSeeder
```

### Country and State selection - laravel-simple-select

https://github.com/victorybiz/laravel-simple-select

```
composer require victorybiz/laravel-simple-select
# Publish the config file
php artisan vendor:publish --tag=simple-select:config
# Publish the view file
php artisan vendor:publish --tag=simple-select:views
# Javascript library
npm install -D @popperjs/core
```

### Image Library - intervention/image

```
composer require intervention/image
```

### PDF Library - setasign/fpdi-fpdf

```
composer require setasign/fpdi-fpdf
```

### Web Scraping Library - guzzlehttp/guzzle

```
composer require guzzlehttp/guzzle
```
