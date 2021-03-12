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
    }

    public function GetToken_get(){

        $jwtToken = $this->JWT->GenerateToken();
        echo json_encode(array('Token'=>$jwtToken));
    }

  
 


 

}
