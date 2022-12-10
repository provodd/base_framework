<?php
namespace provodd\base_framework;

class Router{
    public function start(){
        $route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $route_list = [
            "/" => ['controller' => 'Main', 'action' => 'index'],
            '/index' => ['controller' => 'Main', 'action' => 'index'],
        ];

        if (isset($route_list[$route])){
            $controller = 'App\\Controllers\\'.$route_list[$route]['controller'];
            $object = new $controller();
            $action = $route_list[$route]['action'];
            $object->$action();
        }else{
            echo 'Несуществующая страница';
        }
    }
}