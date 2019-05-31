<?php

return [

    /*
     * ezadev-admin name.
     */
    'name' => 'ezadev-admin',

    /*
     * Logo in admin panel header.
     */
    'logo' => '<b>Ezadev</b> admin',

    /*
     * Mini-logo in admin panel header.
     */
    'logo-mini' => '<b>EZ</b>',

    /*
     * Route configuration.
     */
    'route' => [

        'prefix' => 'admin',

        'namespace' => 'App\\Admin\\Controllers',

        'middleware' => ['web', 'admin'],
    ],

    /*
     * ezadev-admin install directory.
     */
    'directory' => app_path('Admin'),

    /*
     * ezadev-admin html title.
     */
    'title' => 'Admin',

    /*
     * Use `https`.
     */
    'secure' => false,

    /*
     * ezadev-admin auth setting.
     */
    'auth' => [
        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => Ezadev\Admin\Auth\Database\Administrator::class,
            ],
        ],
    ],

    /*
     * ezadev-admin upload setting.
     */
    'upload' => [

        'disk' => 'admin',

        'directory' => [
            'image' => 'images',
            'file'  => 'files',
        ],
    ],

    /*
     * ezadev-admin database setting.
     */
    'database' => [

        // Database connection for following tables.
        'connection' => '',

        // User tables and model.
        'users_table' => 'admin_users',
        'users_model' => Ezadev\Admin\Auth\Database\Administrator::class,

        // Role table and model.
        'roles_table' => 'admin_roles',
        'roles_model' => Ezadev\Admin\Auth\Database\Role::class,

        // Permission table and model.
        'permissions_table' => 'admin_permissions',
        'permissions_model' => Ezadev\Admin\Auth\Database\Permission::class,

        // Menu table and model.
        'menu_table' => 'admin_menu',
        'menu_model' => Ezadev\Admin\Auth\Database\Menu::class,

        // Pivot table for table above.
        'operation_log_table'    => 'admin_operation_log',
        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table'       => 'admin_role_users',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table'        => 'admin_role_menu',
    ],

    /*
     * By setting this option to open or close operation log in ezadev-admin.
     */
    'operation_log' => [

        'enable' => true,

        /*
         * Routes that will not log to database.
         *
         * All method to path like: admin/auth/logs
         * or specific method to path like: get:admin/auth/logs
         */
        'except' => [
            'admin/auth/logs*',
        ],
    ],

    /*
     * @see https://adminlte.io/docs/2.4/layout
     */
    'skin' => 'skin-blue-light',

    /*
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
     */
    'layout' => ['sidebar-mini', 'sidebar-collapse'],

    /*
     * Version displayed in footer.
     */
    'version' => '1.5.x-dev',

    /*
     * Settings for extensions.
     */
    'extensions' => [

    ],
];
