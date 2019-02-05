<?php

namespace Hillel\Controller;

class ErrorController extends BaseController
{
    public function show404()
    {
        $error = 404;

        return $this->render('errors/404', [$error]);
    }
}