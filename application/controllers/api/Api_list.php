<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Api_list extends REST_Controller{

       public function index_get(){}


       public function list_log_login_get(){

              $this->load->model('Model_User');
              $data = $this->Model_User->Get_log_login();
              echo json_encode($data,JSON_PRETTY_PRINT);

       }

       public function list_token_get(){

              $main = $this->db->select('*')
                            ->get('lb_token')
                            ->result_array();
              echo json_encode($main,JSON_PRETTY_PRINT);

       }


}
