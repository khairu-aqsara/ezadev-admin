<?php

namespace Ezadev\Admin;

use Closure;
use Ezadev\Admin\Auth\Database\Menu;
use Ezadev\Admin\Controllers\AuthController;
use Ezadev\Admin\Layout\Content;
use Ezadev\Admin\Traits\HasAssets;
use Ezadev\Admin\Widgets\Navbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

/**
 * Class Admin.
 */
class Admin
{
    use HasAssets;

    /**
     * The Ezadev admin version.
     *
     * @var string
     */
    const VERSION = '0.5';

    /**
     * @var Navbar
     */
    protected $navbar;

    /**
     * @var array
     */
    protected $menu = [];

    /**
     * @var string
     */
    public static $metaTitle;

    /**
     * @var string
     */
    public static $favicon;

    /**
     * @var array
     */
    public static $extensions = [];

    /**
     * @var []Closure
     */
    protected static $bootingCallbacks = [];

    /**
     * @var []Closure
     */
    protected static $bootedCallbacks = [];

    /**
     * Returns the long version of ezadev-admin.
     *
     * @return string The long application version
     */
    public static function getLongVersion()
    {
        return sprintf('ezadev-admin <comment>version</comment> <info>%s</info>', self::VERSION);
    }

    /**
     * @param $model
     * @param Closure $callable
     *
     * @return \Ezadev\Admin\Grid
     *
     * @deprecated since v1.6.1
     */
    public function grid($model, Closure $callable)
    {
        return new Grid($this->getModel($model), $callable);
    }

    /**
     * @param $model
     * @param Closure $callable
     *
     * @return \Ezadev\Admin\Form
     *
     *  @deprecated since v1.6.1
     */
    public function form($model, Closure $callable)
    {
        return new Form($this->getModel($model), $callable);
    }

    /**
     * Build a tree.
     *
     * @param $model
     * @param Closure|null $callable
     *
     * @return \Ezadev\Admin\Tree
     */
    public function tree($model, Closure $callable = null)
    {
        return new Tree($this->getModel($model), $callable);
    }

    /**
     * Build show page.
     *
     * @param $model
     * @param mixed $callable
     *
     * @return Show
     *
     * @deprecated since v1.6.1
     */
    public function show($model, $callable = null)
    {
        return new Show($this->getModel($model), $callable);
    }

    /**
     * @param Closure $callable
     *
     * @return \Ezadev\Admin\Layout\Content
     *
     * @deprecated since v1.6.1
     */
    public function content(Closure $callable = null)
    {
        return new Content($callable);
    }

    /**
     * @param $model
     *
     * @return mixed
     */
    public function getModel($model)
    {
        if ($model instanceof Model) {
            return $model;
        }

        if (is_string($model) && class_exists($model)) {
            return $this->getModel(new $model());
        }

        throw new InvalidArgumentException("$model is not a valid model");
    }

    /**
     * Left sider-bar menu.
     *
     * @return array
     */
    public function menu()
    {
        if (!empty($this->menu)) {
            return $this->menu;
        }

        $menuClass = config('admin.database.menu_model');

        /** @var Menu $menuModel */
        $menuModel = new $menuClass();

        return $this->menu = $menuModel->toTree();
    }

    /**
     * @param array $menu
     *
     * @return array
     */
    public function menuLinks($menu = [])
    {
        if (empty($menu)) {
            $menu = $this->menu();
        }

        $links = [];

        foreach ($menu as $item) {
            if (!empty($item['children'])) {
                $links = array_merge($links, $this->menuLinks($item['children']));
            } else {
                $links[] = Arr::only($item, ['title', 'uri', 'icon']);
            }
        }

        return $links;
    }

    /**
     * Set admin title.
     *
     * @param string $title
     *
     * @return void
     */
    public static function setTitle($title)
    {
        self::$metaTitle = $title;
    }

    /**
     * Get admin title.
     *
     * @return string
     */
    public function title()
    {
        return self::$metaTitle ? self::$metaTitle : config('admin.title');
    }

    /**
     * @param null|string $favicon
     *
     * @return string|void
     */
    public function favicon($favicon = null)
    {
        if (is_null($favicon)) {
            return static::$favicon;
        }

        static::$favicon = $favicon;
    }

