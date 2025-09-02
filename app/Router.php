<?php

namespace app;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = (new Config())->data['routes'];
    }

    public static function getURI()
    {
        if (($_SERVER['REQUEST_URI']) != '/') {
            $uri = explode('?', trim($_SERVER['REQUEST_URI'], '/'));
            return $uri[0];
        }

        return $_SERVER['REQUEST_URI'];
    }

    public function run()
    {
        $uri = $this->getURI();

        if(empty($uri)) $uri = '/';

        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~^$uriPattern$~", $uri)) {

                $internalRoute = preg_replace("~^$uriPattern$~", $path, $uri);

                $segments = explode('/', $internalRoute);

                $controllerName = 'app\Controllers\\' . ucfirst(array_shift($segments));

                $parameters = $segments;

                $controllerObject = new $controllerName;

                $result = call_user_func_array($controllerObject, $parameters);

                if ($result != null) {
                    return;
                }
            }
        }
    }
}
