<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Api_Leave extends REST_Controller{

     public function index_get(){}


     // public function Leave_user_post(){

     //      $data = json_decode(file_get_contents('php://input'), true);
     //      $this->load->model('Model_User');
     //      $result = $this->Model_User->Get_user_ad_with_line_uid($data);  
     //      // return json_encode($query,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); 
     //      echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

     // }

     public function Leave_year_select_post(){
          
          $data = json_decode(file_get_contents('php://input'), true);
          $this->load->model('Model_User');
          $result = $this->Model_User->Get_user_ad_with_line_uid($data);  
        
          $user_ad_code = $result[0]["user_ad_code"]; 
          // $user_ad_code = "003259";

          $this->load->model('Model_Leave');
          $leave_year = $this->Model_Leave->get_leave_year($user_ad_code);
          echo json_encode($leave_year,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

     }

    
     
     public function Leave_year_post(){

          // $data = json_decode(file_get_contents('php://input'), true);

          $data['user_line_uid'] = $this->input->post('user_line_uid');
          $data['leave_year'] = $this->input->post('leave_year');
          $data['user_ad_code'] = $this->input->post('user_ad_code');
        
          $this->load->model('Model_User');
          $result = $this->Model_User->Get_user_ad_with_line_uid($data);  
       
          $user_ad_code = $data['user_ad_code'];
          //  $user_ad_code = "003259";
          $leave_year = $data["leave_year"];
          
          $this->load->model('Model_Leave');
          $leave_head = $this->Model_Leave->get_leave_head_year($user_ad_code,$leave_year);
          $leave_detail = $this->Model_Leave->get_leave_detail_year($user_ad_code,$leave_year);
               
          $result = array(
               'user' => $result[0], 
               'leave_head' => $leave_head, 
               'leave_detail' =>  $leave_detail
          );

          $result = array(
               'status' => true, 
               'result' => $result
          );

          echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

     }

}
