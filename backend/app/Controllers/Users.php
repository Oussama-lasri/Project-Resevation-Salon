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
        $data = json_decode(file_get_contents('php://input'));
        $this->modelUser->first_name = $data->first_name;
        $this->modelUser->last_name = $data->last_name;
        $this->modelUser->phone = $data->phone;
        $this->modelUser->token = $this->token();

        if ($this->modelUser->addUser()) {
            echo json_encode(
                array('message' => 'user Created',
                    'user' => $this->modelUser->addUser())
            );
        } else {
            echo json_encode(
                array('message' => 'User Not Created')
            );
        }
    }

    public function checkToken(){
        $token  = json_decode(file_get_contents('php://input'))->token;
        $this->modelUser->token = $token;
        if($this->modelUser->checkToken()){
            echo json_encode(
                array('message' => 'Found',
                        'user'=>$this->modelUser->checkToken(),
                        )
            ); 
        }else{
            echo json_encode(
                array('message' => 'User Not found')
            );
        }
    }

    public function lastUser(){
        return $this->modelUser->lastInsertId();
    }
    public function token()
    {
        $token = base64_encode(openssl_random_pseudo_bytes(32));
        return $token;
    }
}
