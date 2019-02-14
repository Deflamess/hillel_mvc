<?php

namespace Hillel\Controller;

use Hillel\Model\Message;

class IndexController extends BaseController
{
    public function index()
    {
        $messageModel = new Message($this->getContainer()->get('db'));

        $datetime = new \DateTime();
        $id = $messageModel->save(
            ['message' => 'test2', 'created_at' => $datetime->format(DATE_RFC3339)
            ]
        );
        var_dump($id);
        die;
//        $messages['data'] = $messageModel->findAll();
        $this->render('index/index', $messages);
    }
}