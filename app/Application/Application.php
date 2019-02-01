<?php

namespace Hillel\Application;

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
     * Храним здесь имя файла конфигурации для того чтобы использовать его в методе boot()
     *
     * @var string
     */
    private $configFileName;
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

            // Устанавливаем соединение с базой данных с использованием полученных настроек
            $this->databaseConnection = new DatabaseConnection($this->config->get('database'));
        } catch (\Exception $e) {
            echo $e;
            exit;
        }
    }
}
