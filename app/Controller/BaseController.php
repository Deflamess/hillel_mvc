<?php

namespace Hillel\Controller;

abstract class BaseController
{
    const TEMPLATES_DIR = __DIR__. '/../../views';

    protected function render(string $templateName, array $variables)
    {
        $templateName = self::TEMPLATES_DIR . DIRECTORY_SEPARATOR . $templateName . '.phtml';
        if (!file_exists($templateName)) {
            throw new \Exception('Template not found');
        }
        $var = $variables;
        include_once($templateName);
    }
}