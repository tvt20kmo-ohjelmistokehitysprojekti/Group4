<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Login extends REST_Controller {

    function __construct()
    {
        //enable cors
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // Construct the parent class
        parent::__construct();
    }

    public function login_post(){
        $this->load->model('Login_model');
        $idCard=$this->post('idCard');
        $plaintext_password=$this->post('Pin');
        
        $encrypted_password=$this->Login_model->login($idCard);

        if(password_verify($plaintext_password,$encrypted_password)){
            $result=true;
        }
        else{
            $result=false;
        }
        echo json_encode($result);
    }
}
