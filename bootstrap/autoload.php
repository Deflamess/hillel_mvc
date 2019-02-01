<?php

function autoload($className)
{
    $prefix = 'Hillel\\';

    // базовая директория для префикса пространства имен
    $baseDir = __DIR__ . '/../app/';

    // проверка на то использует ли класс префикс пространства имен
    $len = strlen($prefix);
    if (strncmp($prefix, $className, $len) !== 0) {
        // если нет, то грузим следующий автолоадер если он зарегистрирован
        return;
    }

    // получаем относительно имя класс
    $relativeClass = substr($className, $len);

    // составляем путь к файлу используя базовый путь и относительное имя класса
    // в конце добавляем .php
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // если файл есть - подключаем его
    if (file_exists($file)) {
        require $file;
    }
}
