<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Pankki extends REST_Controller {

    function __construct()
    {
       
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
       
        parent::__construct();

        $this->load->model('Pankki_model');
    }

    public function saldo_get()
    {
        

        $id = $this->input->get('idAccount');

        if ($id === NULL)
        {
            $saldo=$this->Pankki_model->get_saldo(NULL);
        
            if ($saldo)
            {
           
                $this->response($saldo, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
          
                $this->response([
                    'status' => FALSE,
                    'message' => 'No book were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

     
        else {
         
            if ($id <= 0)
            {
            
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

       
            $saldo=$this->Pankki_model->get_saldo($id);
            if (!empty($saldo))
            {
                $this->set_response($saldo, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'book could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

    }

    public function tapahtumat_get()
    {
     

        $id = $this->input->get('idAccount');

       
        if ($id === NULL)
        {
            $tapahtumat=$this->Pankki_model->get_tapahtumat(NULL);
        
            if ($tapahtumat)
            {
            
                $this->response($tapahtumat, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
        
                $this->response([
                    'status' => FALSE,
                    'message' => 'No book were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

     
        else {
       
            if ($id <= 0)
            {
        
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

         
            $tapahtumat=$this->Pankki_model->get_tapahtumat($id);
            if (!empty($tapahtumat))
            {
                $this->set_response($tapahtumat, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Tilillä ei tapahtumia'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

    }
 
    
    public function nosto_post() 
    {
        $idAccount=$this->post('idAccount');
        $idCard=$this->post('idCard');
        $Amount=$this->post('Amount');
        $result=$this->Pankki_model->nosto($idAccount, $idCard, $Amount);

        if($result)
        {
          $message = [

              'message' => 'Nosto onnistui'
          ];

            $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        }
        else
        {
         
            $this->response([
                'status' => FALSE,
                'message' => 'Tilillä ei katetta'
            ], REST_Controller::HTTP_CONFLICT); // CAN NOT CREATE (409) being the HTTP response code
        }
    }

    public function tili_get()
    {


        $idCard = $this->input->get('idCard');
        $Type = $this->input->get('Type');


  
        if ($idCard === NULL)
        {
            $tili=$this->Pankki_model->get_tili(NULL);
      
            if ($tili)
            {
           
                $this->response($tili, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
      
                $this->response([
                    'status' => FALSE,
                    'message' => 'No book were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }


        else {
          
            if ($idCard <= 0)
            {
              
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

         
            $tili=$this->Pankki_model->get_tili($idCard,$Type);
            if (!empty($tili))
            {
                $this->set_response($tili, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Tiliä ei löydy'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

    }
}