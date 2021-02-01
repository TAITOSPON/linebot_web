<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Api_TImeAt extends REST_Controller{

     public function index_get(){}


     public function TimeAt_feed_post(){
          
          $data = json_decode(file_get_contents('php://input'), true);

          $this->load->model('Model_User');
          $result = $this->Model_User->Get_user_ad_with_line_uid($data);  
        
          $user_ad_code = $result[0]["user_ad_code"]; 
        
          $this->load->model('Model_TimeAt');
          $result_timeat = $this->Model_TimeAt->get_time_feed($user_ad_code);  
          $result_timeat = json_decode($result_timeat);

         
          $data = array('result_user' => $result , 'result_time_at'=>$result_timeat);
          $data = array('status' => "true",'result'=> $data);

          echo json_encode($data,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

     }

     public function TimeAt_feed_with_ad_post(){

          $data = json_decode(file_get_contents('php://input'), true);

          $user_ad_code = $data["user_ad_code"]; 
          $this->load->model('Model_User');
          $result = $this->Model_User->Get_line_uid_with_user_ad($data);  

          $this->load->model('Model_TimeAt');
          $result_timeat = $this->Model_TimeAt->get_time_feed($user_ad_code);  
          $result_timeat = json_decode($result_timeat);

         
          $data = array('result_user' => $result , 'result_time_at'=>$result_timeat);
          $data = array('status' => "true",'result'=> $data);

          echo json_encode($data,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

     }




    


}
