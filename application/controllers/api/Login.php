<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function index_get(){
        $this->load->model('Login_model');
        $idCard=$this->input->get('idCard');
        $plaintext_pin=$this->input->get('Pin');
        $encrypted_pin=$this->Login_model->check_login($idCard);

        if(password_verify($plaintext_pin,$encrypted_pin)){
          $result=true;
        }
        else{
          $result=false;
        }
        echo json_encode($result);
    }
}
