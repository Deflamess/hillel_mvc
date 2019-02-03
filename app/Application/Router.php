<?php

namespace Hillel\Application;

/**
 * Загружает все роуты приложения
 */
class Router
{
    private $routes;

    public function __construct(string $routesFile)
    {
        $this->routes = include($routesFile);
    }

    public function getRouteInfo()
    {
        $uri = $_SERVER['REQUEST_URI'];
        foreach($this->routes as $path => $controllerInfo)
        {
            if ($path === $uri) {
                $info = explode('@', $controllerInfo);
                return [
                    'controller' => $info[0],
                    'action' => $info[1]
                ];
            }
        }
    }

}