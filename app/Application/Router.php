<?php

namespace Hillel\Application;


/**
 * Загружает все роуты приложения
 */
class Router
{
    use ContainerTrait;

    private $routes;

    public $id;

    public function __construct(string $routesFile, Container $container)
    {
        $this->routes = include($routesFile);
        $this->container = $container;
    }

    public function getRouteInfo()
    {
        $uri = $_SERVER['REQUEST_URI'];

        //find GET data passed through url and store it into Container
        $params = parse_url($uri, PHP_URL_QUERY);
        $id = (int)(str_replace('id=', '', $params));
        if (!empty($id) ) {
            $this->container->set('id', $id);
        }

        //build string what to ignore in URI ?id= and id_number
        $ignoreStr = "?id=" . $id;
        $uri = str_replace($ignoreStr, '', $uri);

        //check if uri in routes array
        $uri_exists = array_key_exists($uri, $this->routes);

        if ( $uri_exists ) {

            foreach ($this->routes as $path => $controllerInfo) {

                if ( $path === $uri ) {

                    $info = explode('@', $controllerInfo);

                    return [
                        'controller' => $info[0],
                        'action' => $info[1]
                    ];
                }
            }

        }
        if ( !$uri_exists ) {

            return [
                'controller' => 'ErrorController',
                'action' => 'show404'
            ];
        }
        if ( strrpos($uri, '?') > 0 ) {
            return $id;
        }
    }

}
