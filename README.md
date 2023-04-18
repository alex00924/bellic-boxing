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
