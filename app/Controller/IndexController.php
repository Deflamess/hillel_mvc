<?php

namespace Hillel\Controller;

use Hillel\Model\UserModel;

class IndexController extends BaseController
{
    public function renderIndex()
    {

        $userModel = new UserModel($this->getContainer()->get('db'));

        /*$this->id = $userModel->save(
            [
                'name' => 'test',
                'age' => 33,
                'email' => 'tet@n.v',
                'address' => 'hillel'
            ]
        );
        //var_dump($id);
        // die;
        $users['data'] = $userModel->findAll();*/
        $this->render('index/index', []);
    }
}