<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\Event;

class ApiController extends AppController
{

    public $errors;
    public $data;
    public $success;
    public $header;
    protected $user;
    public $user_id;
    

    public function initialize()
    {
        parent::initialize();
        
        $this->errors = [];
        $this->success = true;
        $this->header = NULL;
        $this->data = [];

        $this->components()->unload('Security');
        $this->loadComponent('RequestHandler'); 
        $this->response->type('application/json');
        $this->isJsonResponse = true;
        $this->RequestHandler->renderAs($this, 'json');
        $this->initAuth();        
    }

    /**
     * Initialise basic auth for the API endpoints    
     */
    public function initAuth() 
    {
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Basic' => [
                    'fields' => ['username' => 'username', 'password' => 'api_key'],
                    'userModel' => 'Users'
                ],
            ],
            'storage' => 'Memory',
            'unauthorizedRedirect' => false
        ]);

        $this->user = $this->Auth->identify();

        if (!$this->user) {
            $this->success = false;
            $this->data = [];
            $this->errors = ['Access denied'];
            $this->header = 'denied';
            $this->returnResponse();
        } else {
            $this->user_id = $this->user['id'];
        }                
    }

    /**
     * Based on the response data and success set the http header   
     */
    public function setResponseHeader() 
    {                
        // if success is false and no header set, assume a generic error code
        $this->header = $this->success == false && $this->header == NULL ? 'error' : $this->header;

        switch ($this->header) {
            case 'created':
                    $code = "201";
                    $message = "created";
                break;

            case 'error':
                    $code = "400";
                    $message = "error";
                break;

            case 'denied':
                    $code = "403";
                    $message = "denied";
                break;

            case 'no_results':
                    $code = "404";
                    $message = "no resources found";
                break;               
            
            default:
                    $code = "200";
                    $message = "success";
                break;
        }

        $this->response->header("HTTP/1.0 $code", $message);       
    }  
    
    /**
     * Based on the response data and success set the return values to standard no resource found
     */
    function checkNoResults() 
    {                
        if(empty(($this->data)) && empty($this->errors)) {
            $this->success = false;
            $this->errors = ['No resources found.'];
            $this->header = 'no_results';
        }
    } 

    /**
     * Standard output function for all API responses
     */
    function returnResponse() 
    {          
        $this->checkNoResults();   
        $this->setResponseHeader();
        $this->set(['success' => $this->success, 'data' => $this->data, 'errors' => $this->errors]);
    } 
    
}