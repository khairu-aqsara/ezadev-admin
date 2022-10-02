[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=khairu-aqsara_ezadev-admin&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=khairu-aqsara_ezadev-admin) 
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=khairu-aqsara_ezadev-admin&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=khairu-aqsara_ezadev-admin)

### Requirments
* PHP >= 7.1.0
* Laravel >= 5.5.0
* Fileinfo PHP Extension

### Instalations

```
composer create-project --prefer-dist laravel/laravel:^7.0 blog
composer require ezadev/admin
php artisan vendor:publish --provider="Ezadev\Admin\AdminServiceProvider"
```

After run command you can find config file in `config/admin.php`, in this file you can change the install directory,db connection or table names. At last run following command to finish install.

```
php artisan admin:install
```

then run `php artisan serve` Open http://localhost:8000/admin/ in browser,use username admin and password admin to login.
