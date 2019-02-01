<?php

namespace Hillel\Application;

use PDO;

/**
 * Данный класс служит для установления связи с базой данных,
 * а текже предоставляет метод который возвращает установленное соединение
 */
class DatabaseConnection
{
    /**
     * В конструктор передаем параметры подключения и пытаемся подключится к базе данных,
     * конструктор так же бросает исключение PDOException, оно будет ловиться в метода boot() класса Application
     * @param array $connectionSettings
     * @return \PDO
     */
    public function __construct(array $connectionSettings)
    {
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        return new PDO(
            sprintf('mysql:host=%s;port=%s;dbname=%s',
                $connectionSettings['host'],
                $connectionSettings['port'],
                $connectionSettings['database_name']
            ),
            $connectionSettings['username'],
            $connectionSettings['password'],
            $options
        );
    }
}
