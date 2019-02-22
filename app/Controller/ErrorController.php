<?php

namespace Hillel\Controller;

use Hillel\Model\Message;


class ErrorController extends BaseController
{
    public function show404()
    {
        return $this->render('errors/404', []);
    }
}


