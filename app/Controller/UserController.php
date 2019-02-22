<?php


namespace Hillel\Controller;

use Hillel\Model\UserModel;

class UserController extends BaseController
{

    public $postData = [];
    public $errors = [];
    public function showUser()
    {
        $userModel = new UserModel($this->getContainer()->get('db'));

        $users['data'] = $userModel->findAll();

        //debug
        $id = $this->getContainer()->get('id');
        echo "showUser $id";

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
                        throw new \Exception("Inputed email exists");
                }
                $this->id = $userModel->save($this->postData);
            }
        } catch (\Exception $e) {
            //echo "Error: " . $e->getMessage();
            $this->errors['error'] = $e->getMessage();
            $this->render('errors/EmailExistsInDB', $this->errors);
        }

        $this->render('index/index', $this->postData);

    }

    public function deleteUser()
    {
       //debug
        $id = $this->getContainer()->get('id');
        var_dump($id);
        echo "deleteUser id:$id";

        $userModel = new UserModel($this->getContainer()->get('db'));

        $userModel->deleteUserById($id);

        $users['data'] = $userModel->findAll();

        $this->render('users/userDelete', $users);

    }

}