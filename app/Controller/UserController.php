<?php


namespace Hillel\Controller;

use Hillel\Model\User;

class UserController extends BaseController
{
    public function showUser()
    {
        $userModel = new User($this->getContainer()->get('db'));

        /*$this->id = $userModel->save(
            [
                'name' => 'test2',
                'age' => 33,
                'email' => 'test@n.v',
                'address' => 'hillel'
            ]
        );*/
        //var_dump($id);
        // die;
        $users['data'] = $userModel->findAll();
       $this->render('users/userShow', $users);
    }
}