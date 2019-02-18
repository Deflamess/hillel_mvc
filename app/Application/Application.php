<?php

namespace Hillel\Application;

use Hillel\Controller\BaseController;

/**
 * Самый главный класс приложения, он будет инициализировать все настройки, зависимости,
 * и вызывать нужный контроллкр в зависимости от запроса
 */
class Application
{
    /**
     * Свойство хранит объект обработчика конфигурации, в том числе и данные
     *
     * @var Config
     */
    private $config;

    /**
     * В этом свойстве хранится объект DatabaseConnection с установленным соединением
     * @var \PDO
     */
    private $databaseConnection;

    /**
     * @var Router $router
     */
    private $router;

    /**
     * Храним здесь имя файла конфигурации для того чтобы использовать его в методе boot()
     *
     * @var string
     */
    private $configFileName;

    /**
     * @var Container
     */
    private $container;

    /**
     * Сначала передадим в класс имя файла конфигурации для того чтобы его загрузить
     *
     * @param string $configFileName
     */
    public function __construct(string $configFileName)
    {
        $this->configFileName = $configFileName;

        // начинаем загрузку
        $this->boot();
        $this->registerServices();
    }

    /**
     * Запускает приложение
     */
    public function run()
    {
        $controllerInfo = $this->router->getRouteInfo();
        $controllerPrefix = '\Hillel\\Controller\\';

        $controller = $controllerPrefix . $controllerInfo['controller'];
        /** @var BaseController $controller */
        $controller = new $controller();
        $controller->setContainer($this->container);
        $action = $controllerInfo['action'];
        $controller->$action();
    }
    /**
     * Метод загружает и инициализирует все компоненты приложения,
     * а также обрабатывает возможные исключения на этом этапе
     */
    private function boot()
    {
        try {
            // Сначала загружаем конфигурацию
            $this->config = new Config($this->configFileName);

            $routerConfig = $this->config->get('router');
            $this->router = new Router(Config::CONFIG_DIR . $routerConfig['router_file']);

            // Устанавливаем соединение с базой данных с использованием полученных настроек
            $this->databaseConnection = new DatabaseConnection($this->config->get('database'));
            $this->container = new Container();
        } catch (\Exception $e) {
            echo $e;
            exit;
        }
    }

    private function registerServices()
    {
        $this->container->set('db', $this->databaseConnection->getPdo());
    }
}
