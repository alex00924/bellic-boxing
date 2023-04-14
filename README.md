## Dependencies

### Authenticate - Breeze
composer require laravel/breeze --dev
php artisan breeze:install

### Roles and Permissions - Spatie
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan make:seeder RoleAndPermissionSeeder