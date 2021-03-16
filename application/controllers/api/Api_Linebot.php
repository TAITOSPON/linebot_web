<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');
require(APPPATH .'/libraries/CreatorJwt.php');


class Api_Linebot extends REST_Controller{

    public function index_get(){}

    public function __construct() {
         
         parent::__construct();
         $this->JWT = new CreatorJwt();
         header('Content-Type: application/json');
         $this->load->model('Model_HelpCenter');
    }

 

    public function GetToken_get(){

        $jwtToken = $this->JWT->GenerateToken();
        echo json_encode(array('Token'=>$jwtToken));
    }

    public function GetFeedback_get(){
       
        $result = $this->Model_HelpCenter->GetFeedback(); 

        for($i=0; $i < sizeof($result); $i++){
            $feedback_log_result = $result[$i]['feedback_log_result'];
            $result[$i]['feedback_log_result'] = array(json_decode($feedback_log_result , true));
        }

        echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    }

  
 


 

}
