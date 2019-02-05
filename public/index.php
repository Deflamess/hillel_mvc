<?php

/**
 * Точка входа в приложение, все запросы сервер должен перенаправлять на этот файл
 *
 * Сначала подключаем автозагрузчик классов
 */
require_once __DIR__ . '/../bootstrap/autoload.php';
// Регистрируем автозагрузчик, если класс не будет найден сразу,
// PHP будет использовать загрузчик чтобы найти нужный класс
spl_autoload_register('autoload');

// Подключаем класс приложения
use Hillel\Application\Application;

// Указываем расположения файла конфигурации
$configFile = __DIR__ . '/../config/app.ini';

$app = new Application($configFile);
$app->run();
