<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Api_list extends REST_Controller{

       public function index_get(){}


       public function list_log_login_get(){

              $main = $this->db->select('*')
                            ->get('lb_login_log')
                            ->result_array();
              echo json_encode($main,JSON_PRETTY_PRINT);

       }

       public function list_token_get(){

              $main = $this->db->select('*')
                            ->get('lb_token')
                            ->result_array();
              echo json_encode($main,JSON_PRETTY_PRINT);

       }


}
