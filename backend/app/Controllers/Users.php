<?php
class Users extends Controller
{

    private $modelUser;
    public function __construct()
    {
        $this->modelUser = $this->model('User');
    }

    public function addUser()
    {
        $this->modelUser->first_name = 'maroine';
        $this->modelUser->last_name = 'ait lhaj';
        $this->modelUser->phone = '123456789';
        $this->modelUser->token = 'random';

        if ($this->modelUser->addUser()) {
            echo json_encode(
                array('message' => 'user Created')
            );
        } else {
            echo json_encode(
                array('message' => 'User Not Created')
            );
        }


        // die('success');

    }

    public function index()
    {
    }
}
