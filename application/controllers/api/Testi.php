<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a RestApi based on PHP and CodeIgniter 3.
 * 
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Pekka Alaluukas (edited the version made by Phil Sturgeon & Chris Kacerguis)
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Testi extends REST_Controller {

    function __construct()
    {
        //enable cors
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // Construct the parent class
        parent::__construct();

        $this->load->model('Testi_model');
    }

    public function index_get()
    {
        // Testi from a data store e.g. database  

       // $id = $this->input->get('id');
       $id = $this->uri->segment(3);
       // segment(3) on siis kolmas parametri urlissa

        // If the id parameter doesn't exist return all Testis
        if ($id === NULL)
        {
            $Testi=$this->Testi_model->get_testi(NULL);
            // Check if the Testi data store contains Testi (in case the database result returns NULL)
            if ($Testi)
            {
                // Set the response and exit
                $this->response($Testi, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No Testi were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

         // Find and return a single record for a particular Testi.
        else {
            // Validate the id.
            if ($id <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the Testi from the database, using the id as key for retrieval.
            $Testi=$this->Testi_model->get_testi($id);
            if (!empty($Testi))
            {
                $this->set_response($Testi, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Testi could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

    }

    public function index_post()
    {
        // Add a new Testi
        $add_data=array(
          'fname'=>$this->post('fname')
         
        );
        $insert_id=$this->Testi_model->add_testi($add_data);
        if($insert_id)
        {
            $message = [
                'id_Testi' => $insert_id,
                'fname' => $this->post('fname'),
                'message' => 'Added a resource'
            ];
            $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        }
        else
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Can not add data'
            ], REST_Controller::HTTP_CONFLICT); // CAN NOT CREATE (409) being the HTTP response code
        }

    }
    public function index_put()
    {
        // Update the Testi
        // $id=$this->input->get('id');
        $id = $this->uri->segment(3);
        $update_data=array(
          'fname'=>$this->put('fname')
        );
        $result=$this->Testi_model->update_testi($id, $update_data);

        if($result)
        {
            $message = [
                'id_Testi' => $id,
                'fname' => $this->put('fname'),
                'message' => 'Updates a resource'
            ];

            $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        }
        else 
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Can not update data'
            ], REST_Controller::HTTP_CONFLICT); // CAN NOT CREATE (409) being the HTTP response code
        }
    }

    public function index_delete()
    {
       // $id = $this->input->get('id');
          $id = $this->uri->segment(3);

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        $result=$this->Testi_model->delete_testi($id);
        if ($result)
        {
          $message = [
              'id_Testi' => $id,
              'message' => 'Deleted the resource'
          ];
          $this->set_response($message, REST_Controller::HTTP_OK);
        }
        else
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Can not delete data'
            ], REST_Controller::HTTP_CONFLICT); // CAN NOT CREATE (409) being the HTTP response code
        }
    }



}
