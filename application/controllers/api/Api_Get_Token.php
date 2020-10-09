<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Api_Get_Token extends REST_Controller
{
	public function Api_Get_Token_get()
	{
		 $token = array(
            'cookie_name' => $this->config->item('csrf_cookie_name'),
            'name' => $this->security->get_csrf_token_name(),
            'key' => (!$this->security->get_csrf_hash())?"X":$this->security->get_csrf_hash()
        );
        echo json_encode($token);
      
	}
}