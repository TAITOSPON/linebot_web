<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Api_Leave extends REST_Controller{

       public function index_get(){}

       
       public function Leave_year_post(){

            $data = json_decode(file_get_contents('php://input'), true);
           
           
            // $this->load->model('Model_User');
            // $result = $this->Model_User->Set_user_logout($data);  
            // echo json_encode($data,JSON_PRETTY_PRINT);


            // http://192.168.0.51/memberapi/api/leaveyearapi?id=003599&year=2563

            $user_ad_code =  $data["user_ad_code"];
            $leave_year = $data["leave_year"];

            echo $user_ad_code;
            
            // $file = "http://192.168.0.51/memberapi/api/leaveyearapi?id=.$user_ad_code.&year=".$leave_year;
            // $data = file_get_contents($file);
            // $data = mb_substr($data, strpos($data, '{'));
            // $data = mb_substr($data, 0, -1);
            // $result = json_decode($data, true);

            // echo $result;

            // {
            //     "user_ad_code": "003599",
            //     "leave_year": "2563"
            // }
 
       }

      



      



}
