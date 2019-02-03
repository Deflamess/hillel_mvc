<?php

namespace Hillel\Controller;

class IndexController extends BaseController
{
    public function index()
    {
        $username = 'Vasia';

        return $this->render('index/index', [$username]);
    }
}