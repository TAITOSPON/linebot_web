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
    public function GetAllUserStampWFH_get(){
       
        $result = $this->Model_HelpCenter->GetAllUserStampWFH(); 
        echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      
        // $this->Check($result);
     

       

    }

    // public function Check($query){

    //     $status = "TRUE";

    //     for($i=0; $i < sizeof($query); $i++){

            
    //         if( $query[$i]["time_stamp_log_province"] == "empty"){

    //             $status = "FALSE";
    //         }
    //     }

    //     if($status == "FALSE"){

    //         $result = $this->Model_HelpCenter->RE_GetAllUserStampWFH($query); 
        
    //         $this->Check($result);

    //     }else{

    //         echo json_encode($query,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    //     }

    // }
       


    public function GeAllUserStamp_post(){
        $data = json_decode(file_get_contents('php://input'), true);

        $result = $this->Model_HelpCenter->RE_GetAllUserStampWFH($data); 
        echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        
        // echo json_encode($data,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    }
    

    public function GetData_get(){
       
        $result = $this->Model_HelpCenter->GetData_Issue(); 
        echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    }

  
 


 

}
