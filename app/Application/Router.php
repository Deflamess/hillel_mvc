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

    public $idContainer;

    public function __construct(string $routesFile )
    {
        $this->routes = include($routesFile);
    }

    public function getRouteInfo()
    {
        $uri = $_SERVER['REQUEST_URI'];

        //find GET data passed through url and store it into Container
        $this->id = parse_url($uri, PHP_URL_QUERY);
        $this->id = (int)(str_replace('id=', '', $this->id));
        $this->idContainer = new Container();
        $this->idContainer->set('id', $this->id);

        //build string what to ignore in URI ?id= and id_number
        $ignoreStr = "?id=" . $this->id;
        $uri = str_replace($ignoreStr, '', $uri);
        //var_dump($uri); die;

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
        if ( strrpos($uri, '?') > 0 )
            return $this->id;
    }

}
