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
        // book from a data store e.g. database  

        $id = $this->input->get('idAccount');

        // If the id parameter doesn't exist return all books
        if ($id === NULL)
        {
            $saldo=$this->Pankki_model->get_saldo(NULL);
            // Check if the book data store contains book (in case the database result returns NULL)
            if ($saldo)
            {
                // Set the response and exit
                $this->response($saldo, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No book were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

         // Find and return a single record for a particular book.
        else {
            // Validate the id.
            if ($id <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the book from the database, using the id as key for retrieval.
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
        // book from a data store e.g. database  

        $id = $this->input->get('idAccount');

        // If the id parameter doesn't exist return all books
        if ($id === NULL)
        {
            $tapahtumat=$this->Pankki_model->get_tapahtumat(NULL);
            // Check if the book data store contains book (in case the database result returns NULL)
            if ($tapahtumat)
            {
                // Set the response and exit
                $this->response($tapahtumat, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No book were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

         // Find and return a single record for a particular book.
        else {
            // Validate the id.
            if ($id <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the book from the database, using the id as key for retrieval.
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
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Tilillä ei katetta'
            ], REST_Controller::HTTP_CONFLICT); // CAN NOT CREATE (409) being the HTTP response code
        }
    }
}