<?php

namespace Hillel\Controller;

use Hillel\Application\ContainerTrait;

abstract class BaseController
{
    use ContainerTrait;

    /**
     * @param string $templateName
     * @param array $variables
     * @throws \Exception
     */
    protected function render(string $templateName, array $variables)
    {
        $templateName = TEMPLATES_DIR . $templateName . '.phtml';
        if (!file_exists($templateName)) {
            throw new \Exception('Template not found');
        }

        extract($variables);

        include_once($templateName);
    }
}