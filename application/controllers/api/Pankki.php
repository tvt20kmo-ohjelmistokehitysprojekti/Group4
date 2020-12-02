<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . 'libraries/REST_Controller.php';


class Pankki extends REST_Controller {

    function __construct()
    {
        //enable cors
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: POST");
        // Construct the parent class
        parent::__construct();

        $this->load->model('Pankki_model');
    }
    public function nosto_post() 
    
        $add_data=array(
          'Amount'=>$this->post('Amount'),
          'idAccount'=>$this->post('idAccount')
        );
        if ($add_data["Amount"]==NULL || $add_data["idAccount"]==NULL){
            $this->response([
                'status' => FALSE,
                'message' => 'Bad Reguest'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else{

        $message=$this->Pankki_model->nosto($add_data); 
       
                    
        $this->response($message, REST_Controller::HTTP_OK);
        }
    }
    
    public function Saldo_post()   
    {
        $idAccount = $this->post('idAccount');

        $message=$this->Pankki_model->get_saldo($idAccount);  
        if(!$message){
            $this->response([
                'status' => FALSE,
                'message' => 'Bad Reguest'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else{
            $this->response($message, REST_Controller::HTTP_OK);
        }
    }
    public function Transaction_post()   
    { 
        $idAccount = $this->post('idAccount'); 
            $message=$this->Pankki_model->get_transacts($idAccount);
            if(!$message){
                $this->response([
                    'status' => FALSE,
                    'message' => 'Bad Reguest'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
            else{
            $this->response($message, REST_Controller::HTTP_OK);
            }
    }
    public function Login_post(){ 

        $idCard=$this->post('idCard');
        $Pin=$this->post('Pin');
               
        
        if ($idCard===NULL || $Pin ===NULL){
            $this->response([
                'status' => FALSE,
                'message' => 'Bad Reguest'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else{ 
            $encrypted_password=$this->Pankki_model->check_login($idCard);

            if(password_verify($Pin,$encrypted_password)){
            
                $result = TRUE;
            }
            else{
            $result = FALSE;
            }
            $this->response($result, REST_Controller::HTTP_OK);
        }

    }

    public function Update_pwd_post() 
    {
        
        $clear_password=$this->post('Pin');
        $encrypted_pass = password_hash($clear_password,PASSWORD_DEFAULT);
        $update_data=array(
          'Pin'=>$encrypted_pass,
          'idCard'=> $this->post('idCard')
        );
        $result=$this->Pankki_model->update_password($update_data);

        if($result)
        {
          $message = 'success';

            $this->set_response($message, REST_Controller::HTTP_CREATED); 
        }
        else
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Can not update data'
            ], REST_Controller::HTTP_CONFLICT); 
        }
    }
    
    public function Fetch_account_post()
    {   

        $add_data=array(
        'idCard' => $this->post('idCard'),
        'Type' => $this->post('Type')
        );
        $idAccount=$this->Pankki_model->fetch_accounts($add_data);

        if(!$idAccount){
            $this->response([
                'status' => FALSE,
                'message' => 'Bad Reguest'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else{
        $this->response($idAccount, REST_Controller::HTTP_OK);
        }
        
    }

    public function Name_post(){ 
        $idCard = $this->post('idCard');

        $name=$this->Pankki_model->name($idCard);
        if(!$name){
            $this->response([
                'status' => FALSE,
                'message' => 'Bad Reguest'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else{
        $this->response($name, REST_Controller::HTTP_OK);
        }
    }
}