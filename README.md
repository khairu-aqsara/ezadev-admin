### Requirments
* PHP >= 7.0.0
* Laravel >= 5.5.0
* Fileinfo PHP Extension

### Instalations

```
composer create-project --prefer-dist laravel/laravel ezadev-admin "5.5.*"
composer require ezadev/admin
php artisan vendor:publish --provider="Ezadev\Admin\AdminServiceProvider"
```

After run command you can find config file in `config/admin.php`, in this file you can change the install directory,db connection or table names. At last run following command to finish install.

```
php artisan admin:install
```

then run `php artisan serve` Open http://localhost:8000/admin/ in browser,use username admin and password admin to login.
