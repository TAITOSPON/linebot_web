<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Api_Leave extends REST_Controller{

     public function index_get(){}


     public function Leave_user_post(){

          $data = json_decode(file_get_contents('php://input'), true);
          $this->load->model('Model_User');
          $result = $this->Model_User->Get_user_ad_with_line_uid($data);  
          // return json_encode($query,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); 
          echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

     }


     
     public function Leave_year_post(){

          $data = json_decode(file_get_contents('php://input'), true);
          $this->load->model('Model_User');
          $result = $this->Model_User->Get_user_ad_with_line_uid($data);  
          
          
          // $user_ad_code = $result[0]["user_ad_code"];
          $user_ad_code = "003259";
          $leave_year = $data["leave_year"];
               
          $leave_head = $this->get_leave_year($user_ad_code,$leave_year);
          $leave_detail = $this->get_leave_year_detail($user_ad_code,$leave_year);
               
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

     public function get_leave_year($user_ad_code,$leave_year){
          // http://192.168.0.51/memberapi/api/leaveyearapi?id=003259&year=2562
          $file = "http://192.168.0.51/memberapi/api/leaveyearapi?id=".$user_ad_code."&year=".$leave_year;
          $data = json_decode(file_get_contents($file), true);
          return $data;

     }

     public function get_leave_year_detail($user_ad_code,$leave_year){
          // http://192.168.0.51/memberapi/api/leaveyeardetailapi?id=003259&year=2562
          $file = "http://192.168.0.51/memberapi/api/leaveyeardetailapi?id=".$user_ad_code."&year=".$leave_year;
          $data = json_decode(file_get_contents($file), true);  
       
          $leave_vacation = array();
          $leave_leave = array();

          for ($i = 0; $i < sizeof($data); $i++) {
               
               if($data[$i]["LeaveType"] == "04"){

                    array_push($leave_vacation,$data[$i]);

               }else if($data[$i]["LeaveType"] == "03"){

                    array_push($leave_leave,$data[$i]);

               }

          }

          $data = array(
               'leave_vacation' =>  $leave_vacation,
               'leave_leave' => $leave_leave
          );

          return $data;

     }


}
