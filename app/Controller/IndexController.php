<?php

namespace Hillel\Controller;

use Hillel\Model\Message;
use Hillel\Model\User;

class IndexController extends BaseController
{
    public function renderIndex()
    {
        $messageModel = new Message($this->getContainer()->get('db'));

        /*$datetime = new \DateTime();
        $this->id = $messageModel->save(
            ['message' => 'test2', 'created_at' => $datetime->format("Y-m-d H:i:s")
            ]
        );*/
        //var_dump($id);
        // die;
        $messages['data'] = $messageModel->findAll();
        $this->render('index/index', $messages);

        //work perfect and renders userShow template at URI == /
       /*$userModel = new User($this->getContainer()->get('db'));

        $this->id = $userModel->save(
            [
                'name' => 'test2',
                'age' => 33,
                'email' => 'test@n.v',
                'address' => 'hillel'
            ]
        );
        //var_dump($id);
        // die;
        $users['data'] = $userModel->findAll();
        $this->render('users/userShow', $users);*/
    }
}