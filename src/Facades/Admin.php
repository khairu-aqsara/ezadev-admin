<?php

namespace Ezadev\Admin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Admin.
 *
 * @method static \Ezadev\Admin\Grid grid($model, \Closure $callable)
 * @method static \Ezadev\Admin\Form form($model, \Closure $callable)
 * @method static \Ezadev\Admin\Show show($model, $callable = null)
 * @method static \Ezadev\Admin\Tree tree($model, \Closure $callable = null)
 * @method static \Ezadev\Admin\Layout\Content content(\Closure $callable = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void css($css = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void js($js = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void script($script = '')
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void style($style = '')
 * @method static \Illuminate\Contracts\Auth\Authenticatable|null user()
 * @method static string title()
 * @method static void navbar(\Closure $builder = null)
 * @method static void registerAuthRoutes()
 * @method static void extend($name, $class)
 * @method static void disablePjax()
 * @method static void booting(\Closure $builder)
 * @method static void booted(\Closure $builder)
 * @method static void bootstrap()
 *
 * @see \Ezadev\Admin\Admin
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ezadev\Admin\Admin::class;
    }
}
