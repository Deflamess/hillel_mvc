<?php


namespace Hillel\Controller;

use Hillel\Model\UserModel;


class UserController extends BaseController
{
    public $postData = [];

    public function showUser()
    {
        $userModel = new UserModel($this->getContainer()->get('db'));

        $users['data'] = $userModel->findAll();

        $this->render('users/userShow', $users);
    }

    public function addUser()
    {
        try {
            $userModel = new UserModel($this->getContainer()->get('db'));

            if ( !empty($_POST) ) {

                foreach ($_POST as $key => $value) {
                    // if email exists in DB throw Exception
                    if (!$userModel->emailExists($value))
                        $this->postData[$key] = $value;
                    else
                        throw new MyException("Inputed email exists");
                }
                $this->id = $userModel->save($this->postData);
            }
        } catch (MyException $e) {
            echo "<h2>  $e  </h2>";
        }

        $this->render('index/index', $this->postData);
        //var_dump($this->postData);

        //return $this->postData;
    }

}