    /**
     * Get current login user.
     *
     * @return mixed
     */
    public function user()
    {
        return Auth::guard('admin')->user();
    }

    /**
     * Set navbar.
     *
     * @param Closure|null $builder
     *
     * @return Navbar
     */
    public function navbar(Closure $builder = null)
    {
        if (is_null($builder)) {
            return $this->getNavbar();
        }

        call_user_func($builder, $this->getNavbar());
    }

    /**
     * Get navbar object.
     *
     * @return \Ezadev\Admin\Widgets\Navbar
     */
    public function getNavbar()
    {
        if (is_null($this->navbar)) {
            $this->navbar = new Navbar();
        }

        return $this->navbar;
    }

    /**
     * Register the ezadev-admin builtin routes.
     *
     * @return void
     *
     * @deprecated Use Admin::routes() instead();
     */
    public function registerAuthRoutes()
    {
        $this->routes();
    }

    /**
     * Register the ezadev-admin builtin routes.
     *
     * @return void
     */
    public function routes()
    {
        $attributes = [
            'prefix'     => config('admin.route.prefix'),
            'middleware' => config('admin.route.middleware'),
        ];

        app('router')->group($attributes, function ($router) {

            /* @var \Illuminate\Support\Facades\Route $router */
            $router->namespace('\Ezadev\Admin\Controllers')->group(function ($router) {

                /* @var \Illuminate\Routing\Router $router */
                $router->resource('auth/users', 'UserController')->names('admin.auth.users');
                $router->resource('auth/roles', 'RoleController')->names('admin.auth.roles');
                $router->resource('auth/permissions', 'PermissionController')->names('admin.auth.permissions');
                $router->resource('auth/menu', 'MenuController', ['except' => ['create']])->names('admin.auth.menu');
                $router->resource('auth/logs', 'LogController', ['only' => ['index', 'destroy']])->names('admin.auth.logs');

                $router->post('_handle_form_', 'HandleController@handleForm')->name('admin.handle-form');
            });

            $authController = config('admin.auth.controller', AuthController::class);

            /* @var \Illuminate\Routing\Router $router */
            $router->get('auth/login', $authController.'@getLogin')->name('admin.login');
            $router->post('auth/login', $authController.'@postLogin');
            $router->get('auth/logout', $authController.'@getLogout')->name('admin.logout');
            $router->get('auth/setting', $authController.'@getSetting')->name('admin.setting');
            $router->put('auth/setting', $authController.'@putSetting');
        });
    }

    /**
     * Extend a extension.
     *
     * @param string $name
     * @param string $class
     *
     * @return void
     */
    public static function extend($name, $class)
    {
        static::$extensions[$name] = $class;
    }

    /**
     * @param callable $callback
     */
    public static function booting(callable $callback)
    {
        static::$bootingCallbacks[] = $callback;
    }

    /**
     * @param callable $callback
     */
    public static function booted(callable $callback)
    {
        static::$bootedCallbacks[] = $callback;
    }

    /**
     * Bootstrap the admin application.
     */
    public function bootstrap()
    {
        $this->fireBootingCallbacks();

        Form::registerBuiltinFields();

        Grid::registerColumnDisplayer();

        Grid\Filter::registerFilters();

        require config('admin.bootstrap', admin_path('bootstrap.php'));

        $assets = Form::collectFieldAssets();

        self::css($assets['css']);
        self::js($assets['js']);

        $this->fireBootedCallbacks();
    }

    /**
     * Call the booting callbacks for the admin application.
     */
    protected function fireBootingCallbacks()
    {
        foreach (static::$bootingCallbacks as $callable) {
            call_user_func($callable);
        }
    }

    /**
     * Call the booted callbacks for the admin application.
     */
    protected function fireBootedCallbacks()
    {
        foreach (static::$bootedCallbacks as $callable) {
            call_user_func($callable);
        }
    }

    /*
     * Disable Pjax for current Request
     *
     * @return void
     */
    public function disablePjax()
    {
        if (request()->pjax()) {
            request()->headers->set('X-PJAX', false);
        }
    }
}
