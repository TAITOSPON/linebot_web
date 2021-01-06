<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Api_User extends REST_Controller{

       public function index_get(){}

       
       public function User_logout_post(){

              $data = json_decode(file_get_contents('php://input'), true);
              $this->load->model('Model_User');
              $result = $this->Model_User->Set_user_logout($data);  
              echo json_encode($result,JSON_PRETTY_PRINT);
 
       }

       public function User_check_login_post(){

              $data = json_decode(file_get_contents('php://input'), true);
              $this->load->model('Model_User');
              $result = $this->Model_User->Get_user_login($data);  
              echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
 
       }

       public function User_with_uid_post(){

              $data = json_decode(file_get_contents('php://input'), true);
              $this->load->model('Model_User');
              $result = $this->Model_User->Get_user_ad_with_line_uid($data);  
              echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

       }


       public function User_uid_with_ad_post(){

              $data = json_decode(file_get_contents('php://input'), true);
              $this->load->model('Model_User');
              $result = $this->Model_User->Get_line_uid_with_user_ad($data);  
              echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
       }



     

}
