<?php

namespace Hillel\Application;


/**
 * Загружает все роуты приложения
 */
class Router
{
    private $routes;

    public function __construct(string $routesFile )
    {
        $this->routes = include($routesFile);
    }

    public function getRouteInfo()
    {
        $uri = $_SERVER['REQUEST_URI'];

        /*
         * first method
         * */
        //check if uri in routes array
        $uri_exists = array_key_exists($uri, $this->routes);

        foreach( $this->routes as $path => $controllerInfo ) {

            if ( $path === $uri ) {

                $info = explode('@', $controllerInfo);

                return [
                    'controller' => $info[0],
                    'action' => $info[1]
                ];
            }

        }
        if ( !$uri_exists ) {

            return [
                'controller' => 'ErrorController',
                'action' => 'show404'
            ];
        }


        /*
         * second method, not sure it's right
         * */
        /*$uri_exists = array_key_exists($uri, $this->routes);

        if ($uri_exists) {

           $info = explode('@', $this->routes[$uri]);

            return [
                'controller' => $info[0],
                'action' => $info[1]
            ];
        }

        if ( !$uri_exists ) {
            return [
                'controller' => 'ErrorController',
                'action' => 'show404'
            ];
        }*/
    }

}
