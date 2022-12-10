<?php
namespace provodd\base_framework\Providers;

class Router
{
    public $route_list;

    public function __construct($r)
    {
        $this->route_list = $r;
    }

    public function start()
    {
        $route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $route_list = $this->route_list;

        if (isset($route_list[$route])) {
            $controller = 'App\\Controllers\\' . $route_list[$route]['controller'];
            $object = new $controller();
            $action = $route_list[$route]['action'];
            $object->$action();
        } else {
            echo 'Несуществующая страница';
        }
    }
}