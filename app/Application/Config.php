<?php

namespace Hillel\Application;

/**
 * Класс для загрузки конфигурации,
 * именно этот файл должен будет разобрать ini файл и вернуть его как масси
 *
 */
class Config
{
    const CONFIG_DIR = __DIR__ . '/../../config/';
    /**
     * Массив в котором будут хранится обработанный файл конфигурации
     *
     * @var array
     */
    private $config = [];

    /**
     * Конструктор парсит ini файл и сохраняет его в свойство $config
     * для того чтобы получать из него данные методом get()
     *
     * @param string $fileName
     * @throws \Exception
     */
    public function __construct(string $fileName)
    {
        // Перед тем как работать с файлом, сначала нужно проверить если ли он физически
        if (!file_exists($fileName)) {
            // Если файла нет, бросаем исключение
            throw new \Exception('Configuration file does not exists or not readable');
        }

        // парсим ini файл с секциями и сохраняем его в свойстве config
        $this->config = parse_ini_file($fileName, true);
    }

    /**
     * Метод получает конфигурацию из массива по секции которая была передана
     * Если секции нет, бросаем ислючение
     *
     * @param string $section
     * @return array
     * @throws \Exception
     */
    public function get(string $section): array
    {
        // Проверяем если ключ (секция) в массиве настроек
        // Если нет, то бросам исключение
        if (!isset($this->config[$section])) {
            throw new \Exception(sprintf('%s section was not found'));
        }

        // Секция найдена, возвращаем ее значение
        return $this->config[$section];
    }
}
